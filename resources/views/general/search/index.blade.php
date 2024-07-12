<x-general-layout class="mb-6">
    @php $keyParam = Request::get('key') @endphp

    <ol class="mb-6 inline-flex items-center text-sm">
        <li class="text-light-gray-400">
            <x-nav-link class="leading-none cursor-pointer hover:text-secondary" href="{{ route('homepage') }}" value="Beranda"/>
        </li>
        <li class="flex items-center text-light-gray-400">
            <x-icon class="mx-2 h-3 grayscale" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
            <x-nav-link class="leading-none cursor-pointer hover:text-secondary" href="{{ route('home.search', ['key' => $keyParam]) }}" value="Pencarian"/>
        </li>
        <li class="flex items-center">
            <x-icon class="mx-2 h-3 grayscale" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
            <span class="leading-none text-black">{{ $keyParam }}</span>
        </li>
    </ol>

    <div class="flex gap-4">
        <livewire:general.search.section-filter/>
        <livewire:general.search.section-product/>
    </div>
</x-general-layout>

<script type="module">
    import { Accordion } from "{{ asset('js/' . config('view.js_component')) }}";
    
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('content-loaded', event => {
            setTimeout(() => {
                hideLoader();
                initSelect2();
            }, 1);
        });

        Livewire.on('load-content', event => {
            setTimeout(() => {
                showLoader();
            }, 1);
        });
    });

    function showLoader() {
        document.querySelector('#page-loader').classList.remove('hidden');
    }

    function hideLoader() {
        document.querySelector('#page-loader').classList.add('hidden');
    }

    function initSelect2() {
        $('#product-sort-dir').select2({
            minimumResultsForSearch: Infinity,
            width: '100%',
        });
        
        $('#product-per-page').select2({
            minimumResultsForSearch: Infinity,
            width: '100%',
        });

        $('#product-sort-dir').on('change', function(e) {
            Livewire.dispatch('set-product-sort-by', { 
                sortValue: $(this).val() 
            });
        });

        $('#product-per-page').on('change', function(e) {
            Livewire.dispatch('set-product-per-page', { 
                perPage: $(this).val() 
            });
        });
    }

    function initFilterAccordion() { 
        const listButtonAccord = document.querySelectorAll('[data-accordion-target]');

        listButtonAccord.forEach(button => {
            button.addEventListener('click', () => {
                const triggerEl    = button;
                const dataTarget   = triggerEl.getAttribute('data-accordion-target');
                const targetEl     = document.querySelector(`[data-accordion-trigger=${dataTarget}]`);
                const isTargetHide = targetEl.classList.contains('hide');
                const accordion    = new Accordion();
                const options      = {
                    isHide         : isTargetHide,
                    targetEl       : targetEl,
                    wrapperEl      : triggerEl,
                    additionalClass: 'open',
                }

                accordion.toogleAccordion(options);
            })
        })
    }

    initFilterAccordion();

</script>