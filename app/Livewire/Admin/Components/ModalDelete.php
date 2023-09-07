<?php

namespace App\Livewire\Admin\Components;

use Livewire\Component;
use Livewire\Attributes\On;

class ModalDelete extends Component
{
    public $category = [
        'id' => 0, 
        'name' => '',
    ];

    public $showModal = '';

    #[On('modal-info')] 
    public function addModalInfo($category)
    {
        $this->category = $category;
        $this->showModal = 'show';
    }

    public function closeModal()
    {
        $this->showModal = '';
    }
    
    public function render()
    {
        return view('livewire.admin.components.modal-delete');
    }
}
