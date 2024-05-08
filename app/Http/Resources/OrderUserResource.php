<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'order_key'           => $this->order_key,
            'user_order_status'   => $this->user_order_status,
            'pickup_info'         => $this->pickup_info,
            // 'pickup_address'   => new CategoryResource($this->whenLoaded('pickupAddress')),
            'pickup_code'         => $this->pickup_code,
            'pickup_expired'      => $this->pickup_expired,
            'payment_channel'     => $this->payment_channel,
            'va_number'           => $this->va_number,
            'grandtotal'          => $this->grandtotal,
            'order_completed'     => $this->order_completed,
            // 'products'       => Product::collection($this->whenLoaded('products')),
            // 'supplier_deliveries' => Product::collection($this->whenLoaded('supplierDeliveries')),
        ];
    }

    public function with(Request $request): array
    {
        return [
            'meta' => [
                'status_code' => 201,
                'message'     => 'Created',
            ],
        ];
    }
}
