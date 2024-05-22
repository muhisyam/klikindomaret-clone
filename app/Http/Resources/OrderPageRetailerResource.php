<?php

namespace App\Http\Resources;

use App\Services\OrderService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderPageRetailerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $orderService    = app(OrderService::class);
        $retailer        = $this->whenLoaded('retailers', $this->retailers[0], $this);
        $pickupExpired   = formatToIdnLocale(Carbon::parse($this->pickup_expired), 'j M Y');
        $paymentSuccsess = formatToIdnLocale(Carbon::parse($this->payment_success), 'j M Y | H:i') . ' WIB';
        $orderComplete   = is_null($this->order_completed) 
            ? '-'
            : formatToIdnLocale(Carbon::parse($this->order_completed), 'j M Y | H:i') . ' WIB';

        /**
         * Get incoming order datetime from when user finish the payment, 
         * then it will be explode to an array.
         * 
         * @var string $createdDatetime
        */
        $createdDatetime = explode('|', formatToIdnLocale(Carbon::parse($this->payment_success), 'j M Y|H:i'));
        $createdDate     = $createdDatetime[0];
        $createdTime     = $createdDatetime[1];

        return [
            'order_key'             => $this->order_key,
            'username'              => $this->user->fullname,
            'pickup_info'           => $this->pickup_info,
            'pickup_code'           => $this->pickup_code,
            'payment_channel'       => $this->payment_channel,
            'va_number'             => $this->va_number,
            'subtotal'              => $this->whenLoaded('products', $this->getSubtotal(), 0),
            'grandtotal'            => $this->whenLoaded('products', $this->getGrandtotal(), 0),
            'retailer_name'         => $retailer->retailer_name,
            'retailer_order_status' => $retailer->pivot->retailer_order_status,
            'pickup_expired'        => $pickupExpired,
            'payment_success'       => $paymentSuccsess,
            'order_completed'       => $orderComplete,
            'created_date'          => $createdDate,
            'created_time'          => $createdTime,
            'pickup_address'        => $orderService->getPickupAddress($this->pickupAddress), // TODO: pengn pake whenloaded, nnti di order service klo ga loaded return null
            'user'                  => new OrderRelationshipUserResource($this->whenLoaded('user')),
            'deliveries'            => new OrderRelationshipDeliveryResource($this->whenLoaded('supplierDeliveries', $this->supplierDeliveries[0]->pivot)),
            'products'              => OrderProductResource::collection($this->whenLoaded('products')),
            'products_count'        => count($this->products),
        ];
    }

    public function with(Request $request): array
    {
        return [
            'meta' => [
                'status_code' => 200,
                'message'     => 'OK',
            ],
        ];
    }

    /**
     * Sum total price all product (product price * quantity)
     * 
     * @return int
    */
    private function getSubtotal(): int
    {
        return $this->products->sum(fn ($product) => $product->pivot->price * $product->pivot->quantity);
    }

    /**
     * Sum total price including subtotal product + delivery price
     * 
     * @return int
    */
    private function getGrandtotal(): int
    {
        return $this->getSubtotal() + $this->supplierDeliveries[0]->pivot->delivery_price;
    }
}
