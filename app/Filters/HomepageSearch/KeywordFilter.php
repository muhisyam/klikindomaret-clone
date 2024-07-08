<?php 

namespace App\Filters\HomepageSearch;

use App\Enums\DeployStatus;
use App\Http\Resources\SearchFilterKeywordResource;
use App\Models\MetaKeyword;
use Closure;

class KeywordFilter
{
    function handle(array $result, Closure $next)
    {
        $search   = request('key');
        $keywords = MetaKeyword::query()
            ->where('keyword_deploy_status', DeployStatus::PUBLISHED->value)
            ->where('keyword_name', 'LIKE', "%{$search}%")
            ->take(5)
            ->get();
        
        $result['keywords'] = SearchFilterKeywordResource::collection($keywords);

        return $next($result);
    }
}