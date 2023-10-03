<td class="py-2 w-[50px]">
    <div class="accordion-category-button">
        <button class="block bg-[#eee] border border-[#ccc] text-[#aaa] rounded-full mx-auto" data-accordion-target="{{ $categoryLvl2['slug'] }}" aria-labelledby="{{ $categoryLvl2['slug'] }}" aria-expanded="false" aria-controls="{{ $categoryLvl2['slug'] }}">
            <div class="icon h-5 w-5 duration-500"><i class="ri-arrow-down-s-line"></i></div>
        </button>
    </div>
</td>
<td class="py-2 px-4 w-auto">
    <div class="accordion-category-info flex items-center">
        <div class="label me-1">{{ $categoryLvl2['name'] }}</div>
        <div class="product-count">(<span>{{ $categoryLvl2['children_count'] }}</span>)</div>
    </div>
</td>
<td class="py-2 px-4 w-[210px]">154 Produk</td>
<td class="py-2 px-4 w-[210px]">
    <div class="status flex">
        <div class="icon h-5 {{ $categoryLvl2['status'] ? 'text-green-600' : 'text-gray-400' }} scale-[0.6] me-1"><i class="ri-checkbox-blank-circle-fill"></i></div>
        <div class="info {{ $categoryLvl2['status'] ? '' : 'text-gray-400' }}">{{ $categoryLvl2['status'] ? 'Aktif' : 'Tidak Aktif' }}</div>
    </div>
</td>
<td class="py-2 px-4 w-[50px]">
    <div class="relative">
        <button type="button" class="block rounded overflow-hidden p-1 mx-auto hover:bg-[#fbde7e] hover:text-[#0079c2]" onclick="btnDataAction(this)" aria-label="Data action" data-target-action="{{ $categoryLvl2['slug'] }}">
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
        @livewire('admin.category.table-button-action', ['category' => $categoryLvl2])
    </div>
</td>
<td class="border-b-custom absolute right-0 bottom-0 h-3 border-b border-[#e5e7eb]"></td>