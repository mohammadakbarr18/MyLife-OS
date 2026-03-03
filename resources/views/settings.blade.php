@extends('layouts.app')

@section('title', 'Settings')
@section('page-title', 'Settings')
@section('page-subtitle', 'Manage your account and preferences')

@section('content')

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h2 class="text-lg font-bold text-[#3E2723]" style="font-family: 'Poppins', sans-serif;">
                Account Settings
            </h2>
            <p class="text-sm text-gray-400 mt-0.5">Customize your MyLife OS experience</p>
        </div>
    </div>

    {{-- Placeholder State Card --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100/50 overflow-hidden">
        <div class="flex flex-col items-center justify-center py-24 px-6">
            {{-- Icon --}}
            <div class="w-24 h-24 rounded-[32px] bg-gradient-to-br from-[#FCE2CE] to-[#F5D0B0] flex items-center justify-center mb-8 shadow-inner">
                <svg class="w-12 h-12 text-[#5F402D]/50" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>

            {{-- Text --}}
            <h3 class="text-xl font-bold text-[#3E2723] mb-3" style="font-family: 'Poppins', sans-serif;">
                Settings feature coming soon
            </h3>
            <p class="text-sm text-gray-500 text-center max-w-sm leading-relaxed">
                We're currently building out the settings page so you can personalize your profile, themes, and more. 
            </p>

            {{-- Decorative dots --}}
            <div class="flex items-center gap-2 mt-10">
                <div class="w-2.5 h-2.5 rounded-full bg-[#FCE2CE]"></div>
                <div class="w-2h-2 rounded-full bg-[#FCE2CE]/70"></div>
                <div class="w-1.5 h-1.5 rounded-full bg-[#FCE2CE]/40"></div>
            </div>
        </div>
    </div>

@endsection
