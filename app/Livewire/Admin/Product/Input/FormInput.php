<?php

namespace App\Livewire\Admin\Product\Input;

use App\Http\Controllers\Web\Admin\ProductController;
use App\Http\Responses\ClientErrorResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\Features\SupportEvents\Event;

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
     * Url for select which form should be active.
    */
    #[Url]
    public string $step = '';

    /**
     * Data category for option select parent category.
    */
    public string $activeSwitch = 'product-informations';

    // All category data according to the existing columns for input fields.
    public int $category_id    = 0;
    public int $brand_id       = 0;
    public int $supplier_id    = 0;
    public array $retailers_id = [];

    public array $form_select_category;
    public array $form_select_brand;
    public array $form_select_supplier;
    public array $form_select_retailers;

    public string $plu                     = '';
    public string $product_name            = '';
    public string $product_slug            = '';
    public string $normal_price            = '';
    public string $discount_price          = '';
    public string $discount_start_date     = '';
    public string $discount_end_date       = '';
    public string $product_stock           = '';
    public string $product_deploy_status   = 'Draft';
    public string $product_description     = '';
    public array $product_meta_keyword     = [];
    public array $form_select_meta_keyword = [];
    public array $product_images           = [];

    public function mount(): void
    {
        $switch = $this->step ?: 'product-informations';
        $switch = in_array($switch, ['product-informations', 'product-details', 'product-description'])
            ? $switch
            : 'product-informations';

        $this->activeSwitch = $switch;
    }

    /**
     * Load content and fire the event.
    */
    public function loadContent(): Event
    {
        if (! empty($this->slugFetch)) {
            $this->fetchDataProduct();
        }

        if (! empty($this->old)) {
            $this->setInputOldValues();
        }

        return $this->dispatch(
            'content-loaded', 
            slugFetch: $this->slugFetch, 
            retailer:  $this->retailers_id, 
            keyword:   $this->product_meta_keyword
        );
    }

    /**
     * Fetch data category when route is edit, for form input data. If data not found,
     * it will redirect to Page not found.
    */
    private function fetchDataProduct(): RedirectResponse|bool
    {
        $response = app(ProductController::class)->getDataProducts(
            extendedUrl: $this->slugFetch . '?with_form=true',
            header     : [],
        );


        if ($response['meta']['status_code'] >= 400) {
            return app(ClientErrorResponse::class)->toResponse($response);
        }

        $dataResponse = $response['data'];

        $this->product_images = $dataResponse['product_images'];

        $this->category_id  = $dataResponse['form_select_category']['id'];
        $this->brand_id     = $dataResponse['form_select_brand']['id'];
        $this->supplier_id  = $dataResponse['form_select_supplier']['id'];
        $this->retailers_id = array_column($dataResponse['form_select_retailers'], 'id');

        $this->form_select_category  = $dataResponse['form_select_category'];
        $this->form_select_brand     = $dataResponse['form_select_brand'];
        $this->form_select_supplier  = $dataResponse['form_select_supplier'];
        $this->form_select_retailers = $dataResponse['form_select_retailers'];
        
        $this->plu                   = $dataResponse['plu'];
        $this->product_name          = $dataResponse['product_name'];
        $this->product_slug          = $dataResponse['product_slug'];
        $this->normal_price          = $dataResponse['normal_price'];
        $this->discount_price        = $dataResponse['discount_price'];
        $this->discount_start_date   = $dataResponse['discount_start_date'];
        $this->discount_end_date     = $dataResponse['discount_end_date'];
        $this->product_stock         = $dataResponse['product_stock'];
        $this->product_deploy_status = $dataResponse['product_deploy_status'];
        $this->product_description   = $dataResponse['product_description'];

        $this->product_meta_keyword     = array_column($dataResponse['form_select_meta_keyword'], 'id');
        $this->form_select_meta_keyword = $dataResponse['form_select_meta_keyword'];

        return true;
    }

    /**
     * Set input model with old values if exists.
    */
    private function setInputOldValues(): void
    {
        $dataOld = $this->old;

        $this->plu                   = $dataOld['plu']                   ?? $this->plu;
        $this->product_name          = $dataOld['product_name']          ?? $this->product_name;
        $this->product_slug          = $dataOld['product_slug']          ?? $this->product_slug;
        $this->normal_price          = $dataOld['normal_price']          ?? $this->normal_price;
        $this->discount_price        = $dataOld['discount_price']        ?? '';
        $this->discount_start_date   = $dataOld['discount_start_date']   ?? '';
        $this->discount_end_date     = $dataOld['discount_end_date']     ?? '';
        $this->product_stock         = $dataOld['product_stock']         ?? $this->product_stock;
        $this->product_deploy_status = $dataOld['product_deploy_status'] ?? $this->product_deploy_status;
        $this->product_description   = $dataOld['product_description']   ?? $this->product_description;
        $this->product_meta_keyword  = $dataOld['product_meta_keyword']  ?? $this->product_meta_keyword;

        for ($i=0; $i < count($this->product_meta_keyword); $i++) { 
            $keyword       = $this->product_meta_keyword[$i];
            $formKeyword[] = [
                'id'      => $keyword,
                'keyword' => $keyword,
            ];
        }

        $this->form_select_meta_keyword = $formKeyword;
    }

    /**
     * listen when @var product_name value had changes.
    */
    public function updatedProductName(): Event
    {
        $this->product_slug = Str::slug($this->product_name);

        return $this->dispatch('slug-updated');
    }

    public function render()
    {
        return view('livewire.admin.product.input.form-input');
    }
}
