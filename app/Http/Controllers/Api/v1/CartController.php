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

    public function __construct(
        protected CartService $cartService,
    ) {}

    public function store(CartRequest $request): JsonResponse
    {
        $this->addToCart($request);

        $productName = ['product_name' => $this->product['product_name']];

        return response()->json(['data' => $productName], 200);
    }

    public function show(Request $request): JsonResponse
    {
        $dataCarts = $this->getUserCart($request);

        return response()->json(['data' => $dataCarts], 200);
    }

    public function getUserCart(Request $request)
    {
        $userId    = $request->user()->id;
        $arrCarts  = Cart::userProducts($userId);
        $dataCarts = $this->cartService->getMoreInformation($arrCarts);

        return $dataCarts;
    }
    
    public function update(CartRequest $request, int $userId): JsonResponse
    {
        $this->updateProductQuantity($request);
        
        $productName = ['product_name' => $this->product['product_name']];

        return response()->json(['data' => $productName], 200);
    }

    public function destroy(Request $request, string $productSlug)
    {

    }

    public function destroyCart(int $userId): object
    {
        return Cart::where('user_id', $userId)->delete();
    }
}
