<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $data = Category::all();

        return (CategoryResource::collection($data))->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): CategoryResource
    {
        $data = $request->validated();
        $category = new Category($data);
        $category->save();

        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): CategoryResource
    {
        $category = Category::find($id);

        $this->isDataFound($category);

        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, int $id): CategoryResource
    {
        $category = Category::find($id);

        $this->isDataFound($category);
        
        $data = $request->validated();
        $category->fill($data);
        $category->save();

        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
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
