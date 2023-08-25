<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryController extends Controller
{
    public function index(): JsonResource
    {
        $categories = Category::all();

        return CategoryResource::collection($categories);
    }

    public function store(CategoryRequest $request): CategoryResource
    {
        $data = $request->validated();
        $category = new Category($data);
        $category->save();

        return new CategoryResource($category);
    }

    public function show(string $id): CategoryResource
    {
        $category = Category::find($id);

        $this->isDataFound($category);

        return new CategoryResource($category);
    }

    public function update(CategoryRequest $request, int $id): CategoryResource
    {
        $category = Category::find($id);

        $this->isDataFound($category);
        
        $data = $request->validated();
        $category->fill($data);
        $category->save();

        return new CategoryResource($category);
    }

    public function destroy(int $id): JsonResponse
    {
        $category = Category::find($id);

        $this->isDataFound($category); 

        $category->delete();

        return response()->json(['data' => true], 200);
    }

    protected function isDataFound($data) 
    {
        if(!$data) {
            throw new HttpResponseException(response()->json([
                "errors" => [
                    "message" => [
                        "data not found"
                    ]
                ]
            ])->setStatusCode(404));
        }

        return true;
    }
}
