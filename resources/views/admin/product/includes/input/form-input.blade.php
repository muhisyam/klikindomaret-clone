<div class="item-input-group mb-4">
    <label for="form-input-product-name" class="block text-sm mb-1">Nama Produk</label>
    <input id="form-input-product-name" type="text" name="product-name" class="h-10 w-full border !border-[#ccc] rounded py-2 px-3 focus:ring-transparent">
</div>
<div class="item-input-group mb-4">
    <label for="form-input-product-slug" class="block text-sm mb-1">Slug</label>
    <input id="form-input-product-slug" type="text" name="product-slug" class="h-10 w-full border !border-[#ccc] rounded py-2 px-3 focus:ring-transparent">
</div>
<div class="item-input-group mb-4">
    <label for="form-select-category" class="block text-sm mb-1">Kategori</label>
    <select id="form-select-category" name="category" class="h-10 w-full border !border-[#ccc] rounded py-2 px-3 focus:ring-transparent">
        <option value="" selected>Pilih induk...</option>
        <option value="">Makanan</option>
        <option value="">Minuman</option>
    </select>
</div>
<div class="item-input-group mb-4">
    <label for="form-input-product-price" class="block text-sm mb-1">Harga</label>
    <input id="form-input-product-price" type="number" name="product-price" class="h-10 w-full border !border-[#ccc] rounded py-2 px-3 focus:ring-transparent">
</div>
<div class="item-input-group mb-4">
    <label for="form-select-store" class="block text-sm mb-1">Toko</label>
    <select id="form-select-store" name="store" class="h-10 w-full border !border-[#ccc] rounded py-2 px-3 focus:ring-transparent">
        <option value="" selected>Pilih Toko...</option>
        <option value="">Toko Indomaret</option>
        <option value="">Warehouse 1 Jakarta</option>
    </select>
</div>
<div class="item-input-group mb-4">
    <label for="form-input-product-stock" class="block text-sm mb-1">Stok</label>
    <input id="form-input-product-stock" type="number" name="product-stock" class="h-10 w-full border !border-[#ccc] rounded py-2 px-3 focus:ring-transparent">
</div>
<div class="item-input-group mb-4">
    <label for="form-input-desc" class="block text-sm mb-1">Deskripsi</label>
    <div id="form-input-desc" class="w-full">
        <input id="desc-label" type="text" name="desc-label" placeholder="Label Deskripsi..." class="w-full h-10 border !border-[#ccc] rounded py-2 px-3 mb-4 focus:ring-transparent">
        <textarea id="desc-info" name="desc-info" cols="30" rows="5" placeholder="Deskripsi..." class="w-full border !border-[#ccc] rounded py-2 px-3 focus:ring-transparent"></textarea>
    </div>
</div>
<div class="item-input-group mb-4">
    <label for="form-input-desc" class="block text-sm mb-1">Deskripsi Tambahan</label>
    <div id="form-input-desc" class="w-full">
        <input id="desc-label" type="text" name="addon-desc-label" placeholder="Label Deskripsi..." class="w-full h-10 border !border-[#ccc] rounded py-2 px-3 mb-4 focus:ring-transparent">
        <textarea id="desc-info" name="addon-desc-info" cols="30" rows="5" placeholder="Deskripsi..." class="w-full border !border-[#ccc] rounded py-2 px-3 focus:ring-transparent"></textarea>
    </div>
</div>
<div class="item-input-group ">
    <div id="form-input-desc" class="flex gap-4">
        <button type="button" id="btnAddDesc" class="h-10 flex items-center bg-[#0079c2] text-white rounded py-2 px-4">
            <span class="icon h-6 me-1"><i class="ri-add-fill"></i></span>
            <span class="text">Tambah Deskripsi</span>
        </button>
        <button type="button" id="btnDelDesc" class="h-10 flex items-center bg-[#c33] text-white rounded py-2 px-4">
            <span class="icon h-6 me-1"><i class="ri-delete-bin-6-line"></i></span>
            <span class="text">Hapus Deskripsi</span>
        </button>
    </div>
</div>
<div id="alert" class="desc-alert-info absolute top-2 left-1/2 -translate-x-1/2 flex p-4 mb-6 text-red-800 rounded-lg bg-red-50" role="alert">
    <span class="icon text-[#c33] text-2xl me-2"><i class="ri-information-fill"></i></span>
    <div class="text-sm font-medium">
        Pastikan kamu sudah menandai titik lokasi dengan benar pada alamat yang dipilih untuk pengantaran pesanan.
    </div>
    <button type="button" class="h-8 w-8 grid place-content-center ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200" data-dismiss-target="#alert" aria-label="Close">
        <span class="icon h-8 text-[#c33] text-2xl"><i class="ri-close-line"></i></span>
    </button>
</div>