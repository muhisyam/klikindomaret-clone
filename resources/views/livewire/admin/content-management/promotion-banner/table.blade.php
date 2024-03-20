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
            <th class="py-3 px-4 rounded-tr-md"></th>
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
            <td class="py-2 px-4">
                <div class="relative">
                    {{-- Product Action Button --}}
                    <x-button class="ms-auto overflow-hidden p-1 hover:bg-tertiary hover:text-secondary" data-target-action="{{ $content['banner_slug'] . '-action' }}">
                        <div class="icon-action | h-6 pt-0.5 px-1" data-tooltip-target="action-tooltip-{{ $index }}" data-tooltip-placement="bottom" action-icon-open><i class="ri-more-2-line"></i></div>
                        <div class="icon-close | h-6 pt-0.5 px-1 animation animation-bounceInRight animation-delay-200 hidden" data-tooltip-target="action-close-tooltip-{{ $index }}" data-tooltip-placement="bottom" action-icon-close><i class="ri-close-line"></i></div>
                    </x-button>
                    <div id="action-tooltip-{{ $index }}" role="tooltip" class="absolute z-50 invisible inline-block px-3 py-2 text-xs font-medium text-white whitespace-nowrap transition-opacity duration-300 bg-gray-900 rounded-md shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Action
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                    <div id="action-close-tooltip-{{ $index }}" role="tooltip" class="absolute z-50 invisible inline-block px-3 py-2 text-xs font-medium text-white whitespace-nowrap transition-opacity duration-300 bg-gray-900 rounded-md shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Hide
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>

                    {{-- Product Action Wrapper --}}
                    <div class="absolute top-0 right-10 hidden" data-trigger-action="{{ $content['banner_slug'] . '-action' }}">
                        <div class="w-24 flex justify-end gap-1 overflow-x-clip">
                            <a href="{{ route('products.edit', ['product' => $content['banner_slug']]) }}" class="action-edit | bg-[#f5f5f5] text-[#999] rounded animation animation-bounceInRight animation-delay-100 shadow-sm p-1 px-2 hover:text-[#0079c2]" title="Edit">
                                <div class="icon-edit h-6 pt-0.5"><i class="ri-edit-box-fill"></i></div>
                            </a>
                            <button class="action-del | bg-[#f5f5f5] text-[#999] rounded animation animation-bounceInRight shadow-sm p-1 px-2 hover:text-[#0079c2]" data-content-name="{{ $content['banner_name'] }}" wire:click="dispatchModal({{ json_encode($content) }})" title="Delete">
                                <div class="icon-del h-6 pt-0.5"><i class="ri-delete-bin-6-fill"></i></div>
                            </button>
                        </div>
                    </div>
                    @php /*TODO: Add tooltip*/ @endphp
                </div>
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