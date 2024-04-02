<div class="flex gap-4" wire:init="loadContent">
@unless (is_null($data))

    <section class="w-1/3" data-section="product-images">
        <figure class="rounded-lg p-3 mb-4 w-full bg-white ">
            <img src="{{ asset('img/uploads/products/' . $data['product_slug'] . '/' . $data['product_images'][0]['product_image_name']) }}" alt="{{ $data['product_images'][0]['original_product_image_name'] }}">
        </figure>
        <div class="swiper" data-swiper-id="{{ $section }}-featured">
            <div class="swiper-wrapper">
            @foreach ($data['product_images'] as $images)
                <figure @class([
                    'swiper-slide', 
                    'active' => $loop->first
                ]) data-figure="product-thumbnail">
                    <img class="bg-white rounded-lg p-2" src="{{ asset('img/uploads/products/' . $data['product_slug'] . '/' . $images['product_image_name']) }}" alt="{{ $images['original_product_image_name'] }}">
                </figure>
            @endforeach
            </div>
        </div>
    </section>

    @php
        $discountPercent = round((($data['normal_price'] - $data['discount_price']) / $data['normal_price']) * 100);
    @endphp

    <section class="w-2/3 space-y-4" data-section="product-informations">
        <div class="flex items-center justify-between rounded-lg py-2 px-5 mb-4">
            <div class="left-side flex items-center">
                <img class="w-7 mr-2" src="https://www.klikindomaret.com/Assets/image/icon_flash.png" alt="Flashsale Icon">
                <span class="text-white text-2xl font-bold italic">Flash Sale</span>
            </div>
            <div class="right-side flex text-white font-bold">
                <span class="mr-2">Berakhir dalam:</span>
                <div class="countdown bg-[#ED3128] rounded px-2">00:01:04</div>
            </div>
        </div>
        <div class="relative space-y-4 p-5 rounded-lg bg-white">
            <h1 class="product-title text-xl font-bold mb-2">
                {{ $data['product_name'] }}
            </h1>
            
            <button class="py-1.5 px-3 rounded-full flex items-center gap-1.5 bg-primary-100">
                <x-icon class="w-4" src="{{ asset('img/icons/icon-header-map-marker.webp') }}"/>
                <span class="text-xs">Cari Toko yang Menjual</span>
            </button>

            <div>{{ session('success') }}</div>
            <div>{{ session('failed') }}</div>
            
            <hr>

            <div class="h-24 text-sm">
            @if ($data['discount_price'])
                <div class="flex items-center mb-2">
                    <div class="mr-2 px-1.5 py-1 rounded max-w-[40px] bg-primary-100 text-primary-600 text-center font-bold">{{ $discountPercent }}%</div>
                    <div class="text-light-gray-300 leading-none line-through">Rp {{ formatCurrencyIDR($data['normal_price']) }}</div>
                </div>
            @endif
                <div @class([
                    'text-2xl font-bold', 
                    'text-black'       => ! $data['discount_price'],
                    'text-primary-600' => $data['discount_price'],
                ])>
                    <span>Rp {{ formatCurrencyIDR($data['discount_price'] ?? $data['normal_price']) }}</span>
                </div>
            </div>
            
            <div class="flex justify-between">
                <div class="flex items-center">
                    <span class="font-bold mr-4">Jumlah:</span>
                    <x-button class="border border-secondary h-10 w-10 group hover:bg-secondary" qty="sub">
                        <x-icon class="mx-auto w-2.5" src="{{ asset('img/icons/icon-minus.webp') }}" iconStyle="hover-white"/>
                    </x-button>
                    
                    <x-input-field id="input-qty" class="mx-1 !w-16 text-center" wire:model="quantity"/>
                    
                    <x-button class="border border-secondary h-10 w-10 group hover:bg-secondary" qty="add">
                        <x-icon class="mx-auto w-2.5 rotate-45" src="{{ asset('img/icons/icon-header-close.webp') }}" iconStyle="hover-white"/>
                    </x-button>
                </div>

                <x-button class="justify-center gap-2 h-10 w-60" buttonStyle="secondary" wire:click="toCart">
                    <span class="loader-spin !bg-transparent after:!border-t-white" wire:loading></span>

                    <x-icon class="w-2.5 rotate-45" src="{{ asset('img/icons/icon-header-close.webp') }}" iconStyle="white" wire:loading.attr="hidden"/>
                    <span wire:loading.attr="hidden">Keranjang</span>
                </x-button>
            </div>
            
            <div class="absolute top-1 right-5 flex gap-2">
                <x-button>
                    <x-icon src="{{ asset('img/icons/icon-favorite.webp') }}"/>
                </x-button>
                <x-button class="!rounded-full w-8 h-8 bg-light-gray-50" data-share-target="">
                    <x-icon class="m-auto w-4 grayscale opacity-50" src="{{ asset('img/icons/icon-share.webp') }}"/>
                </x-button>
                <div class="absolute top-10 right-0 py-2 p-3 rounded-md shadow hidden items-center gap-3 bg-white" data-share-trigger="">
                    <a href="#" target="_blank">
                        <img class="max-w-[26px] rounded" src="https://www.klikindomaret.net/Assets/image/svg/icon_fb.svg" alt="Facebook Icon">
                    </a>
                    <a href="#" target="_blank">
                        <img class="max-w-[26px] rounded" src="https://www.klikindomaret.net/Assets/image/svg/icon_twitter.svg" alt="Twitter Icon">
                    </a>
                    <a href="#" target="_blank">
                        <img class="max-w-[26px] rounded" src="https://www.klikindomaret.net/Assets/image/svg/icon_wa.svg" alt="Whatsapp Icon">
                    </a>
                    <a href="#" target="_blank">
                        <img class="max-w-[26px] rounded" src="https://www.klikindomaret.net/Assets/image/svg/icon_copy_link.svg" alt="Link Icon">
                    </a>
                </div>
            </div>
        </div>
        <div class="p-5 rounded-lg flex items-center gap-2 bg-white" data-tooltip-target="product-store-info">
            <img class="w-14 h-14 bg-white rounded-full shadow p-1" src="https://www.klikindomaret.net/Assets/image/icon_store_pdp.png" alt="Store Icon">
            <h2 class="text-sm font-bold">Toko Indomaret</h2>
        </div>
        <x-tooltip data-tooltip-trigger="product-store-info" data-tooltip-offset-y="-60" :arrow="false" value="Produk disediakan dan dikirim oleh Toko Indomaret"/>
        <ul class="relative space-y-4 p-5 pb-14 rounded-lg bg-white text-sm hide" data-product-desc="">
        @foreach ($data['product_descriptions'] as $desc)
            <li>
                <h2 class="font-bold">{{ $desc['title_product_description'] }}</h2>
                <p>{{ $desc['product_description'] }}</p>
            </li>
        @endforeach
            <li class="absolute bottom-0 pt-3 h-12 w-full bg-white">
                <x-button class="text-secondary hover:underline" value="Lihat Selengkapnya"/>
            </li>
        </ul>
    </section>

@else
    <div>
        loading...
    </div>
@endunless
</div>

@push('scripts')
    <script type="module">
        import { handleInputProductQty } from "{{ asset('js/' . config('view.js_component')) }}";

        document.addEventListener('livewire:initialized', () => {
            @this.on('content-loaded', event => {
                setTimeout(() => {
                    document
                        .querySelector('ul[data-product-desc]:last-child')
                        .addEventListener('click', () => document.querySelector('ul[data-product-desc]').classList.toggle('hide'));
                    
                    document
                        .querySelector('button[data-share-target]')
                        .addEventListener('click', el => { 
                            const shareEl = document.querySelector('[data-share-trigger]');

                            if (shareEl.classList.contains('hidden')) {
                                shareEl.classList.remove('hidden');
                                shareEl.classList.add('flex');
                            } else {
                                shareEl.classList.add('hidden');
                                shareEl.classList.remove('flex');
                            }
                        });

                    handleInputProductQty();
                }, 1);
            });
            
            @this.on('unauthenticated', event => {
                setTimeout(() => {
                    document.querySelector('button[data-target-modal="login"]').click();
                }, 1);
            });
        });
    </script>
@endpush