<?php

namespace App\Http\Controllers\Api\v1;

use App\Enums\MetaStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\SelectBrandMinimalResource;
use App\Models\Brand;
use Illuminate\Http\Request;

class MinimalBrandController extends Controller
{
    /**
     * Minimal data brands for data select purposes.
    */
    public function __invoke(Request $request)
    {
        $brands = Brand::query()
            // Search key in model table
            ->where('brand_name', 'LIKE', "%{$request->search}%")
            // Search key in relation table
            ->orWhereHas('officialStore', fn ($query) => $query->where('store_name', 'LIKE', "%{$request->search}%"))
            ->with('officialStore')
            ->paginate(10);

        return SelectBrandMinimalResource::collection($brands)->additional(MetaStatus::get('OK'));
    }
}