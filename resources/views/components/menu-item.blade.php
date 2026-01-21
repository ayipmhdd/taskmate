@props([
    'active' => false,
    'icon' => '',
    'label' => '',
    'href' => '#',
])

@php
    $classes =
        'menu-item block px-4 py-3 rounded-lg text-sm font-bold cursor-pointer transition-all duration-200 text-black bg-white border-2 border-black hover:bg-gray-100 hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px]';
    if ($active) {
        $classes =
            'menu-item block px-4 py-3 rounded-lg text-sm font-black cursor-pointer transition-all duration-200 bg-[#4ade80] text-black border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]';
    }
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    <span class="menu-icon hidden text-xl">{{ $icon }}</span>
    <span class="sidebar-text">{{ $label }}</span>
</a>
