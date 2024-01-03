<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Store;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use App\DataTransferObjects\FindDataDto;
use App\Services\Backend\ApiCallService;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreController extends Controller
{
    public function __construct(
        protected ApiCallService $apiService,
    ) {}
    
    public function index(): JsonResource
    {
        $stores = Store::orderBy('flag', 'asc')->paginate(10);

        return StoreResource::collection($stores);
    }

    public function store(StoreRequest $request): StoreResource
    {
        $data = $request->validated();
        $store = new Store($data);
        
        $store->save();

        return new StoreResource($store);
    }

    public function show(string $storeCode): StoreResource
    {
        $store = $this->getSpesificData($storeCode);

        return new StoreResource($store);
    }

    public function update(StoreRequest $request, string $storeCode): StoreResource
    {
        $store = $this->getSpesificData($storeCode);
        $data = $request->validated();
        
        $store->fill($data);
        $store->save();

        return new StoreResource($store);
    }

    public function destroy(string $storeCode): JsonResponse
    {
        $store = $this->getSpesificData($storeCode);
        $storeName = ['store_name' => $store->store_name];

        $store->delete();

        return response()->json(['data' => $storeName], 200);
    }

    private function getSpesificData(string $storeCode)
    {
        return $this->apiService->findData(
            new FindDataDto(
                model: new Store,
                whereSchema: [
                    ['store_code', $storeCode],
                ],
            )
        );
    }
}
