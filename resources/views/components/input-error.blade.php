@props(['field', 'error', 'validation' => 'form'])

{{-- Checking if field names that are not arrays --}}
@if (isset($error['errors'][$field]))

    {{-- 
        MARK: Error form
    --}}
    @if ($validation === 'form')

        <ul {{ $attributes->merge(['class' => 'mt-1 text-xs text-red-600']) }}>

        @foreach ($error['errors'][$field] as $message)
        
            <li>{{ $message }}</li>
        
        @endforeach
        
        </ul>

    {{-- 
        MARK: Error single image
    --}}
    @elseif ($validation === 'single-image')

        <div class="image-invalid-feedback mb-2 rounded-md p-2 bg-red-100 text-red-700 text-sm">
            <ul>
                <li class="mb-1 flex items-center gap-1">
                    <x-icon class="filter-danger h-4" src="{{ asset('img/icons/icon-warning-error.webp') }}"/>
                    <div class="font-bold leading-none">Category Image Name</div>
                </li>

                @foreach ($error['errors'][$field] as $message)

                <li class="ps-4 flex items-center gap-1 text-xs">
                    <x-icon class="filter-danger h-1.5" src="{{ asset('img/icons/icon-dot-circle.webp') }}"/>
                    <p>{{ trimText($message, 'field') }}</p>
                </li>

                @endforeach
            </ul>
        </div>

    @endif

{{-- Checking if field names that are arrays --}}
@elseif (checkErrorKeyExist($error, $field))
    
    {{-- 
        MARK: Error multiple image
    --}}
    @if ($validation === 'multiple-image')

        @php 
            $errorKeys  = preg_grep('/^' . $field . '\./', array_keys($error['errors']));
            $errorField = array_intersect_key($error['errors'], array_flip($errorKeys));
        @endphp

        <div class="image-invalid-feedback mb-2 rounded-md p-2 bg-red-100 text-red-700 text-sm">
            <ul>

            @foreach ($errorField as $attribute => $messages)

                <li @class([
                    'flex items-center gap-1', 
                    'mt-1' => ! $loop->first
                ])>
                    <x-icon class="filter-danger h-4" src="{{ asset('img/icons/icon-warning-error.webp') }}"/>
                    <div class="font-bold leading-none">{{ prettierAttr($attribute) }}</div>
                </li>

                @foreach ($messages as $message)

                <li class="ps-4 flex items-center gap-1 text-xs">
                    <x-icon class="filter-danger h-1.5" src="{{ asset('img/icons/icon-dot-circle.webp') }}"/>
                    <p>{{ trimText($message, 'field') }}</p>
                </li>
                    
                @endforeach

            @endforeach

            </ul>
        </div>

    @elseif ($validation === 'delete-image')

        @php 
            $errorKeys  = preg_grep('/^' . $field . '\./', array_keys($error['errors']));
            $errorField = array_intersect_key($error['errors'], array_flip($errorKeys));
            $errorField = reset($errorField);
        @endphp

        <div class="image-invalid-feedback mb-2 rounded-md p-2 bg-red-100 text-red-700 text-sm">
            <ul>
                <li class="mb-1 flex items-center gap-1">
                    <x-icon class="filter-danger h-4" src="{{ asset('img/icons/icon-warning-error.webp') }}"/>
                    <div class="font-bold leading-none">Product images</div>
                </li>
                
                @foreach ($errorField as $message)

                <li class="ps-4 flex items-center gap-1 text-xs">
                    <x-icon class="filter-danger h-1.5" src="{{ asset('img/icons/icon-dot-circle.webp') }}"/>
                    <p>{{ trimText($message, 'field') }}</p>
                </li>
                    
                @endforeach

            </ul>
        </div>

    @endif

@endif

