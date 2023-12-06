@if (array_key_exists($field, $error['errors']))
    @if ($validation === 'form')
        <div class="invalid-feedback | flex text-red-600 text-sm mt-1">
            <ul>
                @foreach ($error['errors'][$field] as $message)
                    <li class="flex">
                        <p @class([
                            'icon | h-5 me-1', 
                            'w-[14px] text-[.375rem] text-center' => !$loop->first,
                        ])><i @class([
                                'ri-error-warning-fill' => $loop->first,
                                'ri-circle-fill' => !$loop->first,
                            ]) class="ri-error-warning-fill"></i></p>
                        <p class="message">{{ $message }}</p>
                    </li>
                @endforeach
            </ul>
        </div>

    @elseif ($validation === 'image')
        <div class="invalid-feedback | flex bg-red-100 text-red-700 text-sm rounded p-2 mb-2">
            <ul>
                <li class="flex">
                    <p class="icon | h-5 me-1"><i class="ri-error-warning-fill"></i></p>
                    <p class="message | font-bold">{{ ucfirst($field) }}</p>
                </li>
                @foreach ($error['errors'][$field] as $message)
                    <li class="flex text-xs ps-4">
                        <p class="icon | w-[14px] h-5 text-[.375rem] text-center me-1"><i class="ri-circle-fill"></i></p>
                        <p class="message">{{ $message }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
        
    @elseif ($validation === 'multipleImage')
        <div class="invalid-feedback | bg-red-100 text-red-700 text-sm rounded p-2">
            @foreach ($error['errors'][$field] as $key => $value)
                <ul>
                    <li class="flex">
                        <p class="icon | h-5 me-1"><i class="ri-error-warning-fill"></i></p>
                        <p class="message | font-bold">{{ $key }}</p>
                    </li>
                    @foreach ($value as $message)
                        <li class="flex text-xs ps-4">
                            <p class="icon | w-[14px] h-5 text-[.375rem] text-center me-1"><i class="ri-circle-fill"></i></p>
                            <p class="message">{{ $message }}</p>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    @endif
@elseif ($validation === 'customValidation')
    <div class="invalid-feedback | flex text-red-600 text-sm mt-1">
        <ul>
            @foreach ($customMessage as $message)
                <li class="flex">
                    <p @class([
                        'icon | h-5 me-1', 
                        'w-[14px] text-[.375rem] text-center' => !$loop->first,
                    ])><i @class([
                            'ri-error-warning-fill' => $loop->first,
                            'ri-circle-fill' => !$loop->first,
                        ]) class="ri-error-warning-fill"></i></p>
                    <p class="message">{{ $message }}</p>
                </li>
            @endforeach
        </ul>
    </div> 
@endif