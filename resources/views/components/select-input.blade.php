@props([
    'size' => 'lg',
    'lgLength' => '12',
    'mdLength' => '12',
    'smLength' => '12', 
    'label' => '',
    'disabled' => false,
    'errors' => null,
    'options' => null,
])

<div class="form-group col-lg-{{ $lgLength }} col-md-{{ $mdLength }} col-sm-{{ $smLength }}">
    {{ $slot }}
    <label class="font-weight-bold text-dark text-2">{{ $label }}</label>
    <select
        {{ $attributes->merge([
            'dir' => 'rtl',
            'id' => 'inputId',
            'name' => 'input',
        ]) }}
        class="form-control form-control-{{ $size }} text-left @if ($errors) is-invalid @endif"
        @disabled($disabled)
        {{-- required --}}
        autofocus
    >
    <option value="">انتخاب کنید</option>
        @if ($options)
            @foreach ($options as $option)
                <option value="{{ $option->id }}">{{ $option->title }}</option>
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
