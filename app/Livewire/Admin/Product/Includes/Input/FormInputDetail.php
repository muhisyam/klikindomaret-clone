<?php

namespace App\Livewire\Admin\Product\Includes\Input;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Services\Backend\ApiCallService;

class FormInputDetail extends Component
{
    private $apiService;

    private $endpoint = [
        'parentList' => 'http://127.0.0.1:8080/api/v1/categories?withoutPagination=true',
        'childrenList' => 'http://127.0.0.1:8080/api/v1/categories/sub/',
        'suppliersList' => 'http://127.0.0.1:8080/api/v1/suppliers',
        'storesList' => 'http://127.0.0.1:8080/api/v1/stores/',
    ];

    public $error;
    public $data;
    public $old;
    
    public $inputs = [
        'plu', 
        'name', 
        'slug', 
        'normalPrice', 
        'discountPrice', 
        'stock',
    ];
    
    public $categoryParentsList = NULL;
    public $categoryChildrenList = NULL;
    public $categoryParent = NULL;
    
    public $suppliersList = NULL;
    public $supplierInput = NULL;

    public $storesList = NULL;
    
    public function mount($error, $data = null, $old = null) 
    {   
        $this->error = $error;
        $this->data = $data;
        $this->old = $old;
        
        // Init value each key is NULL 
        $this->inputs = array_map(fn() => NULL, $this->inputs);

        if (!is_null($this->data) || !empty($this->old)) {
            $sourceData = !is_null($this->data) ? $this->data : $this->old;
        
            $this->inputs = [
                'plu' => $sourceData['plu'], 
                'name' => $sourceData['product_name'], 
                'slug' => $sourceData['product_slug'], 
                'normalPrice' => $sourceData['normal_price'], 
                'discountPrice' => $sourceData['discount_price'], 
                'stock' => $sourceData['product_stock'],
            ];
        
            $this->supplierInput = $sourceData['supplier_id'];
            $this->endpoint['storesList'] .= '?supplier_id=' . $this->supplierInput . '&withoutPagination=true';
            
            $this->storesList = ($this->supplierInput === 1 || $this->supplierInput === 2) 
                ? $this->isIndomaretSupplierSelected()
                : $this->getDataFromApiService($this->endpoint['storesList']);
        }
    }

    public function updatedCategoryParent()
    {
        // Get children top level category
        $this->endpoint['childrenList'] .= $this->categoryParent . '?withoutPagination=true';
        $this->categoryChildrenList = $this->getDataFromApiService($this->endpoint['childrenList']);

        $this->dispatch('select2-categories', categoryChildren: $this->categoryChildrenList); 
    }

    public function updatedInputsName()
    {
        $this->inputs['slug'] = Str::slug($this->inputs['name']);
    }

    public function updatedSupplierInput()
    {
        if ($this->supplierInput === '1' || $this->supplierInput === '2') {
            return $this->dispatch('select2-stores', storeList: $this->isIndomaretSupplierSelected()); 
        }

        // Get stores list
        $this->endpoint['storesList'] .= '?supplier_id=' . $this->supplierInput . '&withoutPagination=true';
        $this->storesList = $this->getDataFromApiService($this->endpoint['storesList']);

        $this->dispatch('select2-stores', storeList: $this->storesList); 
    }

    public function render()
    {
        // Get data top level category
        $this->categoryParentsList = $this->getDataFromApiService($this->endpoint['parentList']);

        // Get data supplier
        $this->suppliersList = $this->getDataFromApiService($this->endpoint['suppliersList']);

        return view('livewire.admin.product.includes.input.form-input-detail');
    }

    private function getDataFromApiService(string $endpoint)
    {
        // Init api service class 
        $this->apiService = app(ApiCallService::class);

        return $this->apiService->getData($endpoint);
    }

    private function isIndomaretSupplierSelected()
    {
        return [
            'data' => [[
                'id' => 'all_store',
                'store_name' => 'Semua Toko Indomaret',
            ]]  
        ]; 
    }
}
