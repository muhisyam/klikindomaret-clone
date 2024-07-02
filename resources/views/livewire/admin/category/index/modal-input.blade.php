<div class="modal rounded-xl w-96 bg-white{{ $showCondition ? ' show' : '' }}" data-trigger-modal="{{ $section }}">
    <section class="p-2 border-b border-light-gray-100 flex items-center justify-center">
        <x-icon class="ms-2 w-24" src="{{ asset('img/header/logo.png') }}"/>
    
        <x-button class="ml-auto p-2 h-7 w-7 group hover:bg-tertiary" data-target-modal="{{ $section }}" wire:loading.class="opacity-0">
            <x-icon class="h-3 grayscale group-hover:grayscale-0" src="{{ asset('img/icons/icon-header-close.webp') }}"/>
        </x-button>

        <span class="!absolute top-2.5 right-4 inline-flex loader-spin" wire:loading></span>
    </section>
    <section class="p-4">
        <form class="space-y-4" wire:submit="store">
            <div>
                <x-input-label for="form-select-parent" value="Kategori Induk"/>
                <x-input-select id="form-select-parent" name="parent_id" wire:model.change="parent_id"/>
                <x-input-error field="parent_id" :error="$error"/>
            </div>
            <div>
                <x-input-label for="form-input-category-name" value="Nama Kategori"/>
                <x-input-field id="form-input-category-name" name="category_name" :error="$error" wire:model.blur="category_name"/>
                <x-input-error field="category_name" :error="$error"/>
            </div>
            <div>
                <x-input-label for="form-input-category-slug" value="Slug Kategori"/>
                <x-input-field id="form-input-category-slug" name="category_slug" :error="$error" wire:model="category_slug"/>
                <x-input-error field="category_slug" :error="$error"/>
            </div>
            <div>
                <x-input-label for="form-select-category-status" value="Status"/>
                <x-input-select id="form-select-category-status" name="category_deploy_status" wire:model.change="category_deploy_status">
                
                @foreach (array_diff(\App\Enums\DeployStatus::values(), ['Expired']) as $status)
                    <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
                
                </x-input-select>
            </div>
            <div wire:ignore>
                <x-input-label for="form-input-image" value="Gambar Kategori(optional)"/>
                <x-input-image-simple id="form-input-image" type="file" accept=".jpg, .jpeg, .png, .webp" name="category_image" :error="$error" wire:model="category_image"/>
                <x-input-error field="category_image" :error="$error"/>
            </div>
            <x-button type="submit" class="!mt-6 w-full justify-center h-10 px-8 text-sm" buttonStyle="secondary" value="Tambah"/>
        </form>
    </section>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', () => {
        setTimeout(() => {
            initSelect2();
        }, 1);
    });

    function initSelect2() { 
        // Jquery for convert purpose(✌ ͡• ₃ ͡•)✌
        const inputFormComponent = Livewire.getByName("admin.category.index.modal-input")[0];
        const apiPrefixEndpoint  = "{{ config('api.url') }}";
        const parentSlug         = "{{ $parentSlug }}";

        $('#form-select-parent').select2({
            ajax: {
                url: `${apiPrefixEndpoint}categories/resource/minimal?slug=${parentSlug}`,
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
            templateResult: formatCategoryDropdown,
            templateSelection: formatCategorySelection,
            width: '100%',
        });

        $('#form-select-category-status').select2({
            minimumResultsForSearch: Infinity,
            width: '100%',
        });

        $('#form-select-parent').on('change', function(e) {
            inputFormComponent.set('parent_id', $(this).val());
        });
        
        $('#form-select-category-status').on('change', function(e) {
            inputFormComponent.set('category_deploy_status', $(this).val());
        });

        $(
            '#form-select-parent,'
            + '#form-select-category-status'
        ).parent().attr('wire:ignore', '');
        // Thanks for the tolerance(👍 ͡• ₃ ͡•)👍

        /**
         * Template result dropdown option.
         * 
         * @param {object} data
        */
        function formatCategoryDropdown(data) { 
            if (data.loading) return data.text;

            return formatCategorySelection(data);
        }

        /**
         * Template result selected option.
         * 
         * @param {object} data
        */
        function formatCategorySelection(data) { 
            let categoryLevel = data.category_level;
            let categoryName  = data.category_name;

            return $(
                `<div class="pe-1 flex gap-1.5 text-sm" prevent-close="">
                    <span class="shrink-0">${categoryLevel}</span>
                    <span>|</span>
                    <span class="font-bold italic">${categoryName}</span>
                </div>`
            );
        }
    }
</script>
@endpush