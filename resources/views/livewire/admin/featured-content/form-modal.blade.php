<div class="modal w-96 bg-white rounded-xl{{ $showCondition ? ' show' : '' }}" data-trigger-modal="{{ $section }}">
    <section class="flex items-center justify-center border-b border-light-gray-100 p-3">
        <x-button class="absolute top-0 left-0 h-12 w-12" data-target-modal="{{ $section }}">
            <x-icon class="w-3 m-auto" src="{{ asset('img/icons/icon-header-arrow-left.webp') }}"/>
        </x-button>

        <x-icon class="w-24" src="{{ asset('img/header/logo.png') }}"/>
    </section>

    <section class="p-4">
        <form method="POST" action="{{ route('login.attempt') }}">
            @csrf

            <div class="mb-4">
                <x-input-label for="form-input-featured-name" value="Nama Konten"/>
                <x-input-field id="form-input-featured-name" name="featured_name" :error="session('input_error')"/>
                <x-input-error field="featured_name" :error="session('input_error')"/>
            </div>
            <div class="mb-4">
                <x-input-label for="form-input-featured-slug" value="Slug"/>
                <x-input-field id="form-input-featured-slug" name="featured_slug" :error="session('input_error')"/>
                <x-input-error field="featured_slug" :error="session('input_error')"/>
            </div>
            <div class="mb-4">
                <x-input-label for="form-input-featured-product" value="Tambah Produk"/>
                <select id="form-select-featured-product" name="featured_product" multiple wire:model.live.debounce.250ms="productKey">
                    
                </select>
                <x-input-error field="featured_product" :error="session('input_error')"/>
            </div>
            <x-button type="submit" class="justify-center h-10 px-8 text-sm" buttonStyle="secondary" value="Masuk"/>
        </form>
    </section>
</div>
