<x-admin-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <x-slot:header>
        @include('admin.product.index.header')
    </x-slot:header>
    
    <livewire:admin.product.index.filter-table/>

    <section class="border border-light-gray-100 rounded-xl p-4" data-section="data-table-wrapper">
        <livewire:admin.product.index.table/>
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
                callNotification(event.notif);
                tableHasNewEntries(9);
            }, 1);
        });

        Livewire.on('content-deleted', event => {
            setTimeout(() => {
                callNotification(event.notif);
                Livewire.dispatch('load-content');
            }, 1);
        });
    });

    function callNotification(data) {
        new FloatNotification(data.title, data.message);
    }
</script>