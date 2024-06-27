<x-admin-layout>
    <x-slot:title>
        {{ str_contains(url()->current(), 'create') ? 'Tambah' : 'Ubah' }} Kategori
    </x-slot:title>

    <x-slot:header>
        @include('admin.category.input.header')
    </x-slot:header>
    
    <livewire:admin.category.input.form-tracker/>

    @php
        $isUrlEdit = str_contains(url()->current(), '/edit'); 
        $formRoute = $isUrlEdit 
            ? route('categories.update', ['category' => $categorySlug]) 
            : route('categories.store');

        $slugFetch = $isUrlEdit
            ? $categorySlug
            : '';

        $dataError = session('input_error') ?? ['errors' => []];
    @endphp
    
    <livewire:admin.category.input.form-input 
        :formRoute="$formRoute" 
        :error="$dataError" 
        :old="old()" 
        :slugFetch="$slugFetch"/>
    

</x-admin-layout>

<script type="module">
    document.addEventListener('livewire:initialized', () => {
        let inputNameValue = {};

        Livewire.on('content-loaded', event => {
            setTimeout(() => {
                initImageUploader();
                initButtonRemoveImage();
                initSelect2();
                initEventDetectInputChanges(inputNameValue);
            }, 1);
        });

        Livewire.on('slug-updated', event => {
            setTimeout(() => {
                setInputObject(inputNameValue);
            }, 1);
        });
    });

    function initImageUploader() { 
        const formInputImg = document.querySelector('#form-input-image');
        const dropAreaImg  = document.querySelector('#drop-area-image');
        const browseImgBtn = document.querySelector('#browse-img');
        const imageHandler = new ImageFileHandler();
        
        browseImgBtn.addEventListener('click', () => formInputImg.click());
        formInputImg.addEventListener('change', () => new SingleImageUploader());
        dropAreaImg.addEventListener('dragover', (e) => imageHandler.handleDragOver(e));
        dropAreaImg.addEventListener('dragleave', () => imageHandler.handleDragLeave());
        dropAreaImg.addEventListener('drop', (e) => imageHandler.handleDrop(e));
    }

    function initButtonRemoveImage() { 
        const imageUploader = new SingleImageUploader(true);

        imageUploader.initButtonRemoveSingleImage();
    }

    function initSelect2() { 
        // Jquery for convert purpose(✌ ͡• ₃ ͡•)✌
        const inputFormComponent = Livewire.getByName("admin.category.input.form-input")[0];
        const apiPrefixEndpoint  = "{{ config('api.url') }}";

        $('#form-select-parent').select2({
            ajax: {
                url: `${apiPrefixEndpoint}categories/resource/minimal?from=parent`,
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

        // Set ignore to all select2 components
        $(
            '[data-element="image-uploaded-wrapper"],'
            + '#form-select-parent,'
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
            let splitText, categoryLevel, categoryName;

            if (data.text) splitText = data.text.split('|');

            categoryLevel = splitText ? splitText[0] : data.category_level;
            categoryName  = splitText ? splitText[1] : data.category_name;

            return $(
                `<div class="pe-1 flex gap-1.5 text-sm" prevent-close="">
                    <span class="shrink-0">${categoryLevel}</span>
                    <span>|</span>
                    <span class="font-bold italic">${categoryName}</span>
                </div>`
            );
        }
    }

    function initEventDetectInputChanges(inputNameValue) {
        // Get all input form include image input inside section "category input" through name attr. Why 
        // using name, because tag input forms are different.
        const inputList = document.querySelectorAll('[data-section="category-input-wrapper"] [name]');

        inputList.forEach(input => {
            switch (input.tagName) {
                case 'INPUT':
                    $(input).on('input', () => setInputObject(inputNameValue));

                    break;
            
                case 'SELECT':
                    $(input).on('change', () => setInputObject(inputNameValue));
                    
                    break;
            }
        });
    }

    function setInputObject(inputNameValue) {
        const inputList = document.querySelectorAll('[data-section="category-input-wrapper"] [name]');

        inputList.forEach(input => {
            const nameAttr = input.getAttribute('name');
            const value    = input.value;
            
            inputNameValue[nameAttr] = value;
        })

        Livewire.dispatch('updating-tracker', { formUpdate: inputNameValue });
    }
</script>