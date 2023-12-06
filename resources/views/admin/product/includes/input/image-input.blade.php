<div class="item-input-group mb-6">
    <label for="form-input-image" class="label text-sm mb-1">Tambah Gambar</label>
    <input id="form-input-image" type="file" accept=".jpg, .jpeg, .png" name="product_images[]" class="hidden" multiple>
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
@php $dataimages = isset($data) ? $data['product_images'] : [] @endphp
@forelse ($dataimages as $index => $dataImage)
    <div class="item-image-uploaded | relative">
        <div class="image-item-wrapper | flex items-center justify-between border border-light-grey rounded p-2">
            <div class="image-info-wrapper | w-11/12 flex items-center">
                <figure class="media | max-w-[150px] overflow-x-auto me-2">
                    <img class="h-12 shrink-0" src="{{ asset('img/uploads/products/' . $data['product_slug'] . '/' . $dataImage['product_image_name']) }}" alt="Product Image">
                </figure>
                <div class="image-info">
                    <p class="text | font-bold line-clamp-1 text-ellipsis" data-tooltip-target="image-{{ $index }}-tooltip" data-tooltip-placement="bottom">{{ $dataImage['original_product_image_name'] }}</p>
                    <p class="size | text-xs font-light">{{ $dataImage['product_image_size'] }} KB</p>
                </div>
            </div>
            <div class="action">
                <button type="button" class="icon h-8 text-2xl rounded px-1 hover:bg-tertiary hover:text-secondary" onclick="deleteImage({{ $index }})" aria-label="Delete data image" data-image-name="{{ $dataImage['original_product_image_name'] }}">
                    <i class="ri-delete-bin-6-line"></i>
                </button>
            </div>
        </div>
        <div id="image-{{ $index }}-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-md shadow-sm opacity-0 tooltip">
            {{ $dataImage['original_product_image_name'] }}
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    </div>
@empty
    <div class="list-image-uploaded flex flex-col gap-2 overflow-auto">
        @include('admin.components.validation-message', ['field' => 'product_images', 'validation' => 'multipleImage'])
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
@endforelse