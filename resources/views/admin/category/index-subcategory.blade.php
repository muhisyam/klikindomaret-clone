@extends('admin.index')

@section('title')
Input Kategori
@endsection

@section('content')
<div class="category-list">
    @php
        $dataHeader = [
            'pagename' => 'Subkategori',
            'breadcrumb_pages' => [
                [
                    'info' => 'first',
                    'label' => 'Kategori', 
                    'link' => 'category'
                ],
                [
                    'info' => 'next',
                    'label' => 'List Kategori', 
                    'link' => 'category'
                ],
                [
                    'info' => 'last',
                    'label' => 'Subkategori'
                ],
            ],
            'navigation' => [
                'info' => 'add',
                'url' => '/category/input',
                'icon' => 'ri-add-fill',
                'label' => 'Kategori'
            ]
        ]
    @endphp 
    <section class="data-filter-wrapper border border-[#eee] rounded-xl text-sm py-2 px-4 mb-4">
        <section class="top-section flex gap-2">
            <ul class="list-tabs-section flex flex-1 overflow-auto gap-2 me-2">
                <li class="item-tabs-section">
                    <button class="rounded py-2 px-4 hover:bg-[#f5f5f5]" aria-label="Tab filter data table">Semua</button>
                </li>
                <li class="item-tabs-section">
                    <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5] active" aria-label="Tab filter data table">
                        <h2 class="label whitespace-nowrap me-1">Makanan</h2>
                        <div class="count bg-[#fbde7e] text-[#0079c2] text-xs font-normal rounded py-0.5 px-1.5">10</div>
                    </button>
                </li>
                <li class="item-tabs-section">
                    <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]" aria-label="Tab filter data table">
                        <h2 class="label whitespace-nowrap me-1">Produk Segar</h2>
                        <div class="count bg-[#fbde7e] text-[#0079c2] text-xs font-normal rounded py-0.5 px-1.5">1.258</div>
                    </button>
                </li>
                <li class="item-tabs-section">
                    <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]" aria-label="Tab filter data table">
                        <h2 class="label whitespace-nowrap me-1">Ibu & Anak</h2>
                        <div class="count bg-[#fbde7e] text-[#0079c2] text-xs font-normal rounded py-0.5 px-1.5">40</div>
                    </button>
                </li>
                <li class="item-tabs-section">
                    <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5] active" aria-label="Tab filter data table">
                        <h2 class="label whitespace-nowrap me-1">Kesehatan & Kecantikan</h2>
                        <div class="count bg-[#fbde7e] text-[#0079c2] text-xs font-normal rounded py-0.5 px-1.5">40</div>
                    </button>
                </li>
                <li class="item-tabs-section">
                    <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]" aria-label="Tab filter data table">
                        <h2 class="label whitespace-nowrap me-1">Home & Living</h2>
                        <div class="count bg-[#fbde7e] text-[#0079c2] text-xs font-normal rounded py-0.5 px-1.5">40</div>
                    </button>
                </li>
                <li class="item-tabs-section">
                    <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]" aria-label="Tab filter data table">
                        <h2 class="label whitespace-nowrap me-1">Kebutuhan Idul Adha</h2>
                        <div class="count bg-[#fbde7e] text-[#0079c2] text-xs font-normal rounded py-0.5 px-1.5">40</div>
                    </button>
                </li>
            </ul>
            <div class="separator w-[1px] bg-[#eee] my-2"></div>
            <div class="count-page-show flex items-center ms-2">
                <h2 class="label me-2">Tampilkan per Halaman</h2>
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
                <p class="info">Menampilkan <span>1 - 10</span> dari <span>15052</span> Hasil</p>
            </div>
        </section>
        <div class="separator h-[1px] bg-[#eee] my-2"></div>
        <section class="bottom-section flex gap-2">
            <div class="order-search-group flex flex-1 items-center rounded py-2 px-4">
                <label for="order-search" class="h-5 me-4"><i class="ri-search-line"></i></label>
                <input id="order-search" type="text" name="order-search" placeholder="Cari Kategori..." class="w-full bg-transparent">
            </div>
            <div class="separator w-[1px] bg-[#eee] my-2"></div>
            <ul class="list-filter-table flex gap-2">
                <li class="item-filter-table">
                    <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]" aria-label="Table filter">
                        <div class="icon h-5 me-1"><i class="ri-filter-3-fill"></i></div>
                        <h2 class="label">Filter</h2>
                    </button>
                </li>
                <li class="item-filter-table">
                    <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]" aria-label="Table filter">
                        <div class="icon h-5 me-1"><i class="ri-information-fill"></i></div>
                        <h2 class="label">Status</h2>
                    </button>
                </li>
            </ul>
            <div class="separator w-[1px] bg-[#eee] my-2"></div>
            <button class="layout-setting rounded py-2 px-3 hover:bg-[#f5f5f5]" aria-label="Setting layout table">
                <div class="icon h-5"><i class="ri-list-settings-line"></i></div>
            </button>
            <div class="separator w-[1px] bg-[#eee] my-2"></div>
            <nav class="header-pagination" aria-label="Page navigation">
                <ul class="inline-flex">
                    <li>
                        <a href="#" class="block h-10 px-3 py-2 rounded hover:bg-[#f5f5f5]" aria-label="Previous page">
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
                        <a href="#" class="block h-10 px-3 py-2 rounded hover:bg-[#f5f5f5]" aria-label="Next page">
                            <div class="icon h-5"><i class="ri-arrow-right-s-line"></i></div>
                        </a>
                    </li>
                </ul>
            </nav>
        </section>
    </section>
    <section class="data-table-wrapper border border-[#eee] rounded-xl p-4">
        <table class="w-full">
            <thead class="bg-[#f5f5f5] text-[#999] text-sm text-left uppercase rounded-t">
                @include('admin.category.includes.index.table-header')
            </thead>
            <tbody class="text-sm">
                <tr class="accordion-category-item relative">
                    @include('admin.category.includes.index.nested-table-content-level-2')
                </tr>
                <tr class="accordion-category-content">
                    <td colspan="5">
                        <div id="sarapan" class="accordion-category-wrapper accordion duration-500 ease-out hide" aria-labelledby="accordion-category-button">
                            <table class="w-full min-h-0">
                                <tbody class="relative">
                                    @include('admin.category.includes.index.nested-table-content-level-3')
                                    @include('admin.category.includes.index.nested-table-content-level-3')
                                    @include('admin.category.includes.index.nested-table-content-level-3')
                                    @include('admin.category.includes.index.nested-table-content-level-3')
                                    @include('admin.category.includes.index.nested-table-content-level-3')
                                    @include('admin.category.includes.index.nested-table-content-level-3')
                                    @include('admin.category.includes.index.nested-table-content-level-3')
                                    @include('admin.category.includes.index.nested-table-content-level-3')
                                    <tr class="border-l-custom absolute left-[25px] top-0 border-l border-[#e5e7eb]"></tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr class="accordion-category-item relative">
                    <td class="py-2 w-[50px]">
                        <div class="accordion-category-button">
                            <button class="block bg-[#eee] border border-[#ccc] text-[#aaa] rounded-full mx-auto" data-accordion-target="minuman" aria-labelledby="minuman" aria-expanded="true" aria-controls="minuman">
                                <div class="icon h-5 w-5 duration-500"><i class="ri-arrow-down-s-line"></i></div>
                            </button>
                        </div>
                    </td>
                    <td class="py-2 px-4 w-auto">
                        <div class="accordion-category-info flex items-center">
                            <div class="label me-1">minuman</div>
                            <div class="product-count">(<span>30</span>)</div>
                        </div>
                    </td>
                    <td class="py-2 px-4 w-[210px]">154 Produk</td>
                    <td class="py-2 px-4 w-[210px]">
                        <div class="status flex">
                            <div class="icon h-5 text-gray-600 scale-[0.6] me-1"><i class="ri-checkbox-blank-circle-fill"></i></div>
                            <div class="info">Tidak Aktif</div>
                        </div>
                    </td>
                    <td class="py-2 px-4 w-[50px]">
                        <button class="block rounded p-1 px-2 mx-auto hover:bg-[#fbde7e] hover:text-[#0079c2]" aria-label="data-action">
                            <div class="icon h-6 pt-0.5"><i class="ri-more-2-line"></i></div>
                        </button>
                    </td>
                    <td class="border-b-custom absolute right-0 bottom-0 h-3 border-b border-[#e5e7eb]"></td>
                </tr>
                <tr class="accordion-category-content">
                    <td colspan="5">
                        <div id="minuman" class="accordion-category-wrapper accordion duration-500 ease-out hide" aria-labelledby="accordion-category-button">
                            <table class="w-full min-h-0">
                                <tbody class="relative">
                                    @include('admin.category.includes.index.nested-table-content-level-3')
                                    @include('admin.category.includes.index.nested-table-content-level-3')
                                    @include('admin.category.includes.index.nested-table-content-level-3')
                                    @include('admin.category.includes.index.nested-table-content-level-3')
                                    @include('admin.category.includes.index.nested-table-content-level-3')
                                    @include('admin.category.includes.index.nested-table-content-level-3')
                                    @include('admin.category.includes.index.nested-table-content-level-3')
                                    @include('admin.category.includes.index.nested-table-content-level-3')
                                    <tr class="border-l-custom absolute left-[25px] top-0 border-l border-[#e5e7eb]"></tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</div>
@endsection

@section('scripts')
    @include('admin.category.js.admin-category-main-js')
@endsection