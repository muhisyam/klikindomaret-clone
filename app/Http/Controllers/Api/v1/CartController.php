<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Traits\General\ShoppingCart;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    use ShoppingCart;

    public function store(CartRequest $request): JsonResponse
    {
        $this->addToCart($request);
        $productName = ['product_name' => $this->product->name];

        return response()->json(['data' => $productName], 200);
    }
}
