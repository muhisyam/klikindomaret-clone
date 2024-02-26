@props(['section', 'activeBtn' => true, 'overlay' => false])

@php
    $activeBtn = ! $activeBtn ? ' dont-active' : '';
    $activeOverlay = $overlay ? 'dropdown-overlay' : '';
@endphp

<div class="relative{{ $overlay ? ' before:!-z-10' : '' }}" data-dropdown="{{ $section }}" {{ $activeOverlay }}>
    <x-button :class="$trigger->attributes['class'] . $activeBtn" :data-target-dropdown="$section">
        {{ $trigger }}
    </x-button>

    <div {{ $content->attributes->merge(['class' => 'absolute mt-2 rounded-lg shadow-lg hidden']) }} data-trigger-dropdown={{ $section }}>
        {{ $content }}
    </div>
</div>