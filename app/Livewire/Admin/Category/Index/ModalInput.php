<?php

namespace App\Livewire\Admin\Category\Index;

use App\Http\Controllers\Web\Admin\CategoryController;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class ModalInput extends Component
{
    use WithFileUploads;
    
    /**
     * Slug category parent, that use to API endpoint.
     * 
     * @var string $parentSlug
    */
    public string $parentSlug;
    
    /**
     * Modal section name.
     *
     * @var string
    */
    public string $section;

    /**
     * Modal show condition.
     *
     * @var bool
     */
    public bool $showCondition;

    /**
     * Instance of data input error when input has error.
    */
    public array $error = ['errors' => []];

    /**
     * Data category for option select parent category.
    */
    public array $categoryOption = [];
    
    // All category data according to the existing columns for input fields.
    public int $parent_id                 = 0;
    public string $category_name          = '';
    public string $category_slug          = '';
    public string $category_deploy_status = 'Draft';

    /**
     * Pay attention to the variable data type below, it must be either 
     * "\Livewire\Features\SupportFileUploads\TemporaryUploadedFile" or unset. When 
     * using the "Temporary" type, this variable cannot be debugged from dd() helper, 
     * updated method or reset. Therefore, it is important to adjust according to 
     * the module's requirements.
    */
    public $category_image_name = '';

    /**
     * Fetch data category in format select resource for input select parent category.
    */
    public function fetchDataOptionSelect(): void
    {
        $this->categoryOption = app(CategoryController::class)->getDataCategories(
            extendedUrl: 'index/minimal?slug=' . $this->parentSlug,
            header: [],
        )['data'];

        $this->dispatch('content-option-loaded');

        // This statement will prevent the modal from opening automatically after executing 
        // the request to fetch option data.
        $this->showCondition = false;
    }

    /**
     * This method will prevent modal from opening automatically when a component is created.
    */
    public function mount()
    {
        $this->showCondition = false;
    }

    /**
     * This method will always open the modal on every request, so essentially prevents the modal 
     * from closing when there is an unexpected request event.
    */
    public function boot()
    {
        $this->showCondition = true;
    }

    /**
     * listen when @var category_name value had changes.
    */
    public function updatedCategoryName(): void
    {
        $this->category_slug = Str::slug($this->category_name);
    }

    /**
     * Store form category data through API request.
    */
    public function store()
    {
        $formData = [
            'parent_id'              => $this->parent_id,
            'category_name'          => $this->category_name,
            'category_slug'          => $this->category_slug,
            'category_deploy_status' => $this->category_deploy_status,
        ];

        if (! empty($this->category_image_name)) {
            $formData['category_image_name'] = $this->category_image_name;
        }

        $response = app(CategoryController::class)->postDataRequest($formData);

        if ($response['meta']['status_code'] != 201) {
            return $this->error = $response;
        }

        $this->showCondition = false;

        $this->reset(
            'parent_id', 
            'category_name', 
            'category_slug', 
            'category_deploy_status',
            'category_image_name', 
        );

        $this->dispatch('content-stored', notif: [
            'title'   => 'Tambah Kategori',
            'message' => $response['data']['content_name'],
        ]);
    }

    public function render()
    {
        return view('livewire.admin.category.index.modal-input');
    }
}
