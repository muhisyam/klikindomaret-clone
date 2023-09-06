<div class="modal-delete fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-[60] modal">
    <div class="modal-wrapper min-w-[500px] bg-white rounded">
        <section class="header-section flex items-center justify-between border-b border-[#eee] p-2">
            <div class="left ms-2">
                <figure class="media w-24">
                    <img class="rounded-md" src="{{ asset('img/header/logo.png') }}" alt="">
                </figure>
            </div>
            <div class="right min-w-[50px]">
                <button id="header-button-close" class="block rounded p-1 px-2 ml-auto hover:bg-[#fbde7e] hover:text-[#0079c2]">
                    <div class="icon h-6 pt-0.5"><i class="ri-close-fill"></i></div>
                </button>
            </div>
        </section>
        <section class="body-section flex flex-col items-center pb-4">
            <figure class="media w-52">
                <img src="{{ url('https://img.freepik.com/premium-vector/flat-design-no-data-illustration_23-2150527115.jpg?w=740') }}" alt="">
            </figure>
            <h2 class="text-lg font-bold mb-2">Delete Category?</h2>
            <div class="text-sm text-center">
                <p>Are you sure want to delete <strong>"category"</strong>?</p>
                <p>You can't undo this action.</p>
            </div>
        </section>
        <section class="footer-section pt-2 pb-6">
            <div class="flex justify-center gap-2">
                <button id="footer-button-close" class="w-40 border border-[#0079C2] text-[#0079C2] rounded py-2 hover:bg-[#0079c2] hover:text-white">Close</button>
                <a href="" class="w-40 bg-[#C33] border border-[#C33] text-white rounded py-2">Delete</a>
                {{-- route('categories.destroy, ['category' => $]') --}}
            </div>
        </section>
    </div>
</div>