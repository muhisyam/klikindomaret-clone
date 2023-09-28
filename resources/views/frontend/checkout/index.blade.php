@extends('frontend.index')

@section('content')

<div class="checkout mb-6">
    <div class="checkout-wrapper flex gap-6">
        <div class="left-side checkout-info w-3/4">
            <section id="alert" class="flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50" role="alert">
                <i class="ri-information-fill text-[#0079C2] scale-[1.5] leading-none"></i>
                <div class="ml-3 text-sm font-medium">
                    Pastikan kamu sudah menandai titik lokasi dengan benar pada alamat yang dipilih untuk pengantaran pesanan.
                </div>
                <button type="button" class="ml-auto bg-blue-50 text-[#0079C2] rounded-lg p-1.5 hover:bg-blue-200 grid h-8 w-8" data-dismiss-target="#alert" aria-label="Close">
                    <i class="ri-close-line scale-[1.5]"></i>
                </button>
            </section>
            <section class="free-shipping flex items-center bg-white text-sm rounded-lg py-3 px-4 mb-4">
                <span class="icon text-[#0079C2] leading-none mr-2"><i class="ri-takeaway-fill"></i></span>
                Yuk, tambah belanjaan kamu supaya dapat gratis ongkos kirim!
                <button class="btn-free-shipping text-[#0079C2] ml-1" data-button-role="open-modal"  data-modal-target="#popup-free-shipping">
                    Lihat Selengkapnya
                </button>
            </section>
            <section class="product-cart bg-white rounded-lg p-5">
                @include('frontend.checkout.includes.product-cart')
            </section>
        </div>
        <div class="right-side checkout-summary w-1/4">
            <div class="summary-wrapper sticky top-20">
                @include('frontend.checkout.includes.change-address')
                @include('frontend.checkout.includes.product-summary')
                <section class="input-coupon-voucher bg-white rounded-lg p-4">
                    <div class="input-voucher-wrapper flex">
                        <input type="text" placeholder="Masukkan Voucher/Kupon" class="w-full text-sm border-0 border-b border-[#CCC] p-0 me-2 focus:ring-transparent">
                        <button class="disabled bg-[#09C01A] text-white text-center rounded p-2">Gunakan</button>
                    </div>
                </section>
            </div>
        </div>
        {{-- Modal --}}
        <div class="list-modal">
            @include('frontend.checkout.includes.list-modal')
            <div class="modal-overlay fixed w-full h-screen top-0 left-0 bg-black opacity-50 z-[55] hidden"></div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@include('frontend.checkout.js.checkout-main-js')
@endsection