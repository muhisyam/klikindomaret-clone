<x-admin-layout>
    <x-slot:title>
        Kategori
    </x-slot:title>

    <x-slot:header>
        @include('admin.category.index.header')
    </x-slot:header>
    
    <livewire:admin.category.index.filter-table-children :parentSlug="$parentSlug"/>

    <section class="rounded-xl border border-light-gray-100 p-4" data-section="data-table-wrapper">
        <livewire:admin.category.index.table-children :parentSlug="$parentSlug"/>
    </section>

</x-admin-layout>

<script type="module">
    import { tableNoContentBtn, initTooltips, toggleActionDataTable, tableHasNewEntries } from "{{ asset('js/' . config('view.js_component')) }}";

    document.addEventListener('livewire:initialized', () => {
        Livewire.on('content-loaded', event => {
            setTimeout(() => {
                tableNoContentBtn();
                toggleCategoryRow();
                toggleActionDataTable();
                initTooltips();
            }, 1);
        });

        Livewire.on('content-stored', event => {
            setTimeout(() => {
                toggleCategoryRow();
                callNotification(event.notif);
                tableHasNewEntries(6);
            }, 1);
        });

        Livewire.on('content-deleted', event => {
            setTimeout(() => {
                toggleCategoryRow();
                callNotification(event.notif);
                Livewire.dispatch('load-content');
            }, 1);
        });
    });

    function toggleCategoryRow() {
        const listCategoryLvl2 = document.querySelectorAll('[data-row="index-category-lvl-2"]');

        listCategoryLvl2.forEach(categoryLvl2 => {
            const buttonAccordionCategory = categoryLvl2.querySelector('[data-accordion-target]');

            buttonAccordionCategory.removeEventListener('click', (e) => accordionHandler(e, categoryLvl2));
            buttonAccordionCategory.addEventListener('click', (e) => accordionHandler(e, categoryLvl2));
        });
    }

    function accordionHandler(event, wrapperEl) {
        const triggerEl    = event.currentTarget;
        const dataTarget   = triggerEl.getAttribute('data-accordion-target');
        const targetEl     = document.querySelector(`[data-accordion-trigger=${dataTarget}]`);
        const isTargetHide = targetEl.classList.contains('hide');
        const accordion    = new Accordion();
        const options      = {
            isHide         : isTargetHide,
            targetEl       : targetEl,
            wrapperEl      : wrapperEl,
            additionalClass: 'open',
        }

        accordion.toogleAccordion(options);
    }

    function callNotification(data) {
        new FloatNotification(data.title, data.message);
    }
</script>