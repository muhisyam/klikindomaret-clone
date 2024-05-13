<x-general-layout class="mb-[84px] space-y-6">
    <x-slot:title>
        Order Status
    </x-slot:title>

    <nav aria-label="Breadcrumb">
        <ol class="inline-flex items-center text-sm">
            <li class="inline-flex items-center text-light-gray-300">
                <a href="#" class="inline-flex items-center hover:text-secondeary">
                    Beranda
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <span class="icon h-5 text-light-gray-300 mx-2"><i class="ri-arrow-right-s-line"></i></span>
                    <span class="text-black">Daftar Transaksi</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="flex">
        <section class="w-1/6 me-4" data-section="sidebar">
            @include('general.information.components.sidebar')
        </section>
        <section class="space-y-5 rounded-lg py-5 px-6 w-5/6 bg-white">
            <div class="flex justify-between">
                <div class="flex gap-2">
                    <x-button class="group !rounded-full p-2 gap-2 justify-center w-52 bg-light-gray-50 hover:bg-secondary">
                        <x-icon class="w-4" src="{{ asset('img/icons/ic_retail.webp') }}" iconStyle="hover-white"/>
                        <div class="h-4 text-sm text-secondary group-hover:text-white">Belanja Retail</div>
                    </x-button>
                    <x-button class="group !rounded-full justify-center h-10 w-10 bg-light-gray-50 hover:bg-secondary">
                        <x-icon class="w-4" src="{{ asset('img/icons/ic_virtual.webp') }}" iconStyle="hover-white"/>
                    </x-button>
                    <x-button class="group !rounded-full justify-center h-10 w-10 bg-light-gray-50 hover:bg-secondary">
                        <x-icon class="w-4" src="{{ asset('img/icons/ic_travel.webp') }}" iconStyle="hover-white"/>
                    </x-button>
                    <x-button class="group !rounded-full justify-center h-10 w-10 bg-light-gray-50 hover:bg-secondary">
                        <x-icon class="w-4" src="{{ asset('img/icons/ic_food.webp') }}" iconStyle="hover-white"/>
                    </x-button>
                    <x-button class="group !rounded-full justify-center h-10 w-10 bg-light-gray-50 hover:bg-secondary">
                        <x-icon class="w-4" src="{{ asset('img/icons/ic_ticket_second.webp') }}" iconStyle="hover-white"/>
                    </x-button>
                </div>
                <div class="h-10 w-32 bg-light-gray-50 rounded-lg"></div>
            </div>

            <div class="rounded-lg py-3 px-4 flex items-center gap-3 bg-sky-100 text-black" role="alert">
                <x-icon class="w-6" src="{{ asset('img/icons/icon-info-fill.webp') }}"/>
                <span class="grow text-sm"> Sekarang, pengambilan pesanan dengan metode ambil di toko akan menggunakan PIN. Cek PIN di daftar transaksi & tunjukkan ke kasir saat pengambilan. Butuh bantuan? <a href="#" class="text-secondary">Klik di sini.</a></span>
                <x-button class="p-2 group hover:bg-secondary">
                    <x-icon class="w-3" src="{{ asset('img/icons/icon-header-close.webp') }}" iconStyle="hover-white"/>
                </x-button>
            </div>

            <livewire:general.informations.user-order-list/>

            @php
                $section = 'user-detail-order';
                $show    = false;
            @endphp
            
            <x-modal section="livewire-component" withOverlay="false">
                <x-slot:trigger class="hidden"></x-slot>

                <x-slot:content class="separated-modal">
                @push('components')
                    @livewire('general.informations.modal-user-detail-order', [
                        'section'       => $section,
                        'showCondition' => $show,
                    ])
                @endpush
                </x-slot>
            </x-modal>
        </section>
    </div>

</x-general-layout>