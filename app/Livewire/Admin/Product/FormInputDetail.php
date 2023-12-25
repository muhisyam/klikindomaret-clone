<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Services\Backend\ApiCallService;

class FormInputDetail extends Component
{
    private $apiService;
    private $getParentsListUrl = 'http://127.0.0.1:8080/api/v1/categories?withoutPagination=true';
    private $getParentChildrensListUrl = 'http://127.0.0.1:8080/api/v1/categories/sub/';

    private $getStoresListUrl = 'http://127.0.0.1:8080/api/v1/stores';

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
    
    public $storesList = NULL;
    
    public function mount($error, $data = null, $old = null) 
    {
        $this->error = $error;
        $this->data = $data;
        $this->old = $old;
        
        // Init value each key is NULL 
        $this->inputs = array_map(fn() => NULL, $this->inputs);

        if (!is_null($this->data)) {
            $this->inputs = [
                'plu' => $this->data['plu'], 
                'name' => $this->data['product_name'], 
                'slug' => $this->data['product_slug'], 
                'normalPrice' => $this->data['normal_price'], 
                'discountPrice' => $this->data['discount_price'], 
                'stock' => $this->data['product_stock'],
            ];
        }

        if (!empty($this->old)) {
            $this->inputs = [
                'plu' => $this->old['plu'], 
                'name' => $this->old['product_name'], 
                'slug' => $this->old['product_slug'], 
                'normalPrice' => $this->old['normal_price'], 
                'discountPrice' => $this->old['discount_price'], 
                'stock' => $this->old['product_stock'],
            ];
        }
    }

    public function updatedCategoryParent()
    {
        // Init api service class 
        $this->apiService = app(ApiCallService::class);

        // Get children top level category
        $this->getParentChildrensListUrl .= $this->categoryParent . '?withoutPagination=true';
        $this->categoryChildrenList = $this->apiService->getData($this->getParentChildrensListUrl);

        $this->dispatch('select2', categoryChildren: $this->categoryChildrenList); 
    }

    public function updatedInputsName()
    {
        $this->inputs['slug'] = Str::slug($this->inputs['name']);
    }

    public function render()
    {   
        // Init api service class 
        $this->apiService = app(ApiCallService::class);

        // Get data top level category
        $responseCategory = $this->apiService->getData($this->getParentsListUrl);
        $this->categoryParentsList = $responseCategory['data'];

        // Get data store
        $responseStore = $this->apiService->getData($this->getStoresListUrl);
        $this->storesList = $responseStore['data'];

        return view('livewire.admin.product.form-input-detail');
    }
}
