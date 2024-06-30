@props(['rows', 'cols', 'height' => '36px'])

@for ($i = 0; $i < $rows; $i++)
            
<tr {{ $attributes->merge(['class' => 'border-b']) }}>
    
    @for ($j = 0; $j < $cols; $j++)
    
    <td class="py-5 px-4 h-[{{ $height }}]"><div class="rounded-lg h-3 w-full bg-light-gray-100 animate-pulse"></div></td>

    @endfor

</tr>

@endfor