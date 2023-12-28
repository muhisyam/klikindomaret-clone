<?php

namespace App\Livewire\Admin\Product\Includes\Index;

use Livewire\Component;
use Livewire\Attributes\On;

class TableContent extends Component
{
    public $data;

    public function mount($dataCategory)
    {
        $this->data = $dataCategory;
    }
    
    #[On('sort-data')]
    public function newSortData($sortData) 
    {
        $this->data = $sortData;
    }

    public function render()
    {
        return view('livewire.admin.product.includes.index.table-content');
    }
}
