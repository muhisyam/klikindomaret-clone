<div class="modal w-96 bg-white rounded-xl{{ $showCondition ? ' show' : '' }}" data-trigger-modal="{{ $section }}">
    <section class="flex items-center justify-center border-b border-light-gray-100 p-3">
        <x-button class="absolute top-0 left-0 h-12 w-12" data-target-modal="{{ $section }}">
            <x-icon class="w-3 m-auto" src="{{ asset('img/icons/icon-header-arrow-left.webp') }}"/>
        </x-button>

        <x-icon class="w-24" src="{{ asset('img/header/logo.png') }}"/>
    </section>
    <section class="p-4">
        <form wire:submit="save">

        @php
            if ($errors->any()) $errors = [
                'errors' => $errors->getMessages(),
            ];
        @endphp

            {{-- <div wire:loading>sad</div> --}}
            <div class="mb-4">
                <x-input-label for="form-input-featured-name" value="Nama Konten"/>
                <x-input-field id="form-input-featured-name" name="featuredName" :error="$errors" wire:model="featuredName"/>
                <x-input-error field="featuredName" :error="$errors"/>
            </div>
            <div class="mb-4">
                <x-input-label for="form-input-featured-slug" value="Slug"/>
                <x-input-field id="form-input-featured-slug" name="featuredSlug" :error="$errors" wire:model="featuredSlug"/>
                <x-input-error field="featuredSlug" :error="$errors"/>
            </div>
            <div class="relative mb-4">
                <x-input-label for="form-input-featured-product" value="Tambah Produk"/>
                <x-input-select id="form-select-featured-product" class="overflow-hidden" name="productIds" multiple wire:model="productIds">
                    @php $hasShown = []; @endphp
                    
                    @foreach ($dataProducts['data'] as $categoryName => $productList)
                    <optgroup class="text-transparent" label="{{ $categoryName }}">
                        @foreach ($productList as $item)
                        <option class="text-transparent" value="{{ $item['id'] }}" @selected(in_array($item['id'] ,$productSelected['id']))>{{ $item['product_name'] }}</option>
                        @php if (in_array($item['id'], $productSelected['id'])) $hasShown[] = $item['id'] @endphp
                        @endforeach
                    </optgroup>
                    @endforeach
                    
                    @for ($i = 0; $i < count($productSelected['id']); $i++)
                        @if (! in_array($productSelected['id'][$i], $hasShown))
                        <option class="text-transparent" value="{{ $productSelected['id'][$i] }}" selected>{{ $productSelected['product_name'][$i] }}</option>
                        @endif
                    @endfor
                </x-input-select>
                <x-input-error field="productIds" :error="$errors"/>
            </div>
            <x-button type="submit" class="justify-center h-10 px-8 text-sm" buttonStyle="secondary" value="Masuk"/>
        </form>
    </section>
</div>

@push('scripts')

    <script type="module">
        import { hideOpenedModal } from "../js/components.js";

        // Jquery for livewire purpose(✌ ͡• ₃ ͡•)✌
        $('#form-select-featured-product').on('change', function(e) {
            console.log($(this).attr('data-product-key'));
            let selectedProduct = {
                'id': $(this).val(),
                'product_name': $(this).find('option:selected').text().split('.').map(name => name + '.'),
            };
            
            @this.productSelected = selectedProduct;
            @this.productIds = selectedProduct.id;
                    
            console.log($('#form-select-featured-product').select2('open'));
        });
        // Thanks for the tolerance(👍 ͡• ₃ ͡•)👍
        
        function changeToSelect2() { 
            // Jquery for convert purpose(✌ ͡• ₃ ͡•)✌
            $('#form-select-featured-product').select2({
                width: '100%',
            });

            $('.select2-search__field').attr('wire:model.live.debounce.200ms', 'productKeyword');
            // Thanks for the tolerance(👍 ͡• ₃ ͡•)👍
        }

        document.addEventListener('livewire:initialized', () => {
            @this.on('products-loaded', event => {
                setTimeout(() => {
                    $('option').each(function (index, element) {
                        if (jQuery.inArray(element.value, event.productSelected.id) === -1) {
                            $(element).prop('selected', false);
                        }
                    });

                    changeToSelect2();
                    $('#form-select-featured-product').select2('open');
                }, 1);
            });

            @this.on('stored-content', event => {
                setTimeout(() => {
                    const thisModal = document.querySelectorAll('div[data-trigger-modal*="{{ $section }}"]');
                    thisModal.forEach(el => el.classList.remove('show'));
                }, 1);
            });
        });

        hideOpenedModal();
        changeToSelect2();
    </script>
    
@endpush
