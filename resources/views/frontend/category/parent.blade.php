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
                <div class="accordion-filter-heading">
                    <button class="w-full flex items-center justify-between text-sm font-bold text-[#313131] border-b border-[#C5C5C5] pb-5 mb-2" type="button" aria-expanded="true" aria-controls="accordion-body">
                        <span>Makanan</span>
                        <i class="ri-arrow-down-s-line text-[#0079C2] duration-300"></i>
                    </button>
                </div>
                <div class="accordion-filter-content hide h-[275px] overflow-hidden border-b border-[#C5C5C5]" aria-labelledby="accordion-heading">
                    <ul class="list-subcategory-filter text-sm">
                        <li class="item-subcategory-filter py-2" data-category-name="">
                            <a class="block duration-200 hover:text-[#0079C2] hover:no-underline hover:ml-2" href="#" data-category-name="Sarapan">Sarapan</a>
                        </li>
                        <li class="item-subcategory-filter py-2" data-category-name="">
                            <a class="block duration-200 hover:text-[#0079C2] hover:no-underline hover:ml-2" href="#" data-category-name="Makanan Kaleng">Makanan Kaleng</a>
                        </li>
                        <li class="item-subcategory-filter py-2" data-category-name="">
                            <a class="block duration-200 hover:text-[#0079C2] hover:no-underline hover:ml-2" href="#" data-category-name="Bahan Masakan">Bahan Masakan</a>
                        </li>
                        <li class="item-subcategory-filter py-2" data-category-name="">
                            <a class="block duration-200 hover:text-[#0079C2] hover:no-underline hover:ml-2" href="#" data-category-name="Cokelat & Permen">Cokelat & Permen</a>
                        </li>
                        <li class="item-subcategory-filter py-2" data-category-name="">
                            <a class="block duration-200 hover:text-[#0079C2] hover:no-underline hover:ml-2" href="#" data-category-name="Makanan Instan">Makanan Instan</a>
                        </li>
                        <li class="item-subcategory-filter py-2" data-category-name="">
                            <a class="block duration-200 hover:text-[#0079C2] hover:no-underline hover:ml-2" href="#" data-category-name="Cemilan & Biskuit">Cemilan & Biskuit</a>
                        </li>
                        <li class="item-subcategory-filter py-2" data-category-name="">
                            <a class="block duration-200 hover:text-[#0079C2] hover:no-underline hover:ml-2" href="#" data-category-name="Healthy Food">Healthy Food</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="product-recommend-wrapper">
                <h2 class="title text-[#313131] text-center font-bold my-5">
                    Rekomendasi Produk
                </h2>
                <div class="list-product-recommend">
                    @include('frontend.category.includes.product-recommend')
                </div>
            </div>
        </div>
        <div class="right-side w-[77.2%]">
            <div class="category-section-wrapper">
                <div class="list-category-section">
                    <div class="item-category-section bg-white rounded-lg mb-4" id="category-section-id124124" data-section-name="Sarapan">
                        <div class="category-section-content">
                            <h2 class="title text-[#313131] font-bold px-6 pt-5">
                                <a href="#">Sarapan</a>
                            </h2>
                            <div class="category-product-content">
                                @include('frontend.category.includes.category-section')
                            </div>
                            <div class="see-more px-6 pb-5">
                                <a href="https://www.klikindomaret.com/category/sarapan" class="add-to-cart w-full flex justify-center items-center bg-[#0079C2] border rounded text-white text-sm py-1.5">
                                    <span>Selengkapnya</span>
                                    <div class="w-4 h-4 bg-white rounded-full text-center text-[#0079C2] ml-1.5 mb-[1px]">
                                        <i class="ri-arrow-right-s-line font-bold leading-[1.2]"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item-category-section bg-white rounded-lg mb-4" id="category-section-id124124" data-section-name="Sarapan">
                        <div class="category-section-content">
                            <h2 class="title text-[#313131] font-bold px-6 pt-5">
                                <a href="#">Sarapan</a>
                            </h2>
                            <div class="category-product-content">
                                @include('frontend.category.includes.category-section')
                            </div>
                            <div class="see-more px-6 pb-5">
                                <a href="https://www.klikindomaret.com/category/sarapan" class="add-to-cart w-full flex justify-center items-center bg-[#0079C2] border rounded text-white text-sm py-1.5">
                                    <span>Selengkapnya</span>
                                    <div class="w-4 h-4 bg-white rounded-full text-center text-[#0079C2] ml-1.5 mb-[1px]">
                                        <i class="ri-arrow-right-s-line font-bold leading-[1.2]"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item-category-section bg-white rounded-lg mb-4" id="category-section-id124124" data-section-name="Sarapan">
                        <div class="category-section-content">
                            <h2 class="title text-[#313131] font-bold px-6 pt-5">
                                <a href="#">Sarapan</a>
                            </h2>
                            <div class="category-product-content">
                                @include('frontend.category.includes.category-section')
                            </div>
                            <div class="see-more px-6 pb-5">
                                <a href="https://www.klikindomaret.com/category/sarapan" class="add-to-cart w-full flex justify-center items-center bg-[#0079C2] border rounded text-white text-sm py-1.5">
                                    <span>Selengkapnya</span>
                                    <div class="w-4 h-4 bg-white rounded-full text-center text-[#0079C2] ml-1.5 mb-[1px]">
                                        <i class="ri-arrow-right-s-line font-bold leading-[1.2]"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item-category-section bg-white rounded-lg mb-4" id="category-section-id124124" data-section-name="Sarapan">
                        <div class="category-section-content">
                            <h2 class="title text-[#313131] font-bold px-6 pt-5">
                                <a href="#">Sarapan</a>
                            </h2>
                            <div class="category-product-content">
                                @include('frontend.category.includes.category-section')
                            </div>
                            <div class="see-more px-6 pb-5">
                                <a href="https://www.klikindomaret.com/category/sarapan" class="add-to-cart w-full flex justify-center items-center bg-[#0079C2] border rounded text-white text-sm py-1.5">
                                    <span>Selengkapnya</span>
                                    <div class="w-4 h-4 bg-white rounded-full text-center text-[#0079C2] ml-1.5 mb-[1px]">
                                        <i class="ri-arrow-right-s-line font-bold leading-[1.2]"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item-category-section bg-white rounded-lg mb-4" id="category-section-id124124" data-section-name="Sarapan">
                        <div class="category-section-content">
                            <h2 class="title text-[#313131] font-bold px-6 pt-5">
                                <a href="#">Sarapan</a>
                            </h2>
                            <div class="category-product-content">
                                @include('frontend.category.includes.category-section')
                            </div>
                            <div class="see-more px-6 pb-5">
                                <a href="https://www.klikindomaret.com/category/sarapan" class="add-to-cart w-full flex justify-center items-center bg-[#0079C2] border rounded text-white text-sm py-1.5">
                                    <span>Selengkapnya</span>
                                    <div class="w-4 h-4 bg-white rounded-full text-center text-[#0079C2] ml-1.5 mb-[1px]">
                                        <i class="ri-arrow-right-s-line font-bold leading-[1.2]"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item-category-section bg-white rounded-lg mb-4" id="category-section-id124124" data-section-name="Sarapan">
                        <div class="category-section-content">
                            <h2 class="title text-[#313131] font-bold px-6 pt-5">
                                <a href="#">Sarapan</a>
                            </h2>
                            <div class="category-product-content">
                                @include('frontend.category.includes.category-section')
                            </div>
                            <div class="see-more px-6 pb-5">
                                <a href="https://www.klikindomaret.com/category/sarapan" class="add-to-cart w-full flex justify-center items-center bg-[#0079C2] border rounded text-white text-sm py-1.5">
                                    <span>Selengkapnya</span>
                                    <div class="w-4 h-4 bg-white rounded-full text-center text-[#0079C2] ml-1.5 mb-[1px]">
                                        <i class="ri-arrow-right-s-line font-bold leading-[1.2]"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item-category-section bg-white rounded-lg mb-4" id="category-section-id124124" data-section-name="Sarapan">
                        <div class="category-section-content">
                            <h2 class="title text-[#313131] font-bold px-6 pt-5">
                                <a href="#">Sarapan</a>
                            </h2>
                            <div class="category-product-content">
                                @include('frontend.category.includes.category-section')
                            </div>
                            <div class="see-more px-6 pb-5">
                                <a href="https://www.klikindomaret.com/category/sarapan" class="add-to-cart w-full flex justify-center items-center bg-[#0079C2] border rounded text-white text-sm py-1.5">
                                    <span>Selengkapnya</span>
                                    <div class="w-4 h-4 bg-white rounded-full text-center text-[#0079C2] ml-1.5 mb-[1px]">
                                        <i class="ri-arrow-right-s-line font-bold leading-[1.2]"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item-category-section bg-white rounded-lg mb-4" id="category-section-id124124" data-section-name="Sarapan">
                        <div class="category-section-content">
                            <h2 class="title text-[#313131] font-bold px-6 pt-5">
                                <a href="#">Sarapan</a>
                            </h2>
                            <div class="category-product-content">
                                @include('frontend.category.includes.category-section')
                            </div>
                            <div class="see-more px-6 pb-5">
                                <a href="https://www.klikindomaret.com/category/sarapan" class="add-to-cart w-full flex justify-center items-center bg-[#0079C2] border rounded text-white text-sm py-1.5">
                                    <span>Selengkapnya</span>
                                    <div class="w-4 h-4 bg-white rounded-full text-center text-[#0079C2] ml-1.5 mb-[1px]">
                                        <i class="ri-arrow-right-s-line font-bold leading-[1.2]"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item-category-section bg-white rounded-lg" id="category-section-id124124" data-section-name="Sarapan">
                        <div class="category-section-content">
                            <h2 class="title text-[#313131] font-bold px-6 pt-5">
                                <a href="#">Sarapan</a>
                            </h2>
                            <div class="category-product-content">
                                @include('frontend.category.includes.category-section')
                            </div>
                            <div class="see-more px-6 pb-5">
                                <a href="https://www.klikindomaret.com/category/sarapan" class="add-to-cart w-full flex justify-center items-center bg-[#0079C2] border rounded text-white text-sm py-1.5">
                                    <span>Selengkapnya</span>
                                    <div class="w-4 h-4 bg-white rounded-full text-center text-[#0079C2] ml-1.5 mb-[1px]">
                                        <i class="ri-arrow-right-s-line font-bold leading-[1.2]"></i>
                                    </div>
                                </a>
                            </div>
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