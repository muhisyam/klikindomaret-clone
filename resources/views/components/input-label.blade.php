@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm mb-1']) }}>
    {{ $value ?? $slot }}
</label>