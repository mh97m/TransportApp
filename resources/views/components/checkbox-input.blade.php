@props([
    'label' => '',
    'id' => 'inputId',
    'name' => 'input',
    'disabled' => false,
])

<div class="custom-control custom-checkbox">
    <input
        type="checkbox"
        id="{{ $id }}"
        name="{{ $name }}"
        class="custom-control-input"
        @disabled($disabled)
    />
    <label class="custom-control-label text-2" for="{{ $id }}">
        {{ $label }}
    </label>
</div>