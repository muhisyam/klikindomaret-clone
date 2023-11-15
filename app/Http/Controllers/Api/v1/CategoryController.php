<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\IsCategoryParentAction;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\Backend\ImageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
{
    public function __construct(
        protected ImageService $imageService,
        protected IsCategoryParentAction $isParentAction,
    ) {}

    public function index(): JsonResource
    {
        $categories = Category::where('parent_id', null)
            ->withCount('children')
            ->paginate(10);

        return CategoryResource::collection($categories);
    }

    public function subIndex(string $category_slug): JsonResource
    {  
        $parent = $this->findData('category_slug', $category_slug);
        $categories = Category::where('parent_id', $parent->id)
            ->with('children')
            ->withCount('children')
            ->paginate(5);

        return CategoryResource::collection($categories);
    }

    public function store(CategoryRequest $request): CategoryResource
    {
        $data = $request->validated();
        $category = new Category($data);
        
        $category->category_image_name = $this->imageService->storeImage($request, 'categories');
        $category->original_category_image_name = $this->imageService->storeImageName($request);
        
        $category->save();

        return new CategoryResource($category);
    }

    public function show(string $id): CategoryResource
    {
        $category = $this->findData('id', $id, true);

        return new CategoryResource($category);
    }

    public function update(CategoryRequest $request, int $id): CategoryResource
    {
        $category = $this->findData('id', $id);
        $data = $request->validated();
        $data['parent_id'] = $this->isParentAction->handle($data['parent_id']);
        
        $this->imageService->findImage($category, 'categories');
        $category->fill($data);

        $category->category_image_name = $this->imageService->storeImage($request, 'categories');
        $category->original_category_image_name = $this->imageService->storeImageName($request);
        
        $category->save();

        return new CategoryResource($category);
    }

    public function destroy(int $id): JsonResponse
    {
        $category = $this->findData('id', $id);
        $categoryName = ['category_name' => $category->category_name];
        $this->imageService->findImage($category, 'categories');

        $category->delete();

        return response()->json(['data' => $categoryName], 200);
    }

    public function selectQuery(bool $isChildren)
    {
        $categories = Category::where('parent_id', null)
            ->when($isChildren, function ($query) {
                $query->with('children');
            })
            ->get();

        return CategoryResource::collection($categories);
    }
    
    /**
     * Find data by spesific column in db and return data if exists or throw exception if not found
     */
    public function findData(string $column, mixed $value, bool $withParent = false, string $operation = '='): Category
    {
        try {
            return Category::when($withParent, function ($query) {
                $query->with('parent');
            })
            ->where($column, $operation, $value)
            ->firstOrFail();

        } catch (ModelNotFoundException $th) {
            throw new HttpResponseException(response()->json([
                "errors" => [
                    "message" => [
                        $th->getMessage()
                    ]
                ]
            ])->setStatusCode(404));
        }
    }
}
