@props([
    'number' => '',
    'label' => '',
])

<div {{ $attributes->merge(['class' => 'text-center text-white']) }}>
    <div
        class="text-[56px] font-extrabold font-[\'Space_Grotesk\',sans-serif] bg-gradient-to-br from-[#667eea] to-[#fbbf24] bg-clip-text text-transparent mb-2 leading-none">
        {{ $number }}
    </div>
    <div class="text-base text-white/80 font-medium">
        {{ $label }}
    </div>
</div>
