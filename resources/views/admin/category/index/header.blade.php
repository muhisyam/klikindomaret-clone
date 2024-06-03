<header class="mb-6">
    <section class="flex items-center justify-between">
        <div class="min-w-[180px]">
            <h1 class="title text-2xl font-bold">List Kategori</h1>
        </div>
        <div class="relative text-secondary">
            <div class="greeting relative rounded-lg py-1.5 px-6 h-10 min-w-[135px] flex items-center bg-tertiary overflow-hidden ">
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
        <div class="min-w-[180px]">
            <div class="flex items-center float-right">
                <button class="me-4" aria-label="Notification info">
                    <x-icon class="h-5" src="{{ asset('img/icons/icon-header-bell.webp') }}"/>
                </button>
                <button aria-label="Help Center">
                    <x-icon class="h-5" src="{{ asset('img/icons/icon-header-ask.webp') }}"/>
                </button>
                
                <div class="h-7 w-[1px] bg-[#ccc] mx-3"></div>
                
                @php
                    $section = 'add-category';
                    $show    = false;
                @endphp

                <x-modal :section="$section" :showCondition="$show">
                    <x-slot:trigger class="me-1 px-4 h-8 gap-1.5 text-sm" buttonStyle="secondary">
                        <x-icon class="h-4" src="{{ asset('img/icons/icon-header-add.webp') }}" iconStyle="white"/>
                        <span class="leading-none">Kategori</span>
                    </x-slot>

                    <x-slot:content>
                        <livewire:admin.category.index.modal-input :section="$section" :showCondition="$show"/>
                    </x-slot>
                </x-modal>

                <x-button class="px-2 group h-8 hover:bg-light-gray-50">
                    <x-nav-link href="{{ route('categories.create') }}">
                        <x-icon class="w-4 grayscale group-hover:grayscale-0" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                    </x-nav-link>
                </x-button>
            </div>
        </div>
    </section>
    <section>
        <ol class="inline-flex items-center text-sm">
            <li class="text-light-gray-400">
                <span>Pesanan</span>
            </li>
            <li class="flex items-center text-light-gray-400">
                <x-icon class="mx-2 w-3 grayscale" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                <span>List Kategori</span>
            </li>
            <li class="flex items-center text-light-gray-400">
                <x-icon class="mx-2 w-3 grayscale" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                <span class="text-black">Kategori Induk</span>
            </li>
        </ol>
    </section>
</header>