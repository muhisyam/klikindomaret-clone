<?php

namespace App\Livewire\General\Search;

use App\Http\Controllers\Web\General\SearchController;
use Illuminate\Support\Arr;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\Features\SupportEvents\Event;

class SectionProduct extends Component
{
    /**
     * Url for select which form should be active.
    */
    #[Url]
    public string $key = '';

    /**
     * The key of the parameter in the URL used to search 
     * for products by categories.
    */
    #[Url]
    public string $categories = '';

    /**
     * The http query parameters used to filter products.
    */
    public string $urlParams = '';

    /**
     * The brand filter.
     */
    public string $brand = '';
    
    /**
     * The supplier filter.
     */
    public string $supplier = '';
    
    /**
     * The minimum price filter.
     */
    public string $minPrice = '';
    
    /**
     * The maximum price filter.
     */
    public string $maxPrice = '';
    
    /**
     * The value select sort order.
     */
    public string $sort = 'created|asc';
    
    /**
     * The field to sort by.
     */
    public string $sortBy = 'created_at';
    
    /**
     * The sort direction.
     */
    public string $sortDir = 'asc';
    
    /**
     * The number of items to display per page.
     */
    public int $perPage = 18;
    
    /**
     * The current page number.
     */
    public int $page = 1;

    /**
     * Data products instance.
    */
    public array $products = [];

    /**
     * Data meta instance.
    */
    public array $meta = [];

    /**
     * Loads content based on the given URL.
    */
    #[On('load-content')]
    public function loadContent(array $url = []): Event
    {
        $this->setUrlParameter($url);

        $response = app(SearchController::class)->getListCategories($this->urlParams);

        $this->products = Arr::only($response, 'data');
        $this->meta     = $response['meta'];
        
        return $this->dispatch('content-loaded', data: [
            'list_category' => $response['list_categories'],
            'list_brand'    => $response['list_brands'], 
            'list_supplier' => $response['list_suppliers'], 
        ]);
    }

    /**
     * Sets the URL parameters for the current instance.
    */
    private function setUrlParameter(array $url): void
    {
        if (! empty($url) ) {
            $this->categories = $url['categories']; 
            $this->brand      = $url['brand']; 
            $this->supplier   = $url['supplier']; 
            $this->minPrice   = $url['min_price']; 
            $this->maxPrice   = $url['max_price']; 
        }

        $this->urlParams = 'products?key=' . $this->key 
            . '&categories=' . $this->categories
            . '&brand='      . $this->brand
            . '&supplier='   . $this->supplier
            . '&minPrice='   . $this->minPrice
            . '&maxPrice='   . $this->maxPrice
            . '&sortBy='     . $this->sortBy
            . '&sortDir='    . $this->sortDir
            . '&page='       . $this->page
            . '&paginate='   . true
            . '&perPage='    . $this->perPage;
    }

    /**
     * Sets the product sort by based on the given sort value.
    */
    #[On('set-product-sort-by')]
    public function setProductSortBy(string $sortValue): Event
    {
        $sortColumn = [
            'created'  => 'created_at',
            'name'     => 'product_name',
            'price'    => 'product_price',
            'discount' => 'product_discount',
        ];

        $explodeValue  = explode('|', $sortValue);
        $this->sortBy  = $sortColumn[$explodeValue[0]];
        $this->sortDir = $explodeValue[1];

        return $this->dispatch('load-content');
    }

    /**
     * Sets the per page value for the product section and reloads the content.
    */
    #[On('set-product-per-page')]
    public function setPerPage(string $perPage): Event
    {
        $this->perPage = $perPage;

        return $this->dispatch('load-content');
    }

    /**
     * Sets the page number and dispatches a 'load-content' event.
    */
    public function toPage(string $page): Event
    {
        $this->page = $page;

        return $this->dispatch('load-content');
    }

    public function render()
    {
        return view('livewire.general.search.section-product');
    }
}
