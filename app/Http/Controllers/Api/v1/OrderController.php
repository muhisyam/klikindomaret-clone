<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ModalOrderUserResource;
use App\Http\Resources\OrderPageRetailerResource;
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
    /**
     * Meta data for success resource response.
     * 
     * @var array $metaSuccess
    */
    protected array $metaSuccess = [
        'meta' => [
            'status_code' => 200,
            'message'     => 'OK',
        ]
    ];

    public function __construct(
        protected OrderService $orderService,
    ) {}

    /**
     * Get user orders data for user page. 
     *
     * @param User $user
     * @param Request<string, mixed> $request
     */
    public function indexUserOrder(User $user, Request $request): JsonResource
    {
        $userOrders = $this->geDatatUserOrder($user, $request);

        if (! $this->orderService->ensureDontHasFreshOrder($userOrders)) {
            $userOrders = $this->geDatatUserOrder($user, $request);
        }

        return OrderUserResource::collection($userOrders);
    }

    private function geDatatUserOrder(User $user, Request $request): Collection
    {
        return $this->getUserOrderData(
            user           : $user,
            withSchema     : ['products', 'products.images'],
            withCountSchema: ['products'],
        )
        ->take($request['take_amount'])
        ->get();
    }

    /**
     * Get list retailer orders with spesific product to be taken according 
     * the retailer in admin page.
     *
     * @param User $user
     * @param Request<string, mixed> $request
     */
    public function indexRetailerOrder(User $user, Request $request): JsonResource
    {
        $retailer = $user->retailer;

        if (is_null($retailer)) {
            return [];
        }

        $containerIds   = $this->orderService->setSupplierAndRetailerId($retailer);
        $retailerOrders = Order::getListRetailerOrders($containerIds)->paginate($request['per_page'] ?? 10);

        return OrderPageRetailerResource::collection($retailerOrders)->additional($this->metaSuccess);
    }

    /**
     * Create new order, call when user click pay the order in checkout page.
     *
     * @param array<string, mixed> $request
     */
    public function store(array $request): void
    {
        DB::transaction(function () use ($request) {
            $order = Order::create($request['order_data']);
    
            $order->products()->attach($request['product_ids']);
            $order->retailers()->attach($request['retailer_ids']);
        });
    }

    /**
     * Get detail user order data for modal order user page. 
     *
     * @param User $user
     * @param Request<string, string> $request
     */
    public function showUserModalOrder(Request $request): ModalOrderUserResource
    {
        $userOrders     = Order::getUserModalOrder($request['order_key']);
        $sanitizedGroup = $this->orderService->sanitizeGroupBy($userOrders);

        return new ModalOrderUserResource($sanitizedGroup);
    }

    /**
     * Get detail retailer order with spesific product to be taken according 
     * the retailer in admin page.
     *
     * @param User $user
     * @param Order $order
     */
    public function showRetailerDetailOrder(User $user, Order $order): OrderPageRetailerResource
    {
        $containerIds   = $this->orderService->setSupplierAndRetailerId($user->retailer);
        $retailerOrders = $order->getDetailRetailerOrder($containerIds);

        return new OrderPageRetailerResource($retailerOrders);
    }

    /**
     * Update data when order payment is pending. 
     *
     * @param User $user
     * @param Request<string, mixed> $request
     * @param null|array<string, mixed> $orderData
     */
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

    /**
     * Update data when order payment is successfull then, the user cart will be deleted.. This will add relation data including;
     * - Delivery info each supplier
     * - Retailer that provide the product
     * 
     *
     * @param User $user
     * @param Request<string, mixed> $request
     */
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
                'payment_success'   => now(),
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

    /**
     * Update retailer pivot order status to current status according in retailer live store
     * 
     * @param User $user
     * @param Request<string, mixed> $request
     */
    public function retailerUpdateStatus(User $user, Order $order, Request $request): OrderPageRetailerResource
    {
        $retailerId = $user->retailer->id;
        $status     = $request->status;
        $message    = $request->message ?? Order::$retailerStatusMessage[$status];

        if ($request->status == 'complete') {
            $order->update(['order_completed' => now()]);
        }

        $order->retailers()->attach($retailerId, [
            'retailer_order_status' => $status,
            'message'               => $message,
        ]);

        return new OrderPageRetailerResource($order);
    }

    /**
     * Delete data order where order didnt have the payment.
     *
     * @param User $user
     */
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

    /**
     * Method for retrieving order that can reusable.
     *
     * @param User $user
     * @param string|null $orderStatus
     * @param array<int, string> $withSchema
     * @param array<int, string> $withCountSchema
     */
    private function getUserOrderData(User $user, string $orderStatus = null, array $withSchema = [], array $withCountSchema = []): object|null
    {
        return Order::query()
            ->whereBelongsTo($user)
            ->when($orderStatus, function($order) use ($orderStatus) {
                return $order->where('user_order_status', Order::$userStatus[$orderStatus]);
            })
            ->when($withSchema, function($order) use ($withSchema) {
                return $order->with($withSchema);
            })
            ->when($withCountSchema, function($order) use ($withCountSchema) {
                return $order->withCount($withCountSchema);
            });
    }
}
