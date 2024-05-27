<x-admin-layout>
    <x-slot:title>
        List Pesanan
    </x-slot:title>

    <x-slot:header>
        @include('admin.order.header')
    </x-slot:header>

    <livewire:admin.order.filter-table/>

    <section class="data-table-wrapper border border-[#eee] rounded-xl p-4">
        <livewire:admin.order.table/>
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