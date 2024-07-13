<div class="rounded-lg bg-white" data-featured-name="{{ $data['data']['featured_name'] }}">
    <div class="pt-5 px-6 flex justify-between items-center">
        <h2 class="text-lg text-black font-bold">
            {{ $data['data']['featured_name'] }}
        </h2>
        <x-nav-link href="{{ url($data['data']['featured_redirect_url']) }}" class="text-sm text-secondary" value="Lihat Semua"/>
    </div>
    <div class="swiper !px-6 !pt-4 !pb-5" data-swiper-id="{{ $section }}-featured">
        <div class="swiper-wrapper">
        @foreach ($data['data']['featured_products'] as $product)
        
        @php
            // TODO: move to component but finish favorite first
            // List that an official indomaret supplier, this will be change to "Toko Indomaret"
            $officialSupList = ['fresh', 'store'];
            $supplierName    = $product['product_supplier']['flag_name'];
            $retailerName    = 'Toko Indomaret';
            $retailerIcon    = $supplierName !== 'fresh' ? $supplierName : 'store';
            $discountPercent = round((($product['normal_price'] - $product['discount_price']) / $product['normal_price']) * 100);
            $retailerCode    = ! empty($product['product_retailers']) ? $product['product_retailers'][0]['retailer_code'] : 'xxx';
            $retailerStore   = $supplierName !== 'warehouse' ? $product['product_supplier']['flag_code'] . '-' . $retailerCode : 'null';
            $retailerWh      = $supplierName === 'warehouse' ? $product['product_supplier']['flag_code'] . '-' . $retailerCode : 'null';

            // TODO: Fix NULL value
            if (! in_array($supplierName, $officialSupList)) {
                $retailerName = !empty($product['product_retailers']) ? $product['product_retailers'][0]['retailer_name'] : "NULL, soon fix this!";
            }
        @endphp

            <div class="swiper-slide rounded-lg duration-75 ease-in-out hover:!scale-[1.025] hover:shadow-card" data-plu="{{ $product['plu'] }}" data-flag="{{ $product['product_supplier']['flag_name'] }}" data-store-code="{{ $retailerStore }}" data-wh-code="{{ $retailerWh }}">
                <a href="#" class="rounded-lg" data-product-name="{{ $product['product_name'] }}">

                    @php /*TODO: Fix dis image url*/ @endphp
                    <img class="rounded-t-lg object-cover mb-5" src="{{ asset('img/uploads/products/' . $product['product_images'][0]['product_image_name']) }}" alt="Product Image" loading="lazy">
                    {{-- <img class="rounded-t-lg object-cover mb-5" src="{{ asset('img/uploads/products/' . $product['product_slug'] . '/' . $product['product_images'][0]['product_image_name']) }}" alt="Product Image" loading="lazy"> --}}
                    
                    <div class="p-2" >
                        <div class="mb-1 min-h-[32px] line-clamp-2 text-xs text-black font-bold">
                            {{ $product['product_name'] }}
                        </div>
                        
                        <div @class([
                            'mb-2 flex items-center gap-1 text-xs', 
                            'text-secondary' => in_array($retailerIcon, $officialSupList),
                            'text-[#00b110]' => $retailerIcon === 'warehouse',
                        ])>
                            <x-icon class="w-3" src="{{ asset('img/icons/icon-send-by-' . $retailerIcon . '.webp') }}"/>
                            <span class="line-clamp-1 text-[10px] leading-none">{{ $retailerName }}</span>
                        </div>
                        
                        <div class="mb-7 h-11 flex flex-col">
                        
                        @if ($product['discount_price'])
                            <div class="discount-wrapper flex items-center text-[10px]">
                                <div class="left-side max-w-[40px] rounded bg-primary-50 text-primary-600 text-center font-bold me-2 px-1.5 py-1">
                                    {{ $discountPercent }}%
                                </div>
                                <div class="text-light-gray-300 leading-none line-through">
                                    <div>{{ formatCurrencyIDR($product['normal_price']) }}</div>
                                </div>
                            </div>
                        @endif
                            
                            <div @class([
                                'mt-auto line-clamp-1 text-sm font-bold leading-none', 
                                'text-black'       => ! $product['discount_price'],
                                'text-primary-600' => $product['discount_price'],
                            ])>
                                Rp {{ formatCurrencyIDR($product['discount_price'] ?? $product['normal_price']) }}
                            </div>
                        </div>
                        
                        <x-button class="px-5 py-1.5 justify-center gap-1.5 w-full text-xs" buttonStyle="outline-secondary">
                            <x-icon class="mt-[-2px] w-2 rotate-45" src="{{ asset('img/icons/icon-header-close.webp') }}"/>
                            <span>Keranjang</span>
                        </x-button>
                    </div>
                    
                    <div class="favorite absolute top-1 right-1 bg-[#F5F5F5] rounded-full z-10">
                        <x-button>
                            <x-icon class="w-7" src="{{ asset('img/icons/icon-favorite.webp') }}"/>
                        </x-button>
                    </div>
                </a>
            </div>
        @endforeach
        </div>
        <div class="swiper-button-next !w-11 !h-11 bg-white rounded-full shadow-md" id="{{ $section }}-featured-next">
            <x-icon class="w-7" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
        </div>
        <div class="swiper-button-prev !w-11 !h-11 bg-white rounded-full shadow-md" id="{{ $section }}-featured-prev">
            <x-icon class="w-7 scale-x-[-1]" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('dispatch-for-blade', () => {
            console.log('dispatch for blade success'); // didnt work
        })
    </script>
@endpush
