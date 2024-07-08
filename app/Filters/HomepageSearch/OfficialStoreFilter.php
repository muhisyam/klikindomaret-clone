<?php 

namespace App\Filters\HomepageSearch;

use App\Http\Resources\SearchFilterOfficialStoreResource;
use App\Models\OfficialStore;
use Closure;

class OfficialStoreFilter
{
    function handle(array $result, Closure $next)
    {
        $search         = request('key');
        $officialStores = OfficialStore::where('store_name', 'LIKE', "%{$search}%")->get();

        $result['official_stores'] = SearchFilterOfficialStoreResource::collection($officialStores);

        return $next($result);
    }
}  