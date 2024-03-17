<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            'banner_deploy_status' => $this->banner_deploy_status,
            'banner_route_name' => $this->banner_route_name,
            'banner_redirect_url' => $this->redirect_url,
            'banner_start_date' => $this->banner_start_date,
            'banner_end_date' => $this->banner_end_date,
            'banner_date_diff' => $this->getDateDiff(),
            'model_type' => $this->model_type,
            'banner_meta_keyword' => $this->banner_meta_keyword,
            'promo_children_count' => $this->whenCounted('children'),
            'promo_children' => PromotionBannerResource::collection($this->whenLoaded('children')),
            'promo_products_count' => $this->whenCounted('products'),
            'promo_products' => ProductResource::collection($this->whenLoaded('products')),
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
