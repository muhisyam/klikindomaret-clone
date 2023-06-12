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

@include('frontend.home.inc.channel')

@endsection

@section('scripts')
<script>
    
    const swiper = new Swiper('.list__channel', {
        slidesPerView: 12.5,
        spaceBetween: 20,
        preventClicks: true
    });
</script>
@endsection