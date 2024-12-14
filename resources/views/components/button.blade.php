@props([
    'id' => 'inputId',
    'color' => 'primary',
    'label' => '',
    'lgLength' => '12',
    'mdLength' => '12',
    'smLength' => '12',
    'size' => 'lg',
])

<div class="col-lg-{{ $lgLength }} col-md-{{ $mdLength }} col-sm-{{ $smLength }}">
    <button
        class="btn btn-{{ $size }} btn-block btn-{{ $color }} waves-effect waves-light ffiy"
        {{ $attributes->merge(['type' => 'submit']) }}
    >
        {{ $label }}
    </button>
</div>
