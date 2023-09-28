<div id="{{ $category['slug'] . '-action' }}" class="absolute top-0 right-9 hidden">
    <div class="w-24 flex justify-end gap-1 overflow-hidden">
        <section class="edit1">
            <a href="{{ route('categories.edit', ['category' => $category['id']]) }}" class="action-edit bg-[#f5f5f5] text-[#999] rounded p-1 px-2 hover:text-[#0079c2] animation animation-bounceInRight animation-delay-200" data-tooltip-target="edit-tooltip" data-tooltip-placement="bottom">
                <div class="icon-edit h-6 pt-0.5"><i class="ri-edit-box-fill"></i></div>
            </a>
            <div id="edit-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white whitespace-nowrap transition-opacity duration-300 bg-gray-900 rounded-md shadow-sm opacity-0 tooltip dark:bg-gray-700">
                edit
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </section>
        <section class="delete1">
            <button class="action-del bg-[#f5f5f5] text-[#999] rounded p-1 px-2 hover:text-[#0079c2] animation animation-bounceInRight" data-category-name="{{ $category['name'] }}" data-tooltip-target="delete-tooltip" data-tooltip-placement="bottom" wire:click="dispatchModal({{ json_encode($category) }})">
                <div class="icon-del h-6 pt-0.5"><i class="ri-delete-bin-6-fill"></i></div>
            </button>
            <div id="delete-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white whitespace-nowrap transition-opacity duration-300 bg-gray-900 rounded-md shadow-sm opacity-0 tooltip dark:bg-gray-700">
                delete
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </section>
    </div>
</div>