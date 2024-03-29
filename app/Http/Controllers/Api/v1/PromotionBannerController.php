<?php

namespace App\Http\Controllers\Api\v1;

use App\Enums\DeployStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\PromotionBannerRequest;
use App\Http\Resources\ModalPromoListResource;
use App\Http\Resources\PromotionBannerResource;
use App\Models\Product;
use App\Models\PromotionBanner;
use App\Services\Backend\ImageService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class PromotionBannerController extends Controller
{
    public function __construct(
        protected ImageService $imageService,
    ){}

    public function index(Request $request): JsonResource
    {   
        $promoBanners = PromotionBanner::with('products')
            ->withCount('products')
            ->latest()
            ->paginate(10);

        return PromotionBannerResource::collection($promoBanners);
    }
    
    public function store(PromotionBannerRequest $request): PromotionBannerResource
    {
        $data = $request->validated();

        [$data['banner_image_name'], $data['original_banner_image_name']] = $this->imageService->storeImage($data['banner_image_name'], 'promo-banners');
        $data['banner_meta_keyword'] = Product::whereIn('id', $data['product_ids'])->getKeywordList();

        $promoBanner = PromotionBanner::create(Arr::except($data, ['product_ids']));
        $promoBanner->products()->attach($data['product_ids']);

        return new PromotionBannerResource($promoBanner);
    }

    /**
     * Send just a necessary information for some purposes like modal input.
     * 
    */
    public function indexMinified()
    {
        $promoBanners = PromotionBanner::where('banner_deploy_status', DeployStatus::PUBLISHED)->paginate(10);

        return ModalPromoListResource::collection($promoBanners);
    }
}
