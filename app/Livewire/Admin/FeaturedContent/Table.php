<?php

namespace App\Livewire\Admin\FeaturedContent;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use Livewire\Attributes\On; 
use Livewire\Component;

class Table extends Component
{
    public $sortBy, $orderBy;
    public $data = ['data' => []];
    protected $endpoint, $clientAction;

    public function __construct(
    ) {
        $this->clientAction = app(ClientRequestAction::class);
        $this->endpoint = config('api.url') . 'featured-content';
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div>
            'sadasdsa'
        </div>
        HTML;
    }

    public function loadContent()
    {
        $this->data = $this->getDataFeaturedContent();
    }

    #[On('stored-content')] 
    public function storedContent()
    {
        $this->data = $this->getDataFeaturedContent();
    }

    public function getDataFeaturedContent()
    {
        return $this->clientAction->request(
            new ClientRequestDto(
                method: 'GET',
                endpoint: $this->endpoint,
            )
        );
    }
    
    public function render()
    {
        return view('livewire.admin.featured-content.table');
    }
}
