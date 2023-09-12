<?php

namespace App\Livewire\Admin\Components;

use Livewire\Component;
use Livewire\Attributes\On;

class ModalDelete extends Component
{
    public $category = [];
    
    public $showModal = '';
    public $checkbox = false;

    #[On('modal-info')] 
    public function addModalInfo($category)
    {
        $this->reset('checkbox');
        $this->category = $category;
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
