@props(['section', 'showCondition' => false, 'withOverlay' => true])

@php
    $overlay = $withOverlay ? 'overlay = ""' : '';
@endphp

{{-- 
    Modal slot content component always has element with class modal. If the modal content position conflict 
    with outermost parent position (relative), use class "separated-modal" in slot content, then push the 
    content to "components" in layout component.
--}}

<div {{ $attributes->class(['active' => $showCondition])->merge(['class' => 'relative']) }} data-modal="{{ $section }}" {!! $overlay !!}>
    <x-button :class="$trigger->attributes['class']" :buttonStyle="$trigger->attributes['buttonStyle']" :data-target-modal="$section">
        {{ $trigger }}
    </x-button>

    <div {{ $content->attributes->class(['show' => $showCondition]) }}>
        {{ $content }}
    </div>
</div>