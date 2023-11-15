<tr class="relative">
    <td class="py-2 w-[50px]">
        <div class="dot-list left-[17.5px] -top-2.5 relative z-10">
            <div class="icon absolute h-5 text-[#0079c2] scale-[0.6]">
                <i class="ri-checkbox-blank-circle-fill"></i>
            </div>
        </div>
    </td>
    <td class="py-2 px-4 w-auto">{{ $categoryLvl3['category_name'] }}</td>
    <td class="py-2 px-4 w-32">
        <div class="product-status w-20 {{ $categoryLvl3['category_status'] == 'Draft' ? 'bg-gray-100 text-gray-700' : 'bg-green-100 text-green-700' }} font-bold text-center rounded-lg p-1">
            <div class="info">{{ $categoryLvl3['category_status'] }}</div>
        </div>
    </td>
    <td class="py-2 px-4 w-52">154 Produk</td>
    <td class="py-2 px-4 w-[50px]">
        <div class="relative">
            <button type="button" class="block rounded overflow-hidden p-1 mx-auto hover:bg-[#fbde7e] hover:text-[#0079c2]" onclick="btnDataAction(this)" aria-label="Data action" data-target-action="{{ $categoryLvl3['category_slug'] }}">
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
            @livewire('admin.category.table-button-action', ['category' => $categoryLvl3])
        </div>
    </td>
    <td class="border-b-custom absolute right-0 bottom-0 h-4 border-b border-[#e5e7eb] rounded-l-2xl"></td>
</tr>