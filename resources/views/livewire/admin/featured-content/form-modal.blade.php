<div class="modal w-96 bg-white rounded-xl{{ $showCondition ? ' show' : '' }}" data-trigger-modal="{{ $section }}" wire:init="loadProducts">
    <section class="flex items-center justify-center border-b border-light-gray-100 p-3">
        <x-button class="absolute top-0 left-0 h-12 w-12" data-target-modal="{{ $section }}">
            <x-icon class="w-3 m-auto" src="{{ asset('img/icons/icon-header-arrow-left.webp') }}"/>
        </x-button>

        <x-icon class="w-24" src="{{ asset('img/header/logo.png') }}"/>
    </section>
    <section class="p-4">
        <form wire:submit="save">

        @if ($errors->any())
            @php
            $errors = [
                'errors' => $errors->getMessages(),
            ];
            @endphp
        @endif

            <div wire:loading>sad</div>
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
            <div class="mb-4">
                <x-input-label for="form-input-featured-product" value="Tambah Produk"/>
                <select id="form-select-featured-product" name="productIds" multiple wire:model="productIds">
                    @foreach ($dataProducts['data'] as $item)
                    <option value="{{ $item['id'] }}">{{ $item['product_name'] }}</option>
                    @endforeach
                </select>
                <x-input-error field="productIds" :error="$errors"/>
            </div>
            <x-button type="submit" class="justify-center h-10 px-8 text-sm" buttonStyle="secondary" value="Masuk"/>
        </form>
    </section>
</div>

@push('scripts')

    <script type="text/javascript">
        // Jquery just for convert purpose(✌ ͡• ₃ ͡•)✌
        $('#form-select-featured-product').on('change', function () {
            @this.set('productIds', $(this).val());
        });
        // Thanks for the tolerance(👍 ͡• ₃ ͡•)👍
        
        function changeToSelect2() { 
            // Jquery just for convert purpose(✌ ͡• ₃ ͡•)✌
            $('#form-select-featured-product').select2({
                width: '100%',
            });
            // Thanks for the tolerance(👍 ͡• ₃ ͡•)👍
        }

        changeToSelect2();

        document.addEventListener('livewire:initialized', () => {
            @this.on('products-loaded', (event) => {
                setTimeout(() => {
                    changeToSelect2();
                }, 1);

                setTimeout(() => {
                    const thisModal = document.querySelectorAll('div[data-trigger-modal*="{{ $section }}"]');
                    thisModal[0].classList.contains('show') ? thisModal.forEach(el => el.classList.add('show')) : '';
                }, 2);
            });

            @this.on('stored-content', event => {
                setTimeout(() => {
                    const thisModal = document.querySelectorAll('div[data-trigger-modal*="{{ $section }}"]');
                    thisModal.forEach(el => el.classList.remove('show'));
                }, 1);
            });
        });
    </script>
    
@endpush
