@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'fw-semibold']) }} style="color:#4ade80; font-size:14px;">
        {{ $status }}
    </div>
@endif
