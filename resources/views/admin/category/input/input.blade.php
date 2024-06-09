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
                initSelect2();
                initEventDetectInputChanges(inputNameValue);
                initButtonRemoveImage();
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
                .getByName("admin.category.input.form-input")[0]
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
                    <span>${textSplit[0]}</span>
                    <span>|</span>
                    <span class="font-bold italic">${textSplit[1]}</span>
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