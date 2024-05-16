<?php

namespace App\Http\Resources;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderRetailerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $createdDate      = '[ ' . formatToIdnLocale(Carbon::parse($this->pivot->created_at), 'j M Y | H:i') . ' WIB ]';
        $supplierStoreIds = [1, 2];
        $isStoreSupp      = in_array($this->supplier_id, $supplierStoreIds) ? ' Indomaret ' : ' ';
        $orderMessage     = in_array($this->pivot->retailer_order_status, Order::$basedOnRetailer) 
            ? $this->pivot->message . $isStoreSupp . $this->retailer_name 
            : $this->pivot->message;

        return [
            'retailer_order_status' => $this->pivot->retailer_order_status,
            'message'               => $orderMessage,
            'created_at'            => $createdDate,
        ];
    }
}
