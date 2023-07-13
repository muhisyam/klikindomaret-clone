@extends('admin.index')

@section('title')
List Produk
@endsection

@section('content')
<div class="product-list">
    <div class="product-list-content">
        <h1 class="title text-[#0079c2] text-xl font-bold mb-4">List Produk</h1>
        <section class="product-list-header flex justify-between border border-[#eee] rounded-xl p-4 mb-4">
            <div class="product-filter-wrapper text-sm flex gap-4">
                <div class="product-search-group flex items-center bg-[#f5f5f5] rounded py-2 px-4">
                    <label for="product-search" class="h-5 me-4"><i class="ri-search-line"></i></label>
                    <input id="product-search" type="text" name="product-search" placeholder="Cari Produk..." class="bg-transparent">
                </div>
                <button class="flex items-center bg-[#f5f5f5] rounded py-2 px-4">
                    <div class="label pe-2">Urutkan</div>
                    <div class="icon h-5"><i class="ri-arrow-down-s-line"></i></div>
                </button>
                <button class="flex items-center bg-[#f5f5f5] rounded py-2 px-4">
                    <div class="label pe-2">Kategori</div>
                    <div class="icon h-5"><i class="ri-arrow-down-s-line"></i></div>
                </button>
                <button class="flex items-center bg-[#f5f5f5] rounded py-2 px-4">
                    <div class="label pe-2">Harga</div>
                    <div class="icon h-5"><i class="ri-arrow-down-s-line"></i></div>
                </button>
                <button class="flex items-center bg-[#f5f5f5] rounded py-2 px-4">
                    <div class="label pe-2">Toko</div>
                    <div class="icon h-5"><i class="ri-arrow-down-s-line"></i></div>
                </button>
            </div>
            <div class="product-input-wrapper">
                <a href="#" class="flex items-center bg-[#0079c2] text-white rounded py-2 px-4">
                    <div class="icon h-6 me-2"><i class="ri-add-line"></i></div>
                    <div class="text">Tambah Produk</div>
                </a>
            </div>
        </section>
        <section class="product-list-wrapper border border-[#eee] rounded-xl p-4">
            <table class="w-full">
                <thead>
                    <tr>
                        <td>No.</td>
                        <td>Nama Produk</td>
                        <td>Kategori</td>
                        <td>Harga</td>
                        <td>Toko</td>
                        <td>Stok</td>
                        <td>Terjual</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Sunlight</td>
                        <td>Makanan Kaleng</td>
                        <td>Rp 15.000</td>
                        <td>Toko Indomaret</td>
                        <td>509</td>
                        <td>2206</td>
                        <td><i class="ri-more-2-line"></i></td>
                    </tr>
                </tbody>
                
            </table>
        </section>
    </div>
</div>
@endsection