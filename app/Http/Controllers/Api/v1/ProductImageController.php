<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\ProductImage;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Backend\ImageService;
use App\Http\Requests\ProductImageRequest;
use App\Http\Resources\ProductImageResource;

class ProductImageController extends Controller
{
    public function __construct(
        protected ImageService $imageService,
    ) {}

    public function store(ProductImageRequest $request): JsonResponse
    {
        $dataImages = $request->validated();
        $folderName = 'products/' . $dataImages['product_slug'];
        
        foreach ($dataImages['product_images'] as $index => $dataImage) {
            $productImage = new ProductImage();

            $productImage->product_id = $dataImages['product_id'];
            $productImage->product_image_name = $this->imageService->storeMultipleImage($dataImage, $index, $folderName);
            $productImage->original_product_image_name = $this->imageService->storeImageName($dataImage);
        
            $productImage->save();
            $productImagesData[] = new ProductImageResource($productImage);
        };

        return response()->json(['data' => $productImagesData], 201);
    }

    public function update(ProductImageRequest $request)
    {
        ProductImage::where('product_id', $request['product_id'])->delete();
        
        $saveNewImages = $this->store($request);

        return $saveNewImages;
    }
}
