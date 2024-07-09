<?php

namespace App\Http\Controllers\Api\v1;

use App\Enums\DeployStatus;
use App\Enums\MetaStatus;
use App\Filters\HomepageSearch\CategoryFilter;
use App\Filters\HomepageSearch\KeywordFilter;
use App\Filters\HomepageSearch\OfficialStoreFilter;
use App\Filters\HomepageSearch\PromotionBannerFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\CardProductMinimalResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class SearchController extends Controller
{
    public function navbar(Pipeline $pipeline)
    {
        $search = request('key');
        $result = [
            'banners'         => [],
            'keywords'        => [],
            'categories'      => [],
            'official_stores' => [],
        ];

        if (strlen($search) < 3) {
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

    public function product(Request $request)
    {
        $search    = $request->key;
        $baseQuery = Product::query()
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
            ->leftJoin('suppliers', 'products.supplier_id', '=', 'suppliers.id')
            ->where(function($query) use ($search) {
                $query
                    ->where('product_name', 'LIKE', "%$search%")
                    ->orWhereHas('keywords', function ($keywords) use ($search) {
                        $keywords
                            ->where('keyword_deploy_status', DeployStatus::PUBLISHED->value)
                            ->where('keyword_name', 'LIKE', "%{$search}%");
                    });
            });
        
        $queryProduct = clone $baseQuery; 

        $categoriesListFilter = $queryProduct
            ->select('categories.category_name', 'categories.category_slug')
            ->distinct()
            ->get();

        $brandsListFilter = $queryProduct
            ->select('brands.brand_name', 'brands.brand_slug')
            ->distinct()
            ->get();

        $suppliersListFilter = $queryProduct
            ->select('suppliers.supplier_name', 'suppliers.flag_name')
            ->distinct()
            ->get();

        $additional = array_merge(MetaStatus::get('OK'), [
            'list_categories' => $categoriesListFilter,
            'list_brands'     => $brandsListFilter,
            'list_suppliers'  => $suppliersListFilter,
        ]);

        $resultProducts = $queryProduct
            ->select(
                'products.*',
                'categories.category_slug',
                'brands.brand_slug',
                'suppliers.flag_name',
            )
            ->filterModel($request)
            ->with([
                'images',
                'supplier',
                'category',
            ])
            ->getData($request);

        return CardProductMinimalResource::collection($resultProducts)->additional($additional);
    }
}