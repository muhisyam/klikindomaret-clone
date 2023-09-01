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
        <button class="block rounded p-1 px-2 mx-auto hover:bg-[#fbde7e] hover:text-[#0079c2]" aria-label="Data action">
            <div class="icon h-6 pt-0.5"><i class="ri-more-2-line"></i></div>
        </button>
    </td>
</tr>