<div class="rounded-lg py-5 px-6 bg-white" data-element="skeleton-product-section">
    <div class="mb-4 flex justify-between">
        <div class="rounded-md h-5 w-40 bg-light-gray-100 animate-pulse"></div>
        <div class="rounded-md h-5 w-40 bg-light-gray-100 animate-pulse"></div>
    </div>
    <div class="flex gap-5 overflow-hidden">
    @for ($i = 0; $i < 8; $i++)
        <div class="p-2 w-44">
            <div class="mb-4 rounded-md h-[150px] w-full bg-light-gray-100 animate-pulse"></div>
            <div class="mb-1 rounded-md h-4 w-32 bg-light-gray-100 animate-pulse"></div>
            <div class="mb-2 rounded-md h-3 w-28 bg-light-gray-100 animate-pulse"></div>
            <div class="mb-4 rounded-md h-4 w-32 bg-light-gray-100 animate-pulse"></div>
            <div class="rounded-md h-8 w-full bg-light-gray-100 animate-pulse"></div>
        </div>
    @endfor
    </div>
</div>