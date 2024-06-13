<div class="modal rounded-xl min-w-[500px] bg-white{{ $showCondition ? ' show' : '' }}" data-trigger-modal="{{ $section }}" data-trigger-modal>
    <section class="p-2 border-b border-light-gray-100 flex items-center justify-center">
        <x-icon class="ms-2 w-24" src="{{ asset('img/header/logo.png') }}"/>
    
        <x-button class="ml-auto p-2 h-7 w-7 group hover:bg-tertiary" data-target-modal="{{ $section }}">
            <x-icon class="h-3 grayscale group-hover:grayscale-0" src="{{ asset('img/icons/icon-header-close.webp') }}"/>
        </x-button>

        <span class="!absolute top-2 right-2 inline-flex loader-spin" wire:loading></span>
    </section>
    <section class="pb-6 flex flex-col items-center">
        <img class="w-52" src="{{ url('https://img.freepik.com/premium-vector/flat-design-no-data-illustration_23-2150527115.jpg?w=740') }}" alt="">
        <div class="mb-2 text-lg font-bold">
            Hapus {{ $catalogName }} <span class="text-danger">"{{ $contentName }}"</span>?
        </div>
        <div class="mb-6 text-sm text-center">
            <p>Yakin ingin menghapus? Tindakan ini tidak dapat dibatalkan</p>
            <div class="flex items-center justify-center gap-1">
                <input id="form-input-delete-checkbox" type="checkbox" wire:model.live="checkbox">
                <label for="form-input-delete-checkbox">Tentu, saya ingin menghapus ini.</label>
            </div>
        </div>
        <div class="flex justify-center gap-2">
            <x-button class="w-40 justify-center" data-target-modal="{{ $section }}" buttonStyle="outline-secondary" value="Close"/>

        @if ($checkbox)

            <x-button class="py-2 w-40 justify-center" buttonStyle="danger" value="Delete" wire:click="delete"/>
                
        @else
            
            <div class="rounded-md py-1.5 border border-danger w-40 bg-danger opacity-40 ">
                <div class="loader-spin mx-auto"></div>
            </div>

        @endif

        </div>
    </section>
</div>