<?php

namespace App\Livewire\General\DetailProduct;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductInfo extends Component
{
    protected object $clientAction;
    protected string $endpoint;

    public string $section;
    public mixed $data = null;
    public int $quantity = 1;

    public function __construct(
    ) {
        $this->clientAction = app(ClientRequestAction::class);
        $this->endpoint     = config('api.url') . 'products/';
    }

    public function boot()
    {
        $this->js(<<<JS
            setTimeout(() => {
                const productPromoSwiper = new Swiper('.swiper[data-swiper-id="$this->section-featured"]', {
                    slidesPerView: 4,
                    slidesPerGroup: 1,
                    spaceBetween: 16,
                });

                document.querySelectorAll('button[qty]').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const btnAttrMethod = btn.getAttribute('qty');
                        const inputQty      = document.getElementById('input-qty');
                        const qtyValue      = parseInt(inputQty.value);

                        switch (btnAttrMethod) {
                            case 'sub':
                                if (qtyValue > 1) inputQty.value = qtyValue - 1;
                                break;

                            default:
                                inputQty.value = qtyValue + 1;
                                break;
                        }
                    })
                })

                document
                    .querySelector('ul[data-product-desc]:last-child')
                    .addEventListener('click', () => document.querySelector('ul[data-product-desc]').classList.toggle('hide'));
                
                document
                    .querySelector('button[data-share-target]')
                    .addEventListener('click', function (el) { 
                        const shareEl = document.querySelector('[data-share-trigger]');

                        if (shareEl.classList.contains('hidden')) {
                            shareEl.classList.remove('hidden');
                            shareEl.classList.add('flex');
                        } else {
                            shareEl.classList.add('hidden');
                            shareEl.classList.remove('flex');
                        }
                    });
            }, 1)
        JS);
    }

    private function getDataProduct()
    {
        $response = $this->clientAction->request(
            new ClientRequestDto(
                method: 'GET',
                endpoint: $this->endpoint . $this->section,
            )
        );

        return $response['data'];
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div>
            loading...
        </div>
        HTML;

        // return view('components.skeletons.promo-carousel-section');
    }

    public function toCart()
    {
        
    }

    public function render()
    {
        $this->data = $this->getDataProduct();

        return view('livewire.general.detail-product.product-info');
    }
}
