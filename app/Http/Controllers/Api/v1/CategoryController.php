<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\IsCategoryParentAction;
use App\DataTransferObjects\FindDataDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\Backend\ApiCallService;
use App\Services\Backend\ImageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryController extends Controller
{
    public function __construct(
        protected ApiCallService $apiService,
        protected ImageService $imageService,
        protected IsCategoryParentAction $isParentAction,
    ) {}

    public function index(Request $request): JsonResource
    {
        // TODO: Sync like product controller
        $query = Category::where('parent_id', null)->withCount('children'); 
        $categories = $request->has('withoutPagination') ? $query->get() : $query->paginate(10);

        return CategoryResource::collection($categories);
    }

    public function subIndex(Request $request, string $category_slug): JsonResource
    {  
        // TODO: Simplying this
        $parent = Category::where('category_slug', $category_slug)->first();
        $query = Category::where('parent_id', $parent->id)
            ->with('children')
            ->withCount('children');
         
        $categories = $request->has('withoutPagination') ? $query->get() : $query->paginate(5);

        return CategoryResource::collection($categories);
    }

    public function store(CategoryRequest $request): CategoryResource
    {
        $category = new Category();
        $data = $request->validated();
        $data['parent_id'] = $category->setParentId($data['parent_id']);

        if (isset($data['category_image'])) {
            $category->category_image_name = $this->imageService->storeImage($data['category_image'], 'categories');
            $category->original_category_image_name = $this->imageService->storeImageName($data['category_image']);
        }

        $category->fill($data);
        $category->save();

        return new CategoryResource($category);
    }

    public function show(string $category_slug): CategoryResource
    {
        $category = $this->apiService->findData(
            new FindDataDto(
                model: new Category(),
                whereSchema: [
                    ['category_slug', $category_slug],
                ],
                withSchema: ['parent'],
            )
        );

        return new CategoryResource($category);
    }

    public function update(CategoryRequest $request, string $category_slug): CategoryResource
    {
        $category = $this->getSpesificData($category_slug);
        $data = $request->validated();
        $data['parent_id'] = $category->setParentId($data['parent_id']);
        $data['category_image'] = $category->setImageValue($data);
        
        if (isset($data['category_image']) || isset($data['delete_image'])) {
            $this->imageService->deleteExistsImage($category->category_image_name, 'categories');
            $category->category_image_name = $this->imageService->storeImage($data['category_image'], 'categories');
            $category->original_category_image_name = $this->imageService->storeImageName($data['category_image']);
        }

        $category->fill($data);
        $category->save();

        return new CategoryResource($category);
    }

    public function destroy(string $category_slug): JsonResponse
    {
        $category = $this->getSpesificData($category_slug);
        $categoryName = ['category_name' => $category->category_name];
        
        $category->delete();
        $this->imageService->deleteExistsImage($category, 'categories');

        return response()->json(['data' => $categoryName], 200);
    }

    /**
     * Get top level category with/without chilren by request and without pagination
     */
    // TODO: Pindah ke index
    public function getTopLevelWithChildren(bool $withChildren): JsonResource
    {
        $categories = Category::where('parent_id', null)
            ->when($withChildren, function ($query) {
                $query->with('children');
            })
            ->get();

        return CategoryResource::collection($categories);
    }

    private function getSpesificData(string $category_slug)
    {
        return $this->apiService->findData(
            new FindDataDto(
                model: new Category(),
                whereSchema: [
                    ['category_slug', $category_slug],
                ],
            )
        );
    }
}
