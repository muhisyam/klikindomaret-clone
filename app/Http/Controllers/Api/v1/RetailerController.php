<?php

namespace App\Http\Controllers\Api\v1;

use App\DataTransferObjects\FindDataDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\RetailerRequest;
use App\Http\Resources\RetailerResource;
use App\Models\Retailer;
use App\Services\Backend\ApiCallService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RetailerController extends Controller
{
    public function __construct(
        protected ApiCallService $apiService,
    ) {}
    
    public function index(Request $request): JsonResource
    {
        $query = Retailer::query();

        $retailers = count($request->all()) === 0 
            ? $query->orderBy('region_id', 'asc')->paginate(10)
            : $query->where('supplier_id', $request['supplier_id'])->get();

        return RetailerResource::collection($retailers);
    }

    public function store(RetailerRequest $request): RetailerResource
    {
        $data = $request->validated();
        $retailer = new Retailer($data);
        
        $retailer->save();

        return new RetailerResource($retailer);
    }

    public function show(string $retailerCode): RetailerResource
    {
        $retailer = $this->getSpesificData($retailerCode);

        return new RetailerResource($retailer);
    }

    public function update(RetailerRequest $request, string $retailerCode): RetailerResource
    {
        $retailer = $this->getSpesificData($retailerCode);
        $data = $request->validated();
        
        $retailer->fill($data);
        $retailer->save();

        return new RetailerResource($retailer);
    }

    public function destroy(string $retailerCode): JsonResponse
    {
        $retailer = $this->getSpesificData($retailerCode);
        $retailerName = ['retailer_name' => $retailer->retailer_name];

        $retailer->delete();

        return response()->json(['data' => $retailerName], 200);
    }

    private function getSpesificData(string $retailerCode)
    {
        return $this->apiService->findData(
            new FindDataDto(
                model: new Retailer,
                whereSchema: [
                    ['retailer_code', $retailerCode],
                ],
            )
        );
    }
}
