@props([
    'title' => '',
    'subtitle' => '',
    'badge' => null,
])

<div
    {{ $attributes->merge(['class' => 'bg-white rounded-[20px] border border-[rgba(25,20,0,0.08)] shadow-[0_8px_30px_rgba(0,0,0,0.02)] p-6 px-8 flex flex-col justify-center transition-all duration-300 h-full hover:shadow-[0_8px_30px_rgba(59,130,246,0.08)] hover:border-[rgba(59,130,246,0.1)]']) }}>
    <div class="mb-2">
        <h2 class="text-2xl font-extrabold text-[#1b1b18] leading-[1.3]">
            {{ $title }}
        </h2>
    </div>

    @if ($subtitle)
        <p class="text-sm text-gray-500 mb-5 leading-[1.5]">
            {{ $subtitle }}
        </p>
    @endif

    @if ($badge)
        <div class="mt-auto">
            <div class="text-[10px] font-bold text-gray-400 tracking-wide uppercase mb-2">
                {{ $badge['label'] ?? 'Status' }}
            </div>
            <div
                class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-green-50 border border-green-300 rounded-lg text-xs font-semibold text-green-600">
                <span class="text-[10px]">{{ $badge['icon'] ?? '✓' }}</span>
                {{ $badge['text'] ?? 'Active' }}
            </div>
        </div>
    @endif

    {{ $slot }}
</div>
