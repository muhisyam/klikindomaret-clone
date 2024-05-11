<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $price    = $this->pivot->price;
        $quantity = $this->pivot->quantity;
        $subtotal = $price * $quantity;
        $image    = $this->images[0];

        return [
            'product_name'  => $this->product_name,
            'product_slug'  => $this->product_slug,
            'product_price' => $price,
            'product_image' => $image->product_image_name,
            'quantity'      => $quantity,
            'subtotal'      => $subtotal,
        ];
    }
}
