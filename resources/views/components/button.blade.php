@props([
    'label' => '',
    'type' => 'submit',
    'color' => 'primary',
    'containerClass' => 'form-group col-lg-6',
])

<div class="{{ $containerClass }}">
    <input
        type="{{ $type }}"
        class="btn btn-{{ $color }} btn-modern float-right"
        value={{ $label }}
    />
</div>
