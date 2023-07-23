@extends('admin.index')

@section('title')
List Produk
@endsection

@section('content')
<div class="order-list">
    <div class="order-list-content">
        <header class="header flex items-center justify-between mb-4">
            <h1 class="title text-[#0079c2] text-2xl font-bold">Pemesanan</h1>
            <a href="#" class="flex items-center bg-[#0079c2] text-white rounded py-2 px-4">
                <div class="icon h-6 me-2"><i class="ri-printer-fill"></i></div>
                <div class="text">Cetak</div>
            </a>
        </header>
        <section class="order-list-header flex gap-2 border border-[#eee] rounded-xl text-sm py-2 px-4 mb-4">
            <div class="order-search-group flex flex-1 items-center rounded py-2 px-4">
                <label for="order-search" class="h-5 me-4"><i class="ri-search-line"></i></label>
                <input id="order-search" type="text" name="order-search" placeholder="Cari Produk..." class="w-full bg-transparent">
            </div>
            <div class="separator w-[1px] bg-[#eee] my-2"></div>
            <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]">
                <div class="icon h-5 me-1"><i class="ri-filter-3-fill"></i></div>
                <div class="label">Urutkan</div>
            </button>
            <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]">
                <div class="icon h-5 me-1"><i class="ri-calendar-2-fill"></i></div>
                <div class="label">Tanggal</div>
            </button>
            <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]">
                <div class="icon h-5 me-1"><i class="ri-information-fill"></i></div>
                <div class="label">Status</div>
            </button>   
            <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]">
                <div class="icon h-5 me-1"><i class="ri-takeaway-fill"></i></div>
                <div class="label">Pengambilan</div>
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
        </section>
        <section class="order-list-wrapper border border-[#eee] rounded-xl p-4">
            <table class="w-full">
                <thead class="bg-[#f5f5f5] text-[#999] text-sm text-left uppercase rounded-t">
                    @include('admin.order.includes.table-header')
                </thead>
                <tbody class="text-sm">
                    @include('admin.order.includes.table-content')
                    @include('admin.order.includes.table-content')
                    @include('admin.order.includes.table-content')
                    @include('admin.order.includes.table-content')
                    @include('admin.order.includes.table-content')
                    @include('admin.order.includes.table-content')
                    @include('admin.order.includes.table-content')
                    @include('admin.order.includes.table-content')
                    @include('admin.order.includes.table-content')
                    @include('admin.order.includes.table-content')
                </tbody>
            </table>
        </section>
    </div>
</div>
@endsection