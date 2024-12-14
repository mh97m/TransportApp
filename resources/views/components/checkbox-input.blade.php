@props([
    'id' => 'inputId',
    'label' => '',
    'lgLength' => '12',
    'mdLength' => '12',
    'smLength' => '12',
    'disabled' => false,
])

<div class="col-lg-{{ $lgLength }} col-md-{{ $mdLength }} col-sm-{{ $smLength }}">
    <div class="checkbox checkbox-success">
        <input
            type="checkbox"
            {{ $attributes->merge([
                'dir' => 'rtl',
                'id' => $id,
                'name' => 'input',
            ]) }}
            @disabled($disabled)
        />
        <label for="{{ $id }}">
            {{ $label }}
        </label>
    </div>
</div>