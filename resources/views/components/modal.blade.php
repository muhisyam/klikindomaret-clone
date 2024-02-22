@props(['section'])

<div class="relative" data-modal="{{ $section }}">
    <x-button :class="$trigger->attributes['class']" :data-target-modal="$section">
        {{ $trigger }}
    </x-button>

    <div {{ $content->attributes->merge(['class' => 'modal']) }} data-trigger-modal={{ $section }}>
        {{ $content }}
    </div>
</div>