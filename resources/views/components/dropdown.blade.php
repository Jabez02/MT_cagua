@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'dropdown-menu-end'])

@php
$alignmentClasses = match ($align) {
    'left' => '',
    'top' => 'dropup',
    default => 'dropdown-menu-end',
};
@endphp

<div class="dropdown" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div class="dropdown-toggle" @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open"
            class="dropdown-menu {{ $alignmentClasses }}"
            style="display: none;"
            @click="open = false">
        <div class="dropdown-menu-inner {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>
