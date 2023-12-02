<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\ProductImage;
use App\Http\Controllers\Controller;
use App\Services\Backend\ImageService;
use App\Http\Resources\ProductImageResource;

class ProductImageController extends Controller
{
    public function __construct(
        protected ImageService $imageService,
    ) {}

    public function store(Array $dataProduct, int $dataProductId): Array
    {
        $folderName = 'products/' . $dataProduct['product_slug'];
        
        foreach ($dataProduct['product_images'] as $index => $dataImage) {
            $productImage = new ProductImage();

            $productImage->product_id = $dataProductId;
            $productImage->product_image_name = $this->imageService->storeMultipleImage($dataImage, $index, $folderName);
            $productImage->original_product_image_name = $this->imageService->storeImageName($dataImage);
            $productImage->save();
        
            $productImagesData[] = new ProductImageResource($productImage);
        }

        return $productImagesData;
    }

    public function update(Array $dataProduct, int $dataProductId): Array
    {
        $this->delete($dataProduct['product_slug'], $dataProductId);

        return $this->store($dataProduct, $dataProductId);
    }

    public function delete(String $dataProductSlug, int $dataProductId)
    {
        $dataProductImage = ProductImage::where('product_id', $dataProductId)->get();

        foreach ($dataProductImage as $dataImage) {
            $dataImageName = $dataImage->product_image_name;
            $folderName = 'products/' . $dataProductSlug;

            $dataImage->delete();
            $this->imageService->deleteExistsImage($dataImageName, $folderName);
        }
    }
}
