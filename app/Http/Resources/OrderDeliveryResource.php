<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDeliveryResource extends JsonResource
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
            'expected_pickup_date'  => $this->expected_pickup_date,
            'expected_time_between' => $this->expected_time_between,
        ];
    }
}
