@props(['class' => 'w-4'])

<img {{ $attributes->merge(['class' => $class, 'alt' => 'Icon']) }}>