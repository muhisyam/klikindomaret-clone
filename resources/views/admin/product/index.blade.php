@extends('admin.index')

@section('title')
List Produk
@endsection

@section('content')
<div class="product-list">
    @php
        $dataHeader = [
            'pagename' => 'Data Produk',
            'breadcrumb_pages' => [
                [
                    'info' => 'first',
                    'label' => 'Produk', 
                    'link' => 'products'
                ],
                [
                    'info' => 'last',
                    'label' => 'Data Produk'
                ],
            ],
            'navigation' => [
                'info' => 'add',
                'url' => '/products/create',
                'icon' => 'ri-add-fill',
                'label' => 'Produk'
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
                <input id="order-search" type="text" name="order-search" placeholder="Cari Produk..." class="w-full bg-transparent">
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
                        <div class="icon h-5 me-1"><i class="ri-dashboard-fill"></i></div>
                        <h2 class="label">Kategori</h2>
                    </button>
                </li>
                <li class="item-filter-table">
                    <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]" aria-label="Table filter">
                        <div class="icon h-5 me-1"><i class="ri-store-3-fill"></i></div>
                        <h2 class="label">Toko</h2>
                    </button>
                </li>
                <li class="item-filter-table">
                    <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]" aria-label="Table filter">
                        <div class="icon h-5 me-1"><i class="ri-price-tag-3-fill"></i></div>
                        <h2 class="label">Harga</h2>
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
                @include('admin.product.includes.index.table-header')
            </thead>
            <tbody class="text-sm">
                @include('admin.product.includes.index.table-content')
                <tr class="border-b">
                    <td class="py-2 px-4">1</td>
                    <td class="py-2 px-4">
                        <div class="product-info flex items-center">
                            <figure class="media w-10 me-3">
                                <img class="rounded-md" src="https://assets.klikindomaret.com/products/20035630/20035630_thumb.jpg?Version.20.01.1.01" alt="">
                            </figure>
                            <div class="product-desc w-40 flex-1">
                                <div class="name line-clamp-1 text-ellipsis">
                                    Bebelac 3 Susu Pertumbuhan Fos & Gos Vanila 800G
                                </div>
                                <div class="plu text-xs font-light">
                                    <p>PLU: <span>10003517</span></p>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="py-2 px-4">
                        <div class="sort-categories">
                            <button class="hover:text-[#0079c2]">Bahan Puding & Agar Agar</button>
                        </div>
                    </td>
                    <td class="py-2 px-4">
                        <div class="store-location">
                            <div class="info">Toko Indomaret</div>
                            <div class="address flex text-xs font-light">
                                <div class="address-info me-1">Lokasi</div>
                                <button class="icon h-4 hover:text-[#0079c2]" aria-label="See address data"><i class="ri-eye-fill"></i></button>
                            </div>
                        </div>
                    </td>
                    <td class="py-2 px-4">
                        <div class="product-status bg-gray-100 text-gray-700 font-bold text-center rounded-lg p-1">
                            <div class="info">Draft</div>
                        </div>
                    </td>
                    <td class="py-2 px-4">
                        <div class="stock-info">
                            <div class="empty flex">
                                <div class="icon h-4 text-red-600 me-1"><i class="ri-error-warning-fill"></i></div>
                                <p class="text">Habis</p>
                            </div>
                            <div class="stock-count text-xs font-light">
                                0
                            </div>
                        </div>
                    </td>
                    <td class="py-2 px-4">
                        <div class="discount-info">
                            -
                        </div>
                    </td>
                    <td class="py-2 px-4">
                        <div class="price flex justify-between">
                            <div class="left-side">Rp</div>
                            <div class="right-side">
                                152.052
                            </div>
                        </div>
                    </td>
                    <td class="py-2 px-4 text-center">
                        <button class="hover:bg-[#fbde7e] hover:text-[#0079c2] rounded p-1 px-2" aria-label="Data action">
                            <div class="icon h-6 pt-0.5"><i class="ri-more-2-line"></i></div>
                        </button>
                    </td>
                </tr>
                @include('admin.product.includes.index.table-content')
                @include('admin.product.includes.index.table-content')
                @include('admin.product.includes.index.table-content')
                @include('admin.product.includes.index.table-content')
                @include('admin.product.includes.index.table-content')
                @include('admin.product.includes.index.table-content')
                @include('admin.product.includes.index.table-content')
            </tbody>
        </table>
    </section>
</div>
@endsection