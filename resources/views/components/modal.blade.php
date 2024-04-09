@props(['section', 'showCondition' => false, 'withOverlay' => true])

@php
    $overlay = $withOverlay ? 'overlay = ""' : '';
@endphp

<div {{ $attributes->class(['active' => $showCondition])->merge(['class' => 'relative']) }} data-modal="{{ $section }}" {!! $overlay !!}>
    <x-button :class="$trigger->attributes['class']" :buttonStyle="$trigger->attributes['buttonStyle']" :data-target-modal="$section">
        {{ $trigger }}
    </x-button>

    <div {{ $content->attributes->class(['show' => $showCondition])->merge(['class' => 'modal']) }} data-trigger-modal={{ $section }}>
        {{ $content }}
    </div>
</div>