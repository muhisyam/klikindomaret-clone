<table class="w-full" wire:init="loadContent">
    <thead class="border-b bg-light-gray-50 text-light-gray-400 text-sm text-left uppercase rounded-t">
        <tr>
            <th class="p-3 rounded-tl w-12"><input type="checkbox" class="block m-auto" aria-label="Checkbox select all data"></th>
            <th class="py-3 px-4">
                <div @class([
                    'relative flex cursor-pointer', 
                    'active-asc' => $sortBy === "featured_name" && $orderBy === "asc",
                    'active-desc' => $sortBy === "featured_name" && $orderBy === "desc",
                ]) wire:click="sortBy('featured_name')">
                    <div class="label me-1">Konten</div>
                    <div class="sortable" data-sort></div>
                </div>
            </th>
            <th class="py-3 px-4">
                <div @class([
                    'relative flex cursor-pointer', 
                    'active-asc' => $sortBy === "product_count" && $orderBy === "asc",
                    'active-desc' => $sortBy === "product_count" && $orderBy === "desc",
                ]) wire:click="sortBy('product_count')">
                    <div class="label me-1">Jumlah Konten</div>
                    <div class="sortable" data-sort></div>
                </div>
            </th>
            <th class="py-3 px-4">Redirect Url</th>
            <th class="py-3 px-4 rounded-tr w-36"></th>
        </tr>
    </thead>
    <tbody class="text-sm">
        @unless (is_null($data))

        @forelse ($data['data'] as $index => $content)
        <tr class="border-b">
            <td class="py-2 px-3">
                <input type="checkbox" class="block m-auto" aria-label="Checkbox select data">
            </td>
            <td class="py-2 px-4">{{ $content['featured_name'] }}</td>
            <td class="py-2 px-4">
                <div>{{ formatNumber($content['featured_total_content']) }} Produk</div>
                <div class="flex items-center gap-1 text-xs font-light">
                    <span>List Konten:</span>
                    <x-button>
                        <x-icon class="w-4" src="{{ asset('img/icons/icon-auth-visibility-password.webp') }}"/>
                    </x-button>
                </div>
            </td>
            <td class="py-2 px-4">{{ $content['featured_redirect_url'] }}</td>
            <td class="py-2 px-4 flex justify-end">
                <div class="-me-2.5 rounded-md h-9 w-0 bg-light-gray-50 transition-width duration-700">
                    <div class="flex opacity-0 duration-200" data-trigger-action="{{ $content['featured_slug'] . '-action' }}">
                        <x-button class="h-9 w-9 group hover:bg-light-gray-100" data-tooltip-target="action-delete-{{ $index }}">
                            <x-icon class="mx-auto w-3 grayscale group-hover:grayscale-0" src="{{ asset('img/icons/icon-delete.webp') }}"/>
                        </x-button>
                        <x-tooltip data-tooltip-trigger="action-delete-{{ $index }}" data-tooltip-offset-x="-64" value="Hapus {{ $content['featured_name'] }}" />

                        <x-nav-link href="{{ route('featureds.edit', ['featured' => $content['featured_slug']]) }}" class="rounded-md h-9 w-9 cursor-pointer group hover:bg-light-gray-100" data-tooltip-target="action-edit-{{ $index }}">
                            <x-icon class="mx-auto w-3 grayscale group-hover:grayscale-0" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                        </x-nav-link>
                        <x-tooltip data-tooltip-trigger="action-edit-{{ $index }}" data-tooltip-offset-x="-29" value="Edit" />
                    </div>
                </div>
                <x-button class="justify-center h-9 w-9 group bg-blacks hover:bg-tertiary" data-target-action="{{ $content['featured_slug'] . '-action' }}">
                    <x-icon class="w-3 rotate-90 grayscale group-hover:grayscale-0" src="{{ asset('img/icons/icon-dots-vertical.webp') }}" action-icon-open />
                    <x-icon class="w-2.5 hidden" src="{{ asset('img/icons/icon-header-close.webp') }}" action-icon-close />
                </x-button>
            </td>
        </tr>
        @empty
        <tr>
            <td class="rounded-b-md py-2 px-3 bg-light-gray-50" colspan="8">
                <x-button class="mx-auto text-secondary hover:underline" value="Tambah Konten Baru" data-no-content=""/>
            </td>
        </tr>
        @endforelse
        
        @else
        <tr>
            <td class="rounded-b-md py-2 px-3 bg-light-gray-50" colspan="8">
                Loading...
            </td>
        </tr>
        @endunless
    </tbody>    
</table>

@push('scripts')
    <script type="module">
        import { toggleActionDataTable, hideOpenedModal, createElement, initTooltips } from "../js/components.js";

        function noContentBtn() {
            const btnNoContent = document.querySelector('[data-no-content]');
            if (! btnNoContent) return;

            btnNoContent.addEventListener('click', () => document.querySelector('button[data-target-modal]').click())
        }

        function hasNewEntries() { 
            const tableData = document.querySelector('tbody');
            const btnLoadNewEntries = 
                `<td class="border-b py-2 px-3 bg-light-gray-50" colspan="8">
                    <div wire:loading>Loading</div>
                    <x-button class="mx-auto text-secondary hover:underline" value="Muat Konten Baru" wire:click="loadContent" wire:loading.remove/>
                </td>`;

            const elLoadNewEntries = createElement({
                parentTag: 'tr', 
                innerBody: btnLoadNewEntries
            });
            
            tableData.insertBefore(elLoadNewEntries, tableData.firstElementChild);
        }

        document.addEventListener('livewire:initialized', () => {
            @this.on('content-loaded', event => {
                setTimeout(() => {
                    noContentBtn();
                    initTooltips();
                    toggleActionDataTable();
                }, 1);
            });

            @this.on('load-new-entries', event => {
                setTimeout(() => {
                    hasNewEntries();
                }, 1);
            });
        });

    </script>
@endpush