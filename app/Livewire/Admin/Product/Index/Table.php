<?php

namespace App\Livewire\Admin\Product\Index;

use App\Http\Controllers\Web\Admin\ProductController;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportEvents\Event;

class Table extends Component
{
    /**
     * Data products instance.
    */
    public null|array $products = null;

    /**
     * Extended url for parameter endpoint purpose.
    */
    public string $extendedUrl;

    /**
     * Filter boolean active or inactive current filter.
    */
    public bool $filter;

    /**
     * Sort by column.
    */
    public string $sortBy = '';

    /**
     * Sort direction by ascending or descending.
    */
    public string $sortDir = 'desc';

    /**
     * Init filter value to false every subsequent request.
    */
    public function boot(): void
    {
        $this->filter      = false;
        $this->extendedUrl = '?paginate=true&perPage=10' . withGodAccess('&');
    }

    /**
     * Load content and fire the event.
    */
    #[On('load-content')]
    public function loadContent(): Event
    {
        $this->products = app(ProductController::class)->getListProducts(
            extendedUrl: $this->extendedUrl,
            header     : [
                'Authorization' => getAuthToken(),
            ],
        );

        return $this->dispatch('content-loaded', response: $this->products, filter: $this->filter);
    }

    /**
     * Get params url for endpoint after capturing event.
     * 
     * @param string $url
     * @param bool   $filter
    */
    #[On('filter-table')]
    public function listenFilter(string $url, bool $filter = false): Event
    {
        $this->extendedUrl = $url;
        $this->filter      = $filter;

        return $this->loadContent();
    }

    /**
     * Sort filter for table data.
     * 
     * @param string $column
    */
    public function sortByFilter(string $fieldName): Event
    {
        if ($this->sortBy === $fieldName) {
            $this->sortDir = $this->sortDir === 'asc' 
                ? 'desc' 
                : 'asc';   
        }

        $this->sortBy       = $fieldName;
        $this->extendedUrl .= '&sortBy=' . $this->sortBy . '&sortDir=' . $this->sortDir;
        $this->filter       = true;

        return $this->loadContent();
    }

    /**
     * Listen when reset filter button is fire, then reset all variables 
     * value that ​​related to the filter. After that get new data content.
    */
    #[On('reset-filter')]
    public function resetFilter(): Event
    {
        $this->reset(
            'sortBy', 
            'sortDir',
        );

        return $this->loadContent();
    }

    /**
     * Fire delete event to modal delete.
     * 
     * @param string $model
     * @param string $contentName
     * @param string $contentSlug
    */
    public function delete(string $model, string $contentName, string $contentSlug): Event
    {
        return $this->dispatch('modal-delete', data: [
            'catalog_model' => $model,
            'content_name'  => $contentName, 
            'content_slug'  => $contentSlug, 
        ]);
    }

    public function render()
    {
        return view('livewire.admin.product.index.table');
    }
}
