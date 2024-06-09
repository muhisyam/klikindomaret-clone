<x-admin-layout>
    <x-slot:title>
        Kategori
    </x-slot:title>

    <x-slot:header>
        @include('admin.category.index.header')
    </x-slot:header>
    
    <livewire:admin.category.index.filter-table/>

    <section class="border border-light-gray-100 rounded-xl p-4" data-section="data-table-wrapper">
        <livewire:admin.category.index.table/>
    </section>

</x-admin-layout>

<script type="module">
    import { tableNoContentBtn, initTooltips, toggleActionDataTable, tableHasNewEntries } from "{{ asset('js/' . config('view.js_component')) }}";

    document.addEventListener('livewire:initialized', () => {
        Livewire.on('content-loaded', event => {
            setTimeout(() => {
                tableNoContentBtn();
                initTooltips();
                toggleActionDataTable();
            }, 1);
        });

        Livewire.on('content-stored', event => {
            setTimeout(() => {
                tableHasNewEntries(5);
            }, 1);
        });
    });
</script>