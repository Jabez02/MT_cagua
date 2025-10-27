@props([
    'name',
    'show' => false,
    'maxWidth' => 'lg'
])

@php
$maxWidth = match($maxWidth) {
    'sm' => 'modal-sm',
    'lg' => 'modal-lg',
    'xl' => 'modal-xl',
    default => '',
};
@endphp

<div
    x-data="{
        show: @js($show),
        modal: null,
        init() {
            this.modal = new bootstrap.Modal(this.$el);
            this.$watch('show', value => {
                if (value) {
                    this.modal.show();
                    {{ $attributes->has('focusable') ? 'setTimeout(() => this.$el.querySelector(\'[autofocus]\')?.[\'focus\']?.(), 100)' : '' }}
                } else {
                    this.modal.hide();
                }
            });
            
            this.$el.addEventListener('hidden.bs.modal', () => {
                this.show = false;
            });
        }
    }"
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    class="modal fade"
    tabindex="-1"
    aria-labelledby="{{ $name }}Label"
    aria-hidden="true"
    data-bs-backdrop="static"
>
    <div class="modal-dialog modal-dialog-centered {{ $maxWidth }}">
        <div class="modal-content">
            {{ $slot }}
        </div>
    </div>
</div>
