<header class="mb-6">
    <section class="flex items-center justify-between">
        <div class="w-1/4">
            <h1 class="title text-2xl font-bold">List Kategori</h1>
        </div>
        <div class="relative w-1/2">
            <div class="relative mx-auto rounded-lg py-1.5 h-10 max-w-fit flex items-center bg-tertiary overflow-hidden island-notification">
                <div class="greeting-body px-6 text-secondary opacity-0 island-fade-in animate-delay-600">
                    <div class="notification-greet">
                        {!! createGreeting() !!}
                    </div>
                    
                @unless (is_null(session('success')))
                
                @php $message = session('success') @endphp
                    
                    <script>
                        const title   = "{{ $message['title'] }}"
                        const message = "{{ $message['message'] }}"
                        
                        document.addEventListener('DOMContentLoaded', function() {
                            new FloatNotification(title, message);
                        })
                    </script>

                @endunless

                </div>
            </div>
            <p class="absolute bottom-0 w-full flex justify-center text-xs text-secondary font-bold opacity-0 drop-datetime">
                {{ formatToIdnLocale(today(), 'l, j F Y') }}
            </p>
        </div>
        <div class="w-1/4">
            <div class="flex items-center float-right">
                <button class="me-4" aria-label="Notification info">
                    <x-icon class="h-5" src="{{ asset('img/icons/icon-header-bell.webp') }}"/>
                </button>
                <button aria-label="Help Center">
                    <x-icon class="h-5" src="{{ asset('img/icons/icon-header-ask.webp') }}"/>
                </button>
                
                <div class="h-7 w-[1px] bg-[#ccc] mx-3"></div>

                @php
                    $section    = 'modal-add-category';
                    $show       = false;
                    $parentSlug = isset($parentSlug) ? $parentSlug : '';
                @endphp

                <x-modal :section="$section" :showCondition="$show">
                    <x-slot:trigger class="me-1 px-4 h-8 gap-1.5 text-sm" buttonStyle="secondary">
                        <x-icon class="h-4" src="{{ asset('img/icons/icon-header-add.webp') }}" iconStyle="white"/>
                        <span class="leading-none">Kategori</span>
                    </x-slot>

                    <x-slot:content>
                        <livewire:admin.category.index.modal-input :section="$section" :showCondition="$show" :parentSlug="$parentSlug"/>
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
                <x-nav-link class="leading-none cursor-pointer hover:text-secondary" href="{{ route('categories.index') }}" value="Kategori"/>
            </li>
            <li class="flex items-center text-light-gray-400">
                <x-icon class="mx-2 w-3 grayscale" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                <span class="leading-none text-black">
                    {{ isRoute('index') ? 'Induk' : 'Sub Kategori' }}
                </span>
            </li>
        </ol>
    </section>
</header>