@extends('admin.index')

@section('title')
Input Kategori Induk
@endsection

@section('content')
<div class="category-list">
    @php
        $dataHeader = [
            'pagename' => 'Kategori Induk',
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
                    'label' => 'Kategori Induk'
                ],
            ],
            'navigation' => [
                'info' => 'add',
                'url' => '/categories/create',
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
                <p class="info">Menampilkan <span>{{ $data['meta']['from'] }} - {{ $data['meta']['to'] }}</span> dari <span>{{ $data['meta']['total'] }}</span> Hasil</p>
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
                <ul class="inline-flex w-full">
                    @foreach ($data['meta']['custom_links'] as $links)
                    @if ($loop->first)
                    <li>
                        <a href="{{ $links['url'] ? $links['url'] : '#' }}" class="block w-[40px] h-10 text-center py-2 rounded {{ $links['url'] ? 'hover:bg-[#f5f5f5]' : 'disabled' }}" aria-label="Previous page">
                            <div class="icon h-5"><i class="ri-arrow-left-s-line"></i></div>
                        </a>
                    </li>
                    @continue
                    @elseif ($loop->last)
                    <li>
                        <a href="{{ $links['url'] ? $links['url'] : '#' }}" class="block w-[40px] h-10 text-center py-2 rounded {{ $links['url'] ? 'hover:bg-[#f5f5f5]' : 'disabled' }}" aria-label="Next page">
                            <div class="icon h-5"><i class="ri-arrow-right-s-line"></i></div>
                        </a>
                    </li>
                    @continue
                    @endif
                    @if ($links['label'] == 'separator')
                    <li>
                        <button type="button" class="block w-[40px] h-10 text-center py-2 rounded cursor-default">...</button>
                    </li>
                    @continue    
                    @endif
                    <li>
                        <a href="{{ $links['active'] ? '#' : $links['url'] }}" class="{{ $links['active'] ? 'active' : '' }} block w-[40px] h-10 text-center py-2 rounded hover:bg-[#f5f5f5]" aria-current="page" >{{ $links['label'] }}</a>
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
                @foreach ($data['data'] as $category)
                @include('admin.category.includes.index.table-content')    
                @endforeach
            </tbody>
        </table>
    </section>
</div>
@endsection

@push('scripts')
    @include('admin.category.js.admin-category-main-js')
@endpush