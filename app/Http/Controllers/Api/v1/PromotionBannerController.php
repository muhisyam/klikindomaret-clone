<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromotionBannerRequest;
use App\Http\Resources\PromotionBannerResource;
use App\Models\PromotionBanner;
use App\Services\Backend\ApiCallService;

class PromotionBannerController extends Controller
{
    public function __construct(
        protected ApiCallService $apiService,
    ){}
    
    public function store(PromotionBannerRequest $request): PromotionBannerResource
    {
        $data = $request->validated();
        // TODO: add from data products
        $data['banner_meta_keyword'] = 'sabun'; 
        $promoBanner = PromotionBanner::create($data);
        $promoBanner->products()->attach($data['product_ids']);

        return new PromotionBannerResource($promoBanner);
    }
}
