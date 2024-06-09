<div {{ $attributes->merge(['id' => 'page-loader', 'class' => 'fixed left-0 top-0 z-[80] !my-0 h-full w-full bg-black/50 hidden']) }}>
    <img class="absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 rounded-full loader-pulse" src="{{ asset('img/icons/icon-loader-domar.webp') }}">
</div>