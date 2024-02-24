<div class="modal w-96 rounded-xl bg-white{{ $showCondition ? ' show' : '' }}" data-trigger-modal="{{ $section }}">
    @switch(session('step'))
        @case('Verify OTP')
            @include('auth.register-verify-mobile')
            <div>{{ session('otp') }}</div>
            @break
        @case('Complete Registration')
            @include('auth.register-complete')
            @break
        @default
            @include('auth.register-mobile')
    @endswitch
</div>