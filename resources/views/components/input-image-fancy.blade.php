<div class="relative w-full h-48 flex flex-col justify-center bg-primary-50 border-4 border-primary border-dashed rounded-lg mb-6">
    <div id="drop-area-image" class="absolute top-0 left-0 w-full h-full grid place-content-center bg-black text-white text-2xl rounded-lg z-10">Drop it like it's hot.</div>
    <x-icon class="mb-3 mx-auto h-20" src="{{ asset('img/icons/icon-image.webp') }}"/>
    <div class="flex items-center justify-center gap-1.5">
        <span>Drop your images here, or </span>
        <button type="button" id="browse-img" class="relative text-secondary font-bold z-20">Browse</button>
    </div>
    <p class="text-light-gray-300 text-xs text-center">
        (max image size 500kb)
    </p>
</div>