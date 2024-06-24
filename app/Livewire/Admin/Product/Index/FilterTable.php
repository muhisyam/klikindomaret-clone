<?php

namespace App\Livewire\Admin\Product\Index;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportEvents\Event;

class FilterTable extends Component
{
    /**
     * Products data instance.
    */
    public array $response = [];
    
    /**
     * First template filter url.
    */
    public string $filterUrl = '?paginate=true';
    
    /**
     * Show amount data per page in table.
    */
    public int $perPage = 10;

    /**
     * Dynamic search model data by {model}_name with debounce 
     * interval in 500ms.
    */
    public string $search = '';

    /**
     * Filter boolean active or inactive current filter.
    */
    public bool $isActiveFilter = false;
    
    /**
     * Current active filter key.
    */
    public string $activeFilter = '';

    /**
     * Add limit data page in beginning of every request.
    */
    public function boot()
    {
        $this->response       = [];
        $this->isActiveFilter = false;

        if (! str_contains($this->filterUrl, 'perPage')) {
            $this->filterUrl .= '&perPage=' . $this->perPage;
        }
    }

    /**
     * Load content after capturing event.
     * 
     * @param array $response
     * @param bool  $filter
    */
    #[On('content-loaded')]
    public function loadContent(array $response, bool $filter): void
    {
        $this->response       = $response;
        $this->isActiveFilter = $filter;
    }

    /**
     * Set filter url for where query parameter in endpoint.
     * 
     * @param string $label For identity current active filter tab.
     * @param string $column Target table column name.
     * @param string $query Query to be executed, for example: WHERE, LIKE, BETWEEN 
     * @param string $value Value of the query
    */
    public function filter(string $label = '', string $column = '', string $query = '', string $value = ''): Event
    {
        $this->activeFilter = $label ?? '';
        $activingFilter     = false;

        if ($column === '') {
            return $this->resetFilter();
        }

        $this->filterUrl .= '&search=' . $column . '&' . $query . '=' . $value;
        $activingFilter   = true;

        return $this->dispatch('filter-table', url: $this->filterUrl, filter: $activingFilter);
    }

    /**
     * listen when @var search value had changes.
    */
    public function updatedSearch(): Event
    {
        $this->activeFilter = '';
        $this->filterUrl   .= '&search=product_name&like=' . $this->search;

        return $this->dispatch('filter-table', url: $this->filterUrl, filter: true);
    }

    /**
     * Set filter url for page parameter in endpoint.
     * 
     * @param string $page Page destination.
    */
    public function toPage(string $page): Event 
    {
        $this->filterUrl .= '&page=' . $page;
        
        return $this->dispatch('filter-table', url: $this->filterUrl);
    }

    /**
     * Reset all variables value that ​​related to the filter.
    */
    public function resetFilter(): Event
    {
        $this->reset(
            'filterUrl', 
            'perPage', 
            'search', 
            'isActiveFilter', 
            'activeFilter', 
        );

        return $this->dispatch('reset-filter');
    }
    public function render()
    {
        return view('livewire.admin.product.index.filter-table');
    }
}
