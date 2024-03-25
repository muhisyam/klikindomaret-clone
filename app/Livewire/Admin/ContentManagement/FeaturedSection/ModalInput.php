<?php

namespace App\Livewire\Admin\ContentManagement\FeaturedSection;

use App\Http\Controllers\Web\Admin\FeaturedSectionController;
use Illuminate\Support\Str;
use Livewire\Component;


class ModalInput extends Component
{
    public string $section;
    public bool $showCondition;    
    public string $featuredName = '';
    public string $featuredSlug = '';
    public string $featuredRedirectUrl = '';
    public string $contentTypes = 'Produk';
    public array $contentIds = [];

    public function __construct(
    ) {
        $this->showCondition = false;
    }

    public function updatedFeaturedName() 
    {
        $this->featuredSlug = Str::slug($this->featuredName);
    }

    public function rules()
    {
        return [
            'featuredName'        => 'required|string|max:100',
            'featuredSlug'        => 'required|string|unique:featured_sections,featured_slug|max:200',
            'featuredRedirectUrl' => 'required|string',
            'contentTypes'        => 'required|string',
            'contentIds'          => 'required|array',
        ];
    }

    public function save()
    {
        app(FeaturedSectionController::class)->store($this->validate());

        $this->reset('featuredName', 'featuredSlug', 'contentTypes', 'contentIds');
        $this->dispatch('content-stored');
    }

    public function render()
    {
        return view('livewire.admin.content-management.featured-section.modal-input');
    }
}
