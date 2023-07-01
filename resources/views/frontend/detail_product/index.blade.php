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
                <div class="product-desc-wrapper relative bg-white rounded-lg p-5 mb-4">
                    <h2 class="product-title text-xl font-bold mb-2">
                        Klik Indomaret Tas Ramah Lingkungan Parasut
                    </h2>
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
                    <div class="bottom-btn-wrapper flex justify-between">
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
                            <button type="button" class="add-to-cart flex items-center justify-center w-60 h-10 bg-[#0079C2] text-white text-sm font-bold rounded" id="" data-page-name="" data-plu="" data-product-id="" data-product-price="" data-address-type="" data-address="" data-wh-code="">
                                <i class="ri-add-line mr-2"></i>
                                <span>Keranjang</span>
                            </button>
                        </div>
                    </div>
                    <div class="top-bottom-wrapper absolute top-5 right-5 flex gap-2">
                        <button type="button" class="btn-favorite w-8 h-8 grid place-items-center bg-[#CBCBCB] text-white text-lg rounded-full">
                            <i class="ri-heart-line leading-0"></i>
                        </button>
                        <div class="social-media-share relative">
                            <button type="button" class="btn-share w-8 h-8 grid place-items-center bg-[#CBCBCB] text-white text-lg rounded-full">
                                <i class="ri-share-fill leading-0"></i>
                            </button>
                            <div class="social-media-wrapper hidden absolute top-10 right-0 flex items-center gap-3 bg-white rounded drop-shadow-md py-2 p-3">
                                <a href="#" target="_blank">
                                    <img class="max-w-[26px] rounded" src="https://www.klikindomaret.net/Assets/image/svg/icon_fb.svg" alt="Facebook Icon">
                                </a>
                                <a href="#" target="_blank">
                                    <img class="max-w-[26px] rounded" src="https://www.klikindomaret.net/Assets/image/svg/icon_twitter.svg" alt="Twitter Icon">
                                </a>
                                <a href="#" target="_blank">
                                    <img class="max-w-[26px] rounded" src="https://www.klikindomaret.net/Assets/image/svg/icon_wa.svg" alt="Whatsapp Icon">
                                </a>
                                <a href="#" target="_blank">
                                    <img class="max-w-[26px] rounded" src="https://www.klikindomaret.net/Assets/image/svg/icon_copy_link.svg" alt="Link Icon">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-store-wrapper bg-white flex items-center rounded-lg p-5 mb-4">
                    <div class="store-icon mr-2">
                        <img class="w-14 h-14 bg-white rounded-full shadow p-1" src="https://www.klikindomaret.net/Assets/image/icon_store_pdp.png" alt="Store Icon">
                    </div>
                    <div class="store-name text-sm font-bold cursor-default" data-tooltip-target="product-store-tooltip" data-tooltip-placement="right">Toko Indomaret</div>
                    <div id="product-store-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-md shadow-sm opacity-0 tooltip">
                        Produk disediakan dan dikirim oleh Toko Indomaret
                    </div>
                </div>
                <div class="product-spec-wrapper hide relative bg-white text-sm rounded-lg p-5">
                    <div class="product-spec-content pb-8">
                        <div class="desc-wrapper mb-4">
                            <h3 class="desc-label font-bold">Deskripsi Product</h3>
                            <span class="desc-info">Minuman Yogurt dengan Rasa Strawberry. Merk yogurt dari bermacam-macam rasa buah yang satu ini sudah sangat terkenal. Bahkan, Anda tidak perlu repot-repot menemukan yogurt ini karena Cimory Yogurt Drink sudah dijual bebas di pasaran. Hadir dengan berbagai macam rasa, yogurt ini terbuat dari 100 persen susu sapi segar yang telah melalui proses fermentasi. Minuman bewarna keputih-putihan yang rasanya enak dan segar ini juga mengandung sejumlah bakteri baik yang bagus untuk memelihara kesehatan pencernaan. Jika dibandingkan produk yoghurt lainnya, yoghurt ini mempunyai nilai sodium dan kalium yang tinggi, sehingga yoghurt ini bisa membantu untuk memperkuat imunitas tubuh.</span>
                        </div>
                        <div class="list-spec-wrapper">
                            <div class="item-spec-1 mb-4">
                                <h3 class="spec-label font-bold">Cara Penggunaan:</h3>
                                <span class="spec-info">Kocok sebelum diminum.</span>
                            </div>
                            <div class="item-spec-2 mb-4">
                                <h3 class="spec-label font-bold">Cara Penyimpanan:</h3>
                                <span class="spec-info">Selalu simpan di lemari pendingin. Setelah kemasan dibuka, sebaiknya segera dihabiskan.</span>
                            </div>
                            <div class="item-spec-3 mb-4">
                                <h3 class="spec-label font-bold">Komposisi:</h3>
                                <span class="spec-info">Susu sapi segar (51%), air, gula, susu skim bubuk, susu bubuk full krim, penstabil nabati, sari buah stroberi (0.1%), perisa sintetik stroberi, kultur Streptococcus thermophilus dan Lactobacillus delbrueckii subsp bulgaricus, pewarna karmin CI. No. 75470.</span>
                            </div>
                            <div class="item-spec-4 mb-4">
                                <h3 class="spec-label font-bold">Takaran Per Kemasan:</h3>
                                <span class="spec-info">Sajian per kemasan: 2</span>
                            </div>
                            <div class="item-spec-5 mb-4">
                                <h3 class="spec-label font-bold">Takaran Per Serving:</h3>
                                <span class="spec-info">Energi total 90kkal, energi dari lemak 10kkal. % AKG: Lemak total 1g, protein 3g, karbohidrat total 18g, gula 13g, natrium 45mg, kalium 135mg. kalsium 10%, fosfor 10%.</span>
                            </div>
                            <div class="item-spec-6 mb-4">
                                <h3 class="spec-label font-bold">Takaran Per Saji:</h3>
                                <span class="spec-info">Takaran saji: 125mL</span>
                            </div>
                        </div>
                        <div class="product-plu">
                            <h3 class="plu-label font-bold">PLU:</h3>
                            <span class="plu-info">20056214</span>
                        </div>
                    </div>
                    <div class="button-expand-content absolute bottom-5">
                        <button class="text-[#0079C2] hover:underline" type="button">Lihat Selengkapnya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('frontend.components.list-product')

@endsection

@section('scripts')
@include('frontend.detail_product.js.detail-product-main-js')
@endsection