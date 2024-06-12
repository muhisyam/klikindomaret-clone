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
            <th class="py-3 px-4 w-52">
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
            <th class="py-3 px-4 rounded-tr-md w-36"></th>
        </tr>
    </thead>
    <tbody class="text-sm">

    @unless (is_null($categories))

    @forelse ($categories['data'] as $key => $category)
    
        <tr class="border-b" wire:loading.class="hidden">
            <td class="py-2">
                <a href="{{ route('categories.sub-index', ['category' => $category['category_slug'] ]) }}" 
                   class="mx-auto rounded-full border border-light-gray-200 h-5 w-5 grid place-items-center bg-light-gray-100" 
                   aria-label="List subcategories">
                    <x-icon class="w-3" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                </a>
            </td>
            <td class="py-2 px-4">{{ $category['category_name'] }}</td>
            <td class="py-2 px-4">{!! \App\Enums\DeployStatus::getStyle($category['category_deploy_status']) !!}</td>
            <td class="py-2 px-4 text-end">{{ $category['category_children_count'] }}</td>
            <td class="py-2 px-4 flex justify-end">
                <div class="-me-2.5 rounded-md h-9 w-0 bg-light-gray-50 transition-width duration-700">
                    <div class="flex opacity-0 duration-200" data-trigger-action="{{ $category['category_slug'] }}-action">
                        <x-button class="h-9 w-9 group hover:bg-light-gray-100" 
                                data-tooltip-target="action-delete-{{ $key }}"
                                wire:click="delete(
                                    'category',
                                    '{{ $category['category_name'] }}', 
                                    '{{ $category['category_slug'] }}', 
                                )">
                            <x-icon class="mx-auto w-3 grayscale group-hover:grayscale-0" src="{{ asset('img/icons/icon-delete.webp') }}"/>
                        </x-button>
                        
                        <x-tooltip data-tooltip-trigger="action-delete-{{ $key }}" 
                                data-tooltip-offset-x="-267" 
                                value="Hapus {{ $category['category_name'] }}"/>

                        <x-nav-link href="{{ route('categories.edit', ['category' => $category['category_slug']]) }}" 
                                    class="rounded-md h-9 w-9 cursor-pointer group hover:bg-light-gray-100" 
                                    data-tooltip-target="action-edit-{{ $key }}">
                            <x-icon class="mx-auto w-3 grayscale group-hover:grayscale-0" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                        </x-nav-link>
                        
                        <x-tooltip data-tooltip-trigger="action-edit-{{ $key }}" 
                                data-tooltip-offset-x="-266" 
                                value="Edit {{ $category['category_name'] }}"/>
                    </div>
                </div>
                <x-button class="z-10 justify-center h-9 w-9 group hover:bg-tertiary" data-target-action="{{ $category['category_slug'] }}-action">
                    <x-icon class="w-3 rotate-90 grayscale group-hover:grayscale-0" src="{{ asset('img/icons/icon-dots-vertical.webp') }}" action-icon-open />
                    <x-icon class="w-2.5 hidden" src="{{ asset('img/icons/icon-header-close.webp') }}" action-icon-close />
                </x-button>
            </td>
        </tr>
    
    @empty

        <tr>
            <td class="rounded-b-md py-2 px-3 bg-light-gray-50" colspan="5">
                <x-button class="mx-auto text-secondary hover:underline" value="Tambah Kategori Baru" data-no-content=""/>
            </td>
        </tr>

    @endforelse

    @endunless

    <x-skeletons.table-body @class(['hidden' => ! is_null($categories)]) 
                            data-component="table-skeleton" 
                            rows="10" 
                            cols="5"
                            wire:loading.class.remove="hidden"/>

    </tbody>
</table>