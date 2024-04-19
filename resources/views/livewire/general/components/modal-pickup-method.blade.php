<div class="modal w-[900px] rounded-xl bg-white" data-trigger-modal="{{ $section }}">
    <section class="border-b border-light-gray-100 p-3 flex items-center justify-center">
        <x-button class="absolute top-0 right-0 h-12 w-12" data-target-modal="{{ $section }}" :preventClose="false">
            <x-icon class="m-auto w-3" src="{{ asset('img/icons/icon-header-close.webp') }}"/>
        </x-button>

        <h3 class="font-bold">Metode pengambilan terakhir yang dipakai</h3>
    </section>

    <ul class="p-4 grid grid-cols-4 gap-4">
        <li class="relative space-y-2 rounded-md border border-secondary shadow-input p-2 text-sm overflow-hidden">
            <div class="absolute top-0 right-0 py-1 ps-4 pe-2 rounded-bl-full bg-secondary text-xs text-white">Aktif</div>
            <div class="flex items-center gap-2 !mt-0">
                @php /*TODO: icon home / office*/ @endphp
                <x-icon class="h-4 w-4" src="{{ asset('img/icons/icon-header-map-marker.webp') }}"/>
                <h4>Rumah Cilegon</h4>
            </div>
            <hr class="bg-light-gray-100">
            <div>
                <div class="font-bold">M Hisyam</div>
                <div class="font-light">0812 9823 2264</div>
            </div>
            <address class="text-xs">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corporis similique sapiente expedita veniam beatae mollitia, temporibus ipsum aut iure in reiciendis possimus totam doloremque voluptatum!</address>
        </li>
        @for ($i = 0; $i < 3; $i++)
        <li class="relative space-y-2 rounded-md border border-light-gray-100 p-2 text-sm">
            <div class="flex items-center gap-2">
                @php /*TODO: icon home / office*/ @endphp
                <x-icon class="h-4 w-4" src="{{ asset('img/icons/icon-header-map-marker.webp') }}"/>
                <h4>Rumah Cilegon</h4>
            </div>
            <hr class="bg-light-gray-100">
            <div>
                <div class="font-bold">M Hisyam</div>
                <div class="font-light">0812 9823 2264</div>
            </div>
            <address class="text-xs">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corporis similique sapiente expedita veniam beatae mollitia, temporibus ipsum aut iure in reiciendis possimus totam doloremque voluptatum!</address>
        </li>
        @endfor
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