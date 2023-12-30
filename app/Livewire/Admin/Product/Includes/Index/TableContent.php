<?php

namespace App\Livewire\Admin\Product\Includes\Index;

use Livewire\Component;
use Livewire\Attributes\On;

class TableContent extends Component
{
    public $data;

    public function mount($dataProduct)
    {
        $this->data = $dataProduct;
    }
    
    #[On('sort-data')]
    public function newSortData($sortData) 
    {
        $this->data = $sortData;
    }

    public function dispatchModal($dataProduct)
    {
        $this->dispatch('modal-show', data: $dataProduct);
    }

    public function render()
    {
        return view('livewire.admin.product.includes.index.table-content');
    }
}
