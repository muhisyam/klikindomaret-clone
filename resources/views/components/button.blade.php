@props(['buttonStyle' => 'custom', 'additional'])

@php
    $identicalClass = isset($additional) ? $additional . ' | ' : ''; 

    $classes = match ($buttonStyle) {
        'secondary' => 'bg-secondary text-white ',
        'custom' => '',
    }
@endphp

<button {{ $attributes->merge(['type' => 'button', 'class' => $identicalClass . 'flex items-center rounded-lg' . $classes]) }}>
    {{ $slot }}
</button>