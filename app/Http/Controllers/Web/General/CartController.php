<?php

namespace App\Http\Controllers\Web\General;

use App\Actions\ClientRequestAction;
use App\Actions\CreateMultipartAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected string $endpoint;

    public function __construct(
        protected ClientRequestAction $clientAction,
        protected CreateMultipartAction $multipartAction,
    ) {
        $this->endpoint = config('api.url') . 'carts';
    }
    
    public function store(CartRequest|array $request): array
    {
        $dataRequest = $request instanceof CartRequest ? $request->all() : $request;
        $formData    = $this->multipartAction->create($dataRequest);
        
        return $this->clientAction->request(
            new ClientRequestDto(
                method: 'POST',
                endpoint: $this->endpoint,
                formData: $formData,
                headers: [
                    'Authorization' => 'Bearer ' . session('auth_token')
                ],
            )
        );
    }

    public function update(CartRequest|array $request): array
    {
        $dataRequest = $request instanceof CartRequest ? $request->all() : $request;
        $formData    = $this->multipartAction->create($dataRequest);
        $userId      = session('user')['id'];
        
        return $this->clientAction->request(
            new ClientRequestDto(
                method: 'POST',
                endpoint: $this->endpoint . '/' . $userId,
                formData: $formData,
                headers: [
                    'Authorization' => 'Bearer ' . session('auth_token')
                ],
            )
        );
    }
}
