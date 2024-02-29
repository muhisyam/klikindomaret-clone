<?php

namespace App\Livewire\Admin\FeaturedContent;

use App\Models\Product;
use Livewire\Component;

class FormModal extends Component
{
    public $showCondition = false;
    public $section;
    public $productKey, $dataProduct;

    function updatedProductKey() 
    {
        // TODO: This
    }

    public function render()
    {
        return view('livewire.admin.featured-content.form-modal');
    }
}
