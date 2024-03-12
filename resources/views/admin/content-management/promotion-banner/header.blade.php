<header class="header mb-6">
    <section class="top-section flex items-center justify-between">
        <div class="left-side min-w-[180px]">
            <h1 class="title text-2xl font-bold">List Promosi</h1>
        </div>
        <div class="center-side relative text-[#0079c2]">
            <div class="greeting relative min-w-[135px] h-10 flex items-center bg-[#fbde7e] rounded-lg overflow-hidden py-1.5 px-6">
                <div class="body">
                    <p class="greet-text text-lg tracking-wide">Selamat <span class="time">Pagi</span>, <span class="name italic font-bold">Jordan!</span></p>
                    @if (! is_null(session('success')))
                    @php $message = session('success') @endphp
                    <script>
                        const title = "<?php echo $message['title']; ?>"
                        const message = "<?php echo $message['message']; ?>"
                        
                        document.addEventListener('DOMContentLoaded', function() {
                            showNotification(title, message)
                        })
                    </script>
                    @endif
                </div>
            </div>
            <p class="datetime absolute left-6 -bottom-5 w-full flex justify-center text-xs font-bold pt-1 -ms-6">Jum'at, 12 Agustus 2023</p>
        </div>
        <div class="right-side min-w-[180px]">
            <div class="flex items-center float-right">
                <button class="icon text-lg me-4" aria-label="Notification info"><i class="ri-notification-3-line"></i></button>
                <button class="icon text-lg" aria-label="Help Center"><i class="ri-question-line"></i></button>
                <div class="separator h-7 w-[1px] bg-[#ccc] mx-3"></div>
                
                @php
                    $section = 'add-promo-banner';
                    $show = true;
                @endphp
                <x-modal :section="$section" :showCondition="$show">
                    <x-slot:trigger class="me-1 py-1.5 px-4 text-sm" buttonStyle="secondary">
                        Tambah Promo
                    </x-slot>

                    <x-slot:content class="separated-modal">
                    @push('components')
                        @livewire('admin.content-management.promotion-banner.modal-input', [
                            'section' => $section,
                            'showCondition' => $show,
                        ])
                    @endpush
                    </x-slot>
                </x-modal>

                <x-button class="h-8 px-2 group hover:bg-light-gray-50">
                    <x-nav-link href="#">
                        <x-icon class="w-4 grayscale group-hover:grayscale-0" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                    </x-nav-link>
                </x-button>
            </div>
        </div>
    </section>
    <section class="bottom-section">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center text-sm">
                <li class="flex items-center text-[#95989A]">
                    <span >Konten</span>
                </li>
                <li class="flex items-center text-[#95989A]">
                    <i class="ri-arrow-right-s-line mx-2"></i>
                    <a href="{{ route('promotions.index') }}" class="hover:text-[#0079C2]">Promosi</a>
                </li>
                <li class="flex items-center text-[#95989A]">
                    <i class="ri-arrow-right-s-line mx-2"></i>
                    <span class="text-black">List Promosi</span>
                </li>
            </ol>
        </nav>
    </section>
</header>