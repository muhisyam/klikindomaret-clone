<div class="label text-sm mb-1">Tambah Gambar</div>
<div class="input-image-wrapper w-full h-48 flex flex-col justify-center bg-[#fbf0d0] border-4 border-[#f9c828] border-dashed rounded-lg mb-6">
    <div class="icon h-24 text-[#aca595] text-8xl text-center mb-3"><i class="ri-image-add-fill"></i></div>
    <div class="info flex items-center justify-center">
        <div class="icon h-7 text-[#0079c2] text-xl me-2"><i class="ri-upload-2-line"></i></div>
        <div class="text">
            Drop your images here, or <button type="button" class="text-[#0079c2] font-bold">Browse</button>
        </div>
    </div>
    <div class="validation text-[#aca595] text-xs text-center">
        (max image size 500kb)
    </div>
</div>
<div class="list-image-uploaded flex flex-col gap-2 overflow-auto">
    <div class="item-image-uploaded">
        <div class="item-image-wrapper flex items-center justify-between border border-[#eee] rounded p-2 is-invalid">
            <div class="image-info-wrapper w-11/12 flex items-center">
                <div class="media shrink-0 me-2">
                    <img class="h-12" src="https://assets.klikindomaret.com///products/banner/15-Icon-Makanan-R1.png" alt="">
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
        <div class="invalid-feedback flex text-red-600 text-sm mt-1">
            <div class="icon h-5 me-1"><i class="ri-error-warning-fill"></i></div>
            <div class="message">Ukuran gambar >500kb</div>
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