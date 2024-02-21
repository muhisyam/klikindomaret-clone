<div class="top-header">
    <div class="header-wrapper container mx-auto max-w-7xl h-full">
        <div class="top-section flex justify-between">
            <div class="left-side flex text-xs">
                <div class="app-download my-auto">
                    <div id="dropdown-app-download" data-dropdown-toggle="dropdown-app-id" data-dropdown-offset-distance="5" data-dropdown-placement="bottom-start" class="flex items-center me-5">
                        <span class="icon"><i class="ri-apps-line"></i></span>
                        <span class="mx-1.5">Download App Klik Indomaret</span>
                        <span class="icon"><i class="ri-arrow-drop-down-line"></i></span>
                    </div>

                    <div id="dropdown-app-id"class="dropdown-app z-10 bg-white rounded-lg shadow w-[240px] hidden">
                        <div class="wrapper-dropdown-app p-5">
                            <div class="qrcode">
                                <img src="{{ asset('img/header/qr_download.png') }}" alt="qrcode">
                            </div>
                            <div class="playstore w-[140px] mx-auto my-2.5">
                                <a href="#">
                                    <img src="{{ asset('img/header/logo_googleplay.png') }}" alt="logo_googleplay">
                                </a>
                            </div>
                            <div class="playstore w-[140px] mx-auto my-2.5">
                                <a href="#">
                                    <img src="{{ asset('img/header/logo_appStore.png') }}" alt="logo_appstore">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="social-media flex items-center me-6">
                    <span>Ikuti kami di</span>
                    <a href="https://www.facebook.com/klikindomaret" target="_blank" class="icon mx-2"><i class="ri-facebook-box-fill"></i></a>
                    <a href="https://www.instagram.com/klikindomaret" target="_blank" class="icon"><i class="ri-instagram-fill"></i></a>
                </div>
                <div class="user-service my-auto">
                    <div id="dropdown-user-service" data-dropdown-toggle="dropdown-service-id"  data-dropdown-offset-distance="5" data-dropdown-placement="bottom-end" class="flex items-center">
                        <span class="icon"><i class="ri-customer-service-fill"></i></span>
                        <span class="mx-1.5">Layanan Pelanggan</span>
                        <span class="icon"><i class="ri-arrow-drop-down-line"></i></span>
                    </div>

                    <div id="dropdown-service-id" class="dropdown-service z-10 bg-white rounded-lg shadow w-[275px] hidden text-[#313131]">
                        <div class="wrapper-dropdown-service pt-4 px-3 pb-2">
                            <div class="call-center mb-2.5">
                                <div class="title mb-1 text-[11px]">Call Center :</div>
                                <div class="desc flex">
                                    <span class="icon text-lg me-4"><i class="ri-phone-fill"></i></span>
                                    <div class="wrapper-desc">
                                        <div class="text-[13px]">(021) 1500280</div>
                                        <div class="text-[10px] text-[#95989A]">Senin-Minggu, 08.00-17.00 WIB</div>
                                    </div>
                                </div>
                            </div>
                            <div class="email">
                                <div class="title text-[11px]">Email :</div>
                                <div class="desc flex">
                                    <span class="icon text-lg me-4"><i class="ri-mail-line"></i></span>
                                    <div class="wrapper-desc my-auto">
                                        <div class="text-[13px] mb-1">customercare@klikindomaret.com</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-side h-8 w-1/3 rounded-b-xl drop-shadow-md bg-white overflow-hidden cursor-pointer">
                <div class="first-box flex mx-3.5 mt-1 text-sm">  
                    <span class="icon text-xs pt-[7px]"><i class="ri-map-pin-fill"></i></span>
                    <span class="guest-info ms-2 mt-[-3px] leading-7 text-xs">
                        <span>Harga untuk wilayah JAKARTA PUSAT , Gunung Sahari Selatan</span>
                        <span class="text-[#0079c2]">Masuk dulu yuk untuk ganti alamat & lokasimu</span>
                    </span>
                    <span class="icon pt-1"><i class="ri-arrow-drop-down-line"></i></span>
                </div>
            </div>
        </div>
        <div class="bottom-section flex justify-between pt-3 pb-4">
            <div class="left-side flex items-center w-[80%] max-w-[60rem]">
                <div class="logo">
                    <a href="https://www.klikindomaret.com/">
                        <img class="h-8" src="{{ asset('img/header/logo.png') }}" alt="logo">
                    </a>
                </div>
                <div class="category flex items-center mx-10 text-[#0079c2]" data-tooltip-target="category-tooltip" data-tooltip-placement="bottom" onclick="headerCategory()">
                    <span class="icon mt-0.5"><i class="ri-dashboard-fill"></i></span>
                    <span class="mx-1.5">Kategori</span>
                    <span class="icon mt-0.5"><i class="ri-arrow-drop-down-line"></i></span>
                </div>
                <div id="category-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white whitespace-nowrap transition-opacity duration-300 bg-gray-900 rounded-md shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Lihat Kategori
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                <div class="search-bar w-[39rem]">
                    <form action="">
                        <div class="relative">
                            <input type="search" id="default-search" class="block w-full px-3 py-1.5 text-sm text-[#555] border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 placeholder:text-slate-400" placeholder="Mau beli apa hari ini?" required>
                            
                            <a class="absolute right-5 bottom-[5px] rounded pt-0.5 px-3 text-sm font-bold bg-[#fadd7b]" href="">
                                <i class="ri-search-line text-[#0079c2]"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="right-side relative flex items-center">
                @if(is_null(session('auth_token')))
                    <button class="h-6 w-6 scale-125 text-secondary rounded me-3 hover:bg-dark-primary" data-tooltip-target="shopping-basket-tooltip" data-tooltip-placement="bottom"><i class="ri-shopping-basket-fill"></i></button>
                    <div id="shopping-basket-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white whitespace-nowrap transition-opacity duration-300 bg-gray-900 rounded-md shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Lihat Keranjang
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                    <div class="guest-button text-sm">
                        <button type="button" id="btn-login" class="button-auth  | rounded-lg border border-[#0079c2] me-2 py-1.5 px-4 bg-white text-[#0079c2]" data-modal-open="login">Masuk</button>
                        <button type="button" id="btn-register" class="button-auth  | rounded-lg py-1.5 px-5 bg-[#0079c2] text-white" data-modal-open="register">Daftar</button>
                    </div>
                @else
                    @php
                        //TODO: add tooltips
                    @endphp
                    <x-nav-link href="#" class="relative me-4 rounded-lg p-1.5 text-secondary hover:bg-dark-primary">
                        <x-icon class="w-5" src="{{ asset('img/icons/icon-header-bell.webp') }}"/>
                        <x-notification-count class="top-0 -right-1 rounded py-0.5 px-1" count="99+"/>
                    </x-nav-link>
                    
                    <x-nav-link href="#" class="relative me-4 rounded-lg p-1.5 text-secondary hover:bg-dark-primary">
                        <x-icon class="w-5" src="{{ asset('img/icons/icon-header-status-new.webp') }}"/>
                    </x-nav-link>

                    <x-nav-link href="#" class="relative me-4 rounded-lg p-1.5 text-secondary hover:bg-dark-primary">
                        <x-icon class="w-5" src="{{ asset('img/icons/icon-header-cart.webp') }}"/>
                        <x-notification-count class="top-0 -right-1 rounded py-0.5 px-1" count="99+"/>
                    </x-nav-link>

                    <x-dropdown section="user-account-ewallet">
                        <x-slot name="trigger" class="gap-1.5 me-2 p-1.5 hover:bg-dark-primary">
                            <x-icon class="w-5" src="{{ asset('img/icons/icon-head-wallet.webp') }}"/>
                            <x-icon class="w-1.5 duration-500" src="{{ asset('img/icons/icon-header-chevron-down.webp') }}" data-arrow-dropdown=""/>
                        </x-slot>

                        <x-slot name="content" class="-right-[22px] w-64 p-3 bg-white">
                            <x-button class="group w-full gap-3 mb-3">
                                <x-icon class="w-8 p-1.5 rounded-full shadow-md" src="{{ asset('img/e-wallet/icon-isaku.webp') }}"/>
                                <div class="flex-grow font-bold text-left text-secondary text-sm">
                                    <span class="font-normal text-xs text-light-gray-300">i.saku</span><br>
                                    <span class="group-hover:underline group-hover:underline-offset-2">Hubungkan</span>
                                </div>
                                <x-icon class="w-5" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                            </x-button>

                            <x-button class="group w-full gap-3 mb-3">
                                <x-icon class="w-8 p-1.5 rounded-full shadow-md" src="{{ asset('img/e-wallet/icon-poinku.webp') }}"/>
                                <div class="flex-grow font-bold text-left text-secondary text-sm">
                                    <span class="font-normal text-xs text-light-gray-300">Poinku</span><br>
                                    <span class="group-hover:underline group-hover:underline-offset-2">Hubungkan</span>
                                </div>
                                <x-icon class="w-5" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                            </x-button>

                            <x-button class="group w-full gap-3 mb-3">
                                <x-icon class="w-8 p-1.5 rounded-full shadow-md" src="{{ asset('img/e-wallet/icon-wallet.webp') }}"/>
                                <div class="flex-grow font-bold text-left text-sm">
                                    <span class="font-normal text-xs text-light-gray-300">Saldo Klik</span><br>
                                    <span class="group-hover:underline group-hover:underline-offset-2">Aktivasi</span>
                                </div>
                                <x-icon class="w-5" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                            </x-button>

                            <x-button class="group w-full gap-3 mb-3">
                                <x-icon class="w-8 p-1.5 rounded-full shadow-md" src="{{ asset('img/e-wallet/icon_shopeepay.webp') }}"/>
                                <div class="flex-grow font-bold text-left text-secondary text-sm">
                                    <span class="font-normal text-xs text-light-gray-300">ShopeePay</span><br>
                                    <span class="group-hover:underline group-hover:underline-offset-2">Hubungkan</span>
                                </div>
                                <x-icon class="w-5" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                            </x-button>

                            <x-button class="group w-full gap-3 mb-3">
                                <x-icon class="w-8 p-1.5 rounded-full shadow-md" src="{{ asset('img/e-wallet/icon-ovo.webp') }}"/>
                                <div class="flex-grow font-bold text-left text-secondary text-sm">
                                    <span class="font-normal text-xs text-light-gray-300">OVO</span><br>
                                    <span class="group-hover:underline group-hover:underline-offset-2">Hubungkan</span>
                                </div>
                                <x-icon class="w-5" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                            </x-button>

                            <x-button class="group w-full gap-3 mb-3">
                                <x-icon class="w-8 p-1.5 rounded-full shadow-md" src="{{ asset('img/e-wallet/icon-gopay.webp') }}"/>
                                <div class="flex-grow font-bold text-left text-secondary text-sm">
                                    <span class="font-normal text-xs text-light-gray-300">Gopay</span><br>
                                    <span class="group-hover:underline group-hover:underline-offset-2">Hubungkan</span>
                                </div>
                                <x-icon class="w-5" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                            </x-button>
                        </x-slot>
                    </x-dropdown>

                    @php
                        $user = session('user');
                        $username = formatFullname($user['fullname']);
                    @endphp
                    
                    <x-dropdown section="user-header">
                        <x-slot name="trigger" class="gap-1.5 p-1 hover:bg-dark-primary">
                            @if ($user['user_image_name'])
                                <x-avatar src="{{ asset() }}"/>
                            @else
                                <div class="w-6 h-6 border border-slate-200 rounded-full bg-blue-200 text-xs font-bold text-center pt-[3px]">{{ $user['fullname'][0] }}</div>
                            @endif
                            <span class="text-sm">{{ $username }}</span>
                            <x-icon class="w-1.5 duration-500" src="{{ asset('img/icons/icon-header-chevron-down.webp') }}" data-arrow-dropdown=""/>
                        </x-slot>

                        <x-slot name="content" class="right-0 w-52 bg-white">
                            <x-nav-link href="#" class="justify-between p-3 text-xs hover:text-secondary">
                                <strong>Hi, {{ $username }}</strong>
                                <x-icon class="w-3" src="{{ asset('img/icons/icon-header-edit.webp') }}"  alt="Edit User Icon"/>
                            </x-nav-link>

                            <hr>

                            <x-nav-link href="#" class="gap-3 p-3 text-xs hover:bg-[#e1eeff]">
                                <x-icon class="w-3" src="{{ asset('img/icons/icon-header-fav.webp') }}" alt="Favorite Icon"/>
                                <span>Favorit</span>
                            </x-nav-link>

                            <x-nav-link href="#" class="gap-3 p-3 text-xs hover:bg-[#e1eeff]">
                                <x-icon class="w-3" src="{{ asset('img/icons/icon-header-bank.webp') }}" alt="Bank Account Icon"/>
                                <span>Rekening Bank</span>
                            </x-nav-link>

                            <x-nav-link href="#" class="gap-3 p-3 text-xs hover:bg-[#e1eeff]">
                                <x-icon class="w-3" src="{{ asset('img/icons/icon-header-complaint.webp') }}" alt="Complaint Icon"/>
                                <span>Resolusi Komplain</span>
                            </x-nav-link>

                            <x-nav-link href="#" class="gap-3 p-3 text-xs hover:bg-[#e1eeff]">
                                <x-icon class="w-3" src="{{ asset('img/icons/icon-header-notification.webp') }}" alt="Notification Icon"/>
                                <span>Notifikasi</span>
                            </x-nav-link>

                            <x-nav-link href="#" class="gap-3 p-3 text-xs hover:bg-[#e1eeff]">
                                <x-icon class="w-3" src="{{ asset('img/icons/icon-header-invite-friend.webp') }}" alt="Invite Friend Icon"/>
                                <span>Undang Teman</span>
                            </x-nav-link>

                            <x-nav-link href="#" class="gap-3 p-3 text-xs hover:bg-[#e1eeff]">
                                <x-icon class="w-3" src="{{ asset('img/icons/icon-header-coupon.webp') }}" alt="Coupon Icon"/>
                                <span>Koupon Saya</span>
                            </x-nav-link>

                            <x-nav-link href="#" class="gap-3 p-3 text-xs hover:bg-[#e1eeff]">
                                <x-icon class="w-3" src="{{ asset('img/icons/icon-header-help-center.webp') }}" alt="Helper Center Icon"/>
                                <span>Bantuan</span>
                            </x-nav-link>

                            <hr>

                            <x-nav-link href="#" class="gap-3 p-3 text-xs">
                                <x-icon class="w-4" src="{{ asset('img/icons/icon-head-logout.webp') }}" alt="Logout Icon"/>
                                <span class="text-[#ff3e3e]">Keluar</span>
                            </x-nav-link>
                        </x-slot>
                    </x-dropdown>
                @endif
            </div>
        </div>
    </div>
</div>
