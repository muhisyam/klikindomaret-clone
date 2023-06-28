@extends('frontend.index')

@section('content')
    
<nav class="flex mb-6" aria-label="Breadcrumb">
    <ol class="inline-flex items-center text-sm">
        <li class="inline-flex items-center text-[#95989A]">
            <a href="#" class="inline-flex items-center hover:text-[#0079C2]">
            Beranda
            </a>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
                <i class="ri-arrow-right-s-line text-[#95989A] mx-2"></i>
                <span class="text-black">Pasti Murah dengan Promo Belanja dari Rp 50.000</span>
            </div>
        </li>
    </ol>
</nav>

<section class="promo mb-6">
    <div class="promo-wrapper flex">
        <div class="left-side w-[68.4%] mr-4">
            <div class="promo-banner-content" id="" data-promo-id="" data-promo-name="">
                <img class="rounded-lg" src="https://assets.klikindomaret.com///products/promopage/promo%20tebus%20murah%20sikat%20gigi.jpeg" alt="" loading="lazy">
            </div>
        </div>
        <div class="right-side w-[31.4%] bg-white rounded-lg p-5">
            <div class="promo-information-content">
                <div class="title font-bold mb-4">Setiap pembelian produk Toiletries senilai Rp50.000,- dapatkan diskon Rp10.000,-</div>
                <div class="description flex items-center mb-4">
                    <div class="share-link mr-4">
                        <div class="link-wrapper flex">
                            <a href="#" target="_blank" data-tooltip-target="facebook-share-tooltip" data-tooltip-placement="bottom">
                                <img class="max-w-[26px] rounded-sm mr-2" src="https://www.freepnglogos.com/uploads/facebook-logo-design-1.png" alt="Facebook Icon">
                            </a>
                            <div id="facebook-share-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-md shadow-sm opacity-0 tooltip">
                                Share ke Facebook
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                            <a class="" href="#" target="_blank" data-tooltip-target="twitter-share-tooltip" data-tooltip-placement="bottom">
                                <img class="max-w-[26px] rounded-sm" src="https://seeklogo.com/images/T/twitter-icon-square-logo-108D17D373-seeklogo.com.png" alt="Twitter Icon">
                            </a>
                            <div id="twitter-share-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-md shadow-sm opacity-0 tooltip">
                                Share ke Twitter
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    </div>
                    <div class="period text-sm">
                        <div class="period-header text-[#95989A]">
                            <i class="ri-time-line mr-1"></i>
                            <span class="relative -top-[2px]">Periode</span>
                        </div>
                        <div class="period-info">
                            25 Jun 2023 - 05 Jul 2023
                        </div>
                    </div>
                </div>
                <div class="coupon-wrapper">
                    <div class="with-coupon">
                        <div class="coupon-code relative bg-[#DEF7E3] text-[#118E1C] border border-dashed border-[#118E1C] rounded p-2 mb-3">
                            <div class="header">
                                <img class="max-w-[22px] inline-block mr-1" src="https://www.klikindomaret.com/Assets/image/kupon_green.png" alt="Coupon Icon">
                                <span class="text-sm">Kode Kupon:</span>
                            </div>
                            <div class="code text-lg font-bold">
                                <span>BABYCARE10</span>
                            </div>
                            <div class="copy-code absolute w-[40px] h-[102%] -right-[1px] -top-[1px] grid place-items-center bg-white border border-[#118e1C] rounded-tr rounded-br cursor-pointer">
                                <i class="ri-clipboard-line py-4 px-2" id="copy-code" data-tooltip-target="copy-coupon-tooltip"></i>
                                <i class="ri-check-line hidden py-4 px-2" id="copied-code" data-tooltip-target="copied-coupon-tooltip"></i>
                            </div>
                            <div id="copy-coupon-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-md shadow-sm opacity-0 tooltip">
                                Salin Kode
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                            <div id="copied-coupon-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-md shadow-sm opacity-0 tooltip">
                                Kode berhasil disalin
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                            <div class="sold-out">
                                <img class="absolute max-w-[100px] right-12 top-3" src="https://www.klikindomaret.com/Assets/image/soldout.png" alt="Soldout Image">
                            </div>
                        </div>
                        <div class="stock-progress h-1.5 bg-[#E6E6E6] mb-1">
                            <div class="stock-progress-bar bg-[#118E1C]" aria-valuemin="0" aria-valuemax="100" aria-valuenow="80%" style="width: 80%">
                            </div>
                        </div>
                        <div class="coupon-stock text-sm text-[#CCC]">
                            Sisa kuota promosi
                            <span class="float-right text-[#118E1C]">80%</span>
                        </div>
                    </div>
                    <div class="without-coupon hidden">
                        <div class="coupon-code relative h-[70px] text-[#95989A] text-center leading-[70px] border border-dashed border-[#CCC] rounded">
                            <img class="max-w-[22px] inline-block grayscale opacity-50 mr-1" src="https://www.klikindomaret.com/Assets/image/kupon_green.png" alt="Coupon Icon">
                            <span class="text-sm">Tanpa Kode Kupon</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="category mb-6">
    <div class="category-wrapper flex">
        <div class="left-side w-[21.2%] bg-white rounded-lg p-5 mr-4">
            <div class="accordion-filter-wrapper">
                <div class="list-accordion-filter">
                    <div class="item-filter-1">
                        <div class="accordion-filter-heading">
                            <button class="w-full flex items-center justify-between text-sm font-bold text-[#313131] border-b border-[#C5C5C5] pb-5" type="button" data-accordion-target="#brands-filter" aria-expanded="true" aria-controls="accordion-body">
                                <span>Brand</span>
                                <i class="ri-arrow-down-s-line text-[#0079C2] duration-300"></i>
                            </button>
                        </div>
                        <div id="brands-filter" class="accordion-filter-content hide overflow-hidden border-b border-[#C5C5C5] py-2 mb-5" aria-labelledby="accordion-heading">
                            <ul class="list-brand-filter text-sm">
                                <li class="item-brand-filter py-1.5">
                                    <div class="flex items-center">
                                        <input id="radio-all" type="radio" value="all" name="brands-radio" class="w-4 h-4 text-[#0079C2] focus:ring-transparent bg-[#EEE]" data-brand-name="">
                                        <label for="radio-all" class="ml-2 text-sm font-medium text-gray-900">Semua Brand</label>
                                    </div>
                                </li>
                                <li class="item-brand-filter py-1.5">
                                    <div class="flex items-center">
                                        <input id="radio-214" type="radio" value="Air Mancur" name="brands-radio" class="w-4 h-4 text-[#0079C2] focus:ring-transparent bg-[#EEE]" data-brand-name="">
                                        <label for="radio-214" class="ml-2 text-sm font-medium text-gray-900">Air Mancur</label>
                                    </div>
                                </li>
                                <li class="item-brand-filter py-1.5">
                                    <div class="flex items-center">
                                        <input id="radio-412" type="radio" value="Bakalland" name="brands-radio" class="w-4 h-4 text-[#0079C2] focus:ring-transparent bg-[#EEE]" data-brand-name="">
                                        <label for="radio-412" class="ml-2 text-sm font-medium text-gray-900">Bakalland</label>
                                    </div>
                                </li>
                                <li class="item-brand-filter py-1.5">
                                    <div class="flex items-center">
                                        <input id="radio-224" type="radio" value="Madu Enak" name="brands-radio" class="w-4 h-4 text-[#0079C2] focus:ring-transparent bg-[#EEE]" data-brand-name="">
                                        <label for="radio-224" class="ml-2 text-sm font-medium text-gray-900">Madu Enak</label>
                                    </div>
                                </li>
                                <li class="item-brand-filter py-1.5">
                                    <div class="flex items-center">
                                        <input id="radio-all" type="radio" value="all" name="brands-radio" class="w-4 h-4 text-[#0079C2] focus:ring-transparent bg-[#EEE]" data-brand-name="">
                                        <label for="radio-all" class="ml-2 text-sm font-medium text-gray-900">Semua Brand</label>
                                    </div>
                                </li>
                                <li class="item-brand-filter py-1.5">
                                    <div class="flex items-center">
                                        <input id="radio-214" type="radio" value="Air Mancur" name="brands-radio" class="w-4 h-4 text-[#0079C2] focus:ring-transparent bg-[#EEE]" data-brand-name="">
                                        <label for="radio-214" class="ml-2 text-sm font-medium text-gray-900">Air Mancur</label>
                                    </div>
                                </li>
                                <li class="item-brand-filter py-1.5">
                                    <div class="flex items-center">
                                        <input id="radio-412" type="radio" value="Bakalland" name="brands-radio" class="w-4 h-4 text-[#0079C2] focus:ring-transparent bg-[#EEE]" data-brand-name="">
                                        <label for="radio-412" class="ml-2 text-sm font-medium text-gray-900">Bakalland</label>
                                    </div>
                                </li>
                                <li class="item-brand-filter py-1.5">
                                    <div class="flex items-center">
                                        <input id="radio-224" type="radio" value="Madu Enak" name="brands-radio" class="w-4 h-4 text-[#0079C2] focus:ring-transparent bg-[#EEE]" data-brand-name="">
                                        <label for="radio-224" class="ml-2 text-sm font-medium text-gray-900">Madu Enak</label>
                                    </div>
                                </li>
                                <li class="item-brand-filter py-1.5">
                                    <div class="flex items-center">
                                        <input id="radio-all" type="radio" value="all" name="brands-radio" class="w-4 h-4 text-[#0079C2] focus:ring-transparent bg-[#EEE]" data-brand-name="">
                                        <label for="radio-all" class="ml-2 text-sm font-medium text-gray-900">Semua Brand</label>
                                    </div>
                                </li>
                                <li class="item-brand-filter py-1.5">
                                    <div class="flex items-center">
                                        <input id="radio-214" type="radio" value="Air Mancur" name="brands-radio" class="w-4 h-4 text-[#0079C2] focus:ring-transparent bg-[#EEE]" data-brand-name="">
                                        <label for="radio-214" class="ml-2 text-sm font-medium text-gray-900">Air Mancur</label>
                                    </div>
                                </li>
                                <li class="item-brand-filter py-1.5">
                                    <div class="flex items-center">
                                        <input id="radio-412" type="radio" value="Bakalland" name="brands-radio" class="w-4 h-4 text-[#0079C2] focus:ring-transparent bg-[#EEE]" data-brand-name="">
                                        <label for="radio-412" class="ml-2 text-sm font-medium text-gray-900">Bakalland</label>
                                    </div>
                                </li>
                                <li class="item-brand-filter py-1.5">
                                    <div class="flex items-center">
                                        <input id="radio-224" type="radio" value="Madu Enak" name="brands-radio" class="w-4 h-4 text-[#0079C2] focus:ring-transparent bg-[#EEE]">
                                        <label for="radio-224" class="ml-2 text-sm font-medium text-gray-900">Madu Enak</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="item-filter-2">
                        <div class="accordion-filter-heading">
                            <button class="w-full flex items-center justify-between text-sm font-bold text-[#313131] border-b border-[#C5C5C5] pb-5" type="button" data-accordion-target="#supplier-filter" aria-expanded="true" aria-controls="accordion-body">
                                <span>Penyedia</span>
                                <i class="ri-arrow-down-s-line text-[#0079C2] duration-300"></i>
                            </button>
                        </div>
                        <div id="supplier-filter" class="accordion-filter-content hide overflow-hidden border-b border-[#C5C5C5] py-2 mb-5" aria-labelledby="accordion-heading">
                            <ul class="list-brand-filter text-sm">
                                <li class="item-brand-filter py-1.5">
                                    <div class="flex items-center">
                                        <input id="radio-24141" type="radio" value="TI" name="brands-radio" class="w-4 h-4 text-[#0079C2] focus:ring-transparent bg-[#EEE]" data-supplier-name="Toko Indomaret">
                                        <label for="radio-24141" class="ml-2 text-sm font-medium text-gray-900">Toko Indomaret</label>
                                    </div>
                                </li>
                                <li class="item-brand-filter py-1.5">
                                    <div class="flex items-center">
                                        <input id="radio-5112" type="radio" value="26" name="brands-radio" class="w-4 h-4 text-[#0079C2] focus:ring-transparent bg-[#EEE]" data-supplier-name="">
                                        <label for="radio-5112" class="ml-2 text-sm font-medium text-gray-900">Warehouse Jakarta 1</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="item-filter-3">
                        <div class="filter-heading text-sm font-bold text-[#313131]">
                            <span>Harga</span>
                        </div>
                        <div class="filter-content py-5 mb-2">
                            <div class="list-price-filter grid grid-cols-2 gap-x-3">
                                <div class="item-price-filter">
                                    <div class="min-price flex items-center text-xs border border-[#C5C5C5] rounded py-3 pl-3 focus-within:border-[#0079C2]">
                                        <label for="text-min-price" class="mr-1">Rp</label>
                                        <input id="text-min-price" type="text" name="min-price" class="w-full border-none text-xs p-0 focus:ring-transparent" placeholder="Minimum">
                                    </div>
                                </div>
                                <div class="item-price-filter">
                                    <div class="max-price flex items-center text-xs border border-[#C5C5C5] rounded py-3 pl-3 focus-within:border-[#0079C2]">
                                        <label for="text-max-price" class="mr-1">Rp</label>
                                        <input id="text-max-price" type="text" name="max-price" class="w-full border-none text-xs p-0 focus:ring-transparent" placeholder="Maximum">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="button-filter-wrapper">
                <div class="list-button-filter">
                    <div class="item-button-1">
                        <div class="button-cta-filter">
                            <button class="w-full bg-[#B2D6ED] text-white text-sm text-center rounded cursor-none pointer-events-none py-2" id="cta-filter">Tampilkan Produk</button>
                            {{-- <button class="active w-full bg-[#B2D6ED] text-white text-sm text-center rounded cursor-none pointer-events-none py-2" id="">Tampilkan 100+ Produk</button> --}}
                        </div>
                    </div>
                    <div class="item-button-2">
                        <div class="button-reset-filter">
                            <button class="w-full text-[#0079C2] text-sm text-center py-2 hover:underline" id="reset-filter">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-side w-[77.2%] bg-white rounded-lg p-5">
            <div class="tab-menu-wrapper mb-7">
                <ul class="list-tab text-sm border-b border-[#C5C5C5]">
                    <li class="item-tab active min-w-[120px] inline-block text-center px-6 pb-3 pt-0 hover:text-[#0079C2] hover:cursor-pointer" data-tab-target="#product-promo">
                        Produk
                    </li>
                    <li class="item-tab min-w-[120px] inline-block text-center px-6 pb-3 pt-0 hover:text-[#0079C2] hover:cursor-pointer" data-tab-target="#term-condition-promo">
                        Syarat dan Ketentuan
                    </li>
                </ul>
            </div>
            <div class="tab-panel-wrapper">
                <div class="list-panel">
                    <div class="item-panel-1" id="product-promo">
                        <div class="category-product-wrapper">
                            <div class="category-product-content">
                                <div class="list-heading mb-7">
                                    <div class="item-heading-1 flex">
                                        <div class="left-side w-full">
                                            <div class="search-filter-wrapper relative w-4/5 border border-[#C5C5C5] rounded p-2 px-4">
                                                <input id="text-search-filter" type="text" placeholder="Cari Produk disini..." class="w-full text-sm border-none p-0 pr-12 focus:ring-transparent">
                                                <i class="ri-search-line search-icon absolute top-0 right-0 bg-[#0079C2] text-white rounded scale-75 py-2 px-5"></i>
                                                <i class="ri-close-line clear-icon absolute top-0 right-0 bg-[#0079C2] text-white text-xl rounded scale-75 py-1.5 px-[18px] hidden"></i>
                                            </div>
                                        </div> 
                                        <div class="right-side w-full">
                                            <div class="select-filter-wrapper w-1/2 text-sm float-right cursor-pointer select-none">
                                                <div class="select-box flex justify-between items-center border border-[#C5C5C5] rounded p-2 px-4">
                                                    <div class="select-info">Urutkan: <span>Harga Termahal</span></div>
                                                    <i class="ri-arrow-down-s-line text-[#0079C2] font-bold duration-300"></i>
                                                </div>
                                                <div class="select-option hidden relative">
                                                    <ul class="list-option absolute top-0 w-full bg-white border border-[#C5C5C5] rounded-b shadow-lg z-10">
                                                        <li class="item-option py-2 px-4 hover:bg-[#0079C2] hover:text-white hover:cursor-pointer">
                                                            Alfabet (A-Z)
                                                        </li>
                                                        <li class="item-option py-2 px-4 hover:bg-[#0079C2] hover:text-white hover:cursor-pointer">
                                                            Alfabet (A-Z)
                                                        </li>
                                                        <li class="item-option py-2 px-4 hover:bg-[#0079C2] hover:text-white hover:cursor-pointer">
                                                            Alfabet (A-Z)
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item-heading-2">
                                        <h2 class="title text-sm text-[#CCC] mt-3">
                                            Menampilkan <span>1 - 50 </span>product
                                        </h2>
                                    </div>
                                </div>
                                <div class="list-category-product grid grid-cols-6 gap-4 mb-14">
                                    @include('frontend.category.includes.list-product')
                                    @include('frontend.category.includes.list-product')
                                    @include('frontend.category.includes.list-product')
                                    @include('frontend.category.includes.list-product')
                                    @include('frontend.category.includes.list-product')
                                    @include('frontend.category.includes.list-product')
                                    @include('frontend.category.includes.list-product')
                                    @include('frontend.category.includes.list-product')
                                    @include('frontend.category.includes.list-product')
                                    @include('frontend.category.includes.list-product')
                                    @include('frontend.category.includes.list-product')
                                    @include('frontend.category.includes.list-product')
                                    @include('frontend.category.includes.list-product')
                                    @include('frontend.category.includes.list-product')
                                    @include('frontend.category.includes.list-product')
                                    @include('frontend.category.includes.list-product')
                                    @include('frontend.category.includes.list-product')
                                    @include('frontend.category.includes.list-product')
                                    @include('frontend.category.includes.list-product')
                                    @include('frontend.category.includes.list-product')
                                    @include('frontend.category.includes.list-product')
                                </div>
                                <div class="pagination flex justify-center py-3 text-sm">
                                    <div>Pagination</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item-panel-2 hidden" id="term-condition-promo">
                        <div class="term-condition-wrapper pb-14">
                            <h2 class="font-bold mb-3">Syarat dan Ketentuan Promo Pesta Tebus Murah Sikat Gigi</h2>
                            <ol class="text-sm">
                                <li class="leading-8 before:pr-2">Setiap belanja <strong>produk Pasta Gigi senilai minimal Rp50.000,-</strong> pada halaman promo Klik Indomaret, konsumen dapat <strong>Tebus Murah 1 Sikat Gigi.</strong></li>
                                <li class="leading-8 before:pr-2">
                                    <strong>Kupon promo hanya berlaku selama 45 menit setelah memasukkan kode kupon.</strong>
                                    <ol class="text-sm">
                                        <li class="leading-8 before:pr-2"><strong>Tersedia kuota kupon 5.000 per hari.</strong></li>
                                        <li class="leading-8 before:pr-2"><strong>Promo hanya berlaku di platform aplikasi Klik Indomaret.</strong></li>
                                    </ol>
                                </li>
                                <li class="leading-8 before:pr-2"><strong>Promo berlaku kelipatan, maks diskon 5x per transaksi.</strong></li>
                                <li class="leading-8 before:pr-2"><strong>Tersedia Kuota 30.864 selama periode promo.</strong></li>
                                <li class="leading-8 before:pr-2">Mohon dipastikan item <strong>tebus murah sudah terpilih</strong> dan lanjutkan dengan klik tombol <strong>'Pilih Produk'.</strong></li>
                                <li class="leading-8 before:pr-2"><strong>Apabila tebus murah tidak tampil pada halaman promo Klik Indomaret, maka kuota nya sudah habis.</strong></li>
                                <li class="leading-8 before:pr-2">Dengan melakukan transaksi di dalam program ini, maka konsumen dianggap mengerti dan menyetujui semua <a class="text-[#0079C2]" href="https://www.klikindomaret.com/bantuan/syarat-dan-ketentuan">syarat dan ketentuan yang berlaku.</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
@include('frontend.category.js.category-main-js')
@endsection