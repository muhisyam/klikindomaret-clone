<?php

namespace App\Livewire\Admin\Category\Input;

use App\Http\Controllers\Web\Admin\CategoryController;
use App\Http\Responses\ClientErrorResponse;
use Illuminate\Support\Str;
use Livewire\Component;

class FormInput extends Component
{
    /**
     * From input route destination.
    */
    public string $formRoute;

    /**
     * Instance of data input error when input has error.
    */
    public array $error;

    /**
     * Flash old data input from session when input has error.
    */
    public array $old;

    /**
     * Category slug for fetching data. 
    */
    public string $slugFetch;

    /**
     * Data category for option select parent category.
    */
    public array $categoryOption;

    // All category data according to the existing columns for input fields.
    public int $parent_id                       = 0;
    public string $category_name                = '';
    public string $category_slug                = '';
    public string $category_deploy_status       = 'Draft';
    public string $category_image_name          = '';
    public string $category_image_size          = '';
    public string $original_category_image_name = '';

    /**
     * Load content and fire the event.
    */
    public function loadContent(): void
    {
        $this->fetchDataOptionSelect();

        if (! empty($this->slugFetch)) {
            $this->fetchDataCategory();
        }

        if (! empty($this->old)) {
            $this->setInputOldValues();
        }

        $this->dispatch('content-loaded', slugFetch: $this->slugFetch);
    }

    /**
     * Fetch data category in format select resource for input select parent category.
    */
    private function fetchDataOptionSelect(): void
    {
        $this->categoryOption = app(CategoryController::class)->getDataCategories(
            extendedUrl: 'index/minimal?minimal=true',
            header: [],
        )['data'];
    }

    /**
     * Fetch data category when route is edit, for form input data. If data not found,
     * it will redirect to Page not found.
    */
    private function fetchDataCategory(): ClientErrorResponse|bool
    {
        $response = app(CategoryController::class)->getDataCategories(
            extendedUrl: $this->slugFetch,
            header: [],
        );

        if ($response['meta']['status_code'] >= 400) {
            return new ClientErrorResponse($response);
        }

        $this->category_image_name          = $response['data']['category_image_name'] ?? '';
        $this->category_image_size          = $response['data']['category_image_size'] ?? '';
        $this->original_category_image_name = $response['data']['original_category_image_name'] ?? '';
        $this->parent_id                    = $response['data']['parent_id'] ?? 0;
        $this->category_name                = $response['data']['category_name'];
        $this->category_slug                = $response['data']['category_slug'];
        $this->category_deploy_status       = $response['data']['category_deploy_status'];

        return true;
    }

    /**
     * Set input model with old values if exists.
    */
    private function setInputOldValues(): void
    {
        $this->parent_id              = $this->old['parent_id'] ?? 0;
        $this->category_name          = $this->old['category_name'] ?? '';
        $this->category_slug          = $this->old['category_slug'] ?? '';
        $this->category_deploy_status = $this->old['category_deploy_status'] ?? 'Draft';
    }

    /**
     * listen when @var category_name value had changes.
    */
    public function updatedCategoryName(): void
    {
        $this->category_slug = Str::slug($this->category_name);

        $this->dispatch('slug-updated');
    }

    public function render()
    {
        return view('livewire.admin.category.input.form-input');
    }
}
