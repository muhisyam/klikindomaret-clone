@props(['count'])

<div {{ $attributes->merge(['class' => 'absolute bg-[#ff3e3e] text-[10px] text-white leading-3']) }}>
    {{ $count }}
</div>