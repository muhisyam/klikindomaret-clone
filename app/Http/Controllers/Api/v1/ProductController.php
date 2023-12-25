<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\Backend\ImageService;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductController extends Controller
{
    public function index(): JsonResource
    {
        $products = Product::orderBy('category_id', 'asc')
            ->withCount([
                'images',
            ])
            ->with([
                'category', 
                'store',
                'images',
            ])
            ->paginate(10);

        return ProductResource::collection($products);
    }

    public function store(ProductRequest $request): ProductResource
    {
        $data = $request->validated();
        $product = new Product($data);
        $imageService = new ImageService();
        $productImage = new ProductImageController($imageService);
        $productDescription = new ProductDescriptionController();
        
        $product->save();
        $productImage->store($data, $product->id);
        $productDescription->store($data, $product->id);

        return new ProductResource($product);
    }

    public function show(string $productSlug): ProductResource
    {
        $product = Product::where('product_slug', $productSlug)
            ->with([
                'category', 
                'store', 
                'descriptions',
                'images',
            ])
            ->withCount([
                'descriptions',
                'images',
            ])
            ->first();

        return new ProductResource($product);
    }

    public function update(ProductRequest $request, string $productSlug): ProductResource
    {
        $data = $request->validated();
        $product = Product::where('product_slug', $productSlug)->first();
        $imageService = new ImageService();
        $productImage = new ProductImageController($imageService);
        $productDescription = new ProductDescriptionController();
        
        $productImage->update($data, $product->id);
        $product->fill($data);
        $product->save();
        $productDescription->update($data, $product->id);

        return new ProductResource($product);
    }

    public function destroy(string $productSlug): JsonResponse
    {
        $product = Product::where('product_slug', $productSlug)->first();
        $productName = ['product_name' => $product->product_name];
        $productPath = 'img/uploads/products/' . $productSlug;
        
        $product->delete();
        File::exists($productPath) && File::deleteDirectory($productPath);

        return response()->json(['data' => $productName], 200);
    }
}
