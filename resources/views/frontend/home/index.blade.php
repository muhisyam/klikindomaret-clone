@extends('frontend.index')

@section('content')
    
<div id="alert" class="flex p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
    <i class="ri-information-fill text-[#0079c2] scale-[1.5]"></i>
    <span class="sr-only">Info</span>
    <div class="ml-3 text-md font-medium">
        Pastikan kamu sudah menandai titik lokasi dengan benar pada alamat yang dipilih untuk pengantaran pesanan.
    </div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700" data-dismiss-target="#alert" aria-label="Close">
        <span class="sr-only">Close</span>
        <i class="ri-close-line scale-[1.5]"></i>
    </button>
</div>

@include('frontend.home.inc.heroes')
@include('frontend.home.inc.channels')
@include('frontend.home.inc.promo_banners')
@include('frontend.home.inc.official_stores')
@include('frontend.home.inc.flashsale')

<div class="h-[1000px] bg-lime-300 text-xl">Dump section</div>

@endsection

@section('scripts')
<script>
    // Swipper Hero section
    const heroSwiper = new Swiper('.list-heroes-banner', {
        slidesPerView: 1.317991,
        centeredSlides: true,
        loop: true,
        spaceBetween: 20,
        autoplay: {
            delay: 2000,
            pauseOnMouseEnter: true
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    // Swipper Channel section
    const channelSwiper = new Swiper('.list-channel', {
        slidesPerView: 12.5,
        spaceBetween: 20,
        preventClicks: true
    });

    // Swipper Promo section
    const promoSwiper = new Swiper('.list-promo', {
        slidesPerView: 2.5,
        spaceBetween: 20,
    });

    // Official Store section
    const storeSwiper = new Swiper('.list-store', {
        slidesPerView: 8,
        spaceBetween: 20,
    });

    // Flash Sale section
    const flashSwiper = new Swiper('.list-flash', {
        slidesPerView: 7,
        spaceBetween: 20,
        freeMode: true
    });
</script>
@endsection