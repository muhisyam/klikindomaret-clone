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
            'category' => new CategoryResource($this->whenLoaded('category')),
            'supplier_id' => $this->supplier_id,
            'supplier' => new SupplierResource($this->whenLoaded('supplier')),
            'plu' => $this->plu,
            'product_name' => $this->product_name,
            'product_slug' => $this->product_slug,
            'normal_price' => $this->normal_price,
            'discount_price' => $this->discount_price,
            'product_stock' => $this->product_stock,
            'product_status' => $this->product_status,
            'product_descriptions_count' => $this->descriptions_count,
            'product_descriptions' => ProductDescriptionResource::collection($this->whenLoaded('descriptions')),
            'product_images_count' => $this->images_count,
            'product_images' => ProductImageResource::collection($this->whenLoaded('images')),
            'stores' => StoreResource::collection($this->whenLoaded('stores')),
        ];
    }
}
