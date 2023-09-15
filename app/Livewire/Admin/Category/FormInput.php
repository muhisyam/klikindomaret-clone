<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use App\Services\Backend\CategoryService;
use Illuminate\Http\Request;

class FormInput extends Component
{
    protected $url = 'http://127.0.0.1:8080/api/v1/categories/query/';

    public $error;
    public $data;

    public $category = NULL;
    public $selectedLevel = NULL;
    public $categoryLastChild = NULL;

    public function mount($error, $data = null)
    {
        $this->error = $error;
        $this->data = $data;
    }

    public function boot()
    {
        $this->category = NULL;
    }

    public function updatedSelectedLevel(CategoryService $categoryService, Request $request)
    {
        if ($this->selectedLevel != 1) {
            if ($this->selectedLevel == 2) {
                $this->categoryLastChild = 0;
            } elseif ($this->selectedLevel == 3) {
                $this->categoryLastChild = 1;
            }

            $this->url .= $this->categoryLastChild;
            $this->category = $categoryService->getData($this->url, $request);
        }

        $this->dispatch('select2', category: $this->category); 
    }

    public function render()
    {
        return view('livewire.admin.category.form-input');
    }
}
