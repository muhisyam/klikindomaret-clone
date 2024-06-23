<?php

namespace App\Livewire\Admin\Category\Input;

use App\Http\Controllers\Web\Admin\CategoryController;
use App\Http\Responses\ClientErrorResponse;
use Illuminate\Http\RedirectResponse;
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
    public array $form_select_parent            = [];

    /**
     * Load content and fire the event.
    */
    public function loadContent(): void
    {
        if (! empty($this->slugFetch)) {
            $this->fetchDataCategory();
        }

        if (! empty($this->old)) {
            $this->setInputOldValues();
        }

        $this->dispatch('content-loaded', slugFetch: $this->slugFetch);
    }

    /**
     * Fetch data category when route is edit, for form input data. If data not found,
     * it will redirect to Page not found.
    */
    private function fetchDataCategory(): RedirectResponse|bool
    {
        $response = app(CategoryController::class)->getDataCategories(
            extendedUrl: $this->slugFetch . '?with_form=true',
            header: [],
        );

        if ($response['meta']['status_code'] >= 400) {
            return app(ClientErrorResponse::class)->toResponse($response);
        }

        $dataResponse = $response['data'];

        $this->category_image_name          = $dataResponse['category_image_name'] ?? '';
        $this->category_image_size          = $dataResponse['category_image_size'] ?? '';
        $this->original_category_image_name = $dataResponse['original_category_image_name'] ?? '';
        $this->parent_id                    = $dataResponse['parent_id'] ?? 0;
        $this->category_name                = $dataResponse['category_name'];
        $this->category_slug                = $dataResponse['category_slug'];
        $this->category_deploy_status       = $dataResponse['category_deploy_status'];
        $this->form_select_parent           = $dataResponse['form_select_parent'];

        return true;
    }

    /**
     * Set input model with old values if exists.
    */
    private function setInputOldValues(): void
    {
        $dataOld = $this->old;

        $this->parent_id              = $dataOld['parent_id'];
        $this->category_name          = $dataOld['category_name'];
        $this->category_slug          = $dataOld['category_slug'];
        $this->category_deploy_status = $dataOld['category_deploy_status'];
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
