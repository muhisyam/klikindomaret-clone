<div class="modal w-[550px] bg-white rounded-xl{{ $showCondition ? ' show' : '' }}" data-trigger-modal="{{ $section }}">
    <section class="flex items-center justify-center border-b border-light-gray-100 p-3">
        <x-button class="absolute top-0 left-0 h-12 w-12" data-target-modal="{{ $section }}">
            <x-icon class="w-3 m-auto" src="{{ asset('img/icons/icon-header-arrow-left.webp') }}"/>
        </x-button>

        <x-icon class="w-24" src="{{ asset('img/header/logo.png') }}"/>
    </section>
    <section class="space-y-4 p-4 flex flex-col items-center">

        @php 
            $orderRetailerStatus        = \App\Models\Order::$retailerStatus;
            $orderRetailerStatusMessage = \App\Models\Order::$retailerStatusMessage; 
        @endphp

        <div class="flex items-center gap-2">
            Status pesanan saat ini: 
            <span class="text-secondary">

                @unless (is_null($retailerStatus))
                    {{ $orderRetailerStatusMessage[$retailerStatus] }}
                @else
                    <div class="rounded-lg h-5 w-40 bg-light-gray-50 animate-pulse"></div>
                @endunless
                
            </span>
        </div>
        <div class="mx-6 text-sm text-center">
            Dengan memperbaharui status pesanan, user dapat mengetahui status pesanannya. Pilih status pesanan <strong>#ADMIN-111-1231312</strong>:
        </div>
        <div class="mb-4 w-1/2">
            
            @unless (is_null($retailerStatus))

            @php 
                $statusFound         = false;
                $disableOption       = true;
            @endphp

            <x-input-select id="form-select-retailer-status" name="retailerStatus">

            @foreach ($orderRetailerStatus as $status)

                <option value="{{ $status }}" @selected($statusFound) @disabled($disableOption)>{{ $status }}</option>

                @php 
                    $isStatusFound = $status == $retailerStatus;
                    $statusFound   = $isStatusFound ? true : false;
                    $disableOption = $isStatusFound ? false : true;
                @endphp

            @endforeach

            </x-input-select>

            @else

            <div class="rounded-lg h-10 w-full bg-light-gray-50 animate-pulse"></div>

            @endunless
            
        </div>

        <div class="!mt-6 flex gap-4">
            <x-button class="py-1.5 px-4 text-sm" data-target-modal="{{ $section }}" buttonStyle="outline-secondary" value="Kembali"/>

            @unless ($retailerStatus == $orderRetailerStatus['complete'])
            
            <x-button class="py-1.5 px-4 text-sm" buttonStyle="secondary" value="Perbaharui" wire:click="updateRetailerStatus"/>
                
            @endunless

        </div>
    </section>
</div>