<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Retrieve api product list resources for select in modal
 */
class ModalProductListResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "category_lvl_1" => $this->category_lvl_1,
            "category_lvl_3" => $this->category_lvl_3,
            "product_name" => $this->product_name,
            "product_slug" => $this->product_slug,
            "product_meta_keyword" => $this->product_meta_keyword,
            "product_image_name" => $this->product_image_name,
        ];
    }
}
