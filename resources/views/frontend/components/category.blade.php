<div class="bottom-header w-full bg-white hidden">
    <div class="header-overlay fixed w-full h-screen bg-black opacity-50 -z-10 hidden"></div>
    <div class="header-wrapper">
        <div class="top-section menu-category-content shadow mb-[1px]">
            <ul class="list-menu-category text-[#313131] text-sm">
                <li class="item-menu-category w-36 inline-block text-center py-3 active">
                    <a href="https://www.klikindomaret.com/" data-menu-name="Retail">
                        <img class="max-h-[18px] max-w-[18px] inline-block brightness-95 grayscale-[90%] me-2 mb-1" src="https://www.klikindomaret.com/Assets/image/header/ic_retail.png" alt="Menu Category Icon">
                        <span>Retail</span>
                    </a>
                </li>
                <li class="item-menu-category w-36 inline-block text-center py-3">
                    <a href="https://food.klikindomaret.com/" data-menu-name="Food">
                        <img class="max-h-[18px] max-w-[18px] inline-block brightness-95 grayscale-[90%] me-2 mb-1" src="https://www.klikindomaret.com/Assets/image/header/ic_food.png" alt="Menu Category Icon">
                        <span>Food</span>
                    </a>
                </li>
                <li class="item-menu-category w-36 inline-block text-center py-3">
                    <a href="https://virtual.klikindomaret.com/" data-menu-name="Virtual">
                        <img class="max-h-[18px] max-w-[18px] inline-block brightness-95 grayscale-[90%] me-2 mb-1" src="https://www.klikindomaret.com/Assets/image/header/ic_virtual.png" alt="Menu Category Icon">
                        <span>Virtual</span>
                    </a>
                </li>
                <li class="item-menu-category w-36 inline-block text-center py-3">
                    <a href="https://travel.klikindomaret.com/" data-menu-name="Travel">
                        <img class="max-h-[18px] max-w-[18px] inline-block brightness-95 grayscale-[90%] me-2 mb-1" src="https://www.klikindomaret.com/Assets/image/header/ic_travel.png" alt="Menu Category Icon">
                        <span>Travel</span>
                    </a>
                </li>
                <li class="item-menu-category w-36 inline-block text-center py-3">
                    <a href="https://tiket.klikindomaret.com/category/ticket" data-menu-name="Tiket">
                        <img class="max-h-[18px] max-w-[18px] inline-block brightness-95 grayscale-[90%] me-2 mb-1" src="https://www.klikindomaret.com/Assets/image/header/ic_ticket_second.png" alt="Menu Category Icon">
                        <span>Tiket</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="bottom-section list-category-content min-h-[440px]">
            @include('frontend.components.includes.category-retail')
            @include('frontend.components.includes.category-food')
            @include('frontend.components.includes.category-virtual')
            @include('frontend.components.includes.category-travel')
            @include('frontend.components.includes.category-tiket')
        </div>
    </div>
</div>