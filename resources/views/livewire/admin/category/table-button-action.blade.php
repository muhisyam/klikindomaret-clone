<div id="{{ $category['category_slug'] . '-action' }}" class="absolute top-0 right-9 hidden" wire:ignore>
    <div class="w-24 flex justify-end gap-1 overflow-hidden">
        <a href="{{ route('categories.edit', ['category' => $category['category_slug']]) }}" class="action-edit bg-[#f5f5f5] text-[#999] animation animation-bounceInRight animation-delay-200 rounded p-1 px-2 hover:text-[#0079c2]" title="Edit">
            <div class="icon-edit h-6 pt-0.5"><i class="ri-edit-box-fill"></i></div>
        </a>
        <button class="action-del bg-[#f5f5f5] text-[#999] rounded p-1 px-2 hover:text-[#0079c2] animation animation-bounceInRight" data-category-name="{{ $category['category_name'] }}" wire:click="dispatchModal({{ json_encode($category) }})" title="Delete">
            <div class="icon-del h-6 pt-0.5"><i class="ri-delete-bin-6-fill"></i></div>
        </button>
    </div>
</div>