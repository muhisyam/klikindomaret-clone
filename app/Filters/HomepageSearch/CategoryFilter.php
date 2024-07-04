<?php 

namespace App\Filters\HomepageSearch;

use App\Enums\DeployStatus;
use App\Http\Resources\SearchFilterCategoryResource;
use App\Models\Category;
use Closure;

class CategoryFilter
{
    function handle(array $result, Closure $next)
    {
        $search     = request('search');
        $categories = Category::query()
            ->whereHas('keywords', function ($query) use ($search) {
                $query
                    ->where('keyword_deploy_status', DeployStatus::PUBLISHED->value)
                    ->where('keyword_name', 'LIKE', "%{$search}%");
            })
            ->with([
                'keywords' => function($keywords) use ($search) {
                    $keywords
                        ->where('keyword_deploy_status', DeployStatus::PUBLISHED->value)
                        ->where('keyword_name', 'LIKE', "%{$search}%")
                        ->take(1);
                }
            ])
            ->take(5)
            ->get();
        
        $result['categories'] = SearchFilterCategoryResource::collection($categories);

        return $next($result);
    }
}