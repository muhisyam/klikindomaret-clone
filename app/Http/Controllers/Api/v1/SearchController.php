<?php

namespace App\Http\Controllers\Api\v1;

use App\Filters\HomepageSearch\CategoryFilter;
use App\Filters\HomepageSearch\KeywordFilter;
use App\Filters\HomepageSearch\OfficialStoreFilter;
use App\Filters\HomepageSearch\PromotionBannerFilter;
use App\Http\Controllers\Controller;
use Illuminate\Pipeline\Pipeline;

class SearchController extends Controller
{
    public function __invoke(Pipeline $pipeline)
    {
        $search = request('search');
        $result = [
            'banners'         => [],
            'keywords'        => [],
            'categories'      => [],
            'official_stores' => [],
        ];

        if (strlen($search) < 4) {
            return $result;
        }
        
        $pipeThrough = [
            KeywordFilter::class,
            PromotionBannerFilter::class,
            CategoryFilter::class,
            OfficialStoreFilter::class,
        ];

        return $pipeline
            ->send($result)
            ->through($pipeThrough)
            ->thenReturn();
    }
}