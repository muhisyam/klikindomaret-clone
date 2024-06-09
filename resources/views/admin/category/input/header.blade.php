<header class="mb-6">
    <section class="flex items-center justify-between">
        <div class="w-1/6">
            <h1 class="title text-2xl font-bold">{{ str_contains(url()->current(), 'create') ? 'Tambah' : 'Ubah' }} Kategori</h1>
        </div>
        <div class="relative w-3/5">
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
        <div class="w-1/5">
            <div class="flex items-center float-right">
                <button class="me-4" aria-label="Notification info">
                    <x-icon class="h-5" src="{{ asset('img/icons/icon-header-bell.webp') }}"/>
                </button>
                <button aria-label="Help Center">
                    <x-icon class="h-5" src="{{ asset('img/icons/icon-header-ask.webp') }}"/>
                </button>
                
                <div class="h-7 w-[1px] bg-[#ccc] mx-3"></div>

                <x-nav-link href="javascript:history.go(-1)" class="rounded-md px-4 border border-secondary h-8  justify-center bg-white text-secondary text-sm" buttonStyle="outline-secondary" value="Kembali"/>

            </div>
        </div>
    </section>
    <section>

        @php $isCreatePage = str_contains(url()->current(), 'create') @endphp

        <ol class="inline-flex items-center text-sm">
            <li class="text-light-gray-400">
                <x-nav-link class="leading-none cursor-pointer hover:text-secondary" href="{{ route('categories.index') }}" value="Kategori"/>
            </li>
            <li class="flex items-center">
                <x-icon class="mx-2 h-3 grayscale" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                <span @class([
                        'leading-none',
                        'text-black'          => $isCreatePage,
                        'text-light-gray-400' => ! $isCreatePage,
                    ])>
                    {{ $isCreatePage ? 'Tambah' : 'Ubah' }}
                </span>
            </li>

            @unless ($isCreatePage)
                
            <li class="flex items-center">
                <x-icon class="mx-2 h-3 grayscale" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                <span class="leading-none text-black">{{ slugToTitle($categorySlug) }}</span>
            </li>

            @endunless

        </ol>
    </section>
</header>