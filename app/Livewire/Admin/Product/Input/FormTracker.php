<?php

namespace App\Livewire\Admin\Product\Input;

use Livewire\Attributes\On;
use Livewire\Component;

class FormTracker extends Component
{
     /**
     * Contain default value of input data form.
    */
    public array $formDefaultValue;

    /**
     * List form label for tracking info.
    */
    public array $formLabelName;

    /**
     * Specifies which input are not included in tracker validation. Such as,
     * input that has a default value or not required (optional).
    */
    public array $formGuarded;

    /**
     * Instance data form tracker.
    */
    public array $formTracker;

    /**
     * Line tracker animation long duration.
    */
    public int $duration = 75;

    /**
     * Intializes all value of global props.
    */
    public function mount(): void
    {
        $this->formDefaultValue = [
            'product_images[]'       => '',
            'category_id'            => '',
            'brand_id'               => '',
            'supplier_id'            => '',
            'retailers_id[]'         => '',
            'plu'                    => '',
            'product_name'           => '',
            'product_slug'           => '',
            'normal_price'           => '',
            'discount_price'         => '',
            'discount_start_date'    => '',
            'discount_end_date'      => '',
            'product_stock'          => '',
            'product_deploy_status'  => 'Publish',
            'product_meta_keyword[]' => '',
            'product_description'    => '',
        ];

        $this->formLabelName = [
            'product_images[]'       => 'T. Gambar',
            'category_id'            => 'Kategori',
            'brand_id'               => 'Brand',
            'supplier_id'            => 'Supplier',
            'retailers_id[]'         => 'Retailer',
            'plu'                    => 'PLU',
            'product_name'           => 'Nama',
            'product_slug'           => 'Slug',
            'normal_price'           => 'Harga',
            'discount_price'         => 'Diskon',
            'discount_start_date'    => 'Mulai',
            'discount_end_date'      => 'Selesai',
            'product_stock'          => 'Stok',
            'product_deploy_status'  => 'Status',
            'product_meta_keyword[]' => 'Keyword',
            'product_description'    => 'Deskripsi',
        ];

        $this->formGuarded = [
            'discount_price',
            'discount_start_date',
            'discount_end_date',
            'product_deploy_status',
        ];

        $index = 0;

        foreach ($this->formLabelName as $key => $value) {
            $inputLabel = $this->formLabelName[$key];

            // This initializes the form track line. This will contain a boolean 
            // where the inputs included in the guard, will be set to true and those 
            // that are not, set to false. Each condition will determine the color 
            // of the track line.
            $this->formTracker[$inputLabel] = [
                'is_active'         => in_array($key, $this->formGuarded),
                'animate_duration'  => $this->duration . 'ms',
                'animate_delay'     => $index * $this->duration . 'ms',
            ];

            $index++;
        }
    }

    /**
     * Re initialize form tracker value, when has data category.
     * 
     * @param string $slugFetch Slug product
    */
    #[On('content-loaded')]
    public function validatedAllTracker(string $slugFetch): void
    {
        if (empty($slugFetch)) {
            return;
        }

        $index = 0;

        foreach ($this->formTracker as $key => $value) {
            $this->formTracker[$key] = [
                'is_active'         => true,
                'animate_duration'  => $this->duration . 'ms',
                'animate_delay'     => $index * $this->duration . 'ms',
            ];

            $index++;
        }
    }
    
    /**
     * Update data form tracker when form input had changes.
     * 
     * @param array $formUpdate Latest update Form data from js
    */
    #[On('updating-tracker')]
    public function updatingTracker(array $formUpdate): void
    {
        $index = 0;

        foreach ($formUpdate as $key => $value) {
            if (! isset($this->formLabelName[$key])) {
                continue;
            }

            $delay                 = '0ms';
            $inputLabel            = $this->formLabelName[$key];
            $isInputNotChanged     = $value == $this->formDefaultValue[$key];
            $ensureInputNotGuarded = ! in_array($key, $this->formGuarded);
            $inputIsValidated      = $isInputNotChanged && $ensureInputNotGuarded ? false : true;
            
            if (! $inputIsValidated) {
                $delay = $index * $this->duration . 'ms';
                $index ++;
            }
            
            $this->formTracker[$inputLabel] = [
                'is_active'        => $inputIsValidated,
                'animate_duration' => $this->duration . 'ms',
                'animate_delay'    => $delay,
            ];
        }
    }

    public function render()
    {
        return view('livewire.admin.product.input.form-tracker');
    }
}
