<?php

namespace App\Http\Resources;

use App\Services\OrderService;
use Carbon\Carbon;
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
        $orderService = app(OrderService::class);
        $createdDate  = formatToIdnLocale(Carbon::parse($this->created_at), 'j M Y | H:i') . ' WIB';

        return [
            'order_key'         => $this->order_key,
            'user_order_status' => $this->user_order_status,
            'pickup_info'       => $this->pickup_info,
            'pickup_code'       => $this->pickup_code,
            'pickup_expired'    => $this->pickup_expired,
            'payment_channel'   => $this->payment_channel,
            'va_number'         => $this->va_number,
            'grandtotal'        => $this->grandtotal,
            'order_completed'   => $this->order_completed,
            'product_count'     => $this->whenCounted('products'),
            'created_at'        => $createdDate,
            'status_icon'       => $orderService->getStatusIcon($this->user_order_status),
            'products'          => OrderProductResource::collection($this->whenLoaded('products')),
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
