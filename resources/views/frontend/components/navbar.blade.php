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
            <div class="right-side flex">
                <button class="shopping-basket drop-shadow-sm mt-1 me-7 text-xl text-[#0079c2]"  data-tooltip-target="shopping-basket-tooltip" data-tooltip-placement="bottom">
                    <span><i class="ri-shopping-basket-fill"></i></span>
                </button>
                <div id="shopping-basket-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white whitespace-nowrap transition-opacity duration-300 bg-gray-900 rounded-md shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Lihat Keranjang
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                <div class="guest-button text-sm">
                    <button type="button" id="btn-login" class="rounded-lg border border-[#0079c2] me-2.5 py-1.5 px-4 bg-white text-[#0079c2]">Masuk</button>
                    <button type="button" id="btn-register" class="rounded-lg py-1.5 px-5 bg-[#0079c2] text-white">Daftar</button>
                </div>
            </div>
        </div>
    </div>
</div>
