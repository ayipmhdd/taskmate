@props([
    'active' => false,
    'icon' => '',
    'label' => '',
    'href' => '#',
])

@php
    $classes =
        'menu-item block px-4 py-3 rounded-lg text-sm font-medium cursor-pointer transition-all duration-200 text-gray-500 hover:bg-gray-100 hover:text-[#1b1b18]';
    if ($active) {
        $classes =
            'menu-item block px-4 py-3 rounded-lg text-sm font-semibold cursor-pointer transition-all duration-200 bg-blue-50 text-blue-500';
    }
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    <span class="menu-icon hidden text-xl">{{ $icon }}</span>
    <span class="sidebar-text">{{ $label }}</span>
</a>
