<?php

namespace App\Http\Controllers\Web\Admin;

use App\Actions\ClientRequestAction;
use App\Actions\CreateMultipartAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeaturedSectionRequest;
use Illuminate\Http\Request;

class FeaturedSectionController extends Controller
{
    protected string $endpoint;

    public function __construct(
        protected ClientRequestAction $clientAction,
        protected CreateMultipartAction $multipartAction,
    ) {
        $this->endpoint = config('api.url') . 'featured-sections';
    }
    
    public function index(Request $request) 
    {
        return view('admin.content-management.featured-section.index');
    }

    public function store(FeaturedSectionRequest|array $request)
    {   
        $dataRequest = $request instanceof FeaturedSectionRequest ? $request->all() : $request;
        $dataRequest = $this->syncTypeAndIdContentNumbers($dataRequest);
        $formData    = $this->multipartAction->create($dataRequest);

        $response = $this->clientAction->request(
            new ClientRequestDto(
                method: 'POST',
                endpoint: $this->endpoint,
                formData: $formData,
            )
        );

        return $response;
    }

    private function syncTypeAndIdContentNumbers(FeaturedSectionRequest|array $request)
    {
        $dupeTypes = str_repeat($request['contentTypes'] . ',', count($request['contentIds']));
        $newTypes  = explode(',', $dupeTypes);

        $request['contentTypes'] = $newTypes;

        return $request;
    }
}
