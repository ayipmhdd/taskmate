@props([
    'stars' => 5,
    'quote' => '',
    'authorName' => '',
    'authorRole' => '',
    'authorInitials' => '',
])

<div
    {{ $attributes->merge(['class' => 'bg-white p-10 rounded-[20px] shadow-[0_4px_20px_rgba(0,0,0,0.08)] transition-all duration-300 border-2 border-transparent hover:translate-y-[-8px] hover:shadow-[0_12px_40px_rgba(102,126,234,0.2)] hover:border-[#667eea]']) }}>
    <div class="text-[#fbbf24] text-xl mb-4">
        @for ($i = 0; $i < $stars; $i++)
            ★
        @endfor
    </div>

    <p class="text-gray-600 leading-[1.7] mb-6 italic">
        {{ $quote }}
    </p>

    <div class="flex items-center gap-4">
        <div
            class="w-12 h-12 rounded-full bg-gradient-to-br from-[#667eea] to-[#764ba2] flex items-center justify-center text-white font-bold text-[18px]">
            {{ $authorInitials }}
        </div>

        <div>
            <h4 class="font-semibold text-gray-800 mb-1">
                {{ $authorName }}
            </h4>
            <p class="text-sm text-gray-500">
                {{ $authorRole }}
            </p>
        </div>
    </div>
</div>
