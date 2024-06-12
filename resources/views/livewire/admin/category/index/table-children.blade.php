<table class="min-w-full w-max" wire:init="loadContent">
    <thead class="border-b bg-light-gray-50 text-light-gray-300 text-sm text-left uppercase rounded-t">
        <tr>
            <th class="py-3 px-4 rounded-tl-md w-[50px]"></th>
            <th class="py-3 px-4">
                <div @class([
                        'relative flex cursor-pointer', 
                        'active-asc'  => $sortBy === "category_name" && $sortDir === "asc",
                        'active-desc' => $sortBy === "category_name" && $sortDir === "desc",
                    ]) 
                    wire:click="sortByFilter('category_name')">
                    <div class="me-1">Nama Kategori</div>
                    <div class="sortable" data-sort></div>
                </div>
            </th>
            <th class="py-3 px-4 w-20 text-center">Status</th>
            <th class="py-3 px-4 w-48">
                <div @class([
                        'relative flex cursor-pointer', 
                        'active-asc'  => $sortBy === "children_count" && $sortDir === "asc",
                        'active-desc' => $sortBy === "children_count" && $sortDir === "desc",
                    ]) 
                    wire:click="sortByFilter('children_count')">
                    <div class="me-1">Jumlah Subkategori</div>
                    <div class="sortable" data-sort></div>
                </div>
            </th>
            <th class="py-3 px-4 w-40 text-center">Jumlah Produk</th>
            <th class="py-3 px-4 rounded-tr-md w-36"></th>
        </tr>
    </thead>
    <tbody class="text-sm">

    @unless (is_null($categories))

    @forelse ($categories['data'] as $index => $categoryLvl2)
    
        <tr class="border-b" data-row="index-category-lvl-2" wire:loading.class="hidden">
            <td class="py-2 text-center">
                <button class="mx-auto p-1 rounded-full border border-light-gray-200 bg-light-gray-100" 
                        data-accordion-target="{{ $categoryLvl2['category_slug'] }}">
                        <x-icon class="h-3 duration-500" src="{{ asset('img/icons/icon-header-chevron-down.webp') }}"/>
                </button>
            </td>
            <td class="py-2 px-4">{{ $categoryLvl2['category_name'] }}</td>
            <td class="py-2 px-4">{!! \App\Enums\DeployStatus::getStyle($categoryLvl2['category_deploy_status']) !!}</td>
            <td class="py-2 px-4 text-end">{{ $categoryLvl2['category_children_count'] }}</td>
            <td class="py-2 px-4 text-end">-</td>
            <td class="py-2 px-4 flex justify-end">
                <div class="-me-2.5 rounded-md h-9 w-0 bg-light-gray-50 transition-width duration-700">
                    <div class="flex opacity-0 duration-200" data-trigger-action="{{ $categoryLvl2['category_slug'] }}-action">
                        <x-button class="h-9 w-9 group hover:bg-light-gray-100" 
                                data-tooltip-target="{{ $categoryLvl2['category_slug'] }}-action-delete-{{ $index }}"
                                wire:click="delete(
                                    'category',
                                    '{{ $categoryLvl2['category_name'] }}', 
                                    '{{ $categoryLvl2['category_slug'] }}', 
                                )">
                            <x-icon class="mx-auto w-3 grayscale group-hover:grayscale-0" src="{{ asset('img/icons/icon-delete.webp') }}"/>
                        </x-button>
                        
                        <x-tooltip data-tooltip-trigger="{{ $categoryLvl2['category_slug'] }}-action-delete-{{ $index }}" 
                                data-tooltip-offset-x="-267" 
                                value="Hapus {{ $categoryLvl2['category_name'] }}"/>

                        <x-nav-link href="{{ route('categories.edit', ['category' => $categoryLvl2['category_slug']]) }}" 
                                    class="rounded-md h-9 w-9 cursor-pointer group hover:bg-light-gray-100" 
                                    data-tooltip-target="{{ $categoryLvl2['category_slug'] }}-action-edit-{{ $index }}">
                            <x-icon class="mx-auto w-3 grayscale group-hover:grayscale-0" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                        </x-nav-link>
                        
                        <x-tooltip data-tooltip-trigger="{{ $categoryLvl2['category_slug'] }}-action-edit-{{ $index }}" 
                                data-tooltip-offset-x="-266" 
                                value="Edit {{ $categoryLvl2['category_name'] }}"/>
                    </div>
                </div>
                <x-button class="z-10 justify-center h-9 w-9 group hover:bg-tertiary" data-target-action="{{ $categoryLvl2['category_slug'] }}-action">
                    <x-icon class="w-3 rotate-90 grayscale group-hover:grayscale-0" src="{{ asset('img/icons/icon-dots-vertical.webp') }}" action-icon-open />
                    <x-icon class="w-2.5 hidden" src="{{ asset('img/icons/icon-header-close.webp') }}" action-icon-close />
                </x-button>
            </td>
        </tr>
        <tr wire:loading.class="hidden">
            <td colspan="6">
                <div class="accordion !w-full duration-500 ease-out hide"
                    data-row="index-category-lvl-3"
                    data-accordion-trigger="{{ $categoryLvl2['category_slug'] }}" wire:ignore>
                    <table class="w-full min-h-0">
                        <thead class="bg-[#fbfbfb]">
                            <th class="px-4 w-[50px]"></th>
                            <th class="px-4"></th>
                            <th class="px-4 w-20"></th>
                            <th class="px-4 w-48"></th>
                            <th class="px-4 w-40"></th>
                            <th class="px-4 w-36"></th>
                        </thead>
                        <tbody class="bg-[#fbfbfb]">

                            @foreach ($categoryLvl2['category_children'] as $index => $categoryLvl3)

                            <tr class="border-b">
                                <td class="py-2 w-[50px]">
                                    <x-icon class="mx-auto h-1.5" src="{{ asset('img/icons/icon-dot-circle.webp') }}"/>
                                </td>
                                <td class="py-2 px-4">{{ $categoryLvl3['category_name'] }}</td>
                                <td class="py-2 px-4">{!! \App\Enums\DeployStatus::getStyle($categoryLvl3['category_deploy_status']) !!}</td>
                                <td class="py-2 px-4 text-end">-</td>
                                <td class="py-2 px-4 text-end">{{ $categoryLvl3['category_products_count'] }}</td>
                                <td class="py-2 px-4 flex justify-end">
                                    <div class="-me-2.5 rounded-md h-9 w-0 bg-light-gray-50 transition-width duration-700">
                                        <div class="flex opacity-0 duration-200" data-trigger-action="{{ $categoryLvl3['category_slug'] }}-action">
                                            <x-button class="h-9 w-9 group hover:bg-light-gray-100" 
                                                    data-tooltip-target="{{ $categoryLvl3['category_slug'] }}-action-delete-{{ $index }}"
                                                    wire:click="delete(
                                                        'category',
                                                        '{{ $categoryLvl3['category_name'] }}', 
                                                        '{{ $categoryLvl3['category_slug'] }}', 
                                                    )">
                                                <x-icon class="mx-auto w-3 grayscale group-hover:grayscale-0" src="{{ asset('img/icons/icon-delete.webp') }}"/>
                                            </x-button>
                                            
                                            <x-tooltip data-tooltip-trigger="{{ $categoryLvl3['category_slug'] }}-action-delete-{{ $index }}" 
                                                    data-tooltip-offset-x="-267" 
                                                    value="Hapus {{ $categoryLvl3['category_name'] }}"/>

                                            <x-nav-link href="{{ route('categories.edit', ['category' => $categoryLvl3['category_slug']]) }}" 
                                                        class="rounded-md h-9 w-9 cursor-pointer group hover:bg-light-gray-100" 
                                                        data-tooltip-target="{{ $categoryLvl3['category_slug'] }}-action-edit-{{ $index }}">
                                                <x-icon class="mx-auto w-3 grayscale group-hover:grayscale-0" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                                            </x-nav-link>
                                            
                                            <x-tooltip data-tooltip-trigger="{{ $categoryLvl3['category_slug'] }}-action-edit-{{ $index }}" 
                                                    data-tooltip-offset-x="-266" 
                                                    value="Edit {{ $categoryLvl3['category_name'] }}"/>
                                        </div>
                                    </div>
                                    <x-button class="z-10 justify-center h-9 w-9 group hover:bg-tertiary" data-target-action="{{ $categoryLvl3['category_slug'] }}-action">
                                        <x-icon class="w-3 rotate-90 grayscale group-hover:grayscale-0" src="{{ asset('img/icons/icon-dots-vertical.webp') }}" action-icon-open />
                                        <x-icon class="w-2.5 hidden" src="{{ asset('img/icons/icon-header-close.webp') }}" action-icon-close />
                                    </x-button>
                                </td>
                            </tr>

                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    
    @empty

        <tr>
            <td class="rounded-b-md py-2 px-3 bg-light-gray-50" colspan="6">
                <x-button class="mx-auto text-secondary hover:underline" value="Tambah Kategori Baru" data-no-content=""/>
            </td>
        </tr>

    @endforelse

    @endunless
    
    <x-skeletons.table-body @class(['hidden' => ! is_null($categories)]) 
                            data-component="table-skeleton" 
                            rows="10" 
                            cols="6"
                            wire:loading.class.remove="hidden"/>

    </tbody>
</table>