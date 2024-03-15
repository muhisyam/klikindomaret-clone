<table class="w-full">
    <thead class="border-b bg-light-gray-50 text-light-gray-400 text-sm text-left uppercase">
        <tr>
            <th class="p-3 rounded-tl-md w-12"><input type="checkbox" class="block m-auto" aria-label="Checkbox select all data"></th>
            <th class="py-3 px-4">
                <div @class([
                    'relative flex cursor-pointer', 
                    'active-asc' => $sortBy === "featured_name" && $orderBy === "asc",
                    'active-desc' => $sortBy === "featured_name" && $orderBy === "desc",
                ]) wire:click="sortBy('featured_name')">
                    <div class="label me-1">Promosi</div>
                    <div class="sortable" data-sort></div>
                </div>
            </th>
            <th class="py-3 px-4">Kuota</th>
            <th class="py-3 px-4">Status</th>
            <th class="py-3 px-4">Tenggat Waktu</th>
            <th class="py-3 px-4">
                <div @class([
                    'relative flex cursor-pointer', 
                    'active-asc' => $sortBy === "product_count" && $orderBy === "asc",
                    'active-desc' => $sortBy === "product_count" && $orderBy === "desc",
                ]) wire:click="sortBy('product_count')">
                    {{-- with button show --}}
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
        @forelse ($data['data'] as $index => $content)
        <tr class="border-b">
            <td class="py-2 px-3">
                <input type="checkbox" class="block m-auto" aria-label="Checkbox select data">
            </td>
            <td class="py-2 px-4">{{ $content['featured_name'] }}</td>
            <td class="py-2 px-4">{{ $content['featured_products_count'] }}</td>
            <td class="py-2 px-4">
                <x-button class="mx-auto py-1.5 px-2" buttonStyle="secondary">
                    <x-icon class="w-4 contrast-[6]" src="{{ asset('img/icons/icon-auth-visibility-password.webp') }}"/>
                </x-button>
            </td>
            <td class="py-2 px-4">
                <div class="relative">
                    {{-- Product Action Button --}}
                    <x-button class="ms-auto overflow-hidden p-1 hover:bg-tertiary hover:text-secondary" data-target-action="{{ $content['featured_slug'] . '-action' }}">
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
                    <div class="absolute top-0 right-10 hidden" data-trigger-action="{{ $content['featured_slug'] . '-action' }}">
                        <div class="w-24 flex justify-end gap-1 overflow-x-clip">
                            <a href="{{ route('products.edit', ['product' => $content['featured_slug']]) }}" class="action-edit | bg-[#f5f5f5] text-[#999] rounded animation animation-bounceInRight animation-delay-100 shadow-sm p-1 px-2 hover:text-[#0079c2]" title="Edit">
                                <div class="icon-edit h-6 pt-0.5"><i class="ri-edit-box-fill"></i></div>
                            </a>
                            <button class="action-del | bg-[#f5f5f5] text-[#999] rounded animation animation-bounceInRight shadow-sm p-1 px-2 hover:text-[#0079c2]" data-content-name="{{ $content['featured_name'] }}" wire:click="dispatchModal({{ json_encode($content) }})" title="Delete">
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
                <x-nav-link type="button" role="button" class="justify-center text-secondary hover:underline" data-no-content value="Tambah Konten Baru" prevent-close=""/>
            </td>
        </tr>
        @endforelse
    </tbody>    
</table>

@push('scripts')
    <script type="module">
        import { toggleActionDataTable, hideOpenedComponentsFromOutside } from "../js/components.js";

        function noContentBtn() {
            const btnNoContent = document.querySelector('[data-no-content]');
            if (! btnNoContent) return;

            btnNoContent.addEventListener('click', () => document.querySelector('button[data-target-modal]').click())
        }
        noContentBtn(); //remove

        document.addEventListener('livewire:initialized', () => {
            @this.on('contents-loaded', event => {
                setTimeout(() => {
                    noContentBtn();
                    toggleActionDataTable();
                }, 1);
            });
        });

    </script>
@endpush