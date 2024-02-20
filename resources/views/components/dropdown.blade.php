@props(['section'])

<div class="relative">
    <x-button class="{{ $trigger->attributes['class'] }}" :data-target-dropdown=$section>
        {{ $trigger }}
    </x-button>

    <div {{ $content->attributes->merge(['class' => 'absolute mt-2 rounded-lg shadow-lg opacity-0 transition-opacity duration-300']) }} data-trigger-dropdown={{ $section }}>
        {{ $content }}
    </div>
</div>