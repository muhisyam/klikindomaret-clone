<?php

namespace App\Livewire\General\Home;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use Livewire\Component;

class FeaturedPromoSlider extends Component
{
    public string $section;
    protected object $clientAction;
    protected string $endpoint;
    public mixed $data = null;

    public function __construct(
    ) {
        $this->clientAction = app(ClientRequestAction::class);
        $this->endpoint     = config('api.url') . 'featured-sections/';
    }

    public function boot()
    {
        $this->js(<<<JS
            setTimeout(() => {
                const promoSwiper = new Swiper('.swiper[data-swiper-id="$this->section-featured"]', {
                    slidesPerView: 2.5,
                    spaceBetween: 20,
                });
            }, 1);
        JS);
    }

    private function getFeaturedContent()
    {
        return $this->clientAction->request(
            new ClientRequestDto(
                method: 'GET',
                endpoint: $this->endpoint . $this->section . '?type=products',
            )
        );
    }

    public function placeholder()
    {
        return view('components.skeletons.promo-slider-section');
    }

    public function render()
    {
        $this->data = $this->getFeaturedContent();
        
        return view('livewire.general.home.featured-promo-slider');
    }
}
