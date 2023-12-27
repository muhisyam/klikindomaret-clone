<tbody class="text-sm">
    @foreach ($data['data'] as $index => $product)
        @php
            $productThumbnail = !empty($product['product_images']) ? $product['product_images'][0]['product_image_name'] : '';
            $isDraft = $product['product_status'] === 'Draft' ? True : False;
            $isHasStock = $product['product_stock'] && False;
            $isDiscount = $product['discount_price'] ?? 0;
            $discountPercent = round(($product['discount_price'] / $product['normal_price']) * 100);
        @endphp
        <tr class="border-b">
            <td class="py-2 px-4">{{ $index+1 }}</td>
            <td class="py-2 px-4">
                <div class="product-info flex items-center">
                    <figure class="media w-10 me-3">
                        <img class="rounded-md" src="{{ asset('img/uploads/products/' . $product['product_slug'] . '/' . $productThumbnail) }}" alt="">
                    </figure>
                    <div class="product-desc w-40 flex-1">
                        <div class="name line-clamp-1 text-ellipsis">
                            {{ $product['product_name'] }}
                        </div>
                        <div class="plu text-xs font-light">
                            <p>PLU: <span>{{ $product['plu'] }}</span></p>
                        </div>
                    </div>
                </div>
            </td>
            <td class="py-2 px-4">
                <div class="sort-categories">
                    @php //TODO: Make detail category 
                    @endphp
                    <button class="hover:text-[#0079c2]">{{ $product['category']['category_name'] }}</button>
                </div>
            </td>
            <td class="py-2 px-4">
                <div class="store-location">
                    <div class="info">{{ $product['store']['store_name'] }}</div>
                    <div class="address flex text-xs font-light">
                        <div class="address-info me-1">Lokasi</div>
                        <button class="icon h-4 hover:text-[#0079c2]" aria-label="See address data"><i class="ri-eye-fill"></i></button>
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
                    <div class="ready flex">
                        <div @class([
                            'icon | h-4 me-1', 
                            'text-green-600' => !$isHasStock,
                            'text-red-600' => $isHasStock,
                        ])><i class="ri-checkbox-circle-fill"></i></div>
                        <p class="text">{{ $isHasStock ? 'Tersedia' : 'Habis' }}</p>
                    </div>
                    <div class="stock-count text-xs font-light">
                        {{ $product['product_stock'] }}
                    </div>
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
                <div class="price flex justify-between">
                    <div class="left-side">Rp</div>
                    @php //TODO: Format currency
                    @endphp
                    <div class="right-side">
                        <div class="discount text-right">
                            <div class="after">{{ formatCurrencyIDR($product['normal_price']) }}</div>
                            @if ($isDiscount)
                                <div class="before text-xs font-light line-through">{{ formatCurrencyIDR($product['discount_price']) }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </td>
            <td class="py-2 px-4 text-center">
                <button class="hover:bg-[#fbde7e] hover:text-[#0079c2] rounded p-1 px-2" aria-label="Data action">
                    <div class="icon h-6 pt-0.5"><i class="ri-more-2-line"></i></div>
                </button>
            </td>
        </tr>
    @endforeach
</tbody>