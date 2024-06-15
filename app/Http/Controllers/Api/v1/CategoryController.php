<?php

namespace App\Http\Controllers\Api\v1;

use App\Enums\MetaStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\ImageService;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryController extends Controller
{
    /**
     * Retrieving data categories with request filter parameters, including:
     * - (int)    depth    => between 2 - 3 level
     * - (string) sortBy   => sort by category column
     * - (string) orderBy  => asc or desc
     * - (bool)   paginate => Get data in paginate or not
     * - (int)    perPage  => Limit data pagination
     * 
     * @param \Illuminate\Http\Request $request
    */
    public function index(Request $request): JsonResource
    {
        $categories = Category::query()
            ->whereDoesntHave('parent')
            ->filterModel($request)
            ->withCount('children')
            ->getData($request);

        return CategoryResource::collection($categories)->additional(MetaStatus::get('OK'));
    }

    /**
     * Retrieving children data categories for admin interface.
     * 
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category     $category
    */
    public function indexChildren(Request $request, Category $category): JsonResource
    {  
        $categories = $category
            ->children()
            ->with([
                'children' => fn($children) => $children->withCount('products'),
            ])
            ->withCount('children')
            ->filterModel($request)
            ->getData($request);

        return CategoryResource::collection($categories)->additional(MetaStatus::get('OK'));
    }

    /**
     * Store new data category.
     * 
     * @param \App\Http\Requests\CategoryRequest $request
     * @param \App\Services\CategoryService      $categoryService
    */
    public function store(CategoryRequest $request, CategoryService $categoryService): CategoryResource
    {
        $formData = $request->validated();
        $formData = $categoryService->setNecessaryData($formData, ['parent_id', 'category_image_name']);
        $category = Category::create($formData);

        $categoryService->saveImagesToAsset($formData);

        $contentName = ['data' => ['content_name' => $category->category_name]];
        $additional  = array_merge(MetaStatus::get('CREATED'), $contentName);

        return (new CategoryResource($category))->additional($additional);
    }

    /**
     * Get spesific data category by route model binding.
     * 
     * @param \App\Models\Category $category
    */
    public function show(Request $request, Category $category): CategoryResource
    {
        $additional = array_merge(MetaStatus::get('OK'), [
            'with_form' => $request->with_form,
        ]);

        return (new CategoryResource($category->load('parent')))->additional($additional);
    }

    /**
     * Update spesific data category by route model binding.
     * 
     * @param \App\Http\Requests\CategoryRequest $request
     * @param \App\Models\Category               $category
     * @param \App\Services\CategoryService      $categoryService
    */
    public function update(CategoryRequest $request, Category $category, CategoryService $categoryService): JsonResponse
    {
        $contentName = ['data' => ['content_name' => $category->category_name]];
        $formData    = $request->validated();
        $formData    = $categoryService->setNecessaryData(
            formData: $formData, 
            category: $category,
            column:   ['parent_id', 'category_image_name'],
        );

        $category->update($formData);
        $categoryService->saveImagesToAsset($formData);
        
        return response()->json(array_merge($contentName, MetaStatus::get('OK')), 200);
    }

    /**
     * Delete spesific data category by route model binding and remove the image if exists.
     * 
     * @param \App\Models\Category       $category
     * @param \App\Services\ImageService $imageService
    */
    public function destroy(Category $category, ImageService $imageService): JsonResponse
    {
        $contentName = ['data' => ['content_name' => $category->category_name]];
        $imageName   = $category->category_image_name ?? '';

        $category->delete();
        $imageService->deleteExistsImage('categories', $imageName);

        return response()->json(array_merge($contentName, MetaStatus::get('OK')), 200);
    }
}
