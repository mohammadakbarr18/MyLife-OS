@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-text-dark mb-1']) }}>
    {{ $value ?? $slot }}
</label>
