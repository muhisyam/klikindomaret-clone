<x-admin-layout>
    <x-slot:title>
        List Promosi
    </x-slot:title>

    <x-slot:header>
        @include('admin.content-management.promotion-banner.header')
    </x-slot:header>

    @include('admin.content-management.promotion-banner.filter-table')

    <section class="data-table-wrapper border border-[#eee] rounded-xl p-4">
        <livewire:admin.content-management.promotion-banner.table/>
    </section>
</x-admin-layout>