<?php

namespace App\Livewire\Admin\Product\Includes\Index;

use Livewire\Component;
use App\Services\Backend\ApiCallService;

class TableHeader extends Component
{
    private $apiService;
    private $getProductSortListUrl = 'http://127.0.0.1:8080/api/v1/products';

    public $columnSortBy, $columnOrderBy;
    public $productList;
    public $isProductAsc, $isProductDesc;
    public $isCategoryAsc, $isCategoryDesc;
    public $isStatusAsc, $isStatusDesc;
    public $isStockAsc, $isStockDesc;
    public $isPriceAsc, $isPriceDesc;

    public function boot()
    {
        $this->isProductAsc = 
        $this->isProductDesc =
        $this->isCategoryAsc = 
        $this->isCategoryDesc =
        $this->isStatusAsc = 
        $this->isStatusDesc =
        $this->isStockAsc = 
        $this->isStockDesc =
        $this->isPriceAsc = 
        $this->isPriceDesc = false;
    }

    public function sortBy($fieldName)
    {
        if ($this->columnSortBy === $fieldName) {
            $this->columnOrderBy = $this->columnOrderBy === 'asc' ? 'desc' : 'asc';   
        } else {
            $this->columnSortBy = $fieldName;
            $this->columnOrderBy = 'asc';
        }

        // Init api service class 
        $this->apiService = app(ApiCallService::class);

        // Get sorted list of product 
        $this->getProductSortListUrl .= '?sortby=' . $this->columnSortBy . '&orderby=' . $this->columnOrderBy;
        $this->productList = $this->apiService->getData($this->getProductSortListUrl);

        $this->dispatch('sort-data', sortData: $this->productList);
        $this->updateHeaderClass();

    }

    public function updateHeaderClass()
    {
        $columnMappings = [
            'product_name' => ['isAsc' => 'isProductAsc', 'isDesc' => 'isProductDesc'],
            'category_name' => ['isAsc' => 'isCategoryAsc', 'isDesc' => 'isCategoryDesc'],
            'product_status' => ['isAsc' => 'isStatusAsc', 'isDesc' => 'isStatusDesc'],
            'product_stock' => ['isAsc' => 'isStockAsc', 'isDesc' => 'isStockDesc'],
            'product_price' => ['isAsc' => 'isPriceAsc', 'isDesc' => 'isPriceDesc'],
        ];
    
        // true => product_name, product_name
        if (array_key_exists($this->columnSortBy, $columnMappings)) {
            // $columnMappings['product_name']
            $mapping = $columnMappings[$this->columnSortBy];
            // asc => 'isProductAsc'
            $property = $this->columnOrderBy === 'asc' ? $mapping['isAsc'] : $mapping['isDesc'];
            // $this->isProductAsc
            $this->$property = true;
        }
    } 

    public function render()
    {
        return view('livewire.admin.product.includes.index.table-header');
    }
}
