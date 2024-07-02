<table class="min-w-full w-max" wire:init="loadContent">
    <thead class="border-b bg-light-gray-50 text-light-gray-300 text-sm text-left uppercase rounded-t">
        <tr>
            <th class="p-3 rounded-tl-md w-12">
                <input type="checkbox" class="block m-auto" name="checkbox-select-all" aria-label="Checkbox select all data">
            </th>
            <th class="py-3 px-4">
                <div @class([
                        'relative flex cursor-pointer', 
                        'active-asc'  => $sortBy === "product_name" && $sortDir === "asc",
                        'active-desc' => $sortBy === "product_name" && $sortDir === "desc",
                    ]) 
                    wire:click="sortByFilter('product_name')">
                    <div class="me-1">Nama Produk</div>
                    <div class="sortable" data-sort></div>
                </div>
            </th>
            <th class="py-3 px-4">
                <div @class([
                        'relative flex cursor-pointer', 
                        'active-asc'  => $sortBy === "category_name" && $sortDir === "asc",
                        'active-desc' => $sortBy === "category_name" && $sortDir === "desc",
                    ]) 
                    wire:click="sortByFilter('category_name')">
                    <div class="me-1">Kategori</div>
                    <div class="sortable" data-sort></div>
                </div>
            </th>
            <th class="py-3 px-4">Supplier</th>
            <th class="py-3 px-4 w-20 text-center">Status</th>
            <th class="py-3 px-4">
                <div @class([
                        'relative flex cursor-pointer', 
                        'active-asc'  => $sortBy === "product_stock" && $sortDir === "asc",
                        'active-desc' => $sortBy === "product_stock" && $sortDir === "desc",
                    ]) 
                    wire:click="sortByFilter('product_stock')">
                    <div class="me-1">Stok</div>
                    <div class="sortable" data-sort></div>
                </div>
            </th>
            <th class="py-3 px-4">Diskon</th>
            <th class="py-3 px-4">
                <div @class([
                        'relative flex justify-end cursor-pointer', 
                        'active-asc'  => $sortBy === "product_price" && $sortDir === "asc",
                        'active-desc' => $sortBy === "product_price" && $sortDir === "desc",
                    ]) 
                    wire:click="sortByFilter('product_price')">
                    <div class="me-1">Harga</div>
                    <div class="sortable" data-sort></div>
                </div>
            </th>
            <th @class([
                'py-3 px-4 rounded-tr-md', 
                'w-36' => isSuperRole()
            ])></th>
        </tr>
    </thead>
    <tbody class="text-sm">

    @unless (is_null($products))

    @forelse ($products['data'] as $index => $product)
    
        <tr class="border-b" wire:loading.class="hidden">
            {{-- 
                MARK: Checkbox 
            --}}
            <td class="py-2 px-3">
                <input type="checkbox" class="block m-auto" name="checkbox-select-{{ $product['product_slug'] }}" aria-label="Checkbox select data">
            </td>
            {{-- 
                MARK: Product Name 
            --}}
            <td class="py-2 px-4">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <img class="h-10 w-10 object-fill rounded-md" src="{{ asset('img/uploads/products/' . $product['product_image_path'] . $product['product_thumbnail']) }}" alt="Product Image">
                        <div class="absolute top-0 right-0 rounded-tr-md rounded-bl-md px-1 bg-secondary text-white text-xs font-bold ">{{ $product['product_images_count'] }}</div>
                    </div>
                    <div class="w-40 flex-1">
                        <div class="line-clamp-1 text-ellipsis" data-tooltip-target="name-product-{{ $product['product_slug'] }}">{{ $product['product_name'] }}</div>
                        
                        <x-tooltip data-tooltip-trigger="name-product-{{ $product['product_slug'] }}" value="{{ $product['product_name'] }}"/>

                        <div class="text-xs font-light">
                            <p>PLU: <span>{{ $product['plu'] }}</span></p>
                        </div>
                    </div>
                </div>
            </td>
            {{-- 
                MARK: Category Name 
            --}}
            <td class="py-2 px-4">
                <button class="hover:text-secondary">{{ $product['product_category']['category_name'] }}</button>
            </td>
            {{-- 
                MARK: Supplier 
            --}}
            <td class="py-2 px-4">
                <div>{{ $product['product_supplier']['supplier_name'] }}</div>
                <div class="flex gap-1.5 text-xs font-light">
                    <div>Lokasi:</div>
                    <x-icon class="h-4 hover-filter-secondary" src="{{ asset('img/icons/icon-auth-visibility-password.webp') }}"/>
                </div>
            </td>
            {{-- 
                MARK: Deploy Status 
            --}}
            <td class="py-2 px-4">{!! \App\Enums\DeployStatus::getStyle($product['product_deploy_status']) !!}</td>
            {{-- 
                MARK: Stock 
            --}}
            <td class="py-2 px-4">
                <div class="flex">
                    {!! \App\Models\Product::getStyleStatusStock($product['is_product_on_stock']) !!}
                    <p class="text">{{ $product['is_product_on_stock'] ? 'Tersedia' : 'Habis' }}</p>
                </div>
                <div class="text-xs font-light leading-none">{{ formatNumber($product['product_stock']) }}</div>
            </td>
            <td>discout</td>
            {{-- 
                MARK: Product price 
            --}}
            <td class="py-2 px-4">
                <div class="text-right">
                    <div>{{ 
                        $product['is_product_on_discount'] 
                            ? formatCurrencyIDR($product['discount_price']) 
                            : formatCurrencyIDR($product['normal_price']) 
                    }}</div>

                    @if ($product['is_product_on_discount'] )
                    
                        <div class="flex items-center justify-end gap-1.5">
                            <div class="rounded p-1 bg-primary-100 text-xs text-primary-600 text-center font-bold leading-none">{{ $product['discount_percent'] }}</div>
                            <div class="text-xs font-light line-through">{{ formatCurrencyIDR($product['normal_price']) }}</div>
                        </div>
                    
                    @endif
                </div>
            </td>
            {{-- 
                MARK: Action
            --}}
            <td class="py-2 px-4">
                
            @if (isSuperRole())

                <section class="w-full flex justify-end" data-section="non-official-action">
                    <div class="-me-2.5 rounded-md h-9 w-0 bg-light-gray-50 transition-width duration-700">
                        <div class="flex opacity-0 duration-200" data-trigger-action="{{ $product['product_slug'] }}-action">
                            <x-button class="h-9 w-9 group hover:bg-light-gray-100" 
                                    data-tooltip-target="action-delete-{{ $index }}"
                                    wire:click="delete(
                                        'product',
                                        '{{ $product['product_name'] }}', 
                                        '{{ $product['product_slug'] }}', 
                                    )">
                                <x-icon class="mx-auto w-3 grayscale group-hover:grayscale-0" src="{{ asset('img/icons/icon-delete.webp') }}"/>
                            </x-button>
                            
                            <x-tooltip data-tooltip-trigger="action-delete-{{ $index }}" value="Hapus {{ $product['product_name'] }}"/>

                            <x-nav-link href="{{ route('products.edit', ['product' => $product['product_slug']]) }}" 
                                        class="rounded-md h-9 w-9 cursor-pointer group hover:bg-light-gray-100" 
                                        data-tooltip-target="action-edit-{{ $index }}">
                                <x-icon class="mx-auto w-3 grayscale group-hover:grayscale-0" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                            </x-nav-link>
                            
                            <x-tooltip data-tooltip-trigger="action-edit-{{ $index }}" value="Edit {{ $product['product_name'] }}"/>
                        </div>
                    </div>
                    <x-button class="z-10 justify-center h-9 w-9 group hover:bg-tertiary" data-target-action="{{ $product['product_slug'] }}-action">
                        <x-icon class="w-3 rotate-90 grayscale group-hover:grayscale-0" src="{{ asset('img/icons/icon-dots-vertical.webp') }}" action-icon-open />
                        <x-icon class="w-2.5 hidden" src="{{ asset('img/icons/icon-header-close.webp') }}" action-icon-close />
                    </x-button>
                </section>
                
            @else

                <section class="w-full flex justify-end" data-section="non-official-action">
                    <x-button class="z-10 justify-center h-9 w-9 group hover:bg-tertiary" data-tooltip-target="action-remove-{{ $index }}">
                        <x-icon class="h-4 grayscale group-hover:grayscale-0" src="{{ asset('img/icons/icon-delete-list.webp') }}"/>
                    </x-button>

                    <x-tooltip data-tooltip-trigger="action-remove-{{ $index }}" value="Hapus dari list"/>
                </section>

            @endif

            </td>
        </tr>
    
    @empty

        <tr>
            <td class="rounded-b-md py-2 px-3 bg-light-gray-50" colspan="9">
                <x-button class="mx-auto text-secondary hover:underline" value="Tambah Kategori Baru" data-no-content=""/>
            </td>
        </tr>

    @endforelse

    @endunless

    <x-skeletons.table-body @class(['hidden' => ! is_null($products)]) 
                            data-component="table-skeleton" 
                            rows="10" 
                            cols="9"
                            wire:loading.class.remove="hidden"/>

    </tbody>
</table>