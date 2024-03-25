<?php

namespace App\Http\Controllers\Api\v1;

use App\DataTransferObjects\FindDataDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeaturedSectionRequest;
use App\Http\Resources\FeaturedSectionResource;
use App\Models\FeaturedSection;
use App\Services\Backend\ApiCallService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class FeaturedSectionController extends Controller
{
    public function __construct(
        protected ApiCallService $apiService,
    ){}

    public function index(Request $request): JsonResource
    {   
        $featured = FeaturedSection::with(['products', 'promos'])
            ->withCount(['products', 'promos'])
            ->latest()
            ->paginate(10);

        return FeaturedSectionResource::collection($featured);
    }
    
    public function store(FeaturedSectionRequest $request): FeaturedSectionResource
    {
        $data     = $request->validated();
        $featured = FeaturedSection::create(Arr::except($data, ['content_types', 'content_ids']));

        foreach ($data['content_types'] as $index => $type) {
            $featured->morphContentTo($type)->attach($data['content_ids'][$index]);
        }

        return new FeaturedSectionResource($featured);
    }

    public function show(string $featuredSlug): FeaturedSectionResource
    {
        $featured = $this->getSpesificData($featuredSlug, ['products', 'promos']);

        return new FeaturedSectionResource($featured);
    }

    public function update(FeaturedSectionRequest $request, string $featuredSlug): FeaturedSectionResource
    {
        $data     = $request->validated();
        $featured = $this->getSpesificData($featuredSlug);

        $featured->update(Arr::except($data, ['content_types', 'content_ids']));
        $featured->detachMorphContent();
        
        foreach ($data['content_types'] as $index => $type) {
            $featured->morphContentTo($type)->attach($data['content_ids'][$index]);
        }

        return new FeaturedSectionResource($featured);
    }

    public function destroy(string $featuredSlug): JsonResponse
    {
        $featured     = $this->getSpesificData($featuredSlug);
        $featuredName = ['featured_name' => $featured->featured_name];
        
        $featured->detachMorphContent();
        $featured->delete();

        return response()->json(['data' => $featuredName], 200);
    }

    private function getSpesificData(string $featuredSlug, array $showSchema = null)
    {
        $withSchema = $withCountSchema = $showSchema ?? [];

        return $this->apiService->findData(
            new FindDataDto(
                model: new FeaturedSection,
                whereSchema: [
                    ['featured_slug', $featuredSlug],
                ],
                withSchema: $withSchema,
                withCountSchema: $withCountSchema,
            )
        );
    }
}
