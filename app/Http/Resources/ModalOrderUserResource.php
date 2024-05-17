<?php

namespace App\Http\Resources;

use App\Services\OrderService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModalOrderUserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $orderService    = app(OrderService::class);
        $paymentSuccsess = is_null($this->payment_success) ? $this->payment_success : formatToIdnLocale(Carbon::parse($this->payment_success), 'j M Y | H:i') . ' WIB';
        $createdDate     = formatToIdnLocale(Carbon::parse($this->created_at), 'j M Y | H:i') . ' WIB';

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
            'payment_success'   => $paymentSuccsess,
            'created_at'        => $createdDate,
            'status_icon'       => $orderService->getStatusIcon($this->user_order_status),
            'pickup_address'    => $orderService->getPickupAddress($this->pickupAddress),
            'products'          => $orderService->getDataSanitizedProducts($this->products),
            'deliveries'        => $orderService->getDataSanitizedDeliveries($this->deliveries),
            'retailer_status'   => OrderRetailerResource::collection($this->whenLoaded('retailers')),
        ];
    }
}
