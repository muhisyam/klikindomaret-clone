<div class="register | fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-[60]">
    @php 
        $step = session('step') ?? null;
        $errorKey = session('input_error') ? array_keys(session('input_error')['errors'])[0] : null; 
    @endphp

    @if ($step === 'verify_otp' || ($step === null && $errorKey === 'incorrect_otp'))
        {{ dd($step, $errorKey, $step === 'verify_otp' || ($step === null && $errorKey === 'incorrect_otp')) }}
        @include('frontend.auth.register-verify-mobile')
        <div>{{ session('otp') }}</div>
    @elseif ($step === 'complete_register' || ($step === null && $errorKey !== 'mobile_number'))
    {{ dd($step, $errorKey, ($step === null && $errorKey !== 'mobile_number')) }}

        @include('frontend.auth.register-complete')
    @else
    {{ dd($step, $errorKey) }}

        @include('frontend.auth.register-mobile')
    @endif

</div>