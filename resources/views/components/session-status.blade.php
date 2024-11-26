@props([
    'message' => null,
    'title' => '',
    'color' => 'primary',
])


@if ($message)
    <div class="alert alert-{{ $color }} alert-dismissible m-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <strong>{{ $title }}</strong> {{ $message }}
    </div>
@endif
