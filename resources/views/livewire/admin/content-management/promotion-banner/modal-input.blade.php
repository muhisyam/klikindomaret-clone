<div class="modal w-96 bg-white rounded-xl{{ $showCondition ? ' show' : '' }}" data-trigger-modal="{{ $section }}">
    <section class="flex items-center justify-center border-b border-light-gray-100 p-3">
        <x-button class="absolute top-0 left-0 h-12 w-12" data-target-modal="{{ $section }}">
            <x-icon class="w-3 m-auto" src="{{ asset('img/icons/icon-header-arrow-left.webp') }}"/>
        </x-button>

        <x-icon class="w-24" src="{{ asset('img/header/logo.png') }}"/>

        <span class="!absolute top-2.5 right-4 inline-flex loader-spin" wire:loading></span>
    </section>
    <section class="p-4">
        <form wire:submit="save">

            @php
                if ($errors->any()) $errors = [
                    'errors' => $errors->getMessages(),
                ];
            @endphp

            <div class="mb-4">
                <x-input-label for="form-input-banner-name" value="Nama Promo"/>
                <x-input-field id="form-input-banner-name" name="bannerName" :error="$errors" wire:model.blur="bannerName"/>
                <x-input-error field="bannerName" :error="$errors"/>
            </div>
            <div class="mb-4">
                <x-input-label for="form-input-banner-slug" value="Slug"/>
                <x-input-field id="form-input-banner-slug" name="bannerSlug" :error="$errors" wire:model="bannerSlug" wire:loading.attr="disabled"/>
                <x-input-error field="bannerSlug" :error="$errors"/>
            </div>
            <div class="mb-4" wire:ignore>
                <x-input-label for="form-select-banner-product" value="Tambah Produk"/>
                <x-input-select id="form-select-banner-product" class="overflow-hidden" name="productIds" multiple wire:model="productIds"/>
                <x-input-error field="productIds" :error="$errors"/>
            </div>
            <div class="mb-4" wire:ignore>
                <x-input-label for="form-input-banner-image" value="Banner Promo"/>
                <x-input-image-simple id="form-input-banner-image" type="file" accept=".jpg, .jpeg, .png, .webp" name="bannerImageName" :error="$errors" wire:model="bannerImageName"/>
                <x-input-error field="bannerImageName" :error="$errors"/>
            </div>
            <x-button type="submit" class="ms-auto justify-center h-10 px-8 text-sm" buttonStyle="secondary" value="Masuk"/>
        </form>
    </section>
</div>

@push('scripts')

    <script type="module">
        import { hideOpenedModal } from "../js/components.js";
        
        // Jquery for convert purpose(✌ ͡• ₃ ͡•)✌
        $('#form-select-banner-product').select2({
            ajax: {
                url: "{{ config('api.url') . 'refresh' }}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term,
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data.data,
                        pagination: {
                            more: params.page != data.meta.last_page
                        }
                    };
                },
            },
            minimumInputLength: 5,
            templateResult: formatProduct,
            templateSelection: formatProductSelection,
            closeOnSelect: false,
            width: '100%',
        });

        // Jquery for livewire purpose(✌ ͡• ₃ ͡•)✌
        $('#form-select-banner-product').on('change', function(e) {
            @this.productIds = $(this).val();                    
        });
        // Thanks for the tolerance(👍 ͡• ₃ ͡•)👍
        

        function formatProduct(data) { 
            if (data.loading) return data.text;

            let isImageDefault = data.product_image_name.includes('default') ? '' : data.product_slug + "/";

            return $(
                `<div class="flex gap-1.5" prevent-close="">
                    <img class="h-10 w-10 rounded" src="{{ asset('img/uploads/products/${isImageDefault}${data.product_image_name}') }}" alt="Product image" loading="lazy" prevent-close=""/>
                    <div>
                        <div class="font-bold line-clamp-1" title="${data.product_name}" prevent-close="">${data.product_name}</div>
                        <div class="text-xs line-clamp-1" title="${data.category_lvl_3}" prevent-close="">${data.category_lvl_1} / ${data.category_lvl_2} / ${data.category_lvl_3}</div>
                    </div>
                </div>`
            );

        }

        function formatProductSelection(data) { 
            return data.product_name;
        }

        document.addEventListener('livewire:initialized', () => {
            @this.on('stored-content', event => {
                setTimeout(() => {
                    const thisModal = document.querySelectorAll('div[data-trigger-modal*="{{ $section }}"]');
                    thisModal.forEach(el => el.classList.remove('show'));
                }, 1);
            });
        });

        hideOpenedModal();
    </script>
    
@endpush
