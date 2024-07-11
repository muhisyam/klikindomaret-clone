@props(['amount', 'width' => '132px'])

@php
    $width = 'w-[' . $width . ']';
@endphp

@for ($i = 0; $i < $amount; $i++)

<div {{ $attributes->merge(['class' => 'p-2 ' . $width]) }}>
    <div class="mb-4 rounded-lg h-[150px] w-full bg-light-gray-100 animate-pulse"></div>
    <div class="mb-1 rounded-lg h-4 w-32 bg-light-gray-100 animate-pulse"></div>
    <div class="mb-2 rounded-lg h-3 w-28 bg-light-gray-100 animate-pulse"></div>
    <div class="mb-4 rounded-lg h-4 w-32 bg-light-gray-100 animate-pulse"></div>
    <div class="rounded-lg h-8 w-full bg-light-gray-100 animate-pulse"></div>
</div>

@endfor