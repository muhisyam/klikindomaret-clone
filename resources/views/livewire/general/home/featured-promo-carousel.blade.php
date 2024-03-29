<div data-featured-name="{{ $data['data']['featured_name'] }}" data-swiper-carousel="">
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
        <div class="swiper-button-next !right-[16%] rounded-full shadow-md !w-11 !h-11 bg-white" id="{{ $section }}-featured-next">
            <x-icon class="w-7" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
        </div>
        <div class="swiper-button-prev !left-[14.5%] rounded-full shadow-md !w-11 !h-11 bg-white" id="{{ $section }}-featured-prev">
            <x-icon class="w-7 scale-x-[-1]" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
        </div>
        <div class="swiper-pagination !absolute !left-1/2 !-translate-x-1/2 !-translate-y-1 px-3 rounded-[20px] table !w-fit bg-[#41414142]"></div>
    </div>
</div>