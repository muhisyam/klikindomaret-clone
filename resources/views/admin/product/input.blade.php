@extends('admin.index')

@section('title')
Input Produk
@endsection

@section('content')
<div class="product-input">
    <div class="product-input-wrapper border border-[#eee] rounded-xl p-4 pb-16">
        <h1 class="title text-[#0079c2] text-xl font-bold mb-4">Input Produk</h1>
        <form action="">
            <div class="item-input-group flex items-center gap-4 mb-4">
                <label for="form-input-product-name" class="w-1/6 text-[#959595]">Nama Produk</label>
                <input id="form-input-product-name" type="text" name="product-name"" class="h-10 w-5/6 border !border-[#ccc] rounded py-2 px-3 focus:ring-transparent">
            </div>
            <div class="item-input-group flex items-center gap-4 mb-4">
                <label for="form-input-slug" class="w-1/6 text-[#959595]">Slug</label>
                <input id="form-input-slug" type="text" name="slug" class="h-10 w-5/6 border !border-[#ccc] rounded py-2 px-3 focus:ring-transparent">
            </div>
            <div class="item-input-group flex items-center gap-4 mb-4">
                <label for="form-select-category" class="w-1/6 text-[#959595]">Kategori</label>
                <select id="form-select-category" name="category" class="h-10 w-5/6 border !border-[#ccc] rounded py-2 px-3 focus:ring-transparent">
                    <option value="" selected>Pilih induk...</option>
                    <option value="">Makanan</option>
                    <option value="">Minuman</option>
                </select>
            </div>
            <div class="item-input-group flex gap-4 mb-4">
                <label for="form-input-desc" class="w-1/6 text-[#959595] pt-2">Deskripsi</label>
                <div id="form-input-desc" class="w-5/6">
                    <input id="desc-label" type="desc-text" name="label" placeholder="Label Deskripsi..." class="w-full h-10 border !border-[#ccc] rounded py-2 px-3 mb-4 focus:ring-transparent">
                    <textarea id="desc-info" name="desc-info" cols="30" rows="5" placeholder="Deskripsi..." class="w-full border !border-[#ccc] rounded py-2 px-3 focus:ring-transparent"></textarea>
                </div>
            </div>
            <div class="item-input-group flex gap-4 mb-4">
                <label for="form-input-desc" class="w-1/6 text-[#959595] pt-2">Deskripsi Tambahan</label>
                <div id="form-input-desc" class="w-5/6">
                    <input id="desc-label" type="addon-desc-text" name="label" placeholder="Label Deskripsi..." class="w-full h-10 border !border-[#ccc] rounded py-2 px-3 mb-4 focus:ring-transparent">
                    <textarea id="desc-info" name="addon-desc-info" cols="30" rows="5" placeholder="Deskripsi..." class="w-full border !border-[#ccc] rounded py-2 px-3 focus:ring-transparent"></textarea>
                </div>
            </div>
            <div class="item-input-group flex gap-4 mb-4">
                <label for="form-input-desc" class="w-1/6 text-[#959595] pt-2">Deskripsi Tambahan #2</label>
                <div id="form-input-desc" class="w-5/6">
                    <button class="h-10 flex items-center bg-[#0079c2] text-white rounded py-2 px-4">
                        <span class="icon h-6 me-1"><i class="ri-add-fill"></i></span>
                        <span class="text">Tambah Deskripsi</span>
                    </button>
                </div>
            </div>
            <div class="item-input-group relative flex items-center gap-4 mb-4">
                <label for="form-input-price" class="w-1/6 text-[#959595]">Harga</label>
                <input id="form-input-price" type="number" name="price" class="h-10 w-5/6 border !border-[#ccc] rounded py-2 px-3 focus:ring-transparent">
            </div>
            <div class="item-input-group relative flex items-center gap-4 mb-4">
                <label for="form-input-discount" class="w-1/6 text-[#959595]">Harga Diskon</label>
                <input id="form-input-discount" type="number" name="discount" class="h-10 w-5/6 border !border-[#ccc] rounded py-2 px-3 focus:ring-transparent">
                <div class="discout-preview absolute top-0 right-0 bg-red-400 text-white rounded-r py-2 px-4">
                    <div>Persentase Diskon: <span>10</span>%</div>
                </div>
            </div>
            <div class="item-input-group flex items-center gap-4 mb-4">
                <label for="form-select-store" class="w-1/6 text-[#959595]">Toko</label>
                <select id="form-select-store" name="store" class="h-10 w-5/6 border !border-[#ccc] rounded py-2 px-3 focus:ring-transparent">
                    <option value="" selected>Pilih Toko...</option>
                    <option value="">Toko Indomaret</option>
                    <option value="">Warehouse 1 Jakarta</option>
                </select>
            </div>
            <div class="item-input-group flex items-center gap-4 mb-4">
                <label for="form-input-stock" class="w-1/6 text-[#959595]">Stok</label>
                <input id="form-input-stock" type="number" name="stock" class="h-10 w-5/6 border !border-[#ccc] rounded py-2 px-3 focus:ring-transparent">
            </div>
            <div class="item-input-group flex items-center gap-4 mb-4">
                <label for="form-input-product-image" class="w-1/6 text-[#959595]">Gambar Produk</label>
                <input type="file" name="product-image" id="form-input-product-image" class="h-10 py-2">
            </div>
            <div class="form-button flex gap-4">
                <div class="w-1/6"></div>
                <button class="h-10 w-full max-w-[35%] bg-[#0079c2] text-white rounded py-2 px-4 disabled">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection