<?php

namespace App\Livewire\Admin\Category\Index;

use App\Http\Controllers\Web\Admin\CategoryController;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class TableParent extends Component
{
    /**
     * Categories data instance.
    */
    public null|array $categories = null;

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
        $this->extendedUrl = '?paginate=true&perPage=10';
}

    /**
     * Load content and fire the event.
    */
    #[On('load-content')]
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
     * @param string $fieldName
    */
    public function sortByFilter(string $fieldName): void
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
     * value that ​​related to the filter. After that get new data content.
    */
    #[On('reset-filter')]
    public function resetFilter(): void
    {
        $this->reset(
            'sortBy', 
            'sortDir',
        );

        $this->loadContent();
    }

    /**
     * Fire delete event to modal delete.
     * 
     * @param string $model
     * @param string $contentName
     * @param string $contentSlug
    */
    public function delete(string $model, string $contentName, string $contentSlug): void
    {
        $this->dispatch('modal-delete', data: [
            'catalog_model' => $model,
            'content_name'  => $contentName, 
            'content_slug'  => $contentSlug, 
        ]);
    }

    public function render(): View
    {
        return view('livewire.admin.category.index.table-parent');
    }
}
