<div class="relative rounded-lg pt-5 pb-20 px-6 w-4/5 bg-white" wire:init="loadContent">
    <x-loader wire:loading.class.remove="hidden" wire:target="loadContent"/>

    <div class="flex items-center">
        <div class="w-1/3">
            
        @unless (empty($products))
        
            <p wire:loading.class="hidden">Menampilkan <span>{{ $meta['from'] }} - {{ $meta['to'] }}</span> dari <span>{{ $meta['total'] }}</span> Hasil</p>

        @endunless

            <x-skeletons.table-filter @class(['hidden' => ! empty($products)])
                                    amount="1"
                                    width="100%"
                                    wire:loading.class.remove="hidden"
                                    data-element="skeleton"/>

        </div>

        <div class="w-2/3 flex justify-end items-center gap-5">
            <div class="rounded-md w-[28%] flex items-center bg-light-gray-50">
                <label for="product-per-page" class="px-3 text-sm font-bold">Tampilkan:</label>
                <x-input-select id="product-per-page" name="perPage" wire:model.change="perPage">
                    <option value="18">18</option>
                    <option value="30">30</option>
                    <option value="54">54</option>
                    <option value="72">72</option>
                    <option value="102">102</option>
                </x-input-select>
            </div>
    
            <div class="rounded-md w-5/12 flex items-center bg-light-gray-50">
                <label for="product-sort-dir" class="px-3 text-sm font-bold">Urutkan:</label>
                <x-input-select id="product-sort-dir" name="sort" wire:model.change="sort">
                    <option value="created|asc">Paling Sesuai</option>
                    <option value="created|desc">Terbaru</option>
                    <option value="name|asc">Alfabet (A-Z)</option>
                    <option value="name|desc">Alfabet (Z-A)</option>
                    <option value="price|asc">Harga Terendah</option>
                    <option value="price|desc">Harga Tertinggi</option>
                    <option value="discount|asc">Promo</option>
                </x-input-select>
            </div>
        </div>
    </div>

    <div class="mt-8 grid grid-cols-6 gap-4">
        
    @unless (empty($products))

    @forelse ($products['data'] as $product)
        
        <div class="relative rounded-lg duration-75 ease-in-out hover:!scale-[1.025] hover:shadow-card" data-plu="{{ $product['plu'] }}" data-flag="{{ $product['product_supplier']['flag_name'] }}" wire:loading.class="hidden">
            <a href="#" class="rounded-lg" data-product-name="{{ $product['product_name'] }}">

                <img class="rounded-t-lg object-cover mb-5" src="{{ asset('img/uploads/products/' . $product['product_image_path'] . $product['product_thumbnail']) }}" alt="Product Image" loading="lazy">
                
                <div class="p-2" >
                    <div class="mb-1 min-h-[32px] line-clamp-2 text-xs text-black font-bold">
                        {{ $product['product_name'] }}
                    </div>
                    
                    <div @class([
                        'mb-2 flex items-center gap-1 text-xs', 
                        'text-secondary' => $product['product_supplier_icon'] === 'store',
                        'text-[#00b110]' => $product['product_supplier_icon'] === 'warehouse',
                    ])>
                        <x-icon class="w-3" src="{{ asset('img/icons/icon-send-by-' . $product['product_supplier_icon'] . '.webp') }}"/>
                        <span class="line-clamp-1 text-[10px] leading-none">{{ $product['product_supplier_name']}}</span>
                    </div>
                    
                    <div class="mb-7 h-11 flex flex-col">
                    
                    @if ($product['is_product_on_discount'])

                        <div class="discount-wrapper flex items-center text-[10px]">
                            <div class="left-side max-w-[40px] rounded bg-primary-50 text-primary-600 text-center font-bold me-2 px-1.5 py-1">
                                {{ $product['discount_percent'] }}
                            </div>
                            <div class="text-light-gray-300 leading-none line-through">
                                <div>{{ formatCurrencyIDR($product['normal_price']) }}</div>
                            </div>
                        </div>
                        
                    @endif
                        
                        <div @class([
                            'mt-auto line-clamp-1 text-sm font-bold leading-none', 
                            'text-black'       => ! $product['is_product_on_discount'],
                            'text-primary-600' => $product['is_product_on_discount'],
                        ])>
                            {{ 
                                $product['is_product_on_discount'] 
                                    ? formatCurrencyIDR($product['discount_price']) 
                                    : formatCurrencyIDR($product['normal_price']) 
                            }}
                        </div>
                    </div>
                    
                    <x-button class="px-5 py-1.5 justify-center gap-1.5 w-full text-xs" buttonStyle="outline-secondary">
                        <x-icon class="mt-[-2px] w-2 rotate-45" src="{{ asset('img/icons/icon-header-close.webp') }}"/>
                        <span class="leading-none">Keranjang</span>
                    </x-button>
                </div>
                
                <div class="favorite absolute top-1 right-1 bg-[#F5F5F5] rounded-full z-10">
                    <x-button>
                        <x-icon class="w-7" src="{{ asset('img/icons/icon-favorite.webp') }}"/>
                    </x-button>
                </div>
            </a>
        </div>
    
    @empty

        <div class="py-16 grid col-span-6 place-items-center">
            <img src="{{ asset('img/search/not-found-search.webp') }}" alt="Not Found" loading="lazy">
            <h4 class="mt-5 mb-2 text-2xl font-bold">Produk Tidak Ditemukan</h4>
            <p class="text-center">Maaf produk yang kamu cari tidak ada.<br>Yuk cari produk lain sekarang!</p>
        </div>
    
    @endforelse

    @endunless
    
        <x-skeletons.product-card @class(['hidden' => ! empty($products)])
                                amount="12"
                                wire:loading.class.remove="hidden"
                                data-element="skeleton"/>

    </div>

    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 w-1/3 flex justify-center items-center">

    @unless (empty($products))

        <ul class="flex justify-center" data-element="link-page" wire:loading.class="hidden">

        @foreach ($meta['links'] as $link)
            
            @if ($loop->first)
                
                <li>
                    <x-button @class([
                                "!rounded-r-none h-10 w-10 justify-center bg-secondary",
                                "cursor-default"   => is_null($link['url']),
                            ]) 
                            wire:click="toPage('{{ $link['page'] }}')">
                        <x-icon class="h-3 filter-white" src="{{ asset('img/icons/icon-header-chevron-left.webp') }}"/>
                    </x-button>
                </li>

            @elseif ($link['label'] == 'separator')

                <li>
                    <x-button class="!rounded-none h-10 w-10 justify-center bg-secondary text-white cursor-default" value="..."/>
                </li>

            @elseif (! $loop->last)
            
                <li>
                    <x-button @class([
                                "!rounded-none h-10 w-10 justify-center bg-secondary text-white",
                                "active" => $link['active'],
                            ]) 
                            wire:click="toPage('{{ $link['page'] }}')"
                            value="{{ $link['label'] }}"/>
                </li>

            @elseif ($loop->last)
            
                <li>
                    <x-button @class([
                                "!rounded-l-none h-10 w-10 justify-center bg-secondary",
                                "cursor-default" => is_null($link['url']),
                            ]) 
                            wire:click="toPage('{{ $link['page'] }}')">
                        <x-icon class="h-3 filter-white" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                    </x-button>
                </li>

            @endif

        @endforeach

        </ul>

    @endunless

        <x-skeletons.table-filter @class(['hidden' => ! empty($products)])
                                amount="1"
                                width="[100%]"
                                wire:loading.class.remove="hidden"
                                data-element="skeleton"/>


    </div>

</div>
