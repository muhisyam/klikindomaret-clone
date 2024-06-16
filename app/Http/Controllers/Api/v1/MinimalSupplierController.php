<?php

namespace App\Http\Controllers\Api\v1;

use App\Enums\MetaStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\SelectSupplierMinimalResource;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;

class MinimalSupplierController extends Controller
{
    /**
     * Minimal data suppliers for data select purposes.
    */
    public function __invoke(Request $request)
    {
        $userData  = User::where('username', $request->user)->first();
        $suppliers = Supplier::query()
            ->when(isGodRole() || hasGodAccess($request),
                fn($query) => $query->where('supplier_name', 'LIKE', "%{$request->search}%"),
                fn($query) => $query->where('id', $userData->retailer->supplier->id),
            )
            ->paginate(10);

        return SelectSupplierMinimalResource::collection($suppliers)->additional(MetaStatus::get('OK'));
    }
}