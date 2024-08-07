@props(['value', 'buttonStyle' => 'custom', 'preventClose' => true])

@php
    $style = match ($buttonStyle) {
        'secondary'         => ' border border-secondary bg-secondary text-white',
        'outline-secondary' => ' border border-secondary bg-white text-secondary',
        'danger'            => ' border border-danger bg-danger text-white',
        'custom'            => '',
    }
@endphp

<button {{ $attributes->merge(['type' => 'button', 'class' => 'flex items-center rounded-md hover:opacity-90' . $style]) }} {!! $preventClose ? 'prevent-close=""' : '' !!}>
    {{ $value ?? $slot }}
</button>