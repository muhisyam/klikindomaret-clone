<?php

namespace App\Livewire\Admin\ContentManagement\FeaturedSection;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use Livewire\Attributes\On; 
use Livewire\Component;

class Table extends Component
{
    public string $sortBy, $orderBy;
    public $data = null;
    protected object $clientAction;
    protected string $endpoint;

    public function __construct(
    ) {
        $this->clientAction = app(ClientRequestAction::class);
        $this->endpoint     = config('api.url') . 'featured-sections';
    }

    private function getFeaturedContent()
    {
        return $this->clientAction->request(
            new ClientRequestDto(
                method: 'GET',
                endpoint: $this->endpoint,
            )
        );
    }

    public function loadContent()
    {
        $this->data = $this->getFeaturedContent();
        $this->dispatch('content-loaded');
    }

    #[On('content-stored')] 
    public function storedContent()
    {
        $this->dispatch('load-new-entries');
    }
    
    public function dispatchModal($dataFeaturedContent)
    {
        $this->dispatch('modal-show', data: $dataFeaturedContent);
    }
    
    public function render()
    {
        return view('livewire.admin.content-management.featured-section.table');
    }
}
