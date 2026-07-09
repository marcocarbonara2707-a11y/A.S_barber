@props(['value'])

<label {{ $attributes->merge(['class' => 'form-label-custom']) }}>
    {{ $value ?? $slot }}
</label>
