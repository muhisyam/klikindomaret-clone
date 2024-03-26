<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RetailerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'region_id'        => $this->region_id,
            'supplier_id'      => $this->supplier_id,
            'retailer_code'    => $this->retailer_code,
            'retailer_name'    => $this->retailer_name,
            'retailer_address' => $this->retailer_address,
            'retailer_open'    => $this->retailer_open,
            'opening_times'    => $this->opening_times,
            'closing_times'    => $this->closing_times,
            'longitude'        => $this->longitude,
            'latitude'         => $this->latitude,
        ];
    }
}
