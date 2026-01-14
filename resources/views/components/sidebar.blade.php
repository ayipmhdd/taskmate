@props([
    'collapsed' => false,
    'userName' => '',
    'userEmail' => '',
    'userInitial' => '',
])

<aside id="sidebar"
    class="sidebar fixed top-6 left-6 bottom-6 w-[220px] bg-white rounded-2xl px-4 py-6 z-[100] overflow-y-auto shadow-[0_4px_20px_rgba(0,0,0,0.05)] border-2 border-gray-200 flex flex-col transition-[width,padding] duration-0 [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
    <!-- Logo -->
    <div class="mb-6">
        <h1 class="sidebar-text text-xl font-black tracking-tight uppercase">
            Task<span class="text-blue-600">Mate</span>
        </h1>
        <!-- Logo icon for collapsed state -->
        <div
            class="sidebar-logo-icon hidden w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl text-white text-2xl font-bold items-center justify-center mx-auto mb-5">
            T</div>
    </div>

    <!-- Profile Card -->
    <div class="profile-card bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-5 px-4 mb-6 text-center">
        <div
            class="w-16 h-16 rounded-full bg-white flex items-center justify-center mx-auto mb-3 text-2xl font-bold text-blue-500 shadow-[0_4px_12px_rgba(0,0,0,0.1)]">
            {{ $userInitial }}
        </div>
        <div class="sidebar-text text-white font-bold text-sm mb-1">
            {{ $userName }}
        </div>
        <div class="sidebar-text text-white/80 text-[11px] break-all">
            {{ $userEmail }}
        </div>
    </div>

    <!-- Menu Items -->
    <nav class="flex flex-col space-y-1">
        {{ $slot }}
    </nav>

    <!-- Logout Button -->
    <div class="mt-auto pt-4 border-t border-gray-100">
        {{ $logout ?? '' }}
    </div>
</aside>
