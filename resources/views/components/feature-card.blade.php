@props([
    'icon' => '✨',
    'title' => '',
    'description' => '',
])

<div
    {{ $attributes->merge(['class' => 'relative overflow-hidden bg-gradient-to-br from-gray-50 to-white p-10 rounded-[20px] border-2 border-gray-200 transition-all duration-[400ms] ease-[cubic-bezier(0.4,0,0.2,1)] before:content-[\'\'] before:absolute before:top-0 before:left-0 before:right-0 before:h-1 before:bg-gradient-to-r before:from-[#667eea] before:to-[#764ba2] before:scale-x-0 before:transition-transform before:duration-[400ms] hover:before:scale-x-100 hover:translate-y-[-12px] hover:shadow-[0_25px_50px_rgba(102,126,234,0.25)] hover:bg-white hover:border-[#667eea]']) }}>
    <div
        class="w-14 h-14 bg-gradient-to-br from-[#667eea] to-[#764ba2] rounded-xl mb-6 flex items-center justify-center text-[28px] shadow-[0_8px_20px_rgba(102,126,234,0.3)] transition-all duration-300 group-hover:scale-110 group-hover:rotate-[5deg] group-hover:shadow-[0_12px_30px_rgba(102,126,234,0.4)]">
        {{ $icon }}
    </div>

    <h3 class="text-[22px] font-bold mb-3.5 text-gray-800">
        {{ $title }}
    </h3>

    <p class="text-gray-500 leading-[1.7] text-[15px]">
        {{ $description }}
    </p>
</div>
