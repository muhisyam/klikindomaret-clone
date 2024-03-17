<?php

namespace App\Livewire\Admin\ContentManagement\PromotionBanner;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use Livewire\Attributes\On;
use Livewire\Component;

class Table extends Component
{
    /**
     * Table head filter data
     *
     * @var string
     */
    public string $sortBy, $orderBy;

    /**
     * Data content container
     */
    public $data = null;

    /**
     * Api client request handler
     *
     * @var object
     */
    protected object $clientAction;

    /**
     * Api endpoint
     *
     * @var string
     */
    protected string $endpoint;
 
    public function __construct(
    ) {
        $this->clientAction = app(ClientRequestAction::class);
        $this->endpoint = config('api.url') . 'promotion-banners';
    }

    private function getPromoContents()
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
        $this->data = $this->getPromoContents();
        $this->dispatch('contents-loaded');
    }

    #[On('stored-content')] 
    public function storedContent()
    {
        $this->data = $this->getPromoContents();
    }

    public function render()
    {
        return view('livewire.admin.content-management.promotion-banner.table');
    }
}
