<section class="mb-4 overflow-hidden rounded-xl border border-light-gray-100" data-section="form-tracker">
    <div class="grid grid-cols-{{ count($formTracker) }} gap-0.5">
        
    @foreach ($formTracker as $tracker)

        <div @class([
                '-skew-x-[24deg] h-2 w-full bg-light-gray-100', 
                'animate-active-tracker' => $tracker['is_active'],
            ])
            @style([
                'animation-duration:' . $tracker['animate_duration'],
                'animation-delay:' . $tracker['animate_delay'],
            ])>
        </div>
        
    @endforeach

    </div>
    <div class="py-2 divide-x divide-light-gray-100 grid grid-cols-{{ count($formTracker) }} items-center">
    
    @foreach ($formTracker as $label => $tracker)

        <div @class([
                'py-2 text-sm text-center', 
                'text-danger font-bold' => ! $tracker['is_active'],
            ])>
            {{ $label }}
        </div>
        
    @endforeach

    </div>
</section>