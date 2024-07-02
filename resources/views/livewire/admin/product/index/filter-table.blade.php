<section class="mb-4 py-2 px-4 rounded-xl border border-[#eee] text-sm" data-section="data-filter-wrapper">
    <div class="space-x-1 divide-x divide-light-gray-100 h-10 flex items-center gap-4">
    
    @unless (empty($response))

        <ul class="h-full flex flex-1 gap-2 overflow-x-scroll" data-element="list-tabs" wire:loading.class="hidden">
            <li>
                <x-button @class([
                        'rounded py-2 px-4 hover:bg-light-gray-50', 
                        'active' => $activeFilter == '',
                    ])
                    value="Semua"
                    wire:click="filter()"
                />
            </li>

        @foreach ($response['filter'] as $filter)

            @php
                $query  = array_keys($filter)[1];
                $params = '"' . $filter['label'] . '","' . $filter['search'] . '","' . $query . '","' . $filter[$query] . '"'; 
            @endphp
            
            <li>
                <x-button @class([
                        'rounded py-2 px-4 hover:bg-light-gray-50', 
                        'active' => $activeFilter == $filter['label'],
                    ])
                    value="{{ $filter['label'] }}"
                    wire:click="filter({{ $params }})"
                />
            </li>
            
        @endforeach

        </ul>

    @endunless

        <x-skeletons.table-filter @class(['hidden' => ! empty($response)])
                                amount="3"
                                wire:loading.class.remove="hidden"
                                data-element="skeleton"/>

        <div class="ps-4 h-full flex items-center gap-2">
            <div>Tampilkan per Halaman</div>
            <div class="rounded p-2 w-14 hover:bg-light-gray-50">
                <select class="w-full bg-transparent" name="perPage" wire:model.change="perPage">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>
        </div>

        @php $usePaginationArrow = false @endphp

        <div @class([
                "ps-4 h-full flex items-center",
                "w-[380px]" => $usePaginationArrow,
                "w-[300px]" => ! $usePaginationArrow,
            ])>

        @unless (empty($response))

            <p wire:loading.class="hidden">Menampilkan <span>{{ $response['meta']['from'] }} - {{ $response['meta']['to'] }}</span> dari <span>{{ $response['meta']['total'] }}</span> Hasil</p>
            
        @endunless

            <x-skeletons.table-filter @class(['hidden' => ! empty($response)])
                                    amount="1"
                                    width="100%"
                                    wire:loading.class.remove="hidden"
                                    data-element="skeleton"/>

        </div>
    </div>

    <hr class="my-2 bg-light-gray-100">

    <div class="space-x-1 divide-x divide-light-gray-100 h-10 flex items-center gap-4">
        <div class="rounded py-2 px-4 h-full flex flex-1 items-center gap-4">
            <x-input-label for="model-search" class="!mb-0">
                <x-icon class="h-4" src="{{ asset('img/icons/icon-header-search.webp') }}"/>
            </x-input-label>
            <input id="model-search" 
                   type="text" 
                   name="search" 
                   placeholder="Cari Produk..." 
                   class="w-full bg-transparent"
                   wire:model.live.debounce.500ms="search">
        </div>

        <ul class="ps-4 h-full flex gap-2">
            <li>
                <x-button class="px-4 h-10 gap-1.5 hover:bg-light-gray-50">
                    <x-icon class="h-4" src="{{ asset('img/icons/icon-filter-export.webp') }}"/>
                    <div class="leading-none">Export</div>
                </x-button>
            </li>
            <li>
                <x-button class="px-4 h-10 gap-1.5 hover:bg-light-gray-50">
                    <x-icon class="h-4" src="{{ asset('img/icons/icon-filter-filter.webp') }}"/>
                    <div class="leading-none">Filter</div>
                </x-button>
            </li>
        </ul>

        <div class="ps-4 h-full">

        @unless (empty($response))

            @php $resetFilter = $isActiveFilter ? 'wire:click="resetFilter()"' : '' @endphp

            <button @class([
                    'rounded-md px-4 h-10 flex items-center gap-1.5 hover:opacity-90', 
                    "bg-secondary text-white" => $isActiveFilter,
                    "hover:bg-light-gray-50"  => ! $isActiveFilter,
                ])
                {!! $resetFilter !!}
                wire:loading.class="!hidden">
                <x-icon @class([
                            "h-4",
                            "filter-white" => $isActiveFilter,
                        ])
                        src="{{ asset('img/icons/icon-filter-reset.webp') }}"/>
                <div class="leading-none">Reset</div>
            </button>

        @endunless

            <x-skeletons.table-filter @class(['py-0.5', 'hidden' => ! empty($response)])
                                        amount="1"
                                        width="24"
                                        wire:loading.class.remove="hidden"
                                        data-element="skeleton"/>
        </div>

        <div @class([
                "ps-4 h-full flex items-center",
                "w-[380px]" => $usePaginationArrow,
                "w-[300px]" => ! $usePaginationArrow,
            ])>

        @unless (empty($response))

            <ul class="flex justify-center" data-element="link-page" wire:loading.class="hidden">

            @foreach ($response['meta']['links'] as $link)

                @if ($loop->first)
                    {{-- Remove this if want to use arrow nav --}}
                    @continue
                    
                    <li>
                        <x-button @class([
                                    "h-10 w-10 justify-center",
                                    "cursor-default"         => is_null($link['url']),
                                    "hover:bg-light-gray-50" => $link['url'],
                                ]) 
                                wire:click="toPage('{{ $link['page'] }}')">
                            <x-icon class="h-3 grayscale" src="{{ asset('img/icons/icon-header-chevron-left.webp') }}"/>
                        </x-button>
                    </li>

                @elseif ($link['label'] == 'separator')

                    <li>
                        <x-button class="h-10 w-10 justify-center cursor-default" value="..."/>
                    </li>

                @elseif (! $loop->last)
                
                    <li>
                        <x-button @class([
                                    "h-10 w-10 justify-center hover:bg-light-gray-50",
                                    "active" => $link['active'],
                                ]) 
                                wire:click="toPage('{{ $link['page'] }}')"
                                value="{{ $link['label'] }}"/>
                    </li>

                @endif

            @endforeach

            </ul>

        @endunless
        
            <x-skeletons.table-filter @class(['hidden' => ! empty($response)])
                                    amount="1"
                                    width="[100%]"
                                    wire:loading.class.remove="hidden"
                                    data-element="skeleton"/>

        </div>
    </div>
</section>