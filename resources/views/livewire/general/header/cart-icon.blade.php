<div class="relative me-4 p-1.5 rounded-md hover:bg-dark-primary">
    <x-icon class="w-5" src="{{ asset('img/icons/icon-header-cart.webp') }}"/>
    <x-notification-count class="top-0 -right-1 rounded py-0.5 px-1" count="{{ $cartsCount }}"/>
</div>