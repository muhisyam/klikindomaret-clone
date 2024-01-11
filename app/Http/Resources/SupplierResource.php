<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
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
            'flag_code' => $this->flag_code,
            'flag_name' => $this->flag_name,
            'supplier_name' => $this->supplier_name,
            'stores' => StoreResource::collection($this->whenLoaded('stores')),
        ];
    }
}
