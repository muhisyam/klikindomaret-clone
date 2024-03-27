<?php

namespace App\Livewire\General\Home;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use Livewire\Component;

class FeaturedSectionProduct extends Component
{
    public string $section;
    public string $message;
    protected object $clientAction;
    protected string $endpoint;
    public $data = null;

    public function __construct(
    ) {
        $this->clientAction = app(ClientRequestAction::class);
        $this->endpoint     = config('api.url') . 'featured-sections/';
    }

    public function boot()
    {
        $this->js(<<<JS
            setTimeout(() => {
                const productPromoSwiper = new Swiper('.swiper[data-swiper-id="$this->section-featured"]', {
                    slidesPerView: 7.5,
                    slidesPerGroup: 3,
                    spaceBetween: 20,
                    navigation: {
                        nextEl: "#$this->section-featured-next",
                        prevEl: "#$this->section-featured-prev"
                    }
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
        return view('components.skeletons.product-section');
    }

    public function render()
    {
        $this->data = $this->getFeaturedContent();

        return view('livewire.general.home.featured-section-product');
    }
}
