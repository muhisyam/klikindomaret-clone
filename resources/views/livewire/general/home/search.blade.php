<div @class([
    'relative search-bar w-[39rem]', 
    'open before:!-z-10' => ! $isAllEmpty
])>
    <form action="{{ route('home.search', ['key' => $key]) }}" @class([
        'overflow-hidden border flex items-center gap-2 bg-white',
        'before:absolute before:z-10 before:-bottom-1 before:h-2.5 before:w-[99.7%] before:bg-white'                 => ! $isAllEmpty,
        'after:absolute after:z-10 after:bottom-0 after:ml-4 after:h-[1px] after:w-[94.5%] after:bg-light-gray-100' => ! $isAllEmpty,
        'shadow-input rounded-t-md rounded-x-md border-secondary !border-b-white'                                   => ! $isAllEmpty,
        'rounded-md border-white'                                                                                   => $isAllEmpty,
    ])>
        <input type="search" class="py-1.5 px-4 w-full text-sm" name="key" placeholder="Mau beli apa hari ini?" wire:model.live.debounce.250ms="key">
        <button type="submit" class="mr-4 rounded py-1 px-3 bg-tertiary" wire:loading.class="hidden">
            <x-icon class="w-4" src="{{ asset('img/icons/icon-header-search.webp') }}"/>
        </button>
        <button type="submit" class="mr-4 rounded py-[7px] px-[15px] bg-tertiary hidden" wire:loading.class.remove="hidden">
            <div class="loader-bullet-flash"></div>
        </button>
    </form>
    
    <div @class([
        'absolute overflow-auto shadow-input rounded-b-md border-x border-b border-secondary max-h-[520px] w-full bg-white pb-2',
        'hidden' => $isAllEmpty,
    ]) data-element="search-result-wrapper">

    @unless (empty($result['banners']))

        <section class="py-4 px-4" data-section="banner">
            <div class="swiper" data-swiper-id="banner-search">
                <div class="swiper-wrapper">

                @foreach ($result['banners'] as $banner)

                    <div class="swiper-slide">
                        <a href="{{ $banner['banner_redirect_url'] ?? route('page.promo', ['promo' => $banner['banner_slug']]) }}" data-banner-name="{{ $banner['banner_name'] }}" >
                            <img class="rounded" src="{{ asset('img/uploads/promo-banners/' . $banner['banner_image_name']) }}" alt="{{ $banner['banner_name'] }}">
                        </a>
                    </div>

                @endforeach

                </div>

                <div class="swiper-button-next !right-[3%] rounded-full shadow-md !w-10 !h-10 bg-white/70 hover:bg-white" id="banner-search-next">
                    <x-icon class="w-7" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                </div>
                <div class="swiper-button-prev !left-[3%] rounded-full shadow-md !w-10 !h-10 bg-white/70 hover:bg-white" id="banner-search-prev">
                    <x-icon class="w-7 scale-x-[-1]" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                </div>
            </div>
        </section>

    @endunless

    @unless (empty($result['keywords']))

        <hr @class([
            'mb-1.5 mx-4', 
            'hidden' => empty($result['banners'])
        ])>

        <section data-section="keywords">
            <h3 class="py-1.5 px-4 font-bold">Kata Kunci</h3>
            <ul class="text-sm">

            @foreach ($result['keywords'] as $keyword)

                <li>
                    <x-nav-link href="{{ route('home.search', ['key' => $keyword['keyword_name']]) }}" class="py-1 px-4 hover:bg-secondary-50">
                        {!! $keyword['highlighted'] !!}
                    </x-nav-link>
                </li>

            @endforeach

            </ul>
        </section>

    @endunless

    @unless (empty($result['categories']))

        <hr @class([
            'my-1.5 mx-4', 
            'hidden' => empty($result['keywords'])
        ])>

        <section data-section="categories">
            <h3 class="py-1.5 px-4 font-bold">Kategori</h3>
            <ul class="text-sm">

            @foreach ($result['categories'] as $keyword)

                <li>
                    <a href="{{ route('home.search', ['key' => $keyword['keyword_name'], 'categories' => $keyword['category_name']]) }}" class="py-1 px-4 block hover:bg-secondary-50">
                        <div>{!! $keyword['highlighted'] !!}</div>
                        <div>di Kategori <span class="text-primary-600">{{ $keyword['category_name'] }}</span></div>
                    </a>
                </li>

            @endforeach

            </ul>
        </section>

    @endunless

    @unless (empty($result['official_stores']))

        <hr @class([
            'my-1.5 mx-4', 
            'hidden' => empty($result['categories'])
        ])>

        <section data-section="official-store">
            <h3 class="py-1.5 px-4 font-bold">Official Store</h3>
            <ul class="px-4 grid grid-cols-4 gap-2 text-sm">

            @foreach ($result['official_stores'] as $store)

                <li>
                    <a href="{{ $store['store_redirect_url'] ?? route('page.store', ['store' => $store['store_slug']]) }}" class="group block p-1 rounded-md hover:bg-secondary-50">
                        <figure class="rounded border border-light-gray-100 h-16 group-hover:border-light-gray-200">
                            <img class="mx-auto h-full w-14 object-cover" src="{{ asset('img/uploads/official-stores/' . $store['store_image_name']) }}" alt="Official store image">
                        </figure>
                        <h4 class="min-h-[40px] text-center text-sm line-clamp-2">{!! $store['store_name'] !!}</h4>
                    </a>
                </li>

            @endforeach

            </ul>
        </section>

    @endunless

    </div>
</div>

@push('scripts')
<script>
    const searchInput = document.querySelector('[name="key"]');

    searchInput.addEventListener('focus', () => {
        const formElement = event.target.parentNode;

        formElement.classList.remove('border-white');
        formElement.classList.add('border-secondary', 'shadow-input');
    });

    searchInput.addEventListener('blur', () => {
        const formElement = event.target.parentNode;
        const rootElement = formElement.parentNode;

        if (! rootElement.classList.contains('open')) {
            formElement.classList.add('border-white');
            formElement.classList.remove('border-secondary', 'shadow-input');
        }
    });
</script>
@endpush