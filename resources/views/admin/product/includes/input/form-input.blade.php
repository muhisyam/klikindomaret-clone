<div class="item-input-group mb-4">
    <label for="form-input-product-name" class="block text-sm mb-1">Nama Produk</label>
    <input id="form-input-product-name" type="text" name="product_name" class="h-10 w-full border border-[#ccc] rounded py-2 px-3 focus:ring-transparent">
</div>
<div class="item-input-group mb-4">
    <label for="form-input-product-slug" class="block text-sm mb-1">Slug</label>
    <input id="form-input-product-slug" type="text" name="product_slug" class="h-10 w-full border border-[#ccc] rounded py-2 px-3 focus:ring-transparent">
</div>
<div class="item-input-group mb-4">
    <label for="form-select-category" class="block text-sm mb-1">Kategori</label>
    <select id="form-select-category" name="category" class="is-invalid">
        <option></option>
        <option value="w">Makanan</option>
        <option value="e">Minuman</option>
    </select>
    <div class="invalid-feedback flex text-red-600 text-sm mt-1">
        <p class="icon h-5 me-1"><i class="ri-error-warning-fill"></i></p>
        <p class="message">Input salah!</p>
    </div>
</div>
<div class="item-input-group mb-4">
    <label for="form-input-product-price" class="block text-sm mb-1">Harga</label>
    <input id="form-input-product-price" type="number" name="product-price" class="h-10 w-full border border-[#ccc] rounded py-2 px-3 focus:ring-transparent">
</div>
<div class="item-input-group mb-4">
    <label for="form-select-store" class="block text-sm mb-1">Toko</label>
    <select id="form-select-store" name="store">
        <option></option>
        <option value="x">Toko Indomaret</option>
        <option value="c">Warehouse 1 Jakarta</option>
    </select>
</div>
<div class="item-input-group mb-4">
    <label for="form-input-product-stock" class="block text-sm mb-1">Stok</label>
    <input id="form-input-product-stock" type="number" name="product-stock" class="h-10 w-full border border-[#ccc] rounded py-2 px-3 focus:ring-transparent">
</div>
<div class="item-input-group mb-4">
    <label for="form-input-desc" class="block text-sm mb-1">Deskripsi</label>
    <div id="form-input-desc" class="w-full">
        <input id="desc-label" type="text" name="desc-label" placeholder="Label Deskripsi..." class="w-full h-10 border border-[#ccc] rounded py-2 px-3 mb-4 focus:ring-transparent">
        <textarea id="desc-info" name="desc-info" cols="30" rows="5" placeholder="Deskripsi..." class="w-full border border-[#ccc] rounded py-2 px-3 focus:ring-transparent"></textarea>
    </div>
</div>
<div id="addon-1" class="item-input-group mb-4">
    <label for="form-input-desc-1" class="block text-sm mb-1">Deskripsi Tambahan #1</label>
    <div id="form-input-desc-1" class="w-full">
        <input id="desc-label-1" type="text" name="addon-desc-label" placeholder="Label Deskripsi..." class="w-full h-10 border border-[#ccc] rounded py-2 px-3 mb-4 focus:ring-transparent">
        <textarea id="desc-info-1" name="addon-desc-info-1" cols="30" rows="5" placeholder="Deskripsi..." class="w-full border border-[#ccc] rounded py-2 px-3 focus:ring-transparent"></textarea>
    </div>
</div>
<div id="addon-2" class="item-input-group mb-4 hidden">
    <label for="form-input-desc-2" class="block text-sm mb-1">Deskripsi Tambahan #2</label>
    <div id="form-input-desc-2" class="w-full">
        <input id="desc-label-2" type="text" name="addon-desc-label" placeholder="Label Deskripsi..." class="w-full h-10 border border-[#ccc] rounded py-2 px-3 mb-4 focus:ring-transparent">
        <textarea id="desc-info-2" name="addon-desc-info-2" cols="30" rows="5" placeholder="Deskripsi..." class="w-full border border-[#ccc] rounded py-2 px-3 focus:ring-transparent"></textarea>
    </div>
</div>
<div id="addon-3" class="item-input-group mb-4 hidden">
    <label for="form-input-desc-3" class="block text-sm mb-1">Deskripsi Tambahan #3</label>
    <div id="form-input-desc-3" class="w-full">
        <input id="desc-label-3" type="text" name="addon-desc-label" placeholder="Label Deskripsi..." class="w-full h-10 border border-[#ccc] rounded py-2 px-3 mb-4 focus:ring-transparent">
        <textarea id="desc-info-3" name="addon-desc-info-3" cols="30" rows="5" placeholder="Deskripsi..." class="w-full border border-[#ccc] rounded py-2 px-3 focus:ring-transparent"></textarea>
    </div>
</div>
<div id="addon-4" class="item-input-group mb-4 hidden">
    <label for="form-input-desc-4" class="block text-sm mb-1">Deskripsi Tambahan #4</label>
    <div id="form-input-desc-4" class="w-full">
        <input id="desc-label-4" type="text" name="addon-desc-label" placeholder="Label Deskripsi..." class="w-full h-10 border border-[#ccc] rounded py-2 px-3 mb-4 focus:ring-transparent">
        <textarea id="desc-info-4" name="addon-desc-info-4" cols="30" rows="5" placeholder="Deskripsi..." class="w-full border border-[#ccc] rounded py-2 px-3 focus:ring-transparent"></textarea>
    </div>
</div>
<div id="addon-5" class="item-input-group mb-4 hidden">
    <label for="form-input-desc-5" class="block text-sm mb-1">Deskripsi Tambahan #5</label>
    <div id="form-input-desc-5" class="w-full">
        <input id="desc-label-5" type="text" name="addon-desc-label" placeholder="Label Deskripsi..." class="w-full h-10 border border-[#ccc] rounded py-2 px-3 mb-4 focus:ring-transparent">
        <textarea id="desc-info-5" name="addon-desc-info-5" cols="30" rows="5" placeholder="Deskripsi..." class="w-full border border-[#ccc] rounded py-2 px-3 focus:ring-transparent"></textarea>
    </div>
</div>
<div class="item-input-group">
    <div id="btn-addon-desc" class="flex gap-4">
        <button type="button" id="btnAddDesc" class="h-10 flex items-center bg-[#0079c2] text-white rounded py-2 px-4">
            <div class="icon h-6 me-1"><i class="ri-add-fill"></i></div>
            <div class="text">Tambah Deskripsi</div>
        </button>
        <button type="button" id="btnDelDesc" class="h-10 flex items-center bg-[#c33] text-white rounded py-2 px-4 hidden">
            <div class="icon h-6 me-1"><i class="ri-delete-bin-6-line"></i></div>
            <div class="text">Hapus Deskripsi</div>
        </button>
    </div>
</div>