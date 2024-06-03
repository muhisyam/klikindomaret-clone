<?php

namespace App\Livewire\Admin\Category\Index;

use App\Http\Controllers\Web\Admin\CategoryController;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Table extends Component
{
    /**
     * Categories data instance.
     * 
     * @var null|array $categories
    */
    public null|array $categories = null;

    /**
     * Extended url for parameter endpoint purpose.
     *
     * @var string
    */
    public string $extendedUrl;

    /**
     * Filter boolean active or inactive current filter.
     * 
     * @var bool $filter
    */
    public bool $filter;

    /**
     * Sort by column.
     * 
     * @var string $sortBy
    */
    public string $sortBy = '';

    /**
     * Sort direction by ascending or descending.
     * 
     * @var string $sortDir
    */
    public string $sortDir = 'desc';

    /**
     * Init filter value to false every subsequent request.
    */
    public function boot()
    {
        $this->filter      = false;
        $this->extendedUrl = '?paginate=true&perPage=10';
}

    /**
     * Load content and fire the event.
    */
    public function loadContent(): void
    {
        $this->categories = app(CategoryController::class)->getListCategories(
            extendedUrl: $this->extendedUrl,
        );

        $this->dispatch('content-loaded', response: $this->categories, filter: $this->filter);
    }

    /**
     * Get params url for endpoint after capturing event.
     * 
     * @param string $url
    */
    #[On('filter-table')]
    public function listenFilter(string $url, bool $filter = false): void
    {
        $this->extendedUrl = $url;
        $this->filter      = $filter;

        $this->loadContent();
    }

    /**
     * Sort filter for table data.
     * 
     * @param string $column
    */
    public function sortByFilter(string $fieldName)
    {
        if ($this->sortBy === $fieldName) {
            $this->sortDir = $this->sortDir === 'asc' 
                ? 'desc' 
                : 'asc';   
        }

        $this->sortBy       = $fieldName;
        $this->extendedUrl .= '&sortBy=' . $this->sortBy . '&sortDir=' . $this->sortDir;
        $this->filter       = true;

        $this->loadContent();
    }

    /**
     * Listen when reset filter button is fire, then reset all variables 
     * value that ​​related to the filter. Arter that get new data content.
    */
    #[On('reset-filter')]
    public function resetFilter()
    {
        $this->reset(
            'sortBy', 
            'sortDir',
        );

        $this->loadContent();
    }

    public function delete($dataCategory)
    {
        $this->dispatch('modal-delete', data: $dataCategory);
    }

    public function render(): View
    {
        return view('livewire.admin.category.index.table');
    }
}
