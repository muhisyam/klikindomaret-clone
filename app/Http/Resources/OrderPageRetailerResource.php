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
        $orderService = app(OrderService::class);

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
            'pickup_longitude'      => $this->pickupAddress->longitude,
            'pickup_latitude'       => $this->pickupAddress->latitude,
            'pickup_code'           => $this->pickup_code,
            'pickup_expired'        => $this->pickup_expired,
            'retailer_order_status' => $this->pivot->retailer_order_status,
            'grandtotal'            => $this->grandtotal,
            'created_date'          => $createdDate,
            'created_time'          => $createdTime,
            'pickup_address'        => $orderService->getPickupAddress($this->pickupAddress),
            'deliveries'            => new OrderRelationshipDeliveryResource($this->supplierDeliveries[0]->pivot),
            'products'              => OrderProductResource::collection($this->whenLoaded('products')),
            'products_count'        => count($this->products),
        ];
    }
}
