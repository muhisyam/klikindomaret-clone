<?php

namespace App\Livewire\Admin\FeaturedContent;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Http\Controllers\Web\Admin\FeaturedContentController;
use Livewire\Component;


class ModalInput extends Component
{
    public $section, $showCondition;
    public $dataProducts = ['data' => []];
    protected $endpoint, $clientAction;
    
    public $featuredName, $featuredSlug, $productIds, $productKeyword;
    public $productSelected = ['id' => []];

    public function __construct(
    ) {
        $this->showCondition = false;
        $this->clientAction = app(ClientRequestAction::class);
        $this->endpoint = config('api.url') . 'refresh';
    }

    public function rules()
    {
        return [
            'featuredName' => 'required|string|max:100',
            'featuredSlug' => 'required|string|unique:featured_contents,featured_slug|max:200',
            'productIds' => 'required',
        ];
    }

    public function save()
    {
        app(FeaturedContentController::class)->storeData($this->validate());

        $this->featuredName = $this->featuredSlug = $this->productIds = null;
        $this->dispatch('stored-content');
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

    public function render()
    {
        $this->dispatch('products-loaded', productSelected: $this->productSelected); 

        return view('livewire.admin.featured-content.modal-input');
    }
}
