<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;

class FeaturedSectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $productsCount = $this->whenCounted('products', $this->products, 0); 
        $promosCount   = $this->whenCounted('promos', $this->promos, 0);
        $totalContent  = $productsCount + $promosCount;

        return [
            'featured_name'           => $this->featured_name,
            'featured_slug'           => $this->featured_slug,
            'featured_redirect_url'   => $this->featured_redirect_url,
            'featured_products_count' => $productsCount,
            'featured_products'       => ProductResource::collection($this->whenLoaded('products')),
            'featured_promos_count'   => $promosCount,
            'featured_promos'         => PromotionBannerResource::collection($this->whenLoaded('promos')),
            'featured_total_content'  => $totalContent,
        ];
    }

    public function with(Request $request): array
    {
        return [
            'meta' => [
                'status_code' => 201,
                'message'     => 'Created',
            ],
        ];
    }
}
