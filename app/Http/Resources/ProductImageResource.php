<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
        $imagePath = 'img/uploads/products/coba-save-image/' . $this->product_image_name;
        $imageSize = File::exists($imagePath) ? round(filesize($imagePath) / 1024) : null;

        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'product_image_name' => $this->product_image_name,
            'original_product_image_name' => $this->original_product_image_name,
            'product_image_size' => $imageSize,
        ];
    }
}
