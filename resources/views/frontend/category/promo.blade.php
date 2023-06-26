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

<section class="promo-banner mb-6">
    <div class="promo wrapper">
        <div class="left-side">

        </div>
        <div class="right-side">
            
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
        <div class="right-side w-[77.2%] bg-white rounded-lg px-6 py-5">
            <div class="tabs-menu-wrapper">
                <ul class="list-menu text-sm border-b border-[#C5C5C5]">
                    <li class="item-menu min-w-[120px] inline-block text-center px-6 pb-3 pt-0 hover:text-[#0079C2] hover:cursor-pointer">
                        Produk
                    </li>
                    <li class="item-menu active min-w-[120px] inline-block text-center px-6 pb-3 pt-0 hover:text-[#0079C2] hover:cursor-pointer">
                        Syarat dan Ketentuan
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
@include('frontend.category.js.category-main-js')
@endsection