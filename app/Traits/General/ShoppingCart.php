<?php

namespace App\Traits\General;

use App\Actions\ErrorTraceAction;
use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

trait ShoppingCart
{
    protected $request;
    protected $user;
    protected $product;

    public function addToCart(CartRequest $request)
    {
        $this->request = $request;

        $this->initData();
        $this->ensureProductShouldBeWhatInCart('not exist');
        $this->ensureStockNotLessThanQuantity();

        $this->user->carts()->attach($this->product['id'], ['quantity' => $request['quantity']]);
    }

    public function updateProductQuantity(CartRequest $request)
    {
        $this->request = $request;

        $this->initData();
        $this->ensureProductShouldBeWhatInCart('exist');
        $this->ensureStockNotLessThanQuantity();

        $this->user->carts()->updateExistingPivot($this->product['id'], ['quantity' => $request['quantity']]);
    }

    private function initData()
    {
        $this->user    = User::find(auth()->user()->getAuthIdentifier());
        $this->product = Product::query()
            ->select([
                'id', 
                'product_name', 
                'product_stock',
            ])
            ->where('product_slug', $this->request['product_slug'])
            ->first();
    }

    protected function ensureStockNotLessThanQuantity(): void
    {
        if ($this->product['product_stock'] > $this->request['quantity']) {
            return;
        }
        
        $trace = app(ErrorTraceAction::class)->execute();
        $this->sendInsufficientProducStock($trace);
    }

    /**
     * Send response when product stock is less than request quantity.
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function sendInsufficientProducStock(array $trace): JsonResponse
    {
        throw new HttpResponseException(response([
            'errors' => [
                'message' => [
                    'Persediaan tidak mencukupi'
                ],
            ],
            'meta' => [
                'status_code' => 409,
                'message' => 'Conflict',
                'trace' => [
                    'File' => $trace['filename'],
                    'Line' => $trace['line'],
                ],
            ],
        ])->setStatusCode(409));
    }

    protected function ensureProductShouldBeWhatInCart(string $shouldBe): void
    {
        $isProductExist = Cart::query()
            ->where('user_id', $this->user['id'])
            ->where('product_id', $this->product['id'])
            ->first();

        $condition      = $shouldBe == 'exist' ? $isProductExist : ! $isProductExist;
        $errorMessage   = $shouldBe == 'exist' ? 'belum ada' : 'sudah';
        $errorCode      = $shouldBe == 'exist' ? 404 : 409;

        if ($condition) { 
            return; 
        }

        $trace = app(ErrorTraceAction::class)->execute();
        $this->sendProductShouldBeError($trace, $errorMessage, $errorCode);
    }

    /**
     * Send response when product conditions in the cart are not met.
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function sendProductShouldBeError(array $trace, string $message, int $code): JsonResponse
    {
        throw new HttpResponseException(response([
            'errors' => [
                'message' => [
                    'Produk ' . $message . ' dalam keranjang'
                ],
            ],
            'meta' => [
                'status_code' => $code,
                'message' => $code === 409 ? 'Conflict' : 'Not Found',
                'trace' => [
                    'File' => $trace['filename'],
                    'Line' => $trace['line'],
                ],
            ],
        ])->setStatusCode($code));
    }
}