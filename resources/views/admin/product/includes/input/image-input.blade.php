<div class="item-input-group mb-6">
    <label for="form-input-image" class="label text-sm mb-1">Tambah Gambar</label>
    <input id="form-input-image" type="file" accept="image/" name="product-img[]" class="hidden" multiple>
    <div class="input-image-wrapper relative w-full h-48 flex flex-col justify-center bg-[#fbf0d0] border-4 border-[#f9c828] border-dashed rounded-lg mb-6">
        <div id="drop-area-image" class="absolute top-0 left-0 w-full h-full grid place-content-center bg-black text-white text-2xl rounded-lg z-10">Drop it like it's hot.</div>
        <div class="icon h-24 text-[#aca595] text-8xl text-center mb-3"><i class="ri-image-add-fill"></i></div>
        <div class="info flex items-center justify-center">
            <p class="icon h-7 text-[#0079c2] text-xl me-2"><i class="ri-upload-2-line"></i></p>
            <p class="text">
                Drop your images here, or <button type="button" id="browse-img" class="relative text-[#0079c2] font-bold z-20">Browse</button>
            </p>
        </div>
        <p class="validation text-[#aca595] text-xs text-center">
            (max image size 500kb)
        </p>
    </div>
</div>
<div class="list-image-uploaded flex flex-col gap-2 overflow-auto">
    <div class="item-no-image flex items-center justify-between border border-[#eee] rounded p-2">
        <div class="image-info-wrapper w-11/12 flex items-center">
            <div class="media h-12 w-12 grid place-items-center shrink-0 bg-[#fbf0d0] text-[#0079c2] text-2xl text-center rounded me-2">
                <div class="icon animate__animated animate__rubberBand animate__infinite"><i class="ri-upload-cloud-line"></i></div>
            </div>
            <div class="info">
                <p class="text font-bold line-clamp-1 text-ellipsis">Tidak ada gambar.</p>
            </div>
        </div>
    </div>
</div>