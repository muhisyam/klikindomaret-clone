<?php

namespace App\Livewire\Admin\Product\Includes\Index;

use Livewire\Component;
use App\Services\Backend\ApiCallService;

class TableHeader extends Component
{
    private $apiService;
    private $getProductSortListUrl = 'http://127.0.0.1:8080/api/v1/products';

    public $columnSortBy;
    public $columnOrderBy = 'asc';

    public $productList;

    public function sortBy($fieldName)
    {
        if ($this->columnSortBy === $fieldName) {
            $this->columnOrderBy = $this->columnOrderBy === 'asc' ? 'desc' : 'asc';   
        }

        $this->columnSortBy = $fieldName;

        // Init api service class 
        $this->apiService = app(ApiCallService::class);

        // Get children top level category
        $this->getProductSortListUrl .= '?sortby=' . $this->columnSortBy . '&orderby=' . $this->columnOrderBy;
        $this->productList = $this->apiService->getData($this->getProductSortListUrl);

        $this->dispatch('sort-data', sortData: $this->productList);
        $this->dispatch('get-orderby', orderby: $this->columnOrderBy);
    }

    public function render()
    {
        return view('livewire.admin.product.includes.index.table-header');
    }
}
