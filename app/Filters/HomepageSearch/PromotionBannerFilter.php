<?php 

namespace App\Filters\HomepageSearch;

use App\Enums\DeployStatus;
use App\Http\Resources\SearchFilterPromotionBannerResource;
use App\Models\PromotionBanner;
use Closure;

class PromotionBannerFilter
{
    function handle(array $result, Closure $next)
    {
        $search = request('key');
        $promos = PromotionBanner::query()
            ->where('banner_deploy_status', DeployStatus::PUBLISHED->value)
            ->whereHas('keywords', function ($query) use ($search) {
                $query
                    ->where('keyword_deploy_status', DeployStatus::PUBLISHED->value)
                    ->where('keyword_name', 'LIKE', "%{$search}%");
            })
            ->take(5)
            ->get();
        
        $result['banners'] = SearchFilterPromotionBannerResource::collection($promos);

        return $next($result);
    }
}