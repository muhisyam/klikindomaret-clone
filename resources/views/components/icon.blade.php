@props(['iconStyle' => 'none'])

@php
    $style = match ($iconStyle) {
        'white'       => 'brightness-0 invert',
        'hover-white' => 'group-hover:brightness-0 group-hover:invert',
        'none'        => '',
    }
@endphp

<img {{ $attributes->merge(['class' => $style, 'alt' => 'Icon']) }} loading="lazy">