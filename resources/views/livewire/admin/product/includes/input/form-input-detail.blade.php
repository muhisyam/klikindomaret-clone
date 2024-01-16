<div>
    <div class="item-input-group | mb-4">
        <label for="form-input-plu" class="block text-sm mb-1">PLU</label>
        <input id="form-input-plu" type="number" name="plu" class="h-10 w-full border border-[#ccc] rounded py-2 px-3 focus:ring-transparent {{ array_key_exists('plu', $error['errors']) && 'is-invalid' }}" autofocus wire:model="inputs.plu">
        @include('admin.components.validation-message', ['field' => 'plu', 'validation' => 'form'])
    </div>
    <div class="item-input-group | relative flex gap-4 mb-4">
        <span class="!absolute -top-1 inline-flex loader-spin ms-24" wire:loading></span>
        <div class="parent-category w-1/2" wire:ignore>
            <label for="form-select-category-parent" class="block text-sm mb-1">Kategori Induk</label>
            <select id="form-select-category-parent" wire.model='categoryParent' wire:loading.attr="disabled">
                <option></option>
                @foreach ($categoryParentsList['data'] as $dataParent)
                    <option value="{{ $dataParent['category_slug'] }}">{{ $dataParent['category_name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="children-category | w-1/2" wire:ignore>
            <label for="form-select-category-children" class="block text-sm mb-1">Kategori</label>
            <select id="form-select-category-children" name="category_id" class="{{ array_key_exists('category_id', $error['errors']) && 'is-invalid' }}" wire:loading.attr="disabled">
                <option></option>
                @isset($data)
                    <option value="{{ $data['category_id'] }}" selected>{{ $data['category']['category_name'] }}</option>    
                @endisset
            </select>
            @include('admin.components.validation-message', ['field' => 'category_id', 'validation' => 'form'])
        </div>
    </div>
    <div class="item-input-group | mb-4">
        <label for="form-input-product-name" class="block text-sm mb-1">Nama Produk</label>
        <input id="form-input-product-name" type="text" name="product_name" class="h-10 w-full border border-[#ccc] rounded py-2 px-3 focus:ring-transparent {{ array_key_exists('product_name', $error['errors']) && 'is-invalid' }}" wire:model.blur="inputs.name">
        @include('admin.components.validation-message', ['field' => 'product_name', 'validation' => 'form'])
    </div>
    <div class="item-input-group | mb-4">
        <label for="form-input-product-slug" class="block text-sm mb-1">Slug</label>
        <input id="form-input-product-slug" type="text" name="product_slug" class="h-10 w-full border border-[#ccc] rounded py-2 px-3 focus:ring-transparent {{ array_key_exists('product_slug', $error['errors']) && 'is-invalid' }}" wire:model="inputs.slug">
        @include('admin.components.validation-message', ['field' => 'product_slug', 'validation' => 'form'])
    </div>
    <div class="item-input-group | mb-4">
        <label for="form-input-normal-price" class="block text-sm mb-1">Harga</label>
        <div class="flex border border-[#ccc] rounded">
            <span class="bg-gray-100 border-r border-[#ccc] rounded-l py-2 px-3">Rp</span>
            <input id="form-input-normal-price" type="number" name="normal_price" class="h-10 w-full py-2 px-3 focus:ring-transparent {{ array_key_exists('normal_price', $error['errors']) && 'is-invalid' }}" wire:model="inputs.normalPrice">
        </div>
        @include('admin.components.validation-message', ['field' => 'normal_price', 'validation' => 'form'])
    </div>
    <div class="item-input-group | mb-4">
        <label for="form-input-discount_price-price" class="block text-sm mb-1">Harga Diskon</label>
        <div class="flex border border-[#ccc] rounded">
            <span class="bg-gray-100 border-r border-[#ccc] rounded-l py-2 px-3">Rp</span>
            <input id="form-input-discount_price-price" type="number" name="discount_price" class="h-10 w-full py-2 px-3 focus:ring-transparent {{ array_key_exists('discount_price', $error['errors']) && 'is-invalid' }}" placeholder="0" wire:model="inputs.discountPrice">
        </div>
        @include('admin.components.validation-message', ['field' => 'discount_price', 'validation' => 'form'])
    </div>
    <div class="item-input-group | mb-4">
        <label for="form-input-product-stock" class="block text-sm mb-1">Stok</label>
        <input id="form-input-product-stock" type="number" name="product_stock" class="h-10 w-full border border-[#ccc] rounded py-2 px-3 focus:ring-transparent {{ array_key_exists('product_stock', $error['errors']) && 'is-invalid' }}" wire:model="inputs.stock">
        @include('admin.components.validation-message', ['field' => 'product_stock', 'validation' => 'form'])
    </div>
    <div class="item-input-group | mb-4" wire:ignore>
        <label for="form-select-product-status" class="block text-sm mb-1">Status</label>
        <select id="form-select-product-status" name="product_status" class="{{ array_key_exists('product_status', $error['errors']) && 'is-invalid' }}">
            <option></option>
            @php $selectedStatus = isset($data) ? $data['product_status'] : old('product_status') @endphp
            <option value="Draft" @selected($selectedStatus === 'Draft')>Draft</option>
            <option value="Publish" @selected($selectedStatus === 'Publish')>Publish</option>
        </select>
        @include('admin.components.validation-message', ['field' => 'product_status', 'validation' => 'form'])
    </div>
    <div class="item-input-group | mb-4" wire:ignore>
        <label for="form-select-supplier" class="block text-sm mb-1">Supplier</label>
        <select id="form-select-supplier" name="supplier_id" class="{{ array_key_exists('supplier_id', $error['errors']) && 'is-invalid' }}" wire.model='supplierInput'>
            <option></option>
            @php $selectedSupplier = isset($data) ? $data['supplier_id'] : (int) old('supplier_id') @endphp
            @foreach ($suppliersList['data'] as $supplierData)
                <option value="{{ $supplierData['id'] }}" @selected($selectedSupplier === $supplierData['id'])>{{ $supplierData['supplier_name'] }}</option>
            @endforeach
        </select>
        @include('admin.components.validation-message', ['field' => 'supplier_id', 'validation' => 'form'])
    </div>  
    <div class="item-input-group | | relative mb-4" wire:ignore>
        <span class="!absolute -top-1 inline-flex loader-spin ms-8" wire:loading></span>
        <label for="form-select-store" class="block text-sm mb-1">Toko</label>
        <select id="form-select-store" name="stores[]" class="{{ array_key_exists('stores', $error['errors']) && 'is-invalid' }}" multiple="multiple" wire:loading.attr="disabled">
            @php $selectedStore = isset($data) ? $data['store_ids'] : old('stores') @endphp
            @unless (is_null($selectedStore))
                @foreach($storesList['data'] as $storeData)
                    <option value="{{ $storeData['id'] }}" @selected(in_array((string) $storeData['id'], $selectedStore))>{{ $storeData['store_name'] }}</option>
                @endforeach
            @endunless
        </select>
        @include('admin.components.validation-message', ['field' => 'store_id', 'validation' => 'form'])
    </div>
</div>

@push('scripts')

    <script type="text/javascript">
        // Jquery just for livewire select2 purpose(✌ ͡• ₃ ͡•)✌
        $('#form-select-category-parent').on('change', function () {
            @this.set('categoryParent', $(this).val());
        });

        $('#form-select-supplier').on('change', function () {
            @this.set('supplierInput', $(this).val());
        });
        // ========>>>>>>> Thanks for the tolerance(👍 ͡• ₃ ͡•)👍

        document.addEventListener('livewire:initialized', () => {
            @this.on('select2-categories', (event) => {
                let option = '';
                const selectChildren = document.querySelector('#form-select-category-children');
                const isHasValue = selectChildren.value;
                const dataEvent = event.categoryChildren !== null ? event.categoryChildren.data : null;

                if (dataEvent !== null) {
                    dataEvent.forEach((data) => {
                        let childOption = '';
                        
                        data.children.forEach(dataChild => {
                            childOption += `<option value="${dataChild.id}"${isHasValue == dataChild.id && 'selected'}>${dataChild.category_name}</option>`
                        })
                        
                        option += `<optgroup label="${data.category_name}">${childOption}</optgroup>`;
                    });
                }

                selectChildren.innerHTML = option;
            });

            @this.on('select2-stores', (event) => {
                let option = '';
                const selectStore = document.querySelector('#form-select-store');
                const isHasValue = selectStore.value;
                const eventStore = event.storeList ?? null;

                if (eventStore !== null) {
                    eventStore.data.forEach((dataStore) => {
                        option += `<option value="${dataStore.id}"${isHasValue == dataStore.id && 'selected'}>${dataStore.store_name}</option>`
                    });
                }

                selectStore.innerHTML = option;
            });
        });
    </script>
    
@endpush
