@extends('admin.index')

@section('title')
Input Produk
@endsection

@section('content')
<div class="product-input">
    <div class="product-input-content">
        <h1 class="title text-[#0079c2] text-xl font-bold mb-4">Tambah Produk</h1>
        <form action="">
            <div class="product-input-wrapper flex gap-4 pb-5">
                <div class="left-side w-2/5 border border-[#eee] rounded-xl p-4">
                    <div class="label text-sm mb-1">Tambah Gambar</div>
                    <div class="input-image-wrapper w-full h-56 flex flex-col justify-center bg-[#fbf0d0] border-4 border-[#f9c828] border-dashed rounded-lg mb-6">
                        <div class="icon h-24 text-[#aca595] text-8xl text-center mb-5"><i class="ri-image-add-fill"></i></div>
                        <div class="info flex items-center justify-center">
                            <div class="icon h-7 text-[#0079c2] text-xl me-2"><i class="ri-upload-2-line"></i></div>
                            <div class="text">
                                Drop your images here, or <a href="" class="text-[#0079c2] font-bold">Browse</a>
                            </div>
                        </div>
                    </div>
                    <div class="list-image-uploaded flex flex-col gap-2 overflow-auto">
                        <div class="item-image-uploaded flex items-center justify-between border border-[#eee] rounded p-2">
                            <div class="image-info-wrapper w-11/12 flex items-center">
                                <div class="media shrink-0 me-2">
                                    <img class="h-12" src="https://assets.klikindomaret.com/products/banner/OBAT%20HERBAL%20TRADISIO.jpeg" alt="">
                                </div>
                                <div class="info">
                                    <div class="text font-bold line-clamp-1 text-ellipsis">OBAT HERBAL TRADISIO OBAT HERBAL TRADISIO OBAT HERBAL TRADISIO.jpeg</div>
                                    <div class="size text-xs font-light">142 KB</div>
                                </div>
                            </div>
                            <div class="action">
                                <button class="icon h-8 text-2xl rounded px-1 hover:bg-[#fbde7e] hover:text-[#0079c2]">
                                    <i class="ri-delete-bin-6-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="item-image-uploaded flex items-center justify-between border border-[#eee] rounded p-2">
                            <div class="image-info-wrapper w-11/12 flex items-center">
                                <div class="media shrink-0 me-2">
                                    <img class="h-12" src="https://assets.klikindomaret.com/products/20035630/20035630_thumb.jpg?Version.20.01.1.01" alt="">
                                </div>
                                <div class="info">
                                    <div class="text font-bold line-clamp-1 text-ellipsis">OBAT HERBAL TRADISIO OBAT HERBAL TRADISIO OBAT HERBAL TRADISIO.jpeg</div>
                                    <div class="size text-xs font-light">142 KB</div>
                                </div>
                            </div>
                            <div class="action">
                                <button class="icon h-8 text-2xl rounded px-1 hover:bg-[#fbde7e] hover:text-[#0079c2]">
                                    <i class="ri-delete-bin-6-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="item-image-uploaded flex items-center justify-between border border-[#eee] rounded p-2">
                            <div class="image-info-wrapper w-11/12 flex items-center">
                                <div class="media shrink-0 me-2">
                                    <img class="h-12" src="https://assets.klikindomaret.com/products/banner/OBAT%20HERBAL%20TRADISIO.jpeg" alt="">
                                </div>
                                <div class="info">
                                    <div class="text font-bold line-clamp-1 text-ellipsis">OBAT HERBAL TRADISIO OBAT HERBAL TRADISIO OBAT HERBAL TRADISIO.jpeg</div>
                                    <div class="size text-xs font-light">142 KB</div>
                                </div>
                            </div>
                            <div class="action">
                                <button class="icon h-8 text-2xl rounded px-1 hover:bg-[#fbde7e] hover:text-[#0079c2]">
                                    <i class="ri-delete-bin-6-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="item-image-uploaded flex items-center justify-between border border-[#eee] rounded p-2">
                            <div class="image-info-wrapper w-11/12 flex items-center">
                                <div class="media shrink-0 me-2">
                                    <img class="h-12" src="https://assets.klikindomaret.com/products/20035630/20035630_thumb.jpg?Version.20.01.1.01" alt="">
                                </div>
                                <div class="info">
                                    <div class="text font-bold line-clamp-1 text-ellipsis">OBAT HERBAL TRADISIO OBAT HERBAL TRADISIO OBAT HERBAL TRADISIO.jpeg</div>
                                    <div class="size text-xs font-light">142 KB</div>
                                </div>
                            </div>
                            <div class="action">
                                <button class="icon h-8 text-2xl rounded px-1 hover:bg-[#fbde7e] hover:text-[#0079c2]">
                                    <i class="ri-delete-bin-6-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="item-image-upload flex items-center justify-between border border-[#eee] rounded p-2">
                            <div class="image-info-wrapper w-11/12 flex items-center">
                                <div class="media h-12 w-12 grid place-items-center shrink-0 bg-[#fbf0d0] text-[#0079c2] text-2xl text-center rounded me-2">
                                    <div class="icon jump"><i class="ri-upload-cloud-line"></i></div>
                                </div>
                                <div class="info">
                                    <div class="text font-bold line-clamp-1 text-ellipsis">OBAT HERBAL TRADISIO OBAT HERBAL TRADISIO OBAT HERBAL TRADISIO.jpeg</div>
                                    <div class="upload-progress h-1 bg-[#e6e6e6] mb-1">
                                        <div class="upload-progress-bar bg-[#f9c828]" style="width: 78%">
                                        </div>
                                    </div>
                                    <div class="size text-xs font-light"><span>78</span>% Done</div>
                                </div>
                            </div>
                            <div class="action">
                                <button class="icon h-8 text-2xl rounded px-1 hover:bg-[#fbde7e] hover:text-[#0079c2]">
                                    <i class="ri-delete-bin-6-line"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right-side w-3/5 border border-[#eee] rounded-xl overflow-auto p-4">        
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
                            <button class="h-10 flex items-center bg-[#0079c2] text-white rounded py-2 px-4">
                                <span class="icon h-6 me-1"><i class="ri-add-fill"></i></span>
                                <span class="text">Tambah Deskripsi</span>
                            </button>
                            <button class="h-10 flex items-center bg-[#c33] text-white rounded py-2 px-4">
                                <span class="icon h-6 me-1"><i class="ri-delete-bin-6-line"></i></span>
                                <span class="text">Hapus Deskripsi</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-button text-right">
                <button class="h-10 w-full max-w-[20%] bg-[#0079c2] text-white rounded py-2 px-4 disabled">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection