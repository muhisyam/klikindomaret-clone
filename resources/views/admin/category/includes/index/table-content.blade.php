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
            <div class="product-count">(<span>{{ $category['childs_count'] }}</span>)</div>
        </div>
    </td>
    <td class="py-2 px-4">154 Produk</td>
    <td class="py-2 px-4">
        <div class="status flex">
            <div class="icon h-5 text-gray-600 scale-[0.6] me-1"><i class="ri-checkbox-blank-circle-fill"></i></div>
            <div class="info">{{ $category['status'] ? 'Aktif' : 'Tidak Aktif' }}</div>
        </div>
    </td>
    <td class="py-2 px-4">
        <div class="relative">
            <button class="block rounded p-1 px-2 mx-auto hover:bg-[#fbde7e] hover:text-[#0079c2]" onclick="btnDataAction(this)" aria-label="Data action" data-target-action="{{ $category['slug'] }}">
                <div class="icon h-6 pt-0.5"><i class="ri-more-2-line"></i></div>
            </button>
            <div id="{{ $category['slug'] }}" class="absolute top-0 right-9 hidden">
                <div class="w-24 flex justify-end gap-1 overflow-hidden">
                    <a href="{{ route('categories.edit', ['category' => $category['id']]) }}" class="action-edit bg-[#f5f5f5] text-[#999] rounded p-1 px-2 hover:text-[#0079c2] animation animation-bounceInRight animation-delay-200">
                        <div class="icon h-6 pt-0.5"><i class="ri-edit-box-fill"></i></div>
                    </a>
                    <button class="action-del bg-[#f5f5f5] text-[#999] rounded p-1 px-2 hover:text-[#0079c2] animation animation-bounceInRight">
                        <div class="icon h-6 pt-0.5"><i class="ri-delete-bin-6-fill"></i></div>
                    </button>
                </div>
            </div>
            {{-- TODO: Add tooltip --}}
        </div>
    </td>
</tr>