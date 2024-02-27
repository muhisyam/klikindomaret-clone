@props(['section', 'activeBtn' => true, 'overlay' => false])

@php
    $activeBtn = ! $activeBtn ? ' dont-active' : '';
    $activeOverlay = $overlay ? 'overlay' : '';
@endphp

<div @class([
    'relative', 
    'before:!-z-10' => $overlay
]) data-dropdown="{{ $section }}" {{ $activeOverlay }}>
    <x-button :class="$trigger->attributes['class'] . $activeBtn" :data-target-dropdown="$section">
        {{ $trigger }}
    </x-button>

    <div {{ $content->attributes->merge(['class' => 'absolute mt-2 rounded-lg shadow-lg hidden']) }} data-trigger-dropdown={{ $section }}>
        {{ $content }}
    </div>
</div>