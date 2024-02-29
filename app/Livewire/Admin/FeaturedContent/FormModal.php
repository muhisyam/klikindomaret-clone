<?php

namespace App\Livewire\Admin\FeaturedContent;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Http\Controllers\Web\Admin\FeaturedContentController;
use Livewire\Attributes\Validate;
use Livewire\Component;


class FormModal extends Component
{
    public $section, $showCondition;
    public $dataProducts = ['data' => []];
    protected $endpoint, $clientAction;
    
    public $featuredName, $featuredSlug, $productIds;

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
        $this->dispatch('stored-content');         
    }
    
    public function loadProducts() 
    {
        $this->dataProducts = $this->clientAction->request(
            new ClientRequestDto(
                method: 'GET',
                endpoint: $this->endpoint,
            )
        );
    }

    public function render()
    {
        $this->dispatch('products-loaded'); 

        return view('livewire.admin.featured-content.form-modal');
    }
}
