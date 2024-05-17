<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderRelationshipDeliveryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'delivery_option'       => $this->delivery_option,
            'expected_pickup_date'  => formatToIdnLocale(Carbon::parse($this->expected_pickup_date), 'j M Y'),
            'expected_time_between' => $this->expected_time_between,
            'delivery_price'        => $this->delivery_price,
        ];
    }
}
