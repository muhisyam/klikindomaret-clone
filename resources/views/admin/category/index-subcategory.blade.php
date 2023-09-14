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
                    'link' => 'categories'
                ],
                [
                    'info' => 'next',
                    'label' => 'List Kategori', 
                    'link' => 'categories'
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
                    @foreach ($data['meta']['links'] as $links)
                    @if ($loop->first)
                    <li>
                        <a href="{{ $links['url'] }}" class="block h-10 px-3 py-2 rounded hover:bg-[#f5f5f5]" aria-label="Previous page">
                            <div class="icon h-5"><i class="ri-arrow-left-s-line"></i></div>
                        </a>
                    </li>
                    @continue
                    @elseif ($loop->last)
                    <li>
                        <a href="{{ $links['url'] }}" class="block h-10 px-3 py-2 rounded hover:bg-[#f5f5f5]" aria-label="Next page">
                            <div class="icon h-5"><i class="ri-arrow-right-s-line"></i></div>
                        </a>
                    </li>
                    @continue
                    @endif
                    <li>
                        <a href="{{ $links['url'] }}" class="{{ $links['active'] ? 'active' : '' }} block h-10 py-2 px-4 rounded hover:bg-[#f5f5f5]" aria-current="page" >{{ $links['label'] }}</a>
                    </li>
                    @endforeach
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
                @foreach ($data['data'] as $categoryLvl2)
                <tr class="accordion-category-item relative">
                    @include('admin.category.includes.index.nested-table-content-level-2')
                </tr>
                <tr class="accordion-category-content">
                    <td colspan="5">
                        <div id="{{ $categoryLvl2['slug'] }}" class="accordion-category-wrapper accordion duration-500 ease-out hide" aria-labelledby="accordion-category-button" aria-hidden="true">
                            <table class="w-full min-h-0">
                                <tbody class="relative">
                                    @foreach ($categoryLvl2['children'] as $categoryLvl3)
                                    @include('admin.category.includes.index.nested-table-content-level-3')   
                                    @endforeach
                                    <tr class="border-l-custom absolute left-[25px] top-0 border-l border-[#e5e7eb]"></tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</div>
@endsection

@section('scripts')
    @include('admin.category.js.admin-category-main-js')
@endsection