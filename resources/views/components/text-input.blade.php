@props([
    'dir' => 'rtl',
    'label' => '',
    'id' => 'inputId',
    'name' => 'input',
    'disabled' => false,
    'errors' => null,
])

<div class="form-group col">
    {{ $slot }}
    <label class="font-weight-bold text-dark text-2">{{ $label }}</label>
    <input
        dir="{{ $dir }}"
        {{ $attributes->merge(['type' => 'text']) }}
        id="{{ $id }}"
        name="{{ $name }}"
        class="form-control form-control-lg text-left @if ($errors) is-invalid @endif"
        @disabled($disabled)
        required
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
