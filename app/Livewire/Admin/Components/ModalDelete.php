<?php

namespace App\Livewire\Admin\Components;

use Livewire\Component;
use Livewire\Attributes\On;

class ModalDelete extends Component
{
    public $dataModal = [];
    
    public $showModal = '';
    public $checkbox = false;

    public $catalogLists = [
        'category_name' => 'category',
        'product_name' => 'product',
        'featured_name' => 'featured',
    ];
    
    public $deleteRouteLists = [
        'category' => 'categories.destroy',
        'product' => 'products.destroy',
        'featured' => 'featured-contents.destroy',
    ]; 

    public $catalog;
    public $deleteRoute;

    #[On('modal-delete')] 
    public function addModalInfo($data)
    {
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $this->catalogLists)) {
                $this->catalog = $this->catalogLists[$key];
                $this->deleteRoute = $this->deleteRouteLists[$this->catalog];
            } 
        }

        $this->reset('checkbox');
        $this->dataModal = $data;
        $this->showModal = 'show';
    }

    public function closeModal()
    {
        $this->showModal = '';
        $this->checkbox = false;
    }
    
    public function render()
    {
        return view('livewire.admin.components.modal-delete');
    }
}
