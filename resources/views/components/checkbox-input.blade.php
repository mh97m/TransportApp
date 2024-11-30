@props([
    'disabled' => false,
])

<div class="custom-control custom-checkbox">
    <input
        type="checkbox"
        {{ $attributes->merge([
            'dir' => 'rtl',
            'id' => 'inputId',
            'name' => 'input',
        ]) }}
        class="custom-control-input"
        @disabled($disabled)
    />
    <label class="custom-control-label text-2">
        {{ $slot }}
    </label>
</div>