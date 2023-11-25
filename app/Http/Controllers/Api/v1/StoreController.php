<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Store;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreController extends Controller
{
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
        $store = Store::where('store_code', $storeCode)->first();

        return new StoreResource($store);
    }

    public function update(StoreRequest $request, string $storeCode): StoreResource
    {
        $store = Store::where('store_code', $storeCode)->first();
        $data = $request->validated();
        
        $store->fill($data);
        $store->save();

        return new StoreResource($store);
    }

    public function destroy(string $storeCode): JsonResponse
    {
        $store = Store::where('store_code', $storeCode)->first();
        $storeName = ['store_name' => $store->store_name];

        $store->delete();

        return response()->json(['data' => $storeName], 200);
    }
}
