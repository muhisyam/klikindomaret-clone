<?php

namespace App\Http\Controllers\Api\v1;

use App\DataTransferObjects\FindDataDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeaturedContentRequest;
use App\Http\Resources\FeaturedContentResource;
use App\Models\FeaturedContent;
use App\Services\Backend\ApiCallService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeaturedContentController extends Controller
{
    public function __construct(
        protected ApiCallService $apiService,
    ){}

    public function index(Request $request): JsonResource
    {   
        $featured = FeaturedContent::with(['products'])
            ->withCount(['products'])
            ->paginate(10);

        return FeaturedContentResource::collection($featured);
    }
    
    public function store(FeaturedContentRequest $request): FeaturedContentResource
    {
        $data = $request->validated();
        $featured = new FeaturedContent($data);
        
        $featured->save();
        $featured->products()->attach($data['product_ids']);

        return new FeaturedContentResource($featured);
    }

    public function show(string $featuredSlug): FeaturedContentResource
    {
        $featured = $this->getSpesificData($featuredSlug, true);

        return new FeaturedContentResource($featured);
    }

    public function update(FeaturedContentRequest $request, string $featuredSlug): FeaturedContentResource
    {
        $data = $request->validated();
        $featured = $this->getSpesificData($featuredSlug);
        
        $featured->fill($data);
        $featured->save();
        $featured->products()->sync($data['product_ids']);

        return new FeaturedContentResource($featured);
    }

    public function destroy(string $featuredSlug): JsonResponse
    {
        $featured = $this->getSpesificData($featuredSlug);
        $featuredName = ['featured_name' => $featured->featured_name];
        
        $featured->products()->detach();
        $featured->delete();

        return response()->json(['data' => $featuredName], 200);
    }

    private function getSpesificData(string $featuredSlug, bool $showSchema = false)
    {
        $withSchema = $withCountSchema = $showSchema ? ['products'] : [];

        return $this->apiService->findData(
            new FindDataDto(
                model: new FeaturedContent,
                whereSchema: [
                    ['featured_slug', $featuredSlug],
                ],
                withSchema: $withSchema,
                withCountSchema: $withCountSchema,
            )
        );
    }
}
