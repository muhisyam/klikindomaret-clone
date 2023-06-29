@extends('frontend.index')

@section('content')

<nav class="flex mb-6" aria-label="Breadcrumb">
    <ol class="inline-flex items-center text-sm">
        <li class="inline-flex items-center text-[#95989A]">
            <a href="#" class="inline-flex items-center hover:text-[#0079C2]">
            Beranda
            </a>
        </li>
        <li>
            <div class="flex items-center text-[#95989A]">
                <i class="ri-arrow-right-s-line mx-2"></i>
                <a href="#" class="hover:text-[#0079C2]">Makanan</a>
            </div>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
                <i class="ri-arrow-right-s-line text-[#95989A] mx-2"></i>
                <span class="text-black">Sarapan</span>
            </div>
        </li>
    </ol>
</nav>
    
<section class="detail-product mb-6">
    <div class="detail-product-wrapper flex">
        <div class="left-side w-1/3 mr-4">
            <div class="product-image w-full bg-white rounded-lg p-3 mb-4">
                <div class="media">
                    <img src="https://assets.klikindomaret.com/products/20113566/20113566_1.jpg" data-image-zoom="https://assets.klikindomaret.com/products/20113566/20113566_1.jpg" alt="Product Image">
                </div>
            </div>
            <div class="product-thumbnail">
                <div class="swiper list-thumbnail">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide item-thumbnail active">
                            <img class="bg-white rounded-lg p-2" src="https://assets.klikindomaret.com/products/20113566/20113566_1.jpg" data-image-zoom="https://assets.klikindomaret.com/products/20113566/20113566_1.jpg" alt="Product Image">
                        </div>
                        <div class="swiper-slide item-thumbnail">
                            <img class="bg-white rounded-lg p-2" src="https://assets.klikindomaret.com/products/20113566/20113566_1.jpg" data-image-zoom="https://assets.klikindomaret.com/products/20113566/20113566_1.jpg" alt="Product Image">
                        </div>
                        <div class="swiper-slide item-thumbnail">
                            <img class="bg-white rounded-lg p-2" src="https://assets.klikindomaret.com/products/20113566/20113566_1.jpg" data-image-zoom="https://assets.klikindomaret.com/products/20113566/20113566_1.jpg" alt="Product Image">
                        </div>
                        <div class="swiper-slide item-thumbnail">
                            <img class="bg-white rounded-lg p-2" src="https://assets.klikindomaret.com/products/20113566/20113566_1.jpg" data-image-zoom="https://assets.klikindomaret.com/products/20113566/20113566_1.jpg" alt="Product Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-side w-2/3">
            <div class="product-info-wrapper">
                <div class="flash-sale-header flex items-center justify-between rounded-lg py-2 px-5">
                    <div class="left-side flex items-center">
                        <img class="w-7 mr-2" src="https://www.klikindomaret.com/Assets/image/icon_flash.png" alt="Flashsale Icon">
                        <span class="text-white text-2xl font-bold italic">Flash Sale</span>
                    </div>
                    <div class="right-side flex text-white font-bold">
                        <span class="mr-2">Berakhir dalam:</span>
                        <div class="countdown bg-[#ED3128] rounded px-2">00:01:04</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
@include('frontend.detail_product.js.detail-product-main-js')
@endsection