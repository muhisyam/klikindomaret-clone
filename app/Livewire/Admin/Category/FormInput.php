<?php

namespace App\Livewire\Admin\Category;

use App\Services\Backend\ApiCallService;
use Livewire\Component;
use Illuminate\Support\Str;

class FormInput extends Component
{
    protected $url = 'http://127.0.0.1:8080/api/v1/categories/top-children/';

    public $error;
    public $data;
    public $old;

    public $category = NULL;
    public $selectedLevel = NULL;
    public $categoryLastChild = NULL;
    public $inputName = NULL;
    public $inputSlug = NULL;

    public function mount($error, $data = null, $old = null)
    {
        $this->error = $error;
        $this->data = $data;
        $this->old = $old;

        if (!is_null($this->data)) {
            $this->inputName = $this->data['category_name'];
            $this->inputSlug = $this->data['category_slug'];
        }

        if (!empty($this->old)) {
            $this->inputName = $this->old['category_name'];
            $this->inputSlug = $this->old['category_slug'];
        }
    }

    public function boot()
    {
        $this->category = NULL;

        if (!is_null($this->data)) {
            $this->inputSlug = $this->data['category_slug'];
        }
    }

    public function updatedSelectedLevel(ApiCallService $apiService)
    {
        if ($this->selectedLevel != 1) {
            $this->categoryLastChild = $this->selectedLevel == 2 ? 0 : 1;
            
            $this->url .= $this->categoryLastChild;
            $this->category = $apiService->getData($this->url);
        }

        $this->dispatch('select2', category: $this->category); 
    }

    public function updatedInputName()
    {
        $this->inputSlug = Str::slug($this->inputName);
    }

    public function render()
    {
        return view('livewire.admin.category.form-input');
    }
}
