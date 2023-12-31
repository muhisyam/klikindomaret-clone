<?php

namespace App\Http\Controllers\Api\v1;

use App\DataTransferObjects\FindDataDto;
use App\Models\Region;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegionRequest;
use App\Http\Resources\RegionResource;
use App\Services\Backend\ApiCallService;
use Illuminate\Http\Resources\Json\JsonResource;

class RegionController extends Controller
{
    public function __construct(
        protected ApiCallService $apiService,
    ) {}

    public function index(): JsonResource
    {
        $regions = Region::paginate(10);

        return RegionResource::collection($regions);
    }

    public function store(RegionRequest $request): RegionResource
    {
        $data = $request->validated();
        $region = new Region($data);
        
        $region->save();

        return new RegionResource($region);
    }

    public function show(string $regionCode): RegionResource
    {
        $region = Region::where('region_code', $regionCode)->first();

        return new RegionResource($region);
    }

    public function update(RegionRequest $request, string $regionCode): RegionResource
    {
        $region = Region::where('region_code', $regionCode)->first();
        $data = $request->validated();
        
        $region->fill($data);
        $region->save();

        return new RegionResource($region);
    }

    public function destroy(string $regionCode): JsonResponse
    {
        $region = Region::where('region_code', $regionCode)->first();
        $regionName = ['region_name' => $region->region_name];

        $region->delete();

        return response()->json(['data' => $regionName], 200);
    }
}
