<?php

namespace App\Livewire\Admin\ContentManagement\PromotionBanner;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Http\Controllers\Web\Admin\PromotionBannerController;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class ModalInput extends Component
{
    use WithFileUploads;
    
    public $section, $showCondition;
    public $dataProducts = ['data' => []];
    protected $endpoint, $clientAction;
    
    public $bannerName, $bannerSlug, $bannerImageName, $productIds, $productKeyword;
    public $productSelected = ['id' => []];

    public function __construct(
    ) {
        $this->showCondition = false;
        $this->clientAction = app(ClientRequestAction::class);
        $this->endpoint = config('api.url') . 'refresh';
    }

    public function updatedBannerName() 
    {
        $this->bannerSlug = Str::slug($this->bannerName);
    }

    public function updatedProductKeyword() 
    {
        if ($this->productKeyword !== '' && strlen($this->productKeyword) > 4) {
            $this->dataProducts = $this->clientAction->request(
                new ClientRequestDto(
                    method: 'GET',
                    endpoint: $this->endpoint . '?search=' . $this->productKeyword,
                )
            );
        }
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
        $data = $this->validate();

        //Important: Add dot for product select2 purpose!
        $data['bannerName'] .= '.'; 
        
        app(PromotionBannerController::class)->store($data);

        $this->bannerName = $this->bannerSlug = $this->bannerImageName = $this->productIds = null;
        // $this->dispatch('stored-content');
    }

    public function render()
    {
        $this->dispatch('products-loaded', productSelected: $this->productSelected);
        
        return view('livewire.admin.content-management.promotion-banner.modal-input');
    }
}
