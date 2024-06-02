@props(['amount', 'height' => '9', 'width' => '32'])

@php
    $class = '';

    if ($amount > 1) {
        $class = 'flex flex-1 gap-2';
    }
@endphp

<div {{ $attributes->merge(['class' => 'w-full ' . $class]) }}>

@for ($i = 0; $i < $amount; $i++)
    
    <div class="rounded-md h-{{ $height }} w-{{ $width }} bg-light-gray-100 animate-pulse"></div>
    
@endfor

</div>