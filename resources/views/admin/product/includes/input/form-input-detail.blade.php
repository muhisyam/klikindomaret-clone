<div class="item-input-group mb-4">
    <label for="form-input-plu" class="block text-sm mb-1">PLU</label>
    <input id="form-input-plu" type="number" name="plu" class="h-10 w-full border border-[#ccc] rounded py-2 px-3 focus:ring-transparent">
</div>
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
    <input id="form-input-product-price" type="number" name="product_price" class="h-10 w-full border border-[#ccc] rounded py-2 px-3 focus:ring-transparent">
</div>
<div class="item-input-group mb-4">
    <label for="form-input-discount_price-price" class="block text-sm mb-1">Harga Diskon</label>
    <input id="form-input-discount_price-price" type="number" name="discount_price" class="h-10 w-full border border-[#ccc] rounded py-2 px-3 focus:ring-transparent">
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
    <input id="form-input-product-stock" type="number" name="product_stock" class="h-10 w-full border border-[#ccc] rounded py-2 px-3 focus:ring-transparent">
</div>
<div class="item-input-group mb-4">
    <label for="form-select-product-status" class="block text-sm mb-1">Status</label>
    <select id="form-select-product-status" name="product_status">
        <option></option>
        <option value="x">Draft</option>
        <option value="c">Publish</option>
    </select>
</div>
