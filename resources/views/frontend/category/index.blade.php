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

<section class="category mb-6">
    <div class="category-wrapper flex">
        <div class="left-side w-[21.2%] bg-white rounded-lg p-5 mr-4">
            <div class="accordion-filter-wrapper">
                <div class="list-accordion-filter">
                    <div class="item-filter-1">
                        <div class="accordion-filter-heading">
                            <button class="w-full flex items-center justify-between text-sm font-bold text-[#313131] border-b border-[#C5C5C5] pb-5" type="button" data-accordion-target="#subcategory-filter" aria-expanded="true" aria-controls="accordion-body">
                                <span>Sarapan</span>
                                <i class="ri-arrow-down-s-line text-[#0079C2] duration-300"></i>
                            </button>
                        </div>
                        <div id="subcategory-filter" class="accordion-filter-content hide overflow-hidden border-b border-[#C5C5C5] py-2" aria-labelledby="accordion-heading">
                            <ul class="list-subcategory-filter text-sm">
                                <li class="item-subcategory-filter py-1.5" data-category-name="">
                                    <a class="block duration-200 hover:text-[#0079C2] hover:no-underline hover:ml-2" href="#" data-category-name="Sarapan">Sarapan</a>
                                </li>
                                <li class="item-subcategory-filter py-1.5" data-category-name="">
                                    <a class="block duration-200 hover:text-[#0079C2] hover:no-underline hover:ml-2" href="#" data-category-name="Makanan Kaleng">Makanan Kaleng</a>
                                </li>
                                <li class="item-subcategory-filter py-1.5" data-category-name="">
                                    <a class="block duration-200 hover:text-[#0079C2] hover:no-underline hover:ml-2" href="#" data-category-name="Bahan Masakan">Bahan Masakan</a>
                                </li>
                                <li class="item-subcategory-filter py-1.5" data-category-name="">
                                    <a class="block duration-200 hover:text-[#0079C2] hover:no-underline hover:ml-2" href="#" data-category-name="Cokelat & Permen">Cokelat & Permen</a>
                                </li>
                                <li class="item-subcategory-filter py-1.5" data-category-name="">
                                    <a class="block duration-200 hover:text-[#0079C2] hover:no-underline hover:ml-2" href="#" data-category-name="Makanan Instan">Makanan Instan</a>
                                </li>
                                <li class="item-subcategory-filter py-1.5" data-category-name="">
                                    <a class="block duration-200 hover:text-[#0079C2] hover:no-underline hover:ml-2" href="#" data-category-name="Cemilan & Biskuit">Cemilan & Biskuit</a>
                                </li>
                                <li class="item-subcategory-filter py-1.5" data-category-name="">
                                    <a class="block duration-200 hover:text-[#0079C2] hover:no-underline hover:ml-2" href="#" data-category-name="Healthy Food">Healthy Food</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="item-filter-2">
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
                    <div class="item-filter-3">
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
                            <button class="w-full text-[#0079C2] text-sm text-center py-2" id="reset-filter">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-side w-[77.2%] bg-white rounded-lg px-6 py-5">
            <div class="category-product-wrapper">
                <div class="category-product-content">
                    <div class="list-heading mb-7">
                        <div class="item-heading-1">
                            <div class="left-side w-1/2">
                                <div class="search-filter-wrapper relative w-4/5 border border-[#C5C5C5] rounded p-2 px-4">
                                    <input type="text" placeholder="Cari Produk disini..." class="w-full text-sm border-none p-0 pr-12 focus:ring-transparent">
                                    <i class="ri-search-line absolute top-0 right-0 bg-[#B2D6ED] text-white rounded scale-75 py-2 px-5"></i>
                                    {{-- <i class="ri-close-line"></i> --}}
                                </div>
                            </div> 
                            <div class="right-side w-1/2">
                            </div>
                        </div>
                        <div class="item-heading-2">
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
    </div>
</section>

@endsection

@section('scripts')
@include('frontend.category.js.category-main-js')
@endsection