@props([
    'id' => 'inputId',
    'label' => '',
    'placeholder' => '',
    'size' => 'lg',
    'lgLength' => '12',
    'mdLength' => '12',
    'smLength' => '12',
    'required' => false,
    'disabled' => false,
    'errors' => null,
])

<div class="col-lg-{{ $lgLength }} col-md-{{ $mdLength }} col-sm-{{ $smLength }}">
    {{ $slot }}
    <label for="{{ $id }}">{{ $label }}</label>
    <input
        {{ $attributes->merge([
            'type' => 'text',
            'dir' => 'rtl',
            'id' => $id,
            'name' => 'input',
        ]) }}
        class="form-control form-control-{{ $size }} @if ($errors) is-invalid @endif"
        placeholder="{{ $placeholder }}"
        @disabled($disabled)
        @required($required)
        autofocus
    />
    @if ($errors)
        @foreach ($errors as $error)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $error }}</strong>
            </span>
        @endforeach
    @endif
</div>