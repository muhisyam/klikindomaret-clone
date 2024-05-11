<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ModalOrderUserResource;
use App\Http\Resources\OrderUserResource;
use App\Models\Order;
use App\Models\User;
use App\Services\OrderService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct(
        protected OrderService $orderService,
    ) {}

    public function store(array $request): void
    {
        DB::transaction(function () use ($request) {
            $order = Order::create($request['order_data']);
    
            $order->products()->attach($request['product_ids']);
            $order->retailers()->attach($request['retailer_ids']);
        });
    }

    public function showUserOrder(User $user, Request $request): JsonResource
    {
        $userOrders = $this->getDataShowUserOrder($user, $request);

        if (! $this->orderService->ensureDontHasFreshOrder($userOrders)) {
            $userOrders = $this->getDataShowUserOrder($user, $request);
        }

        return OrderUserResource::collection($userOrders);
    }

    private function getDataShowUserOrder(User $user, Request $request): Collection
    {
        return $this->getUserOrderData(
            user           : $user,
            withSchema     : ['products', 'products.images'],
            withCountSchema: ['products'],
        )
        ->take($request['take_amount'])
        ->get();
    }

    public function showUserModalOrder(Request $request): ModalOrderUserResource
    {
        $userOrders     = Order::getUserModalOrder($request['order_key']);
        $sanitizedGroup = $this->orderService->sanitizeGroupBy($userOrders);

        return new ModalOrderUserResource($sanitizedGroup);
    }

    public function updateOnPending(User $user, Request $request, array $orderData = null): OrderUserResource
    {
        if ($orderData) {
            $userOrder  = $orderData['user_order'];
            $updateData = $orderData['new_data_order'];
        } else {
            $userOrder  = null;
            $updateData = $request;
        }

        $userOrder = $userOrder ?? $this->getUserOrderData($user, 'create')->first();

        $userOrder->update([
            'payment_channel'   => $updateData['payment_channel'],
            'va_number'         => $updateData['va_number'],
            'user_order_status' => Order::$userStatus[$updateData['order_status']],
        ]);

        return new OrderUserResource($userOrder);
    }

    public function updateOnProcess(User $user, Request $request): OrderUserResource
    {
        $userOrder = DB::transaction(function () use ($user, $request) {
            $userOrder           = $this->getUserOrderData($user, 'pending')->first();
            $dataDeliveryInfo    = $this->orderService->getDataPickupDateRelation($request);
            $retailersRelation   = $userOrder->retailers();
            $retailersIds        = $retailersRelation->pluck('id')->toArray();
            $retailerOrderStatus = Order::$retailerStatus['incoming'];

            $userOrder->update([
                'user_order_status' => Order::$userStatus[$request['order_status']],
                'pickup_code'       => $this->orderService->getPickupCode(),
                'pickup_expired'    => today()->addDays(3),
                'payment_channel'   => $request['payment_channel'],
                'va_number'         => $request['va_number'],
            ]);

            $userOrder->supplierDeliveries()->attach($dataDeliveryInfo);
            $retailersRelation->syncWithPivotValues($retailersIds, [
                'retailer_order_status' => $retailerOrderStatus,
                'message'               => Order::$retailerStatusMessage[$retailerOrderStatus],
            ]);

            app(CartController::class)->destroyCart($user->id);

            return $userOrder;
        });
        
        return new OrderUserResource($userOrder);
    }

    public function destroy(User $user): JsonResponse
    {
        $orderFromTheOven = $this->getUserOrderData($user, 'create')->first();

        if (! $orderFromTheOven) {
            return response()->json(['data' => []], 404);
        }

        $contentName = ['content_name' => $orderFromTheOven->order_key];
        
        $orderFromTheOven->delete();

        return response()->json(['data' => $contentName], 200);
    }

    private function getUserOrderData(User $user, string $orderStatus = null, array $withSchema = [], array $withCountSchema = []): object|null
    {
        return Order::query()
            ->whereBelongsTo($user)
            ->when($orderStatus, function($q) use ($orderStatus) {
                return $q->where('user_order_status', Order::$userStatus[$orderStatus]);
            })
            ->when($withSchema, function($q) use ($withSchema) {
                return $q->with($withSchema);
            })
            ->when($withCountSchema, function($q) use ($withCountSchema) {
                return $q->withCount($withCountSchema);
            });
    }
}
