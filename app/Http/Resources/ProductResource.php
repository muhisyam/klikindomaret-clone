<?php

namespace App\Http\Resources;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $includeForm         = isset($this->additional['with_form']);
        $isProductOnStock    = $this->product_stock == 0 ? false : true;
        $isProductOnDiscount = is_null($this->discount_price) ? false : true;
        $productThumbnail    = $this->whenLoaded('images', $this->images[0]['product_image_name']);
        $productService      = app(ProductService::class);
        $discountPercent     = $productService->getDiscountPercent($this->resource, $isProductOnDiscount);
        $productImagePath    = $productService->getImagePath($this->resource, $productThumbnail);
        $filteredKeyword     = $productService->filterKeywords($this->product_meta_keyword);
        $productImages       = $this->whenLoaded('images', $this->setProductImages($productImagePath));

        return [
            'plu'                      => $this->plu,
            'product_name'             => $this->product_name,
            'product_slug'             => $this->product_slug,
            'normal_price'             => $this->normal_price,
            'discount_price'           => $this->discount_price ?? '',
            'discount_start_date'      => $this->discount_start_date ?? '',
            'discount_end_date'        => $this->discount_end_date ?? '',
            'product_stock'            => $this->product_stock,
            'product_deploy_status'    => $this->product_deploy_status,
            'model_type'               => $this->model_type,
            'product_description'      => $this->product_description,
            'product_meta_keyword'     => $this->product_meta_keyword,
            'product_images_count'     => $this->whenCounted('images'),
            'discount_percent'         => $discountPercent,
            'is_product_on_stock'      => $isProductOnStock,
            'is_product_on_discount'   => $isProductOnDiscount,
            'product_thumbnail'        => $productThumbnail,
            'product_image_path'       => $productImagePath,
            'product_category'         => new CategoryResource($this->whenLoaded('category')),
            'product_supplier'         => new SupplierResource($this->whenLoaded('supplier')),
            'product_images'           => ProductImageResource::collection($productImages),
            'product_retailers'        => RetailerResource::collection($this->whenLoaded('retailers')),
            'form_select_category'     => $includeForm ? new SelectCategoryMinimalResource($this->whenLoaded('category')) : [],
            'form_select_brand'        => $includeForm ? new SelectBrandMinimalResource($this->whenLoaded('brand')) : [],
            'form_select_supplier'     => $includeForm ? new SelectSupplierMinimalResource($this->whenLoaded('supplier')) : [],
            'form_select_retailers'    => $includeForm ? SelectRetailerMinimalResource::collection($this->whenLoaded('retailers')) : [],
            'form_select_meta_keyword' => $includeForm ? SelectKeywordMinimalResource::collection($filteredKeyword) : [],
        ];
    }

    private function setProductImages(string $productImagePath)
    {
        foreach ($this->images as $image) {
            $image->product_image_path = $productImagePath;
        }

        return $this->images;
    }
}
