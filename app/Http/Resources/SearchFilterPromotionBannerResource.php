<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchFilterPromotionBannerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'banner_name'         => $this->banner_name,
            'banner_slug'         => $this->banner_slug,
            'banner_route_name'   => $this->banner_route_name,
            'banner_redirect_url' => $this->banner_redirect_url,
            'banner_image_name'   => $this->banner_image_name,
        ];
    }
}
