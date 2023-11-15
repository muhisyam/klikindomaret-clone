<tr class="border-b">
    <td class="py-2">
        <div class="accordion-category-button">
            <a href="{{ route('categories.subIndex', ['category' => $category['category_slug']]) }}" aria-label="List subcategories">
                <div class="h-5 w-5 bg-[#eee] border border-[#ccc] text-[#0079c2] rounded-full mx-auto">
                    <div class="icon h-5 w-5 text-center"><i class="ri-arrow-right-s-line"></i></div>
                </div>
            </a>
        </div>
    </td>
    <td class="py-2 px-4">
        <div class="accordion-category-info flex items-center">
            <div class="label me-1">{{ $category['category_name'] }}</div>
            <div class="product-count">(<span>{{ $category['children_count'] }}</span>)</div>
        </div>
    </td>
    <td class="py-2 px-4">
        <div class="product-status w-20 {{ $category['category_status'] == 'Draft' ? 'bg-gray-100 text-gray-700' : 'bg-green-100 text-green-700' }} font-bold text-center rounded-lg p-1">
            <div class="info">{{ $category['category_status'] }}</div>
        </div>
    </td>
    <td class="py-2 px-4">154 Produk</td>
    <td class="py-2 px-4">
        <div class="relative">
            <button class="block rounded overflow-hidden p-1 mx-auto hover:bg-[#fbde7e] hover:text-[#0079c2]" onclick="btnDataAction(this)" aria-label="Data action" data-target-action="{{ $category['category_slug'] }}">
                <div class="icon-action h-6 pt-0.5 px-1" data-tooltip-target="action-tooltip-{{ $key }}" data-tooltip-placement="bottom"><i class="ri-more-2-line"></i></div>
                <div class="icon-close h-6 pt-0.5 px-1 animation animation-bounceInRight hidden" data-tooltip-target="action-close-tooltip-{{ $key }}" data-tooltip-placement="bottom"><i class="ri-close-line"></i></div>
            </button>
            <div id="action-tooltip-{{ $key }}" role="tooltip" class="absolute z-50 invisible inline-block px-3 py-2 text-xs font-medium text-white whitespace-nowrap transition-opacity duration-300 bg-gray-900 rounded-md shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Action
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            <div id="action-close-tooltip-{{ $key }}" role="tooltip" class="absolute z-50 invisible inline-block px-3 py-2 text-xs font-medium text-white whitespace-nowrap transition-opacity duration-300 bg-gray-900 rounded-md shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Hide
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            @livewire('admin.category.table-button-action', ['category' => $category])
        </div>
    </td>
</tr>