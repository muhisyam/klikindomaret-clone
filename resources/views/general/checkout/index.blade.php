<x-general-layout class="mb-[84px] flex gap-6">
    <section class="w-3/4 space-y-4" data-section="checkout-product">
        <div class="rounded-lg py-3 px-6 flex items-center gap-3 bg-sky-100 text-black" role="alert">
            <x-icon class="w-6" src="{{ asset('img/icons/icon-info-fill.webp') }}"/>
            <span class="grow text-sm">Akun Klik Indomaret kamu sudah otomatis terhubung dan terdaftar di Indomaret Poinku.</span>
            <x-button class="p-2 group hover:bg-secondary">
                <x-icon class="w-3" src="{{ asset('img/icons/icon-header-close.webp') }}" iconStyle="hover-white"/>
            </x-button>
        </div>

        <div class="rounded-lg py-3 px-6 flex items-center gap-2 bg-white">
            <x-icon class="w-6" src="{{ asset('img/icons/icon-shipping.webp') }}"/>
            <span class="text-sm">Yuk, tambah belanjaan kamu supaya dapat gratis ongkos kirim!</span>
            <x-modal section="free-delivery">
                <x-slot:trigger class="text-secondary text-sm">
                    Lihat Selengkapnya
                </x-slot>

                <x-slot:content class="h-80 w-80 bg-white">
                    <div>asd</div>
                </x-slot>
            </x-modal>
        </div>

        <livewire:general.checkout.checkout-product/>
    </section>
    <section class="w-1/4" data-section="checkout-summary">
        <div class="sticky top-20">

            @php $section = 'change-pickup-methods'; @endphp

            <x-modal :section="$section" :withOverlay="false">
                <x-slot:trigger class="mb-4 !rounded-lg py-3 px-4 bg-white">
                    <x-icon class="w-3" src="{{ asset('img/icons/icon-header-map-marker.webp') }}"/>
                    <div class="text-xs line-clamp-1"><b>Ambil di: </b><span>JANTI-SLEMAN (FWFU), JL JANTI 03 RT008/004 KEL CATURTUNGGAL KEC DEPOK KAB SLEMAN YOGYAKARTA</span></div>
                    <x-icon class="w-3 duration-500" src="{{ asset('img/icons/icon-header-chevron-down.webp') }}" data-arrow-dropdown=""/>
                </x-slot>

                <x-slot:content class="separated-modal">
                @push('components')
                    @livewire('general.components.modal-pickup-method', ['section' => $section])
                @endpush
                </x-slot>
            </x-modal>

            <livewire:general.checkout.checkout-summary/>
        </div>
    </section>
</x-general-layout>

<script>
    // document.addEventListener('livewire:initialized', () => {
    //     Livewire.on('run-js-content-loaded', event => {
    //         setTimeout(() => {
    //             console.log('xzcxzcxzcxz');
    //         }, 1);
    //     });
    // });
</script>