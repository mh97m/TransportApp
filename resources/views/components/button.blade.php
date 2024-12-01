@props([
    'label' => '',
    'color' => 'primary',
    'size' => '',
    'containerClass' => 'form-group col-lg-6',
])

<div class="{{ $containerClass }}">
    <input
    {{ $attributes->merge(['type' => 'submit']) }}
        class="btn btn-{{ $color }} {{ $size }} btn-modern float-right"
        value={{ $label }}
    />
</div>
