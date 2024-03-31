@props(['value', 'arrow' => true])

<div {{ $attributes->merge(['class' => 'tooltip absolute z-50 invisible inline-block px-2 py-1 text-xs font-medium text-white whitespace-nowrap transition-opacity duration-300 bg-gray-900 rounded-md shadow-sm opacity-0', 'role' => 'tooltip']) }}>
    {{ $value ?? $slot }}
    {!! $arrow ? '<div class="tooltip-arrow" data-popper-arrow></div>' : '' !!}
</div>

@push('scripts')

    <script type="module">
        import { initTooltips } from "{{ asset('js/' . config('view.js_component')) }}";

        initTooltips();
    </script>

@endpush