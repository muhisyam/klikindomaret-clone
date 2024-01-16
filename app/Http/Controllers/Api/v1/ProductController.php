<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\ProductFilterAction;
use App\DataTransferObjects\FindDataDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\Backend\ApiCallService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function __construct(
        protected ApiCallService $apiService,
        protected ProductImageController $productImageController,
        protected ProductDescriptionController $productDescriptionController,
    ){}

    public function index(Request $request): JsonResource
    {
        $productFilter = new ProductFilterAction();
        $query = count($request->all()) === 0 
            ? Product::query() 
            : $productFilter->execute($request);
        
        $products = $query
            ->with(['category', 'supplier', 'images'])
            ->withCount(['images'])
            ->paginate(10);

        return ProductResource::collection($products);
    }

    public function store(ProductRequest $request): ProductResource
    {
        $data = $request->validated();
        $product = new Product($data);
        
        $product->save();
        $product->stores()->attach($data['store_ids']);
        $this->productImageController->store($data, $product->id);
        $this->productDescriptionController->store($data, $product->id);

        return new ProductResource($product);
    }

    public function show(string $productSlug): ProductResource
    {
        $product = $this->apiService->findData(
            new FindDataDto(
                model: new Product,
                whereSchema: [
                    ['product_slug', $productSlug],
                ],
                withSchema: [
                    'category', 
                    'supplier', 
                    'descriptions',
                    'images',
                    'stores',
                ],
                withCountSchema: [
                    'images',
                ],
            )
        );

        return new ProductResource($product);
    }

    public function update(ProductRequest $request, string $productSlug): ProductResource
    {
        $data = $request->validated();
        $product = $this->getSpesificData($productSlug);
        
        $this->productImageController->update($data, $product->id);
        $product->fill($data);
        $product->save();
        $product->stores()->sync($data['store_ids']);
        $this->productDescriptionController->update($data, $product->id);

        return new ProductResource($product);
    }

    public function destroy(string $productSlug): JsonResponse
    {
        $product = $this->getSpesificData($productSlug);
        $productName = ['product_name' => $product->product_name];
        $productPath = 'img/uploads/products/' . $productSlug;
        
        $product->stores()->detach();
        $product->delete();
        File::exists($productPath) && File::deleteDirectory($productPath);

        return response()->json(['data' => $productName], 200);
    }

    private function getSpesificData(string $productSlug)
    {
        return $this->apiService->findData(
            new FindDataDto(
                model: new Product,
                whereSchema: [
                    ['product_slug', $productSlug],
                ],
            )
        );
    }
}
