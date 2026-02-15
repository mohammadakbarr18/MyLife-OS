@props(['status'])

@if ($status)
    <div x-data="{ show: true }"
         x-init="setTimeout(() => show = false, 4000)"
         x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-500"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         {{ $attributes->merge(['class' => 'inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-2xl bg-[#FCE2CE] text-[#5F402D] text-xs sm:text-sm font-semibold text-center shadow-sm whitespace-nowrap animate-pulse']) }}>
        <svg class="w-4 h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
        </svg>
        <span>{{ $status }}</span>
    </div>
@endif
