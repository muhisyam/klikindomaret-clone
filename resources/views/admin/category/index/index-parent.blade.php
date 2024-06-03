<x-admin-layout>
    <x-slot:title>
        Kategori
    </x-slot:title>

    <x-slot:header>
        @include('admin.category.index.header')
    </x-slot:header>
    
    <livewire:admin.category.index.filter-table/>

    <section class="border border-[#eee] rounded-xl p-4" data-section="data-table-wrapper">
        <livewire:admin.category.index.table/>
    </section>

</x-admin-layout>

<script type="module">
    import { initTooltips, toggleActionDataTable, tableHasNewEntries } from "{{ asset('js/' . config('view.js_component')) }}";

    document.addEventListener('livewire:initialized', () => {
        Livewire.on('content-loaded', event => {
            setTimeout(() => {
                initTooltips();
                toggleActionDataTable();
            }, 1);
        });

        Livewire.on('load-new-entries', event => {
            setTimeout(() => {
                tableHasNewEntries();
            }, 1);
        });
    });
</script>