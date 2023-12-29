<?php

namespace App\Actions;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductFilterAction
{
    public function execute(Request $request)
    {
        $advancedSortOptions = [
            'category_name',
            'product_price',
        ];

        $columnSortBy = $request->input('sortby');
        $columnOrderBy = $request->input('orderby');

        $query = Product::query();

        if ($columnSortBy && in_array($columnSortBy, $advancedSortOptions)) {
            if ($columnSortBy === 'category_name') {
                $query->join('categories', 'products.category_id', 'categories.id')
                    ->orderBy('categories.category_name', $columnOrderBy)
                    ->select('products.*', 'categories.category_name');
            } else {
                $query->orderByRaw('CASE WHEN discount_price > 0 THEN discount_price ELSE normal_price END ' . $columnOrderBy);
            }
        } elseif ($columnSortBy) {
            $query->orderBy($columnSortBy, $columnOrderBy);
        }

        return $query;
    }
}