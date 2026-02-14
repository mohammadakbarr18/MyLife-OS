@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-peach-dark']) }}>
        {{ $status }}
    </div>
@endif
