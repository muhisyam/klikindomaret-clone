@props(['inputStyle' => 'default', 'error' => []])

@php
    $classes = match ($inputStyle) {
        'default' => ' bg-light-gray-50 transition-shadow focus:border-secondary focus:shadow-input focus:outline-secondary',
        'custom'  => '',
    };

    $isError = isset($error['errors'][$attributes['name']]);
@endphp

<textarea {{ $attributes->class(['border-light-gray-50' => ! $isError, 'border-red-600 is-invalid' => $isError])->merge(['class' => 'h-10 w-full rounded-md border border-light-gray-50 py-2 px-3 text-sm text-black' . $classes]) }}></textarea>