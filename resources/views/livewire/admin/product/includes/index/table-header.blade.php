<thead class="bg-[#f5f5f5] text-[#999] text-sm text-left uppercase rounded-t">
    <tr>
        @php /*TODO: Error class updated*/ @endphp
        <th class="py-3 px-4 rounded-tl">No.</th>
        <th class="py-3 px-4">
            <button type="button" class="header-col-wrapper relative flex" wire:click="sortBy('product_name')">
                <div class="label me-1">Product</div>
                <div class="sortable" data-sort></div>
            </button>
        </th>
        <th class="py-3 px-4">
            <button type="button" class="header-col-wrapper relative flex" wire:click="sortBy('category_name')">
                <div class="label me-1">Kategori</div>
                <div class="sortable" data-sort></div>
            </button>
        </th>
        <th class="py-3 px-4">Toko</th>
        <th class="py-3 px-4">
            <button type="button" class="header-col-wrapper relative flex" wire:click="sortBy('product_status')">
                <div class="label me-1">Status</div>
                <div class="sortable" data-sort></div>
            </button>
        </th>
        <th class="py-3 px-4">
            <button type="button" class="header-col-wrapper relative flex" wire:click="sortBy('product_stock')">
                <div class="label me-1">Stok</div>
                <div class="sortable" data-sort></div>
            </button>
        </th>
        <th class="py-3 px-4">Diskon</th>
        <th class="py-3 px-4">
            <button type="button" class="header-col-wrapper relative flex" wire:click="sortBy('product_price')">
                <div class="label me-1">Harga</div>
                <div class="sortable" data-sort></div>
            </button>
        </th>
        <th class="py-3 px-4 rounded-tr"></th>
    </tr>
</thead>

@push('scripts')

    <script>
        const buttonHeaderList = document.querySelectorAll('.header-col-wrapper');

        buttonHeaderList.forEach(button => {
            button.addEventListener('click', function() {
                buttonHeaderList.forEach(button => {
                    button.classList.remove('active-asc');
                    button.classList.remove('active-desc');
                });

                Livewire.on('get-orderby', (event) => {
                    event.orderby === 'asc' ? button.classList.add('active-asc') : button.classList.add('active-desc');
                });
            })
        })
    </script>

@endpush
