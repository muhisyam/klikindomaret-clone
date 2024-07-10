<?php

namespace App\Livewire\General\Home;

use App\Http\Controllers\Web\General\SearchController;
use Livewire\Attributes\Url;
use Livewire\Component;

class Search extends Component
{
    /**
     * The key of the parameter in the URL used to search for products.
    */
    #[Url]
    public string $key = '';
    
    /**
     * Container for result of filters. 
    */
    public array $result = [];

    /**
     * Variable for help checking is result are empty. 
    */
    public bool $isAllEmpty = true;

    /**
     * listen when @var key value had changes. It will get filters content when
     * @var key length > 4.
    */
    public function updatedKey(): bool
    {
        if (strlen($this->key) < 3) {
            $this->result = [
                'banners'         => [],
                'keywords'        => [],
                'categories'      => [],
                'official_stores' => [],
            ];

            return $this->checkResultAreEmpty();
        }

        $this->result = app(SearchController::class)->getListCategories('navbar?key=' . $this->key);

        if (! empty($this->result['banners'])) {
            $this->setSwiperJs();
        }

        return $this->checkResultAreEmpty();
    }

    /**
     * Set swiper js for banners filter when exists.
    */
    private function setSwiperJs(): void
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
    private function checkResultAreEmpty(): bool
    {
        return $this->isAllEmpty =
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
