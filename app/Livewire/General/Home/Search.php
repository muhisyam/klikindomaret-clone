<?php

namespace App\Livewire\General\Home;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use Livewire\Component;

class Search extends Component
{
    /**
     * Key name input search.
    */
    public string $search_key;

    /**
     * Container for result of filters. 
    */
    public array $result = [];

    /**
     * Variable for help checking is result are empty. 
    */
    public bool $isAllEmpty = true;

    /**
     * listen when @var search_key value had changes. It will get filters content when
     * @var search_key length > 4.
    */
    public function updatedSearchKey()
    {
        if (strlen($this->search_key) < 4) {
            $this->result = [
                'banners'         => [],
                'keywords'        => [],
                'categories'      => [],
                'official_stores' => [],
            ];

            $this->checkResultAreEmpty();

            return false;
        }

        $clientAction = app(ClientRequestAction::class);

        $this->result = $clientAction->request(
            new ClientRequestDto(
                method:   'GET',
                endpoint: config('api.url') . 'search?search=' . $this->search_key,
            )
        );

        if (! empty($this->result['banners'])) {
            $this->setSwiperJs();
        }

        $this->checkResultAreEmpty();
    }

    /**
     * Set swiper js for banners filter when exists.
    */
    private function setSwiperJs()
    {
        $this->js(<<<JS
            setTimeout(() => {
                const heroSwiper = new Swiper('.swiper[data-swiper-id="banner-search"]', {
                    slidesPerView: 2.7,
                    spaceBetween: 12,
                    navigation: {
                        nextEl: "#banner-search-next",
                        prevEl: "#banner-search-prev"
                    },
                });
            }, 1);
        JS);
    }

    /**
     * Check the result filter are empty.
    */
    private function checkResultAreEmpty()
    {
        $this->isAllEmpty =
            empty($this->result['banners']) && 
            empty($this->result['keywords']) && 
            empty($this->result['categories']) && 
            empty($this->result['official_stores']);
    }

    public function render()
    {
        return view('livewire.general.home.search');
    }
}
