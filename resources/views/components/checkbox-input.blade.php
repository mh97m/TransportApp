@props([
    'disabled' => false,
    'id' => 'inputId',
])

<div class="custom-control custom-checkbox">
    <input
        type="checkbox"
        {{ $attributes->merge([
            'dir' => 'rtl',
            'id' => $id,
            'name' => 'input',
        ]) }}
        class="custom-control-input"
        @disabled($disabled)
    />
    <label class="custom-control-label text-2" for="{{ $id }}">
        {{ $slot }}
    </label>
</div>