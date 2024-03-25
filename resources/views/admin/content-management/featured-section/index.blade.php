<x-admin-layout>
    <x-slot:title>
        List Promosi
    </x-slot:title>

    <x-slot:header>
        @include('admin.content-management.featured-section.header')
    </x-slot:header>

    @include('admin.content-management.featured-section.filter-table')

    <section class="data-table-wrapper border border-[#eee] rounded-xl p-4">
        <livewire:admin.content-management.featured-section.table/>
    </section>
</x-admin-layout>