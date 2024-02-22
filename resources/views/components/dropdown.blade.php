@props(['section'])

<div class="relative" data-dropdown="{{ $section }}">
    <x-button :class="$trigger->attributes['class']" :data-target-dropdown="$section">
        {{ $trigger }}
    </x-button>

    <div {{ $content->attributes->merge(['class' => 'absolute mt-2 rounded-lg shadow-lg hidden']) }} data-trigger-dropdown={{ $section }}>
        {{ $content }}
    </div>
</div>