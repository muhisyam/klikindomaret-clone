@extends('admin.index')

@section('title')
Input Produk
@endsection

@section('content')
<div class="product-input">
    <div class="product-input-content">
        <h1 class="title text-[#0079c2] text-xl font-bold mb-4">Tambah Produk</h1>
        <div class="product-input-wrapper flex gap-4 pb-5">
            <div class="left-side w-2/5 border border-[#eee] rounded-xl p-4">
                <div class="label text-sm mb-2">Tambah Gambar</div>
                <div class="input-image-wrapper w-full h-56 flex flex-col justify-center bg-[#fbf0d0] border-4 border-[#f9c828] border-dashed rounded-lg mb-6">
                    <div class="icon h-24 text-[#aca595] text-8xl text-center mb-5"><i class="ri-image-add-fill"></i></div>
                    <div class="info flex items-center justify-center">
                        <div class="icon h-7 text-[#0079c2] text-xl me-2"><i class="ri-upload-2-line"></i></div>
                        <div class="text">
                            Drop your images here, or <a href="" class="text-[#0079c2] font-bold">Browse</a>
                        </div>
                    </div>
                </div>
                <div class="list-image-uploaded flex flex-col gap-2">
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
        </div>
        <div class="form-button text-right">
            <button class="h-10 w-full max-w-[20%] bg-[#0079c2] text-white rounded py-2 px-4 disabled">Submit</button>
        </div>
    </div>
</div>
@endsection