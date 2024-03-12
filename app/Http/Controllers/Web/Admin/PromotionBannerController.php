<?php

namespace App\Http\Controllers\Web\Admin;

use App\Actions\ClientRequestAction;
use App\Actions\CreateMultipartAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\PromotionBannerRequest;
use Illuminate\Contracts\View\View;

class PromotionBannerController extends Controller
{
    protected string $endpoint;

    public function __construct(
        protected ClientRequestAction $clientAction,
        protected CreateMultipartAction $multipartAction,
    ) {
        $this->endpoint = config('api.url') . 'promotion-banners';
    }
    
    public function index(): View
    {
        return view('admin.content-management.promotion-banner.index');
    }

    public function store(PromotionBannerRequest|array $request)
    {   
        $dataRequest = $request instanceof PromotionBannerRequest ? $request->all() : $request;
        $formData = $this->multipartAction->create($dataRequest, 'banner_image_name');
        
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
