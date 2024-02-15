<div @class([
        'register modal | fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-[60]', 
        'show' => ! is_null(session('input_error')) || ! is_null(session('step')),
    ])>

    @switch(session('step'))
        @case('Verify OTP')
            @include('frontend.auth.register-verify-mobile')
            <div>{{ session('otp') }}</div>
            @break
        @case('Complete Registration')
            @include('frontend.auth.register-complete')    
            @break
        @default
            @include('frontend.auth.register-mobile')
    @endswitch
</div>