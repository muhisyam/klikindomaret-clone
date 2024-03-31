@props(['inputStyle' => 'default', 'error' => null])

@php
    $classes = match ($inputStyle) {
        'default' => ' bg-light-gray-50 transition-shadow focus:border-secondary focus:shadow-input focus:outline-secondary',
        'custom' => '',
    };

    $isError = array_key_exists($attributes['name'], is_array($error) ? $error['errors'] : ['errors' => []]);
@endphp

<input {{ $attributes->merge(['class' => 'hidden', 'type' => 'file']) }}>
<div @class([
    'border-2 border-dashed rounded-md flex items-center h-10 w-full bg-tertiary',
    'border-primary' => ! $isError,
    'border-red-600' => $isError,
])>
    <div data-image-target="input-image-simple" class="flex opacity-0 duration-500"></div>
    <x-button class="ms-auto h-9 w-full min-w-[40px] justify-center duration-1000 hover:bg-primary" data-image-trigger="input-image-simple">
        <x-icon class="w-3 rotate-45 duration-500" src="{{ asset('img/icons/icon-header-close.webp') }}" />
    </x-button>
</div>

@push('scripts')

    <script type="module">
        import { SimpleImageUploader } from "{{ asset('js/' . config('view.js_component')) }}";

        function initImageUpload() {
            const browseImgBtn = document.querySelector('button[data-image-trigger]');
            const formInputImg = document.querySelector('input[id*="image"]');
            
            browseImgBtn.addEventListener('click', () => formInputImg.click());
            formInputImg.addEventListener('change', (e) => new SimpleImageUploader(e.target));
        }

        initImageUpload();
    </script>

@endpush