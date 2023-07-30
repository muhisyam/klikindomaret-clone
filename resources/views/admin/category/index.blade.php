@extends('admin.index')

@section('title')
Input Kategori
@endsection

@section('content')
<div class="category-list">
    <div class="category-list-content">
        <header class="header mb-6">
            <div class="top-section flex items-center justify-between">
                <div class="left-side min-w-[180px]"><h1 class="title text-2xl font-bold">Kategori</h1></div>
                <div class="center-side relative">
                    <div class="greeting bg-[#fbde7e] text-[#0079c2] text-center rounded-lg py-1.5 px-6">
                        <div class="text-lg tracking-wide">Selamat <span class="time">Siang</span>, <span class="name italic font-bold">Jordan!</span></div>
                        <div class="datetime absolute -bottom-5 w-full flex justify-center text-xs font-bold pt-1 -ms-6">Jum'at, 12 Agustus 2023</div>
                    </div>
                </div>
                <div class="right-side min-w-[180px]">
                    <div class="flex items-center float-right">
                        <button class="icon text-lg me-4"><i class="ri-notification-3-line"></i></button>
                        <button class="icon text-lg"><i class="ri-question-line"></i></button>
                        <div class="separator h-7 w-[1px] bg-[#ccc] mx-3"></div>
                        <a href="#" class="w-fit flex items-center bg-[#0079c2] text-white rounded py-2 px-4">
                            <div class="icon h-6 me-2"><i class="ri-add-fill"></i></div>
                            <div class="text">Kategori</div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="bottom-section">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center text-sm">
                        <li class="inline-flex items-center text-[#95989A]">
                            <a href="#" class="inline-flex items-center hover:text-[#0079C2]">
                            Kategori
                            </a>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <i class="ri-arrow-right-s-line text-[#95989A] mx-2"></i>
                                <span class="text-black">List Kategori</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </header>
        <section class="category-list-header border border-[#eee] rounded-xl text-sm py-2 px-4 mb-4">
            <div class="top-section flex gap-2">
                <div class="list-tabs-section flex flex-1 overflow-auto gap-2 me-2">
                    <button class="item-tabs-section rounded py-2 px-4 hover:bg-[#f5f5f5]">Semua</button>
                    <button class="item-tabs-section flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5] active">
                        <div class="label whitespace-nowrap me-1">Makanan</div>
                        <div class="count bg-[#fbde7e] text-[#0079c2] text-xs font-normal rounded py-0.5 px-1.5">10</div>
                    </button>
                    <button class="item-tabs-section flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]">
                        <div class="label whitespace-nowrap me-1">Produk Segar</div>
                        <div class="count bg-[#fbde7e] text-[#0079c2] text-xs font-normal rounded py-0.5 px-1.5">1.258</div>
                    </button>
                    <button class="item-tabs-section flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]">
                        <div class="label whitespace-nowrap me-1">Ibu & Anak</div>
                        <div class="count bg-[#fbde7e] text-[#0079c2] text-xs font-normal rounded py-0.5 px-1.5">40</div>
                    </button>
                    <button class="item-tabs-section flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5] active">
                        <div class="label whitespace-nowrap me-1">Kesehatan & Kecantikan</div>
                        <div class="count bg-[#fbde7e] text-[#0079c2] text-xs font-normal rounded py-0.5 px-1.5">40</div>
                    </button>
                    <button class="item-tabs-section flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]">
                        <div class="label whitespace-nowrap me-1">Home & Living</div>
                        <div class="count bg-[#fbde7e] text-[#0079c2] text-xs font-normal rounded py-0.5 px-1.5">40</div>
                    </button>
                    <button class="item-tabs-section flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]">
                        <div class="label whitespace-nowrap me-1">Kebutuhan Idul Adha</div>
                        <div class="count bg-[#fbde7e] text-[#0079c2] text-xs font-normal rounded py-0.5 px-1.5">40</div>
                    </button>
                </div>
                <div class="separator w-[1px] bg-[#eee] my-2"></div>
                <div class="count-page-show flex items-center ms-2">
                    <div class="label me-2">Tampilkan per Halaman</div>
                    <div class="input-count-page w-14 rounded p-2 hover:bg-[#f5f5f5]">
                        <select name="" id="" class="w-full bg-transparent">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>
                <div class="separator w-[1px] bg-[#eee] my-2"></div>
                <div class="count-page-show w-[268.5px] flex items-center ms-2">
                    <div class="info">Menampilkan <span>1 - 10</span> dari <span>15052</span> Hasil</div>
                </div>
            </div>
            <div class="separator h-[1px] bg-[#eee] my-2"></div>
            <div class="bottom-section flex gap-2">
                <div class="order-search-group flex flex-1 items-center rounded py-2 px-4">
                    <label for="order-search" class="h-5 me-4"><i class="ri-search-line"></i></label>
                    <input id="order-search" type="text" name="order-search" placeholder="Cari Kategori..." class="w-full bg-transparent">
                </div>
                <div class="separator w-[1px] bg-[#eee] my-2"></div>
                <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]">
                    <div class="icon h-5 me-1"><i class="ri-filter-3-fill"></i></div>
                    <div class="label">Filter</div>
                </button>
                <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]">
                    <div class="icon h-5 me-1"><i class="ri-information-fill"></i></div>
                    <div class="label">Status</div>
                </button>
                <div class="separator w-[1px] bg-[#eee] my-2"></div>
                <button class="layout-setting rounded py-2 px-3 hover:bg-[#f5f5f5]">
                    <div class="icon h-5"><i class="ri-list-settings-line"></i></div>
                </button>
                <div class="separator w-[1px] bg-[#eee] my-2"></div>
                <nav class="header-pagination" aria-label="Page navigation example">
                    <ul class="inline-flex">
                        <li>
                            <a href="#" class="block h-10 px-3 py-2 rounded hover:bg-[#f5f5f5]">
                                <div class="icon h-5"><i class="ri-arrow-left-s-line"></i></div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block h-10 py-2 px-4 rounded hover:bg-[#f5f5f5]">1</a>
                        </li>
                        <li>
                            <a href="#" class="block h-10 py-2 px-4 rounded hover:bg-[#f5f5f5]">2</a>
                        </li>
                        <li>
                            <a href="#" class="active block h-10 py-2 px-4 rounded hover:bg-[#f5f5f5]" aria-current="page" >3</a>
                        </li>
                        <li>
                            <a href="#" class="block h-10 py-2 px-4 rounded hover:bg-[#f5f5f5]">4</a>
                        </li>
                        <li>
                            <a href="#" class="block h-10 py-2 px-4 rounded hover:bg-[#f5f5f5]">5</a>
                        </li>
                        <li>
                            <a href="#" class="block h-10 px-3 py-2 rounded hover:bg-[#f5f5f5]">
                                <div class="icon h-5"><i class="ri-arrow-right-s-line"></i></div>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </section>
        <div class="category-list-wrapper border border-[#eee] rounded-xl p-4">
            <table class="w-full">
                <thead class="bg-[#f5f5f5] text-[#999] text-sm text-left uppercase rounded-t">
                    @include('admin.category.includes.index.table-header')
                </thead>
                <tbody class="text-sm">
                    @include('admin.category.includes.index.table-content')
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
{{-- <div class="item-category">
    <div class="accordion-category-heading">
        <button class="h-10 w-full flex items-center justify-between border border-[#CCC] rounded text-[#313131] py-2 px-3" type="button" data-accordion-target="makanan" aria-expanded="true" aria-controls="accordion-body">
            <span>Makanan</span>
            <i class="ri-arrow-down-s-line text-[#0079C2] duration-300"></i>
        </button>
    </div>
    <div id="makanan" class="accordion-category-content overflow-hidden" aria-labelledby="accordion-category-heading">
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
    <div id="minuman" class="accordion-category-content hide overflow-hidden" aria-labelledby="accordion-category-heading">
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
    <div id="pakaian" class="accordion-category-content hide overflow-hidden" aria-labelledby="accordion-category-heading">
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
</div> --}}

@section('scripts')
    @include('admin.category.js.admin-category-main-js')
@endsection