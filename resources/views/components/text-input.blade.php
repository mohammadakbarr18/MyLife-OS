@props(['disabled' => false])

<input 
    {{ $disabled ? 'disabled' : '' }} 
    {!! $attributes->merge(['class' => 'w-full border-gray-300 bg-white text-text-dark rounded-2xl shadow-sm focus:border-peach-main focus:ring-peach-main transition-all duration-300 py-3 px-4 placeholder-gray-400']) !!}
>
