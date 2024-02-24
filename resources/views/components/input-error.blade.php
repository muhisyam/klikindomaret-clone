@props(['field','error' => null, 'validation' => 'form'])

@php
    $dataError = is_array($error) ? $error['errors'] : ['errors' => []];
@endphp

@if (array_key_exists($field, $dataError))
    @if ($validation === 'form')
        <ul {{ $attributes->merge(['class' => 'mt-1 text-xs text-red-600']) }}>
            @foreach ($dataError[$field] as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    @else
        
    @endif
@endif