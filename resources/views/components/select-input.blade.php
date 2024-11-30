@props([
    'dir' => 'rtl',
    'size' => 'lg',
    'lgLength' => '12',
    'mdLength' => '12',
    'smLength' => '12', 
    'label' => '',
    'id' => 'inputId',
    'name' => 'input',
    'disabled' => false,
    'errors' => null,
    'options' => null,
])

<div class="form-group col-lg-{{ $lgLength }} col-md-{{ $mdLength }} col-sm-{{ $smLength }}">
    {{ $slot }}
    <label class="font-weight-bold text-dark text-2">{{ $label }}</label>
    <select
        dir="{{ $dir }}"
        {{ $attributes->merge(['type' => 'text']) }}
        id="{{ $id }}"
        name="{{ $name }}"
        class="form-control form-control-{{ $size }} text-left @if ($errors) is-invalid @endif"
        @disabled($disabled)
        required
        autofocus
    >
    <option value="">انتخاب کنید</option>
        @if ($options)
            @foreach ($options as $option)
                <option value="{{ $option->id }}">{{ $option->name }}</option>
            @endforeach
        @endif
    </select>
    @if ($errors)
        @foreach ($errors as $error)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $error }}</strong>
            </span>
        @endforeach
    @endif
</div>
