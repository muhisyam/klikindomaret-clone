<thead class="bg-[#f5f5f5] text-[#999] text-sm text-left uppercase rounded-t">
    <tr>
        <th class="p-3 rounded-tl w-[50px]"><input type="checkbox" class="block m-auto" aria-label="Checkbox select all data"></th>
        <th class="py-3 px-4">
            <div @class([
                'header-col-wrapper | relative flex cursor-pointer', 
                'active-asc' => $isProductAsc,
                'active-desc' => $isProductDesc,
            ]) wire:click="sortBy('product_name')">
                <div class="label me-1">Product</div>
                <div class="sortable" data-sort></div>
            </div>
        </th>
        <th class="py-3 px-4">
            <div @class([
                'header-col-wrapper | relative flex cursor-pointer', 
                'active-asc' => $isCategoryAsc,
                'active-desc' => $isCategoryDesc,
            ]) wire:click="sortBy('category_name')">
                <div class="label me-1">Kategori</div>
                <div class="sortable" data-sort></div>
            </div>
        </th>
        <th class="py-3 px-4">Toko</th>
        <th class="py-3 px-4">
            <div @class([
                'header-col-wrapper | relative flex cursor-pointer', 
                'active-asc' => $isStatusAsc,
                'active-desc' => $isStatusDesc,
            ]) wire:click="sortBy('product_status')">
                <div class="label me-1">Status</div>
                <div class="sortable" data-sort></div>
            </div>
        </th>
        <th class="py-3 px-4">
            <div @class([
                'header-col-wrapper | relative flex cursor-pointer', 
                'active-asc' => $isStockAsc,
                'active-desc' => $isStockDesc,
            ]) wire:click="sortBy('product_stock')">
                <div class="label me-1">Stok</div>
                <div class="sortable" data-sort></div>
            </div>
        </th>
        <th class="py-3 px-4">Diskon</th>
        <th class="py-3 px-4">
            <div @class([
                'header-col-wrapper | relative flex cursor-pointer', 
                'active-asc' => $isPriceAsc,
                'active-desc' => $isPriceDesc,
            ]) wire:click="sortBy('product_price')">
                <div class="label me-1">Harga</div>
                <div class="sortable" data-sort></div>
            </div>
        </th>
        <th class="py-3 px-4 rounded-tr"></th>
    </tr>
</thead>