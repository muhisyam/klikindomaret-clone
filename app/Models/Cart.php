<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeUserProducts($query, $userId)
    {
        $result = $query
            ->where('user_id', $userId)
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->leftJoin('categories as cat3', 'products.category_id', '=', 'cat3.id')
            ->leftJoin('categories as cat2', 'cat3.parent_id', '=', 'cat2.id')
            ->leftJoin('categories as cat1', 'cat2.parent_id', '=', 'cat1.id')
            ->leftJoin('product_images as images', 'products.id', '=', 'images.product_id')
            ->leftJoin('suppliers', 'products.supplier_id', '=', 'suppliers.id')
            ->orderBy('carts.created_at', 'desc')
            ->select(
                'carts.quantity', 
                'products.product_name',
                'products.product_slug',
                'products.normal_price',
                'products.discount_price',
                'cat3.category_name as category_lvl_3',
                'cat2.category_name as category_lvl_2',
                'cat1.category_name as category_lvl_1',
                'cat3.category_slug as slug_category_lvl_3',
                'cat2.category_slug as slug_category_lvl_2',
                'cat1.category_slug as slug_category_lvl_1',
                'images.product_image_name', 
                'suppliers.id as supplier_id',
                'suppliers.supplier_name',
            )
            ->get()
            ->groupBy('supplier_name');

        return $this->mergeOfficialSupplier($result);
    }

    public function mergeOfficialSupplier($queryResult)
    {
        $arrayResult   = $queryResult->toArray();
        $isHasFlagF    = $arrayResult['Indomaret'] ?? [];
        $isHasFlagT    = $arrayResult['Indomaret Fresh'] ?? [];
        $mergeSupplier = ['Toko Indomaret' => array_merge($isHasFlagF, $isHasFlagT)];
        $mergeToResult = array_merge($mergeSupplier, $arrayResult);

        return Arr::except($mergeToResult, ['Indomaret', 'Indomaret Fresh']);
    }
}
