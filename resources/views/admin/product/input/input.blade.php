<x-admin-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <x-slot:header>
        @include('admin.product.input.header')
    </x-slot:header>
    
    <livewire:admin.product.input.form-tracker/>

    @php
        $isUrlEdit = isRouteContains('edit'); 
        $formRoute = $isUrlEdit 
            ? route('products.update', ['product' => $productSlug]) 
            : route('products.store');

        $slugFetch = $isUrlEdit
            ? $productSlug
            : '';

        $dataError = session('input_error') ?? ['errors' => []];
    @endphp
    
    <livewire:admin.product.input.form-input 
        :formRoute="$formRoute" 
        :error="$dataError" 
        :old="old()" 
        :slugFetch="$slugFetch"/>
    

</x-admin-layout>

<script type="module">
    import { initInvalidSelect2 } from "{{ asset('js/' . config('view.js_component')) }}";

    window.imageFiles = {};

    document.addEventListener('livewire:initialized', () => {
        Livewire.on('content-loaded', event => {
            window.event = event;

            setTimeout(() => {
                initSwitchForm();
                initImageUploader();
                initButtonRemoveImage();
                initSelect2();
                initInvalidSelect2();
                initTinyMCE();
                initEventDetectInputChanges();
            }, 1);
        });

        Livewire.on('slug-updated', event => {
            setTimeout(() => {
                setInputObject();
            }, 1);
        });
    });

    function initSwitchForm() { 
        const buttonSwitchList = document.querySelectorAll('button[switch-form-target]');

        buttonSwitchList.forEach(buttonSwitch => {
            buttonSwitch.addEventListener('click', () => {
                const dataTarget = buttonSwitch.getAttribute('switch-form-target');
                const targetEl   = document.querySelector(`[switch-form-trigger="${dataTarget}"]`);

                hideAllSwitchForm();
                
                targetEl.classList.remove('hidden');

                Livewire
                    .getByName("admin.product.input.form-input")[0]
                    .set('activeSwitch', dataTarget);

            })
        })
    }

    function hideAllSwitchForm() { 
        document
            .querySelectorAll('[switch-form-trigger]')
            .forEach(el => el.classList.add('hidden'));

        document
            .querySelectorAll('[switch-form-target]')
            .forEach(el => el.classList.remove('font-bold'));
    }

    function initImageUploader() { 
        const formInputImg = document.querySelector('#form-input-image');
        const dropAreaImg  = document.querySelector('#drop-area-image');
        const browseImgBtn = document.querySelector('#browse-img');
        const imageHandler = new ImageFileHandler('multiple');
        
        browseImgBtn.addEventListener('click', () => formInputImg.click());
        dropAreaImg.addEventListener('dragover', (e) => imageHandler.handleDragOver(e));
        dropAreaImg.addEventListener('dragleave', () => imageHandler.handleDragLeave());
        dropAreaImg.addEventListener('drop', (e) => {
            imageHandler.handleDrop(e);
            setInputObject();
        });
        formInputImg.addEventListener('change', (e) => {
            imageHandler.handleImageUpload(e);
            setInputObject();
        });
    }

    function initButtonRemoveImage() { 
        const imageUploader = new MultipleImageUploader(true);

        imageUploader.initButtonRemoveMultipleImage();
    }

    function initSelect2(event) { 
        const inputFormComponent = Livewire.getByName('admin.product.input.form-input')[0];
        const apiPrefixEndpoint  = "{{ config('api.url') }}";

        // Jquery for convert purpose(✌ ͡• ₃ ͡•)✌

        initSelectCategory(apiPrefixEndpoint);
        initSelectBrand(apiPrefixEndpoint);
        initSelectSupplier(apiPrefixEndpoint);

        if ($('#form-select-retailer').has('option').length > 0) {
            const username      = "{{ getAuthUsername() }}";
            const supplierValue = $('#form-select-supplier').val();
            const retailerValue = window.event.retailer;
            
            initSelectRetailer(apiPrefixEndpoint, username, supplierValue);
            $('#form-select-retailer').val(retailerValue).trigger('change');
        }

        initSelectDelployStatus();
        initSelectKeyword();

        $('#form-select-category').on('change', function(e) {
            inputFormComponent.set('category_id', $(this).val());
        });
        
        $('#form-select-brand').on('change', function(e) {
            inputFormComponent.set('brand_id', $(this).val());
        });

        $('#form-select-supplier').on('change', function(e) {
            const username = "{{ getAuthUsername() }}";
            
            inputFormComponent.set('supplier_id', $(this).val());
            initSelectRetailer(apiPrefixEndpoint, username, $(this).val());
        });

        $('#form-select-retailer').on('change', function(e) {
            inputFormComponent.set('retailer_id', $(this).val());
        });

        $('#form-select-product-status').on('change', function(e) {
            inputFormComponent.set('product_deploy_status', $(this).val());
        });
        
        $('#form-select-product-keyword').on('change', function(e) {
            inputFormComponent.set('product_meta_keyword', $(this).val());
        });

        // Set ignore to all select2 components
        $(
            '[data-element="image-uploaded-wrapper"],'
            + '#form-select-category,'
            + '#form-select-brand,'
            + '#form-select-supplier,'
            + '#form-select-retailer,'
            + '#form-select-product-status,'
            + '#form-select-product-keyword'
        ).parent().attr('wire:ignore', '');

        // Thanks for the tolerance(👍 ͡• ₃ ͡•)👍
    }

    function initSelectCategory(apiPrefixEndpoint) { 
        $('#form-select-category').select2({
            ajax: {
                url: `${apiPrefixEndpoint}categories/resource/minimal?from=child`,
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

        /**
         * Template result dropdown option.
         * 
         * @param {object} data
        */
        function formatCategoryDropdown(data) { 
            if (data.loading) return data.text;

            const parent = data.parent;

            return $(`
                <div prevent-close="">
                    <div class="font-bold line-clamp-1" title="${data.category_name}">${data.category_name}</div>
                    <div class="text-xs line-clamp-1">${parent.parent_lvl_1}${parent.parent_lvl_2}</div>
                </div>
            `);
        }

        /**
         * Template result selected option.
         * 
         * @param {object} data
        */
        function formatCategorySelection(data) { 
            return data.category_name ?? data.text;
        }
    }

    function initSelectBrand(apiPrefixEndpoint) {
        $('#form-select-brand').select2({
            ajax: {
                url: `${apiPrefixEndpoint}brands/resource/minimal`,
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
            templateResult: formatBrandDropdown,
            templateSelection: formatBrandSelection,
            width: '100%',
        });

        /**
         * Template result dropdown option.
         * 
         * @param {object} data
        */
        function formatBrandDropdown(data) { 
            if (data.loading) return data.text;

            return $(`
                <div prevent-close="">
                    <div class="font-bold line-clamp-1" title="${data.brand_name}">${data.brand_name}</div>
                    <div class="text-xs line-clamp-1" title="${data.brand_store_name}">Official Store: ${data.brand_store_name}</div>
                </div>
            `);
        }

        /**
         * Template result selected option.
         * 
         * @param {object} data
        */
        function formatBrandSelection(data) { 
            return data.brand_name ?? data.text;
        }
    }

    function initSelectSupplier(apiPrefixEndpoint) {
        const username = "{{ getAuthUsername() }}";

        $('#form-select-supplier').select2({
            ajax: {
                url: `${apiPrefixEndpoint}suppliers/resource/minimal?user=${username}`,
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term,
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    $.map(data.data, function (obj) {
                        obj.text = obj.supplier_name || obj.name;

                        return obj;
                    });

                    params.page = params.page || 1;

                    return {
                        results: data.data,
                        pagination: {
                            more: params.page != data.meta.last_page
                        }
                    };
                },
            },
            width: '100%',
        });
    }

    function initSelectRetailer(apiPrefixEndpoint, username, supplierValue) {
        $('#form-select-retailer').select2({
            ajax: {
                url: `${apiPrefixEndpoint}retailers/resource/minimal?user=${username}&supplier=${supplierValue}`,
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term,
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    $.map(data.data, function (obj) {
                        obj.text = obj.retailer_name || obj.name;

                        return obj;
                    });

                    params.page = params.page || 1;

                    return {
                        results: data.data,
                        pagination: {
                            more: params.page != data.meta.last_page
                        }
                    };
                },
            },
            width: '100%',
        });
    }

    function initSelectDelployStatus() { 
        $('#form-select-product-status').select2({
            minimumResultsForSearch: Infinity,
            width: '100%',
        });
    }

    function initSelectKeyword() { 
        $('#form-select-product-keyword').select2({
            width: '100%',
            tags: true,
            tokenSeparators: [','],
        });

        const keywordValue = window.event.keyword;

        if ($('#form-select-product-keyword').has('option').length > 0) {
            $('#form-select-product-keyword').val(keywordValue).trigger('change');
        }
    }
    
    function initTinyMCE() {
        const element = 'textarea#form-input-product-description';
        const isError = $(element).hasClass('is-invalid');

        tinymce.init({
            selector: element,
            height: '380px',
            menubar: false,
            skin: 'material-classic',
            content_css: 'material-classic',
            icons: 'small',
            plugins: 'table lists link',
            toolbar: 'undo redo | bold italic underline | link | bullist numlist',
            setup: (editor) => {
                editor.on('init', () => {
                    editor.getContainer().style.borderRadius = '6px';
                    editor.getContainer().style.borderColor  = `${isError ? '#dc2626' : ''}`;
                });
                editor.on('focus', () => {
                    editor.getContainer().style.boxShadow    = '0 1px 4px rgba(0, 121, 194, .4)';
                    editor.getContainer().style.borderColor  = '#0079c2';
                    editor.getContainer().style.outlineColor = '#0079c2';
                });
                editor.on('blur', () => {
                    editor.getContainer().style.boxShadow    = '';
                    editor.getContainer().style.borderColor  = '';
                    editor.getContainer().style.outlineColor = '';
                });
            }
        });
    }

    function initEventDetectInputChanges(inputNameValue) {
        // Get all input form include image input inside section "product input" through name attr. Why 
        // using name, because tag input forms are different.
        const inputList = document.querySelectorAll('[data-section="product-input-wrapper"] [name]');

        inputList.forEach(input => {
            switch (input.tagName) {
                case 'SELECT':
                    $(input).on('change', () => setInputObject());
                    
                    break;

                default:
                    $(input).on('input', () => setInputObject());
                    
                    break;
            }
        });
    }

    function setInputObject() {
        const inputList = document.querySelectorAll('[data-section="product-input-wrapper"] [name]');
        const inputNameValue = {};

        inputList.forEach(input => {
            const nameAttr = input.getAttribute('name');
            const value    = input.value;
            
            inputNameValue[nameAttr] = value;
        })

        Livewire.dispatch('updating-tracker', { formUpdate: inputNameValue });
    }
</script>