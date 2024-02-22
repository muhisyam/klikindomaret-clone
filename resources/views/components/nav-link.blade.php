@props(['value'])

<a {{ $attributes->merge(['class' => 'flex items-center']) }}>
    {{ $value ?? $slot }}
</a>