@props(['field', 'error', 'validation' => 'form'])

{{-- Check if field is exist in errors session --}}
@isset ($error['errors'][$field])

    {{-- Create html error element --}}
    @if ($validation === 'form')

        <ul {{ $attributes->merge(['class' => 'mt-1 text-xs text-red-600']) }}>

        @foreach ($error['errors'][$field] as $message)
        
            <li>{{ $message }}</li>
        
        @endforeach
        
        </ul>

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

@endisset