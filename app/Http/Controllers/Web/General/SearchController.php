<?php

namespace App\Http\Controllers\Web\General;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Http\Controllers\Controller;
use App\Services\PaginationService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;

class SearchController extends Controller
{
    /**
     * Api endpoint
     *
     * @var string
     */
    protected string $endpoint;

    /**
     * Create a new resource instance.
     *
     * @return void
    */
    public function __construct(
        protected ClientRequestAction $clientAction,
        protected PaginationService   $paginationService
    ) {
        $this->endpoint = config('api.url') . 'search/';
    }
    
    /**
     * Direct to product search page.
    */
    public function index(): View
    {
        return view('general.search.index');
    }

    /**
     * Retieve filtered product list in user interface.
    */
    public function getListCategories(string $extendedUrl = '', array $header = []): array
    {
        $response = $this->getDataCategories($extendedUrl, $header);
        $response = $this->updatingMetaLink($response);

        return $response;
    }

    /**
     * Retieve data filtered products with sub url or params.
    */
    public function getDataCategories(string $extendedUrl, array $header): array
    {
        return $this->clientAction->request(
            new ClientRequestDto(
                method:   'GET',
                endpoint: $this->endpoint . $extendedUrl,
                headers:  $header,
            )
        );
    }

    /**
     * Updates the 'links' key in the 'meta' array of the given response array if it is a paginated response.
    */
    private function updatingMetaLink(array $response): array
    {
        if (! $this->isResponsePagination($response)) {
            return $response;
        }

        $response['meta']['links'] = $this->paginationService->customPaginationLinks($response['meta']);

        return $response;
    }

    private function isResponsePagination(array $response): bool
    {
        return Arr::exists($response, 'links') ? true : false;
    }
}