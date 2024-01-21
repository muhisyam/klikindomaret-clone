<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\ProductImage;
use App\Http\Controllers\Controller;
use App\Services\Backend\ImageService;
use App\DataTransferObjects\FindDataDto;
use App\Services\Backend\ApiCallService;
use App\Http\Resources\ProductImageResource;

class ProductImageController extends Controller
{
    public function __construct(
        protected ApiCallService $apiService,
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

    public function update(Array $dataProduct, int $dataProductId)
    {
        if (isset($dataProduct['delete_images'])) {
            $this->delete($dataProduct, $dataProductId);
        } else {
            $this->delete($dataProduct, $dataProductId);
            
            return $this->store($dataProduct, $dataProductId);
        }
    }

    public function delete(array $dataProduct, int $dataProductId)
    {
        $dataProductImage = null;

        if (isset($dataProduct['delete_images'])) {
            foreach ($dataProduct['delete_images'] as $dataImage) {
                $dataProductImage[] = $this->getSpesificData(['product_image_name', $dataImage]);
            }
        } else {
            $dataProductImage = ProductImage::where('product_id', $dataProductId)->get();
        }

        foreach ($dataProductImage as $dataImage) {
            $dataImageName = $dataImage->product_image_name;
            $folderName = 'products/' . $dataProduct['product_slug'];

            $dataImage->delete();
            $this->imageService->deleteExistsImage($dataImageName, $folderName);
        }
    }

    private function getSpesificData(array $whereData)
    {
        return $this->apiService->findData(
            new FindDataDto(
                model: new ProductImage,
                whereSchema: [$whereData],
            )
        );
    }
}
