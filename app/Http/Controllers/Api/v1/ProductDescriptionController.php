<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\ProductDescription;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductDescriptionResource;

class ProductDescriptionController extends Controller
{
    public function store(Array $dataProduct, int $dataProductId): Array
    {
        for ($i = 0; $i < count($dataProduct['product_description']); $i++) { 
            $productDescription = new ProductDescription();

            $productDescription->product_id = $dataProductId;
            $productDescription->title_product_description = $dataProduct['title_product_description'][$i];
            $productDescription->product_description = $dataProduct['product_description'][$i];
            $productDescription->save();

            $productDescriptionsData[] = new ProductDescriptionResource($productDescription);
        };

        return $productDescriptionsData;
    }

    public function update(Array $dataProduct, int $dataProductId): Array
    {
        ProductDescription::where('product_id', $dataProductId)->delete();

        return $this->store($dataProduct, $dataProductId);
    }
}