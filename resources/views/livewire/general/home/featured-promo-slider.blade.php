<div data-featured-name="{{ $data['data']['featured_name'] }}">
    <div class="mb-4 flex justify-between items-center">
        <h2 class="text-lg text-black font-bold">
            {{ $data['data']['featured_name'] }}
        </h2>
        <x-nav-link href="{{ url($data['data']['featured_redirect_url']) }}" class="text-sm text-secondary" value="Lihat Semua"/>
    </div>
    <div class="swiper" data-swiper-id="{{ $section }}-featured">
        <div class="swiper-wrapper">
        @foreach ($data['data']['featured_promos'] as $promo)

        @php
            $bannerUrl   = $promo['banner_redirect_url'];
            $redirectUrl = $bannerUrl ? url($bannerUrl) : route($promo['banner_route_name'], ['promo' => $promo['banner_slug']]);
        @endphp

            <div class="swiper-slide">
                <a href="{{ $redirectUrl }}" data-banner-url="{{ $redirectUrl }}" data-banner-name="{{ $promo['banner_name'] }}" >
                    <img class="rounded-lg" src="{{ asset('img/uploads/promo-banners/' . $promo['banner_image_name']) }}" alt="{{ $promo['banner_name'] }}">
                </a>
            </div>
        @endforeach
        </div>
    </div>
</div>
