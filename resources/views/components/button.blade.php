@props([
    'label' => '',
    'color' => 'primary',
    'containerClass' => 'form-group col-lg-6',
])

<div class="{{ $containerClass }}">
    <input
    {{ $attributes->merge(['type' => 'submit']) }}
        class="btn btn-{{ $color }} btn-modern float-right"
        value={{ $label }}
    />
</div>
