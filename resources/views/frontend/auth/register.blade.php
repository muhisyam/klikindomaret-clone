<div class="register | fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-[60]">
    @switch(session('step'))
        @case('verify')
            @include('frontend.auth.register-verify-mobile')
            <div>{{ session('otp') }}</div>
            @break
        @case('complete_register')
            @include('frontend.auth.register-complete')
            @break
        @default
            @include('frontend.auth.register-mobile')
    @endswitch
</div>  