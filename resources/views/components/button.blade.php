@props([
    'variant' => 'primary',
    'href' => null,
    'type' => 'button',
])

@php
    $baseClasses =
        'inline-block px-6 py-2.5 rounded-[10px] font-semibold text-[15px] transition-all duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] cursor-pointer';

    $variants = [
        'primary' =>
            'bg-gradient-to-br from-[#667eea] to-[#764ba2] text-white border-none shadow-[0_4px_15px_rgba(102,126,234,0.2)] hover:translate-y-[-2px] hover:shadow-[0_8px_25px_rgba(102,126,234,0.35)]',
        'white' =>
            'bg-white text-[#667eea] font-bold shadow-[0_10px_30px_rgba(0,0,0,0.2)] hover:translate-y-[-3px] hover:shadow-[0_15px_40px_rgba(0,0,0,0.3)]',
        'outline' =>
            'bg-transparent text-white border-2 border-white/80 backdrop-blur-[10px] hover:bg-white/10 hover:border-white',
        'login' => 'text-gray-600 relative hover:text-[#667eea]',
    ];

    $classes = $baseClasses . ' ' . $variants[$variant];
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
