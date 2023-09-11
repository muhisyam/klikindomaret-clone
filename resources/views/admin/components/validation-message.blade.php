@if (array_key_exists($field, $error['errors']))
    @if ($validation == "form")
    <div class="invalid-feedback flex text-red-600 text-sm mt-1">
        <ul>
            @foreach ($error['errors'][$field] as $message)
            @if ($loop->first)
            <li class="flex">
                <p class="icon h-5 me-1"><i class="ri-error-warning-fill"></i></p>
                <p class="message">{{ $message }}</p>
            </li>
            @continue
            @endif
            <li class="flex">
                <p class="icon w-[14px] h-5 text-[.375rem] text-center me-1"><i class="ri-circle-fill"></i></p>
                <p class="message">{{ $message }}</p>
            </li>
            @endforeach
        </ul>
    </div> 
    @endif

    @if ($validation == "image")
    <div class="item-image-uploaded is-invalid">
        <div class="invalid-feedback flex bg-red-100 text-red-700 text-sm rounded p-2 mb-2">
            <ul>
                @foreach ($error['errors'][$field] as $message)
                @if ($loop->first)
                <li class="flex">
                    <p class="icon h-5 me-1"><i class="ri-error-warning-fill"></i></p>
                    <p class="message">{{ $message }}</p>
                </li>
                @continue
                @endif
                <li class="flex">
                    <p class="icon w-[14px] h-5 text-[.375rem] text-center me-1"><i class="ri-circle-fill"></i></p>
                    <p class="message">{{ $message }}</p>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
@endif