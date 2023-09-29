<tr class="border-b">
    <td class="py-2">
        <div class="accordion-category-button">
            <a href="{{ route('categories.subIndex', ['category' => $category['slug']]) }}" aria-label="List subcategories">
                <div class="h-5 w-5 bg-[#eee] border border-[#ccc] text-[#0079c2] rounded-full mx-auto">
                    <div class="icon h-5 w-5 text-center"><i class="ri-arrow-right-s-line"></i></div>
                </div>
            </a>
        </div>
    </td>
    <td class="py-2 px-4">
        <div class="accordion-category-info flex items-center">
            <div class="label me-1">{{ $category['name'] }}</div>
            <div class="product-count">(<span>{{ $category['children_count'] }}</span>)</div>
        </div>
    </td>
    <td class="py-2 px-4">154 Produk</td>
    <td class="py-2 px-4">
        <div class="status flex">
            <div class="icon h-5 {{ $category['status'] ? 'text-green-600' : 'text-gray-400' }} scale-[0.6] me-1"><i class="ri-checkbox-blank-circle-fill"></i></div>
            <div class="info {{ $category['status'] ? '' : 'text-gray-400' }}">{{ $category['status'] ? 'Aktif' : 'Tidak Aktif' }}</div>
        </div>
    </td>
    <td class="py-2 px-4">
        <div class="relative">
            <button class="block rounded p-1 px-2 mx-auto hover:bg-[#fbde7e] hover:text-[#0079c2]" onclick="btnDataAction(this)" aria-label="Data action" data-target-action="{{ $category['slug'] }}" data-tooltip-target="action-tooltip-{{ $key }}" data-tooltip-placement="bottom">
                <div class="icon h-6 pt-0.5"><i class="ri-more-2-line"></i></div>
            </button>
            <div id="action-tooltip-{{ $key }}" role="tooltip" class="absolute z-50 invisible inline-block px-3 py-2 text-xs font-medium text-white whitespace-nowrap transition-opacity duration-300 bg-gray-900 rounded-md shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Action
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            @livewire('admin.category.table-button-action', ['category' => $category])
        </div>
    </td>
</tr>