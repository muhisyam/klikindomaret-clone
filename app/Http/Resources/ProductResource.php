<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'category_id' => $this->category_id,
            'store_id' => $this->store_id,
            'product_name' => $this->product_name,
            'product_slug' => $this->product_slug,
            'normal_price' => $this->normal_price,
            'discount_price' => $this->discount_price,
            'product_status' => $this->product_status,
            'product_stock' => $this->product_stock,
            'plu' => $this->plu,
        ];
    }
}
