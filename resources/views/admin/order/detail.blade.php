<x-admin-layout>
    <x-slot:title>
        Detail Pesanan
    </x-slot:title>

    <x-slot:header>
        @include('admin.order.header')
    </x-slot:header>

    <livewire:admin.order.detail-section-header/>
    <livewire:admin.order.detail-section-body :orderKey="$orderKey"/>

    @php
        $section       = 'update-retailer-status';
        $showCondition = false;
    @endphp
    
    <x-modal :section="$section">
        <x-slot:trigger class="ml-auto mt-4 py-2 w-full max-w-[20%] justify-center text-sm" buttonStyle="secondary">
            Perbaharui Status
        </x-slot>

        <x-slot:content>
            <livewire:admin.order.modal-update-status :showCondition="$showCondition" :section="$section"/>
        </x-slot>
    </x-modal>
</x-admin-layout>

<script type="module">
    // import { initTooltips, toggleActionDataTable, tableHasNewEntries } from "{{ asset('js/' . config('view.js_component')) }}";

    document.addEventListener('livewire:initialized', () => {
        Livewire.on('content-status-obtained', event => {
            setTimeout(() => {
                // Jquery for convert purpose(✌ ͡• ₃ ͡•)✌
                $('#form-select-retailer-status').select2();
                // Thanks for the tolerance(👍 ͡• ₃ ͡•)👍
            }, 1);
        });
    });
</script>