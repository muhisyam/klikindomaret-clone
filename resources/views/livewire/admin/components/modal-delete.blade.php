<div class="modal-delete fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-[60] modal {{ $showModal }}">
    <div class="modal-wrapper min-w-[500px] bg-white rounded">
        <section class="header-section flex items-center justify-between border-b border-[#eee] p-2">
            <div class="left ms-2">
                <figure class="media w-24">
                    <img class="rounded-md" src="{{ asset('img/header/logo.png') }}" alt="">
                </figure>
            </div>
            <div class="right min-w-[50px]">
                <button id="header-button-close" class="block rounded p-1 px-2 ml-auto hover:bg-[#fbde7e] hover:text-[#0079c2]" wire:click="closeModal">
                    <div class="icon h-6 pt-0.5"><i class="ri-close-fill"></i></div>
                </button>
            </div>
        </section>
        <section class="body-section flex flex-col items-center pb-4">
            <figure class="media w-52">
                <img src="{{ url('https://img.freepik.com/premium-vector/flat-design-no-data-illustration_23-2150527115.jpg?w=740') }}" alt="">
            </figure>
            <h2 class="text-lg font-bold mb-2">Delete <span class="text-red-700">"{{ !empty($category) ? $category['category_name'] : '' }}"</span> Category?</h2>
            <div class="text-sm text-center">
                <p>Are you sure want to delete? You can't undo this action.</p>
                <div class="input-group flex items-center justify-center gap-1">
                    <input id="form-input-delete-checkbox" type="checkbox" wire:model.live="checkbox">
                    <label for="form-input-delete-checkbox">Sure, i want to delete this.</label>
                </div>
            </div>
        </section>
        <section class="footer-section pt-2 pb-6">
            <div class="flex justify-center gap-2">
                @if ($checkbox)
                <form action="{{ route('categories.destroy', ['category' => !empty($category) ? $category['id'] : 0]) }}" method="POST">
                    @csrf
                    @method('delete')
    
                    <button type="submit" class="w-40 bg-[#C33] border border-[#C33] text-white rounded py-2">Delete</button>
                </form>
                @else
                <div class="w-40 bg-[#c93636] border border-[#C3] rounded opacity-40 py-1.5">
                    <div class="loader-spin mx-auto"></div>
                </div>
                @endif
                <button id="footer-button-close" class="w-40 border border-[#0079C2] text-[#0079C2] rounded py-2 hover:bg-[#0079c2] hover:text-white" wire:click="closeModal">Close</button>
            </div>
        </section>
    </div>
</div>