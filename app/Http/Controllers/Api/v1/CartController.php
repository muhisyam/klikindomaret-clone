<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Services\CartService;
use App\Traits\General\ShoppingCart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    use ShoppingCart;

    public function store(CartRequest $request): JsonResponse
    {
        $this->addToCart($request);

        $productName = ['product_name' => $this->product['product_name']];

        return response()->json(['data' => $productName], 200);
    }

    public function show(Request $request, CartService $cartService): JsonResponse
    {
        $userId    = $request->user()->id;
        $arrCarts  = Cart::userProducts($userId);
        $dataCarts = $cartService->getMoreInformation($arrCarts);

        return response()->json(['data' => $dataCarts], 200);
    }
    
    public function update(CartRequest $request, int $userId): JsonResponse
    {
        $this->updateProductQuantity($request);
        
        $productName = ['product_name' => $this->product['product_name']];

        return response()->json(['data' => $productName], 200);
    }
}
