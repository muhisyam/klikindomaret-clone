<div class="modal rounded-xl w-96 bg-white{{ $showCondition ? ' show' : '' }}" data-trigger-modal="{{ $section }}" wire:init="fetchDataOptionSelect">
    <section class="p-2 border-b border-light-gray-100 flex items-center justify-center">
        <x-icon class="ms-2 w-24" src="{{ asset('img/header/logo.png') }}"/>
    
        <x-button class="ml-auto p-2 h-7 w-7 group hover:bg-tertiary" data-target-modal="{{ $section }}" wire:loading.remove>
            <x-icon class="h-3 grayscale group-hover:grayscale-0" src="{{ asset('img/icons/icon-header-close.webp') }}"/>
        </x-button>

        <span class="!absolute top-2.5 right-4 inline-flex loader-spin" wire:loading></span>
    </section>
    <section class="p-4">
        <form wire:submit="store">
            <div class="mb-4">
                <x-input-label for="form-select-parent" value="Kategori Induk"/>
                <x-input-select id="form-select-parent" name="parent_id" wire:model.change="parent_id">
                    <option value="0" @selected(0 == $parent_id)>Kategori Level 0|Induk Kategori</option>

                @foreach ($categoryOption as $option)
                    <option value="{{ $option['category_id'] }}" @selected($option['category_id'] == $parent_id)>{{ $option['category_level'] . '|' .  $option['category_name']}}</option>
                @endforeach

                </x-input-select>
                <x-input-error field="parent_id" :error="$error"/>
            </div>
            <div class="mb-4">
                <x-input-label for="form-input-category-name" value="Nama Kategori"/>
                <x-input-field id="form-input-category-name" name="category_name" :error="$error" wire:model.blur="category_name"/>
                <x-input-error field="category_name" :error="$error"/>
            </div>
            <div class="mb-4">
                <x-input-label for="form-input-category-slug" value="Slug Kategori"/>
                <x-input-field id="form-input-category-slug" name="category_slug" :error="$error" wire:model="category_slug"/>
                <x-input-error field="category_slug" :error="$error"/>
            </div>
            <div class="mb-4">
                <x-input-label for="form-select-category-status" value="Status"/>
                <x-input-select id="form-select-category-status" name="category_deploy_status" wire:model.change="category_deploy_status">
                
                @foreach (array_diff(\App\Enums\DeployStatus::values(), ['Expired']) as $status)
                    <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
                
                </x-input-select>
            </div>
            <div class="mb-4" wire:ignore>
                <x-input-label for="form-input-image" value="Gambar Kategori(optional)"/>
                <x-input-image-simple id="form-input-image" type="file" accept=".jpg, .jpeg, .png, .webp" name="category_image_name" :error="$error" wire:model="category_image_name"/>
                <x-input-error field="category_image_name" :error="$error"/>
            </div>
            <x-button type="submit" class="justify-center h-10 px-8 text-sm" buttonStyle="secondary" value="Tambah"/>
        </form>
    </section>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('content-option-loaded', event => {
            setTimeout(() => {
                initSelect2();
            }, 1);
        });
    });

    function initSelect2() { 
        // Jquery for convert purpose(✌ ͡• ₃ ͡•)✌
        $('#form-select-parent').select2({
            templateResult: formatCategoryDropdown,
            templateSelection: formatCategorySelection,
            width: '100%',
        });

        $('#form-select-parent').parent().attr('wire:ignore', '');

        $('#form-select-parent').on('change', function(e) {
            Livewire
                .getByName("admin.category.index.modal-input")[0]
                .set('parent_id', $(this).val());
        });
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
            let textSplit = data.text.split('|');

            return $(
                `<div class="pe-1 flex gap-1.5 text-sm" prevent-close="">
                    <span class="shrink-0">${textSplit[0]}</span>
                    <span>|</span>
                    <span class="font-bold italic">${textSplit[1]}</span>
                </div>`
            );
        }
    }
</script>
@endpush