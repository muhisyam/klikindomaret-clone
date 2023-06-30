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
                <div class="flash-sale-header flex items-center justify-between rounded-lg py-2 px-5 mb-4">
                    <div class="left-side flex items-center">
                        <img class="w-7 mr-2" src="https://www.klikindomaret.com/Assets/image/icon_flash.png" alt="Flashsale Icon">
                        <span class="text-white text-2xl font-bold italic">Flash Sale</span>
                    </div>
                    <div class="right-side flex text-white font-bold">
                        <span class="mr-2">Berakhir dalam:</span>
                        <div class="countdown bg-[#ED3128] rounded px-2">00:01:04</div>
                    </div>
                </div>
                <div class="product-desc-wrapper bg-white rounded-lg p-5">
                    <div class="product-title text-xl font-bold mb-2">
                        Klik Indomaret Tas Ramah Lingkungan Parasut
                    </div>
                    <div class="find-store mb-4">
                        <button class="flex items-center bg-[#FAE7D4] rounded-full py-0.5 px-2">
                            <i class="ri-map-pin-2-fill text-[#0079C2] mr-1"></i>
                            <span class="text-xs">Cari Toko yang Menjual</span>
                        </button>
                    </div>
                    <hr>
                    <div class="product-price text-sm mt-6 mb-8">
                        <div class="discount-price flex items-center mb-2">
                            <div class="discount max-w-[40px] bg-[#FAE7D4] text-[#F28418] text-center font-bold rounded px-1.5 py-1 mr-2">15%</div>
                            <div class="price text-[#95989A] leading-none line-through">Rp 15.000</div>
                        </div>
                        <div class="normal-price text-[#F28418] text-2xl font-bold">
                            <span>Rp 10.000</span>
                        </div>
                    </div>
                    <div class="product-btn-wrapper">
                        <div class="product-qty flex items-center">
                            <span class="font-bold mr-4">Qty</span>
                            <div class="input-qty-wrapper">
                                <button type="button" class="text-[#C5C5C5] text-sm font-bold border border-[#C5C5C5] rounded py-2 px-3 hover:bg-[#0079C2] hover:text-white hover:border-[#0079C2]" id="btn-min-qty">
                                    <i class="ri-add-line"></i>
                                </button>
                                <input type="number" class="w-10 h-10 text-center border-0 border-b border-[#C5C5C5] p-0 mx-1 focus:ring-transparent focus:border-[#C5C5C5]" value="1" id="input-qty">
                                <button type="button" class="text-[#C5C5C5] text-sm font-bold border border-[#C5C5C5] rounded py-2 px-3 hover:bg-[#0079C2] hover:text-white hover:border-[#0079C2]" id="btn-plus-qty">
                                    <i class="ri-subtract-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="btn-cart">
                            <button type="button max-w-[270px] bg-[#]" class="add-to-cart" id=""></button>
                        </div>
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