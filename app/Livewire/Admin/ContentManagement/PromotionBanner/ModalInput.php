<?php

namespace App\Livewire\Admin\ContentManagement\PromotionBanner;

use App\Http\Controllers\Web\Admin\PromotionBannerController;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class ModalInput extends Component
{
    use WithFileUploads;
    
    public $section, $showCondition;    
    public $bannerName, $bannerSlug, $bannerImageName, $productIds;

    public function __construct(
    ) {
        $this->showCondition = false;
    }

    public function updatedBannerName() 
    {
        $this->bannerSlug = Str::slug($this->bannerName);
    }

    public function rules()
    {
        return [
            'bannerName' => 'required|string|max:100',
            'bannerSlug' => 'required|string|unique:promotion_banners,banner_slug|max:200',
            'bannerImageName' => 'required|image|mimes:jpg,png,jpeg,webp|max:512',
            'productIds' => 'required',
        ];
    }

    public function save()
    {        
        app(PromotionBannerController::class)->store($this->validate());

        $this->bannerName = $this->bannerSlug = $this->bannerImageName = $this->productIds = null;
        $this->dispatch('stored-content');
    }

    public function render()
    {
        
        return view('livewire.admin.content-management.promotion-banner.modal-input');
    }
}
