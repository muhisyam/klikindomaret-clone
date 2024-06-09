<?php

namespace App\Livewire\Admin\Category\Input;

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
    public int $duration = 400;

    /**
     * Intializes all value of global props.
    */
    public function mount(): void
    {
        $this->formDefaultValue = [
            'category_image_name'    => '',
            'parent_id'              => '0',
            'category_name'          => '',
            'category_slug'          => '',
            'category_deploy_status' => 'Publish',
        ];

        $this->formLabelName = [
            'category_image_name'    => 'Tambah Gambar',
            'parent_id'              => 'Kategori Induk',
            'category_name'          => 'Nama Kategori',
            'category_slug'          => 'Slug Kategori',
            'category_deploy_status' => 'Status',
        ];

        $this->formGuarded = [
            'category_image_name',
            'parent_id',
            'category_deploy_status',
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
    */
    #[On('updating-tracker')]
    public function updatingTracker(array $formUpdate): void
    {
        $index = 0;

        foreach ($formUpdate as $key => $value) {
            if (! isset($this->formLabelName[$key])) {
                continue;
            }

            $inputLabel            = $this->formLabelName[$key];
            $isInputNotChanged     = $value == $this->formDefaultValue[$key];
            $ensureInputNotGuarded = ! in_array($key, $this->formGuarded);
            $inputIsValidated      = $isInputNotChanged && $ensureInputNotGuarded ? false : true;
            
            if (! $inputIsValidated) {
                $delay = $index * $this->duration . 'ms';
                $index ++;
            } else {
                $delay = '0ms';
            }
            
            $this->formTracker[$inputLabel] = [
                'is_active'         => $inputIsValidated,
                'animate_duration'  => $this->duration . 'ms',
                'animate_delay'     => $delay,
            ];
        }
    }
    
    public function render()
    {
        return view('livewire.admin.category.input.form-tracker');
    }
}
