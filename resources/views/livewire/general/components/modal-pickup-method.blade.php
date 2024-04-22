<div class="modal w-[900px] rounded-xl bg-white" data-trigger-modal="{{ $section }}" wire:init="loadContent">
    <section class="border-b border-light-gray-100 p-3 flex items-center justify-center">
        <x-button class="absolute top-0 right-0 h-12 w-12" data-target-modal="{{ $section }}" :preventClose="false">
            <x-icon class="m-auto w-3" src="{{ asset('img/icons/icon-header-close.webp') }}"/>
        </x-button>

        <h3 class="font-bold">Metode pengambilan terakhir yang dipakai</h3>
    </section>

    <ul class="p-4 grid grid-cols-4 gap-4">
        
    @foreach ($methods as $method)

        <li>
            @php
                $selectedBorderStyle = $method['is_selected_method'] ? 'border-secondary shadow-input overflow-hidden' : 'border-light-gray-100';
            @endphp

            <x-button @class([
                'relative space-y-2 border p-2 flex-col !items-baseline text-sm overflow-hidden',
                'border-secondary shadow-input' => $method['is_selected_method'],
                'border-light-gray-100'         => ! $method['is_selected_method'],
            ])>
                @if ($method['is_selected_method'])
                    <div class="absolute top-0 right-0 py-1 ps-4 pe-2 rounded-bl-full bg-secondary text-xs text-white">Aktif</div> 
                @endif
        
                    <div @class([
                        'border-b border-light-gray-100 pb-2 flex items-center gap-1 w-full', 
                        '!mt-0' => $method['is_selected_method'],
                    ])>
                        <x-icon class="h-4 w-4" src="{{ asset('img/icons/icon-bookmark.webp') }}"/>
                        <h4 class="line-clamp-1">{{ $method['place_detail']['place_name'] }}</h4>
                    </div>
        
                    <div class="min-h-[40px]">
                        <div class="font-bold line-clamp-1">{{ $method['place_detail']['reciever_name'] }}</div>
        
                    @unless (is_null($method['place_detail']['reciever_phone_number'])) 
                        <div class="font-light">{{ $method['place_detail']['reciever_phone_number'] }}</div> 
                    @endunless
                        
                    </div>
                    
                    <address class="min-h-[80px] text-xs text-left line-clamp-5">{{ $method['place_detail']['place_address'] }}</address>
            </x-button>
        </li>

    @endforeach

    </ul>

    <div class="text-sm text-center my-2">atau pilih metode lainnya:</div>

    <section class="flex justify-center gap-4 py-4" data-section="select-another-method">
        <x-button class="flex-col gap-1 py-2 px-4" buttonStyle="outline-secondary">
            <x-icon class="w-4" src="{{ asset('img/icons/icon-shipping.webp') }}"/>
            <div class="text-sm">Kirim ke Alamat</div>
        </x-button>

        <x-button class="flex-col gap-1 py-2 px-4" buttonStyle="outline-secondary">
            <x-icon class="w-4" src="{{ asset('img/icons/icon-send-by-store.webp') }}"/>
            <div class="text-sm">Ambil di Toko</div>
        </x-button>
    </section>
</div>