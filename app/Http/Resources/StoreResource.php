<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'region_id' => $this->region_id,
            'supplier_id' => $this->supplier_id,
            'store_code' => $this->store_code,
            'store_name' => $this->store_name,
            'store_address' => $this->store_address,
            'store_open' => $this->store_open,
            'opening_times' => $this->opening_times,
            'closing_times' => $this->closing_times,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
        ];
    }
}
