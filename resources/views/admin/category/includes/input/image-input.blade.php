<div class="item-input-group mb-4">
    <label for="form-input-image" class="label text-sm mb-1">Tambah Gambar</label>
    <input id="form-input-image" type="file" accept=".jpg, .jpeg, .png" name="category_image" class="hidden">
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
<div class="list-image-uploaded flex flex-col gap-2">
    @include('admin.components.validation-message', ['field' => 'category_image', 'validation' => 'image'])
    @isset($data['category_image_name'])
    <div class="item-image-uploaded">
        <div class="item-image-wrapper flex items-center justify-between border border-[#eee] rounded p-2">
            <div class="image-info-wrapper w-11/12 flex items-center">
                <figure class="media shrink-0 me-2">
                    <img class="h-12" src="{{ asset('img/uploads/categories/' . $data['category_image_name']) }}" alt="Category Image">
                </figure>
                <div class="info">
                    <p class="text font-bold line-clamp-1 text-ellipsis">{{ $data['original_category_image_name'] }}</p>
                    <p class="size text-xs font-light">142 KB</p>
                </div>
            </div>
            <div class="action">
                <button type="button" class="icon h-8 text-2xl rounded px-1 hover:bg-[#fbde7e] hover:text-[#0079c2]"  onclick="removeImage(this)" aria-label="Delete data image" data-original-image-name="{{ $data['original_category_image_name'] }}" data-image-name="{{ $data['category_image_name'] }}">
                    <i class="ri-delete-bin-6-line"></i>
                </button>
            </div>
        </div>
    </div>
    @else
    <div class="item-no-image flex items-center justify-between border border-[#eee] rounded p-2">
        <div class="image-info-wrapper w-11/12 flex items-center">
            <div class="media h-12 w-12 grid place-items-center shrink-0 bg-[#fbf0d0] text-[#0079c2] text-2xl text-center rounded me-2">
                <div class="icon jump"><i class="ri-upload-cloud-line"></i></div>
            </div>
            <div class="info">
                <p class="text font-bold line-clamp-1 text-ellipsis">Tidak ada gambar.</p>
            </div>
        </div>
    </div>
    @endisset
</div>