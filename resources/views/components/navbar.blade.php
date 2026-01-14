@props([
    'transparent' => false,
])

<nav class="fixed top-0 left-0 right-0 z-[10001] h-[70px] bg-white/95 backdrop-blur-[10px]">
    <div class="max-w-full px-5 flex justify-between items-center h-full">
        <!-- Logo with SVG -->
        <a href="/" class="flex items-center gap-3">
            <img src="{{ asset('assets/TaskMate.svg') }}" alt="TaskMate Logo" class="h-10 w-10">
            <span class="text-[28px] font-black font-['Space_Grotesk',sans-serif] tracking-[-0.5px]">
                <span class="text-gray-900">TASK</span><span
                    class="bg-gradient-to-br from-[#667eea] to-[#764ba2] bg-clip-text text-transparent">MATE</span>
            </span>
        </a>

        <!-- Navigation Links -->
        <div class="flex gap-4 items-center">
            {{ $slot }}
        </div>
    </div>
</nav>
