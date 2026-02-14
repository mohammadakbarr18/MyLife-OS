<button 
    {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full inline-flex items-center justify-center px-4 py-3 bg-peach-light border border-transparent rounded-3xl font-semibold text-text-dark tracking-widest hover:bg-peach-main active:bg-peach-dark focus:outline-none focus:ring-2 focus:ring-peach-main focus:ring-offset-2 transition-all duration-300 transform hover:-translate-y-0.5 shadow-md']) }}
>
    {{ $slot }}
</button>
