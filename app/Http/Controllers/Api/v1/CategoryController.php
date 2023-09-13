<?php

namespace App\Http\Controllers\Api\v1;

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
    ) {}

    public function index(): JsonResource
    {
        $categories = Category::where('parent_id', '0')
            ->withCount('childs')
            ->paginate(10);

        return CategoryResource::collection($categories);
    }

    public function subIndex(string $slug): JsonResource
    {   
        $sad = Category::where('slug', $slug)->first();
        $categories = Category::where('parent_id', $sad->id)
            ->with('childs')
            ->withCount('childs')
            ->paginate(5);

        return CategoryResource::collection($categories);
    }

    public function store(CategoryRequest $request): CategoryResource
    {
        $data = $request->validated();
        $category = new Category($data);
        $category->image = $this->imageService->storeImage($request, 'categories');
        $category->save();

        return new CategoryResource($category);
    }

    public function show(string $id): CategoryResource
    {
        $category = $this->findData($id);

        return new CategoryResource($category);
    }

    public function update(CategoryRequest $request, int $id): CategoryResource
    {
        $category = $this->findData($id);
        $data = $request->validated();
        $this->imageService->findImage($category, 'categories');
        $category->fill($data);
        $category->image = $this->imageService->storeImage($request, 'categories');
        
        $category->save();

        return new CategoryResource($category);
    }

    public function destroy(int $id): JsonResponse
    {
        $category = $this->findData($id);
        $categoryName = ['name' => $category->name];
        $this->imageService->findImage($category, 'categories');

        $category->delete();

        return response()->json(['data' => $categoryName], 200);
    }
    
    /**
     * Find data in db and return data if exists or throw exception if not found
     */
    public function findData(string $id): Category
    {
        try {
            return Category::findOrFail($id);

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
