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
    protected $user;
    protected $product;

    public function addToCart(CartRequest $request)
    {
        $this->getUserData();
        $this->getProductData($request);

        //TODO: Ensure product stock is available
        
        if ($this->ensureProductNotExistInCart()) {
            $this->user->carts()->attach($this->product->id, ['quantity' => $request['quantity']]);
        }
    }

    private function getUserData()
    {
        $this->user = User::find(auth()->user()->getAuthIdentifier());
    }

    private function getProductData($request)
    {
        $this->product = Product::select(['id', 'product_name'])->where('product_slug', $request['product_slug'])->first();
    }

    protected function ensureProductNotExistInCart()
    {
        // TODO: check if can use whenHas or something like that
        $isProductExist = Cart::where([
            ['user_id', $this->user->id],
            ['product_id', $this->product->id],
        ])->first();

        if (! $isProductExist) { return true; }

        $trace = app(ErrorTraceAction::class)->execute();
        $this->sendProductHasExist($trace);
    }

    /**
     * Send response when Rate Limiter detect too many attempts failed.
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function sendProductHasExist(array $trace): JsonResponse
    {
        throw new HttpResponseException(response([
            'errors' => [
                'message' => [
                    'Data already exists'
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
}