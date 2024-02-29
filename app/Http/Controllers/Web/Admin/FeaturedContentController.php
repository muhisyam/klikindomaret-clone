<?php

namespace App\Http\Controllers\Web\Admin;

use App\Actions\ClientRequestAction;
use App\Actions\CreateMultipartAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeaturedContentRequest;
use Illuminate\Http\Request;

class FeaturedContentController extends Controller
{
    protected string $endpoint;

    public function __construct(
        protected ClientRequestAction $clientAction,
        protected CreateMultipartAction $multipartAction,
    ) {
        $this->endpoint = config('api.url') . 'featured-content';
    }
    
    public function index(Request $request) 
    {
        return view('admin.featured-content.index');
    }

    public function storeData(FeaturedContentRequest|array $request)
    {   
        $dataRequest = $request instanceof FeaturedContentRequest ? $request->all() : $request;
        $formData = $this->multipartAction->create($dataRequest);

        $response = $this->clientAction->request(
            new ClientRequestDto(
                method: 'POST',
                endpoint: $this->endpoint,
                formData: $formData,
            )
        );

        return $response;
    }
}
