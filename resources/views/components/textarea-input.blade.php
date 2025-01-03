@props([
    'size' => 'lg',
    'lgLength' => '12',
    'mdLength' => '12',
    'smLength' => '12',
    'rows' => '8',
    'label' => '',
    'disabled' => false,
    'errors' => null,
])

<div class="form-group col-lg-{{ $lgLength }} col-md-{{ $mdLength }} col-sm-{{ $smLength }}">
    {{ $slot }}
    <label class="font-weight-bold text-dark text-2">{{ $label }}</label>
    <textarea
        {{ $attributes->merge([
            'dir' => 'rtl',
            'id' => 'inputId',
            'name' => 'input',
        ]) }}
        class="form-control form-control-{{ $size }} text-left @if ($errors) is-invalid @endif"
        @disabled($disabled)
        maxlength="5000"
        rows="{{ $rows }}"
        {{-- required --}}
        autofocus
    ></textarea>
    @if ($errors)
        @foreach ($errors as $error)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $error }}</strong>
            </span>
        @endforeach
    @endif
</div>