<?php

namespace App\Http\Resources;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $productService   = app(ProductService::class);
        $productImageSize = $productService->getImageSize($this->resource, $this->product_image_path);

        return [
            'id'                          => $this->id,
            'product_id'                  => $this->product_id,
            'product_image_name'          => $this->product_image_name,
            'original_product_image_name' => $this->original_product_image_name,
            'product_image_path'          => $this->product_image_path,
            'product_image_size'          => $productImageSize,
        ];
    }
}
