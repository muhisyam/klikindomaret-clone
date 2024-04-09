<div class="modal rounded-xl w-max bg-white" data-trigger-modal="choose-time-toko-indomaret">
    <section class="flex items-center justify-center border-b border-light-gray-100 p-3">
        <x-button class="absolute top-0 left-0 h-12 w-12" data-target-modal="choose-time-toko-indomaret" :preventClose="false">
            <x-icon class="w-3 m-auto" src="{{ asset('img/icons/icon-header-arrow-left.webp') }}"/>
        </x-button>

        <div class="font-bold">Pilih Waktu</div>
    </section>

    @php
        $today         = today()->format('j M');
        $tomorrow      = today()->addDay()->format('j M');
        $afterTomorrow = today()->addDays(2)->format('l, j M');
        $openingHours  = [
            '07.00 - 07.59', '08.00 - 08.59', '09.00 - 09.59',  '10.00 - 10.59',
            '11.00 - 11.59', '12.00 - 12.59', '13.00 - 13.59',  '14.00 - 14.59',
            '15.00 - 15.59', '16.00 - 16.59', '17.00 - 17.59',  '18.00 - 18.59',
            '19.00 - 19.59', '20.00 - 20.59'
        ];
    @endphp

    <section class="p-4 flex gap-4 border-b border-light-gray-100 ">
        <x-button class="py-2 px-4 text-sm" data-section-target="date-today" buttonStyle="secondary" value="Hari ini, {{ $today }}"/>
        <x-button class="py-2 px-4 text-sm" data-section-target="date-tomorrow" buttonStyle="outline-secondary" value="Besok, {{ $tomorrow }}"/>
        <x-button class="py-2 px-4 text-sm" data-section-target="date-after-tomorrow" buttonStyle="outline-secondary" value="{{ $afterTomorrow }}"/>
    </section>

    <section class="p-4 grid grid-cols-2 gap-4" data-section="date-today">

    @foreach ($openingHours as $index => $openingHour)

    @php
        $currentHour      = now();
        $intOpenHour      = (int) explode(' - ', $openingHour)[0];
        $openHourInFormat = \Carbon\Carbon::createFromTime($intOpenHour);
        $isPastTimeNow    = $currentHour->gt($openHourInFormat);
    @endphp

        <div class="rounded-md border border-light-gray-100 pe-2 ps-4 flex items-center justify-between h-12 w-96 text-sm{{ $isPastTimeNow ? ' bg-light-gray-100' : '' }}">
            <div class="font-bold">{{ $openingHour }}</div>
        @unless ($isPastTimeNow)
            <x-button class="!rounded py-1 px-2 text-sm hover:bg-secondary hover:text-white" data-delivery-date="{{ date('j') . ',' . date('M') }}" data-delivery-time="{{ $openingHours[$index] }}" buttonStyle="outline-secondary" value="Pilih jam ini"/>
        @endunless
        </div>
    @endforeach

    </section>
    
    <section class="p-4 hidden grid-cols-2 gap-4" data-section="date-tomorrow">

    @foreach ($openingHours as $index => $openingHour)
        <div class="rounded-md border border-light-gray-100 pe-2 ps-4 flex items-center justify-between h-12 w-96 text-sm">
            <div class="font-bold">{{ $openingHour }}</div>
            <x-button class="!rounded py-1 px-2 text-sm hover:bg-secondary hover:text-white" data-delivery-date="{{ date('j') + 1 . ',' . date('M') }}" data-delivery-time="{{ $openingHours[$index] }}" buttonStyle="outline-secondary" value="Pilih jam ini"/>
        </div>
    @endforeach

    </section>
    
    <section class="p-4 hidden grid-cols-2 gap-4" data-section="date-after-tomorrow">

    @foreach ($openingHours as $index => $openingHour)
        <div class="rounded-md border border-light-gray-100 pe-2 ps-4 flex items-center justify-between h-12 w-96 text-sm">
            <div class="font-bold">{{ $openingHour }}</div>
            <x-button class="!rounded py-1 px-2 text-sm hover:bg-secondary hover:text-white" data-delivery-date="{{ date('j') + 2 . ',' . date('M') }}" data-delivery-time="{{ $openingHours[$index] }}" buttonStyle="outline-secondary" value="Pilih jam ini"/>
        </div>
    @endforeach

    </section>
</div>