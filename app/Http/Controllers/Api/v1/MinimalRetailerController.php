<?php

namespace App\Http\Controllers\Api\v1;

use App\Enums\MetaStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\SelectRetailerMinimalResource;
use App\Models\Retailer;
use App\Models\User;
use Illuminate\Http\Request;

class MinimalRetailerController extends Controller
{
    /**
     * Minimal data retailers for data select purposes.
    */
    public function __invoke(Request $request)
    {
        $supplierId = $request->supplier;
        $userData   = User::where('username', $request->user)->first();
        $retailers  = Retailer::query()
            ->where('supplier_id', $supplierId)
            ->when(isGodRole() || hasGodAccess($request),
                fn($query) => $query->where('retailer_name', 'LIKE', "%{$request->search}%"),
                fn($query) => $query->where('id', $userData->retailer->id),
            )
            ->paginate(10);

        return SelectRetailerMinimalResource::collection($retailers)->additional(MetaStatus::get('OK'));
    }
}