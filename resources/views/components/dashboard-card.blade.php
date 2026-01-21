@props([
    'title' => '',
    'subtitle' => '',
    'badge' => null,
])

<div
    {{ $attributes->merge(['class' => 'bg-white rounded-xl border-[3px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-6 px-8 flex flex-col justify-center transition-all duration-200 h-full hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]']) }}>
    <div class="mb-2">
        <h2 class="text-2xl font-black text-[#1b1b18] leading-[1.3]">
            {{ $title }}
        </h2>
    </div>

    @if ($subtitle)
        <p class="text-sm text-gray-600 mb-5 leading-normal font-medium">
            {{ $subtitle }}
        </p>
    @endif

    @if ($badge)
        <div class="mt-auto">
            <div class="text-[10px] font-black text-gray-600 tracking-wide uppercase mb-2">
                {{ $badge['label'] ?? 'Status' }}
            </div>
            <div
                class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-[#4ade80] border-2 border-black rounded-lg text-xs font-black text-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                <span class="text-[10px]">{{ $badge['icon'] ?? '✓' }}</span>
                {{ $badge['text'] ?? 'Active' }}
            </div>
        </div>
    @endif

    {{ $slot }}
</div>
