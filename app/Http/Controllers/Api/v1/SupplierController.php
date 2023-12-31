<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\Http\Resources\SupplierResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierController extends Controller
{
    public function index(): JsonResource
    {
        $suppliers = Supplier::paginate(10);

        return SupplierResource::collection($suppliers);
    }

    public function store(SupplierRequest $request): SupplierResource
    {
        $data = $request->validated();
        $supplier = new Supplier($data);
        
        $supplier->save();

        return new SupplierResource($supplier);
    }

    public function show(string $supplierFlag): SupplierResource
    {
        $supplierFlag = explode('-', $supplierFlag);

        $supplier = Supplier::where([
            ['flag_code', $supplierFlag[0]],
            ['flag_name', $supplierFlag[1]]
        ])->first();

        return new SupplierResource($supplier);
    }

    public function update(SupplierRequest $request, string $supplierFlag): SupplierResource
    {
        $supplierFlag = explode('-', $supplierFlag);

        $supplier = Supplier::where([
            ['flag_code', $supplierFlag[0]],
            ['flag_name', $supplierFlag[1]]
        ])->first();

        $data = $request->validated();
        
        $supplier->fill($data);
        $supplier->save();

        return new SupplierResource($supplier);
    }

    public function destroy(string $supplierFlag): JsonResponse
    {
        $supplierFlag = explode('-', $supplierFlag);
        
        $supplier = Supplier::where([
            ['flag_code', $supplierFlag[0]],
            ['flag_name', $supplierFlag[1]]
        ])->first();

        $supplierName = ['supplier_name' => $supplier->supplier_name];

        $supplier->delete();

        return response()->json(['data' => $supplierName], 200);
    }
}
