<?php

namespace App\Http\Resources;

use App\Models\Supplier;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardProductMinimalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $isProductOnStock    = $this->product_stock == 0 ? false : true;
        $isProductOnDiscount = is_null($this->discount_price) ? false : true;
        $productThumbnail    = $this->whenLoaded('images', $this->images[0]['product_image_name']);
        $productService      = app(ProductService::class);
        $discountPercent     = $productService->getDiscountPercent($this->resource, $isProductOnDiscount);
        $productImagePath    = $productService->getImagePath($this->resource, $productThumbnail);
        $isOfficialStore     = in_array($this->supplier_id, Supplier::$staticStoreSupplier);
        $productSupplierIcon = $isOfficialStore ? 'store' : $this->whenLoaded('supplier', $this->supplier->flag_name, 'store');
        $productSupplierName = $isOfficialStore ? 'Toko Indomaret' : $this->whenLoaded('supplier', $this->supplier->supplier_name, 'Toko Indomaret');

        return [
            'plu'                    => $this->plu,
            'product_name'           => $this->product_name,
            'product_slug'           => $this->product_slug,
            'normal_price'           => $this->normal_price,
            'discount_price'         => $this->discount_price ?? 0,
            'product_stock'          => $this->product_stock,
            'product_deploy_status'  => $this->product_deploy_status,
            'model_type'             => $this->model_type,
            'product_images_count'   => $this->whenCounted('images'),
            'discount_percent'       => $discountPercent,
            'is_product_on_stock'    => $isProductOnStock,
            'is_product_on_discount' => $isProductOnDiscount,
            'is_official_store'      => $isOfficialStore,
            'product_thumbnail'      => $productThumbnail,
            'product_image_path'     => $productImagePath,
            'product_supplier_icon'  => $productSupplierIcon,
            'product_supplier_name'  => $productSupplierName,
            'product_supplier'       => new SupplierResource($this->whenLoaded('supplier')),
        ];
    }
}