<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use App\Services\ImageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryController extends Controller
{
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

    public function store(CategoryRequest $request, ImageService $imageService): CategoryResource
    {
        $data = $request->validated();
        $category = new Category($data);
        $category->image = $imageService->storeImage($request, 'categories');
        $category->save();

        return new CategoryResource($category);
    }

    public function show(CategoryService $CategoryService, string $id): CategoryResource
    {
        $category = $CategoryService->findData($id);

        return new CategoryResource($category);
    }

    public function update(CategoryRequest $request, CategoryService $CategoryService, ImageService $imageService, int $id): CategoryResource
    {
        $category = $CategoryService->findData($id);
        $data = $request->validated();
        $imageService->findImage($category, 'categories');
        $category->fill($data);
        $category->image = $imageService->storeImage($request, 'categories');
        
        $category->save();

        return new CategoryResource($category);
    }

    public function destroy(CategoryService $CategoryService, ImageService $imageService, int $id): JsonResponse
    {
        $category = $CategoryService->findData($id);
        $imageService->findImage($category, 'categories');

        $category->delete();

        return response()->json(['data' => true], 200);
    }
}
