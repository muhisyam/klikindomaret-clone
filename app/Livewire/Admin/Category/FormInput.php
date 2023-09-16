<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\Backend\CategoryService;

class FormInput extends Component
{
    protected $url = 'http://127.0.0.1:8080/api/v1/categories/query/';

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
            $this->inputName = $this->data['name'];
            $this->inputSlug = $this->data['slug'];
        }

        if (!empty($this->old)) {
            $this->inputName = $this->old['name'];
            $this->inputSlug = $this->old['slug'];
        }
    }

    public function boot()
    {
        $this->category = NULL;

        if (!is_null($this->data)) {
            $this->inputSlug = $this->data['slug'];
        }
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

    public function updatedInputName()
    {
        $this->inputSlug = Str::slug($this->inputName);
    }

    public function render()
    {
        return view('livewire.admin.category.form-input');
    }
}
