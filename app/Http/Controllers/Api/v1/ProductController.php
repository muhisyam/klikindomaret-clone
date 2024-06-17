<?php

namespace App\Http\Controllers\Api\v1;

use App\Enums\MetaStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ImageService;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct() {
        $this->middleware('auth:sanctum')->except('show');
    }

    /**
     * Retrieve product data with request filter parameters, including:
     * - (string) search   - Search for values in specific columns
     * - (string) sortBy   - Column to sort by
     * - (string) orderBy  - Sort order: asc or desc
     * - (bool)   paginate - Whether to paginate the results
     * - (int)    perPage  - Number of items per page if paginating
     * 
     * @param \Illuminate\Http\Request $request
    */
    public function index(Request $request): JsonResource
    {
        $products = Product::query()
            ->relatedToRetailer($request)
            ->join('categories', 'products.category_id', 'categories.id')
            ->select('categories.category_name', 'products.*')
            ->filterModel($request)
            ->with([
                'category', 
                'supplier', 
                'images',
            ])
            ->withCount([
                'images',
            ])
            ->getData($request);

        return ProductResource::collection($products)->additional(MetaStatus::get('OK'));
    }

    /**
     * Store new data product.
     * 
     * @param \App\Http\Requests\ProductRequest  $request
     * @param \App\Services\ProductService       $productService
    */
    public function store(ProductRequest $request, ProductService $productService)
    {
        $formData = $productService->setNecessaryData(
            formData: $request->validated(), 
            column  : ['keywords', 'raw_data_images'],
        );

        $product = DB::transaction(function () use ($formData, $productService) {
            $product = Product::create($formData);

            $product->retailers()->attach($formData['retailers_id']);
            $productService->saveImageToDbIfExists($product, $formData);
            $productService->saveImagesToAsset($formData);

            return $product;
        });
        
        $addtional = array_merge(MetaStatus::get('CREATED'), [
            'data' => [
                'content_name' => $product->product_name,
            ]
        ]);

        return (new ProductResource($product))->additional($addtional);
    }

     /**
     * Show a product with loaded neccesary relations.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product      $product
     */
    public function show(Request $request, Product $product): ProductResource
    {
        $product = $product
            ->load([
                'category', 
                'brand', 
                'supplier', 
                'retailers',
                'images',
            ])
            ->loadCount([
                'images',
            ]);

        $addtional = array_merge(MetaStatus::get('OK'), [
            'with_form' => $request->with_form,
        ]);

        return (new ProductResource($product))->additional($addtional);
    }
    /**
     * Update spesific data product by route model binding.
     *
     * @param \App\Http\Requests\ProductRequest $request        The validated request data.
     * @param \App\Models\Product               $product        The product to be updated.
     * @param \App\Services\ProductService      $productService The product service.
    */
    public function update(ProductRequest $request, Product $product, ProductService $productService): JsonResponse
    {
        $contentName = ['data' => ['content_name' => $product->product_name]];
        $productSlug = $product->product_slug;
        $formData    = $productService->setNecessaryData(
            formData: $request->validated(), 
            column:   ['keywords', 'raw_data_images'],
        );
        
        DB::transaction(function () use ($product, $productSlug, $formData, $productService) {
            $product->update($formData);
            $product->retailers()->sync($formData['retailers_id']);
            $product->images()->deleteImages($formData, $productSlug);

            // Delete image directory or image in directory.
            $productService->handleImageDirectory(
                formData:    $formData,
                productSlug: $productSlug,
            );

            $productService->saveImageToDbIfExists($product, $formData);
            $productService->saveImagesToAsset($formData);
        });
        
        return response()->json(array_merge($contentName, MetaStatus::get('OK')), 200);
    }

    /**
     * Delete spesific data product by route model binding and remove the image directory if exists.
     * 
     * @param \App\Models\Product        $product
     * @param \App\Services\ImageService $imageService
    */
    public function destroy(Product $product, ImageService $imageService): JsonResponse
    {
        $contentName = ['data' => ['content_name' => $product->product_name]];
        
        DB::transaction(function () use ($product, $imageService) {
            $imagePath = 'img/uploads/products/' . $product->product_slug;

            $product->retailers()->detach();
            $product->delete();
            $imageService->deleteDirectory($imagePath);
        });

        return response()->json(array_merge($contentName, MetaStatus::get('OK')), 200);
    }
}
