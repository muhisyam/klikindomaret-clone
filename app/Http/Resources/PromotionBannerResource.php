<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PromotionBannerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'banner_name' => $this->banner_name,
            'banner_slug' => $this->banner_slug,
            'promotion_code' => $this->promotion_code,
            'promotion_quota' => $this->promotion_quota,
            'short_term_condition' => $this->short_term_condition,
            'term_condition' => $this->term_condition,
            'banner_image_name' => $this->banner_image_name,
            'original_banner_image_name' => $this->original_banner_image_name,
            'deploy_status' => $this->deploy_status,
            'route_name' => $this->route_name,
            'redirect_url' => $this->redirect_url,
            'redirect_out_site_url' => $this->redirect_out_site_url,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'model_type' => $this->model_type,
            'children' => PromotionBannerResource::collection($this->whenLoaded('children')),
            'products' => ProductResource::collection($this->whenLoaded('products')),
        ];
    }

    public function with(Request $request): array
    {
        return [
            'meta' => [
                'status_code' => 200,
                'message' => 'Success',
            ],
        ];
    }
}
