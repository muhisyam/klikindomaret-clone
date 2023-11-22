<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductController extends Controller
{
    public function index(): JsonResource
    {
        $products = Product::sortBy('category_id', 'asc')
            ->paginate(10);

        return ProductResource::collection($products);
    }

    public function store(ProductRequest $request): ProductResource
    {
        $data = $request->validated();
        $product = new Product($data);
        
        // $product->save();

        return new ProductResource($product);
    }

    public function show(string $id): ProductResource
    {
        $product = Product::find($id);

        return new ProductResource($product);
    }

    public function update(ProductRequest $request, int $id): ProductResource
    {
        $product = Product::find($id);
        $data = $request->validated();
        
        $product->fill($data);
        $product->save();

        return new ProductResource($product);
    }

    public function destroy(int $id): JsonResponse
    {
        $product = Product::find($id);
        $productName = ['product_name' => $product->product_name];

        $product->delete();

        return response()->json(['data' => $productName], 200);
    }
}
