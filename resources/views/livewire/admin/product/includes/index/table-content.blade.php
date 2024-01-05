<tbody class="text-sm">
    @foreach ($data['data'] as $index => $product)
        @php
            $productThumbnail = $product['product_images'][0]['product_image_name'];
            $isDraft = $product['product_status'] === 'Draft' ? True : False;
            $isHasStock = $product['product_stock'] ?: False;
            $isDiscount = $product['discount_price'] ?? 0;
            $discountPercent = round((($product['normal_price'] - $product['discount_price']) / $product['normal_price']) * 100);
        @endphp
        <tr class="border-b">
            <td class="py-2 px-3">
                <input type="checkbox" class="block m-auto" aria-label="Checkbox select data">
            </td>
            <td class="py-2 px-4">
                <div class="product-info | flex items-center">
                    <div class="product-media | relative">
                        <figure class="media | w-10 me-3">
                            <img class="aspect-square object-fill rounded-md" src="{{ asset('img/uploads/products/' . $product['product_slug'] . '/' . $productThumbnail) }}" alt="">
                        </figure>
                        <div class="media-count | absolute top-0 right-3 bg-secondary text-white text-xs font-bold rounded-tr-md rounded-bl-md px-1">{{ $product['product_images_count'] }}</div>
                    </div>
                    <div class="product-desc | w-40 flex-1">
                        <div class="name | line-clamp-1 text-ellipsis">{{ $product['product_name'] }}</div>
                        <div class="plu | text-xs font-light">
                            <p>PLU: <span>{{ $product['plu'] }}</span></p>
                        </div>
                    </div>
                </div>
            </td>
            <td class="py-2 px-4">
                <div class="sort-categories">
                    @php /*TODO: If clicked sort by the category, after that the the filter is on not the header*/ @endphp
                    <button class="hover:text-[#0079c2]">{{ $product['category']['category_name'] }}</button>
                </div>
            </td>
            <td class="py-2 px-4">
                <div class="supplier-location">
                    <div class="info">{{ $product['supplier']['supplier_name'] }}</div>
                    <div class="address | flex text-xs font-light">
                        <div class="address-info | me-1">Lokasi</div>
                        <button class="icon | h-4 hover:text-[#0079c2]" aria-label="See address data"><i class="ri-eye-fill"></i></button>
                    </div>
                </div>
            </td>
            <td class="py-2 px-4">
                <div @class([
                    'product-status | font-bold text-center rounded-lg p-1', 
                    'bg-green-100 text-green-700' => !$isDraft,
                    'bg-gray-100 text-gray-700' => $isDraft,
                ])>
                    <div class="info">{{ $product['product_status'] }}</div>
                </div>
            </td>
            <td class="py-2 px-4">
                <div class="stock-info">
                    <div class="info | flex">
                        <div @class([
                            'icon | h-4 me-1', 
                            'text-green-600' => $isHasStock,
                            'text-red-600' => !$isHasStock,
                        ])>
                            <i @class([
                                'ri-checkbox-circle-fill'=> $isHasStock,
                                'ri-error-warning-fill' => !$isHasStock, 
                            ])></i>
                        </div>
                        <p class="text">{{ $isHasStock ? 'Tersedia' : 'Habis' }}</p>
                    </div>
                    <div class="stock-count | text-xs font-light">{{ $product['product_stock'] }}</div>
                </div>
            </td>
            <td class="py-2 px-4">
                <div class="discount-info">
                    @if ($isDiscount)
                        <div class="discount | flex">
                            <div class="icon | h-4 text-red-600 me-1"><i class="ri-price-tag-3-fill"></i></div>
                            <p class="text">Diskon</p>
                        </div>
                        <div class="percent | text-xs font-light">
                            {{ $discountPercent }}%
                        </div>
                    @else
                        -
                    @endif
                </div>
            </td>
            <td class="py-2 px-4">
                <div class="price | flex justify-between">
                    <div class="left-side">Rp</div>
                    <div class="right-side">
                        <div class="discount | text-right">
                            <div class="after">{{ $isDiscount ? formatCurrencyIDR($product['discount_price']) : formatCurrencyIDR($product['normal_price']) }}</div>
                            @if ($isDiscount)
                                <div class="before | text-xs font-light line-through">{{ formatCurrencyIDR($product['normal_price']) }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </td>
            <td class="py-2 px-4">
                <div class="relative">
                    {{-- Product Action Button --}}
                    <button class="block rounded overflow-hidden p-1 mx-auto hover:bg-[#fbde7e] hover:text-[#0079c2]" onclick="btnDataAction(this)" aria-label="Data action" data-target-action="{{ $product['product_slug'] }}">
                        <div class="icon-action | h-6 pt-0.5 px-1" data-tooltip-target="action-tooltip-{{ $index }}" data-tooltip-placement="bottom"><i class="ri-more-2-line"></i></div>
                        <div class="icon-close | h-6 pt-0.5 px-1 animation animation-bounceInRight animation-delay-200 hidden" data-tooltip-target="action-close-tooltip-{{ $index }}" data-tooltip-placement="bottom"><i class="ri-close-line"></i></div>
                    </button>
                    <div id="action-tooltip-{{ $index }}" role="tooltip" class="absolute z-50 invisible inline-block px-3 py-2 text-xs font-medium text-white whitespace-nowrap transition-opacity duration-300 bg-gray-900 rounded-md shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Action
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                    <div id="action-close-tooltip-{{ $index }}" role="tooltip" class="absolute z-50 invisible inline-block px-3 py-2 text-xs font-medium text-white whitespace-nowrap transition-opacity duration-300 bg-gray-900 rounded-md shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Hide
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>

                    {{-- Product Action Wrapper --}}
                    <div id="{{ $product['product_slug'] . '-action' }}" class="absolute top-0 right-11 hidden">
                        <div class="w-24 flex justify-end gap-1 overflow-x-clip">
                            <a href="{{ route('products.edit', ['product' => $product['product_slug']]) }}" class="action-edit | bg-[#f5f5f5] text-[#999] rounded animation animation-bounceInRight animation-delay-100 shadow-sm p-1 px-2 hover:text-[#0079c2]" title="Edit">
                                <div class="icon-edit h-6 pt-0.5"><i class="ri-edit-box-fill"></i></div>
                            </a>
                            <button class="action-del | bg-[#f5f5f5] text-[#999] rounded animation animation-bounceInRight shadow-sm p-1 px-2 hover:text-[#0079c2]" data-category-name="{{ $product['product_name'] }}" wire:click="dispatchModal({{ json_encode($product) }})" title="Delete">
                                <div class="icon-del h-6 pt-0.5"><i class="ri-delete-bin-6-fill"></i></div>
                            </button>
                        </div>
                    </div>
                    @php /*TODO: Add tooltip*/ @endphp
                </div>
            </td>
        </tr>
    @endforeach
</tbody>
