<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;

class TableButtonAction extends Component
{
    public $category;

    public function dispatchModal($dataCategory)
    {
        $this->dispatch('modal-info', category: $dataCategory);
    }

    public function render()
    {
        return view('livewire.admin.category.table-button-action');
    }
}
