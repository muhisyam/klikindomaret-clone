<table class="w-full" wire:init="loadContent">
    <thead class="border-b bg-light-gray-50 text-light-gray-400 text-sm text-left uppercase">
        <tr>
            <th class="p-3 rounded-tl-md w-12"><input type="checkbox" class="block m-auto" aria-label="Checkbox select all data"></th>
            <th class="py-3 px-4">
                <div @class([
                    'relative flex cursor-pointer', 
                    'active-asc' => $sortBy === "banner_name" && $orderBy === "asc",
                    'active-desc' => $sortBy === "banner_name" && $orderBy === "desc",
                ]) wire:click="sortBy('banner_name')">
                    <div class="label me-1">Promosi</div>
                    <div class="sortable" data-sort></div>
                </div>
            </th>
            <th class="py-3 px-4 text-end">Kuota</th>
            <th class="py-3 px-4 w-32 text-center">Status</th>
            <th class="py-3 px-4">Tanggal Promo</th>
            <th class="py-3 px-4 w-40">
                <div @class([
                    'relative mx-auto flex cursor-pointer', 
                    'active-asc' => $sortBy === "promo_products_count" && $orderBy === "asc",
                    'active-desc' => $sortBy === "promo_products_count" && $orderBy === "desc",
                ]) wire:click="sortBy('promo_products_count')">
                    <div class="label me-1">Jumlah Produk</div>
                    <div class="sortable" data-sort></div>
                </div>
            </th>
            {{-- page or redirect, hover show the link --}}
            <th class="py-3 px-4">Link</th> 
            <th class="py-3 px-2 rounded-tr-md w-[124px]"></th>
        </tr>
    </thead>
    <tbody class="text-sm">
        @unless (is_null($data))

        @forelse ($data['data'] as $index => $content)
        <tr class="border-b">
            <td class="py-2 px-3">
                <input type="checkbox" class="block m-auto" aria-label="Checkbox select data">
            </td>
            <td class="py-2 px-4">
                <div class="flex gap-2 h-8">
                    <img class="rounded" src="{{ asset('img/uploads/promo-banners/' . $content['banner_image_name']) }}" alt="Promo Banner Image">
                    <div>
                        <div class="font-bold line-clamp-1">{{ $content['banner_name'] }}</div>
                        <div class="text-xs font-light">Kode: {{ $content['promotion_code'] ?? '-' }}</div>
                    </div>
                </div>
            </td>
            <td class="py-2 px-4 text-end">{{ formatNumber($content['promotion_quota']) }}</td>
            <td class="py-2 px-4 text-center">{!! \App\Enums\DeployStatus::getStyle($content['banner_deploy_status']) !!}</td>
            <td class="py-2 px-4">
                <div>Periode: {{ $content['banner_start_date'] }} - {{ $content['banner_end_date'] }}</div>
                <div class="text-xs font-light">Keterangan: {!! $content['banner_event_status'] !!}</div>
            </td>
            <td class="py-2 px-4">
                <div>{{ formatNumber($content['promo_products_count']) }} Produk</div>
                <div class="flex items-center gap-1 text-xs font-light">
                    <span>List Produk:</span>
                    <x-button>
                        <x-icon class="w-4" src="{{ asset('img/icons/icon-auth-visibility-password.webp') }}"/>
                    </x-button>
                </div>
            </td>
            <td class="py-2 px-4">{{ $content['banner_route_name'] }}</td>
            <td class="py-2 px-2 flex justify-end">
                <div class="-me-2.5 rounded-md h-9 w-0 bg-light-gray-50 transition-width duration-700">
                    <div class="flex opacity-0 duration-200" data-trigger-action="{{ $content['banner_slug'] . '-action' }}">
                        <x-button class="h-9 w-9 group hover:bg-light-gray-100">
                            <x-icon class="mx-auto w-3 grayscale group-hover:grayscale-0" src="{{ asset('img/icons/icon-delete.webp') }}"/>
                        </x-button>

                        <x-nav-link href="{{ route('products.edit', ['product' => $content['banner_slug']]) }}" class="rounded-md h-9 w-9 cursor-pointer group hover:bg-light-gray-100">
                            <x-icon class="mx-auto w-3 grayscale group-hover:grayscale-0" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                        </x-nav-link>
                    </div>
                </div>
                <x-button class="justify-center h-9 w-9 group bg-blacks hover:bg-tertiary" data-target-action="{{ $content['banner_slug'] . '-action' }}">
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
        import { toggleActionDataTable, hideOpenedModal, createElement } from "../js/components.js";

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