<?php

namespace App\Livewire\General\Search;

use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\Features\SupportEvents\Event;

class SectionFilter extends Component
{
    /**
     * The key of the parameter in the URL used to search 
     * for products by categories.
    */
    #[Url]
    public string $categories = '';

    // Data for input of filters. 
    public array $listCategories = [];
    public array $listBrand = [];
    public array $listSupplier = [];

    // Container for input value of filters. 
    public array $filterCategories = [];
    public array $filterSupplier = [];
    public string $filterBrand = '';
    public string $filterMinPrice = '';
    public string $filterMaxPrice = '';

    /**
     * Loads the filter data from the given array and updates the component's state.
    */
    #[On('content-loaded')]
    public function loadFilter(array $data): void
    {
        $this->listCategories = $data['list_category'];
        $this->listBrand      = $data['list_brand'];
        $this->listSupplier   = $data['list_supplier'];

        $this->filterCategories = explode('|', $this->categories);
    }

    /**
     * Applies the current filter settings to the content.
     *
     * This function takes the current filter settings, constructs a URL query string,
     * and dispatches an event to load the content based on the filter settings.
    */
    public function applyFilter(): Event
    {
        $paramCategory = implode('|', $this->filterCategories);
        $paramSupplier = implode('|', $this->filterSupplier);

        return $this->dispatch('load-content', url: [
            'categories' => $paramCategory,
            'supplier'   => $paramSupplier,
            'brand'      => $this->filterBrand,
            'min_price'  => $this->filterMinPrice,
            'max_price'  => $this->filterMaxPrice,
        ]);
    }

    /**
     * Resets the filter settings and applies the current filter settings to the content.
    */
    public function resetFilter(): void
    {
        $this->reset(
            'filterCategories', 
            'filterBrand', 
            'filterSupplier',
            'filterMinPrice',
            'filterMaxPrice',
        );

        $this->filterCategories = explode('|', $this->categories);

        $this->applyFilter();
    }

    public function render()
    {
        return view('livewire.general.search.section-filter');
    }
}
