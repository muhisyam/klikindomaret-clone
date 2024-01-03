<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\DataTransferObjects\FindDataDto;
use App\Http\Resources\SupplierResource;
use App\Services\Backend\ApiCallService;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierController extends Controller
{
    public function __construct(
        protected ApiCallService $apiService,
    ) {}
    
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
        $supplier = $this->getSpesificData($supplierFlag);

        return new SupplierResource($supplier);
    }

    public function update(SupplierRequest $request, string $supplierFlag): SupplierResource
    {
        $supplier = $this->getSpesificData($supplierFlag);
        $data = $request->validated();
        
        $supplier->fill($data);
        $supplier->save();

        return new SupplierResource($supplier);
    }

    public function destroy(string $supplierFlag): JsonResponse
    {
        $supplier = $this->getSpesificData($supplierFlag);
        $supplierName = ['supplier_name' => $supplier->supplier_name];

        $supplier->delete();

        return response()->json(['data' => $supplierName], 200);
    }

    private function getSpesificData(string $supplierFlag)
    {
        $supplierFlag = explode('-', $supplierFlag);

        return $this->apiService->findData(
            new FindDataDto(
                model: new Supplier,
                whereSchema: [
                    ['flag_code', $supplierFlag[0]],
                    ['flag_name', $supplierFlag[1]],
                ],
            )
        );
    }
}
