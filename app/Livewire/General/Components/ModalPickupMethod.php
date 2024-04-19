<?php

namespace App\Livewire\General\Components;

use Livewire\Component;

class ModalPickupMethod extends Component
{
    public string $section;
    
    public function render()
    {
        return view('livewire.general.components.modal-pickup-method');
    }
}
