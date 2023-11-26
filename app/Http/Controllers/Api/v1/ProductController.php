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
        $products = Product::orderBy('category_id', 'asc')
            ->paginate(10);

        return ProductResource::collection($products);
    }

    public function store(ProductRequest $request): ProductResource
    {
        $data = $request->validated();
        $product = new Product($data);
        
        $product->save();

        return new ProductResource($product);
    }

    public function show(string $productSlug): ProductResource
    {
        $product = Product::where('product_slug', $productSlug)->first();

        return new ProductResource($product);
    }

    public function update(ProductRequest $request, string $productSlug): ProductResource
    {
        $product = Product::where('product_slug', $productSlug)->first();
        $data = $request->validated();
        
        $product->fill($data);
        $product->save();

        return new ProductResource($product);
    }

    public function destroy(string $productSlug): JsonResponse
    {
        $product = Product::where('product_slug', $productSlug)->first();
        $productName = ['product_name' => $product->product_name];

        $product->delete();

        return response()->json(['data' => $productName], 200);
    }
}
