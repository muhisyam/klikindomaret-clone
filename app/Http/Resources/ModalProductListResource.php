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
        foreach ($this->resource as $value) {
            $data[] = [
                'id' => $value->id,
                'product_name' => $value->product_name,
            ];
        }

        return $data;
    }
}
