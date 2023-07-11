@extends('admin.index')

@section('title')
Input Kategori
@endsection

@section('content')
<div class="category-list">
    <div class="category-list-wrapper border border-[#eee] rounded-xl p-4">
        <h1 class="title text-[#0079c2] text-xl font-bold mb-4">List Kategori</h1>
        <div class="list-category">
            <div class="item-category">
                <div class="accordion-category-heading">
                    <button class="h-10 w-full flex items-center justify-between border border-[#CCC] rounded text-[#313131] py-2 px-3" type="button" data-accordion-target="makanan" aria-expanded="true" aria-controls="accordion-body">
                        <span>Makanan</span>
                        <i class="ri-arrow-down-s-line text-[#0079C2] duration-300"></i>
                    </button>
                </div>
                <div id="makanan" class="accordion-category-content overflow-hidden mb-5" aria-labelledby="accordion-category-heading">
                    <ul class="list-category-level-2 grid grid-cols-6 gap-4 text-sm">
                        <li class="item-category-level-2">
                            <a href="#" class="flex items-center py-1.5 ms-4 hover:text-[#0079c2]">
                                <div class="icon scale-50 me-2"><i class="ri-checkbox-blank-circle-fill"></i></div>
                                <div class="text-sm">Sarapan</div>
                            </a>
                            <ul class="list-category-level-3 ms-6">
                                <li class="item-category-level-3">
                                    <a href="#" class="flex items-center py-1.5 ms-3 hover:text-[#0079c2]">
                                        <div class="icon scale-125 me-2"><i class="ri-arrow-right-s-fill"></i></div>
                                        <div class="text-sm">Sarapan</div>
                                    </a>
                                </li>
                                <li class="item-category-level-3">
                                    <a href="#" class="flex items-center py-1.5 ms-3 hover:text-[#0079c2]">
                                        <div class="icon scale-125 me-2"><i class="ri-arrow-right-s-fill"></i></div>
                                        <div class="text-sm">Sarapan</div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="item-subcategory">
                            <a href="#" class="flex items-center py-1.5 ms-3 hover:text-[#0079c2]">
                                <div class="icon scale-50 me-2"><i class="ri-checkbox-blank-circle-fill"></i></div>
                                <div class="text-sm">Makanan Kaleng</div>
                            </a>
                        </li>
                        <li class="item-subcategory">
                            <a href="#" class="flex items-center py-1.5 ms-3 hover:text-[#0079c2]">
                                <div class="icon scale-50 me-2"><i class="ri-checkbox-blank-circle-fill"></i></div>
                                <div class="text-sm">Masakan Instan</div>
                            </a>
                        </li>
                        <li class="item-subcategory">
                            <a href="#" class="flex items-center py-1.5 ms-3 hover:text-[#0079c2]">
                                <div class="icon scale-50 me-2"><i class="ri-checkbox-blank-circle-fill"></i></div>
                                <div class="text-sm">Makan Siang</div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="item-category">
                <div class="accordion-category-heading">
                    <button class="h-10 w-full flex items-center justify-between border border-[#CCC] rounded text-[#313131] py-2 px-3" type="button" data-accordion-target="minuman" aria-expanded="true" aria-controls="accordion-body">
                        <span>Minuman</span>
                        <i class="ri-arrow-down-s-line text-[#0079C2] duration-300"></i>
                    </button>
                </div>
                <div id="minuman" class="accordion-category-content hide overflow-hidden mb-5" aria-labelledby="accordion-category-heading">
                    <ul class="list-subcategory text-sm">
                        <li class="item-subcategory">
                            <a href="#" class="flex items-center py-1.5 ms-3 hover:text-[#0079c2]">
                                <div class="icon scale-50 me-2"><i class="ri-checkbox-blank-circle-fill"></i></div>
                                <div class="text-sm">Sarapan</div>
                            </a>
                        </li>
                        <li class="item-subcategory">
                            <a href="#" class="flex items-center py-1.5 ms-3 hover:text-[#0079c2]">
                                <div class="icon scale-50 me-2"><i class="ri-checkbox-blank-circle-fill"></i></div>
                                <div class="text-sm">Makanan Kaleng</div>
                            </a>
                        </li>
                        <li class="item-subcategory">
                            <a href="#" class="flex items-center py-1.5 ms-3 hover:text-[#0079c2]">
                                <div class="icon scale-50 me-2"><i class="ri-checkbox-blank-circle-fill"></i></div>
                                <div class="text-sm">Masakan Instan</div>
                            </a>
                        </li>
                        <li class="item-subcategory">
                            <a href="#" class="flex items-center py-1.5 ms-3 hover:text-[#0079c2]">
                                <div class="icon scale-50 me-2"><i class="ri-checkbox-blank-circle-fill"></i></div>
                                <div class="text-sm">Makan Siang</div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="item-category">
                <div class="accordion-category-heading">
                    <button class="h-10 w-full flex items-center justify-between border border-[#CCC] rounded text-[#313131] py-2 px-3" type="button" data-accordion-target="pakaian" aria-expanded="true" aria-controls="accordion-body">
                        <span>Pakaian</span>
                        <i class="ri-arrow-down-s-line text-[#0079C2] duration-300"></i>
                    </button>
                </div>
                <div id="pakaian" class="accordion-category-content hide overflow-hidden mb-5" aria-labelledby="accordion-category-heading">
                    <ul class="list-subcategory text-sm">
                        <li class="item-subcategory">
                            <a href="#" class="flex items-center py-1.5 ms-3 hover:text-[#0079c2]">
                                <div class="icon scale-50 me-2"><i class="ri-checkbox-blank-circle-fill"></i></div>
                                <div class="text-sm">Sarapan</div>
                            </a>
                        </li>
                        <li class="item-subcategory">
                            <a href="#" class="flex items-center py-1.5 ms-3 hover:text-[#0079c2]">
                                <div class="icon scale-50 me-2"><i class="ri-checkbox-blank-circle-fill"></i></div>
                                <div class="text-sm">Makanan Kaleng</div>
                            </a>
                        </li>
                        <li class="item-subcategory">
                            <a href="#" class="flex items-center py-1.5 ms-3 hover:text-[#0079c2]">
                                <div class="icon scale-50 me-2"><i class="ri-checkbox-blank-circle-fill"></i></div>
                                <div class="text-sm">Masakan Instan</div>
                            </a>
                        </li>
                        <li class="item-subcategory">
                            <a href="#" class="flex items-center py-1.5 ms-3 hover:text-[#0079c2]">
                                <div class="icon scale-50 me-2"><i class="ri-checkbox-blank-circle-fill"></i></div>
                                <div class="text-sm">Makan Siang</div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    @include('admin.category.js.admin-category-main-js')
@endsection