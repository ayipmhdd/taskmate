<!DOCTYPE html>
<html lang="en" class="h-full bg-[#FDFDFC]">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - TaskMate</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/TaskMate.svg') }}">
</head>

<body class="group/body h-screen w-full font-sans antialiased text-[#1b1b18] overflow-hidden p-0 m-0 box-border">

    <!-- Floating Toggle Hover Area (Group Trigger) -->
    <div id="toggleArea"
        class="group/toggle fixed top-0 left-[256px] w-12 h-full z-[10000] transition-all duration-300 ease-in-out">
        <!-- Floating Chevron Toggle Button -->
        <button id="toggleButton" onclick="toggleSidebar()" aria-label="Toggle Sidebar"
            class="fixed top-1/2 left-[268px] -translate-y-1/2 w-[32px] h-[32px] bg-white border-2 border-black rounded-lg flex items-center justify-center cursor-pointer z-[10001] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] opacity-0 transition-all duration-300 ease-in-out hover:opacity-100 hover:bg-[#4ade80] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[1px] hover:translate-y-[-49%] active:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-[2px] active:translate-y-[-48%] group-hover/toggle:opacity-100">
            <svg id="chevronIcon" class="w-4 h-4 font-black" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
        </button>
    </div>

    <!-- Main Flexbox Container (Zero-Scroll Wrapper) -->
    <div class="flex h-screen w-full overflow-hidden">

        <!-- Column 1: Sidebar (Tailwind Width Classes: w-64 open, w-20 collapsed) -->
        <aside id="sidebar"
            class="sidebar flex-shrink-0 w-64 bg-white rounded-xl m-6 mr-0 px-4 py-6 z-[100] overflow-y-auto border-[3px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col transition-all duration-300 ease-in-out [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
            <!-- Logo Header -->
            <div class="mb-6 sidebar-header flex items-center gap-3 transition-all duration-300 ease-in-out">
                <!-- Logo SVG -->
                <img src="{{ asset('assets/TaskMate.svg') }}" alt="TaskMate Logo" class="h-8 w-8 flex-shrink-0">

                <!-- Brand Text (Hidden when collapsed) -->
                <h1 class="sidebar-text text-xl font-black tracking-tight uppercase whitespace-nowrap">
                    <span class="text-gray-900">TASK</span><span class="text-blue-600">MATE</span>
                </h1>
            </div>

            <!-- Profile Card (Horizontal Layout) -->
            <div
                class="profile-card bg-[#4ade80] rounded-lg p-4 mb-6 flex items-center gap-3 border-[3px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <!-- Avatar Circle (Left Side) -->
                <div
                    class="w-12 h-12 rounded-full bg-white flex items-center justify-center flex-shrink-0 text-xl font-black text-black border-2 border-black">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <!-- User Info (Right Side) -->
                <div class="sidebar-text flex-1 min-w-0">
                    <div class="text-black font-black text-sm mb-0.5 truncate">
                        {{ Auth::user()->name }}
                    </div>
                    <div class="text-black/70 text-[10px] truncate font-bold">
                        {{ Auth::user()->email }}
                    </div>
                </div>
            </div>

            <!-- Menu Items -->
            <nav class="flex flex-col space-y-2">
                <x-menu-item active icon="🏠" label="Dashboard" href="#" />
                <x-menu-item icon="✓" label="Tasks" href="#" />
                <x-menu-item icon="📋" label="Boards" href="#" />
                <x-menu-item icon="⚙️" label="Settings" href="#" />
            </nav>

            <!-- Logout Button -->
            <div class="mt-auto pt-4 border-t-[3px] border-black">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full menu-item block px-4 py-3 rounded-lg text-sm font-black cursor-pointer transition-all duration-200 text-black bg-white border-2 border-black hover:bg-red-500 hover:text-white hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px]">
                        <span class="menu-icon hidden text-xl">🚪</span>
                        <span class="sidebar-text">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Column 2: Main Content (Flexible - flex-1, Scrollbar Hidden) -->
        <main
            class="main-content flex-1 overflow-hidden transition-all duration-300 ease-in-out p-6 pl-6 flex flex-col gap-4 [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">

            <!-- Row 1: Welcome + Clock (50/50 Split) -->
            <div class="grid grid-cols-2 gap-4 flex-shrink-0">
                <!-- Welcome Card -->
                <x-dashboard-card title="Welcome back, {{ Auth::user()->name }}! 👋"
                    subtitle="You're doing great! Keep up the momentum and crush your goals today." :badge="[
                        'label' => 'Your Status',
                        'icon' => '🔥',
                        'text' => 'On Fire!',
                    ]" />

                <!-- Digital Clock with Notification -->
                <div
                    class="bg-white rounded-xl border-[3px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-5 flex flex-col items-center justify-center transition-all duration-200 h-full hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] relative">
                    <!-- Notification Icon (Top Right) -->
                    <div class="absolute top-4 right-4">
                        <div
                            class="w-10 h-10 bg-blue-500 rounded-lg border-2 border-black flex items-center justify-center cursor-pointer hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all duration-200">
                            <span class="text-[18px]">🔔</span>
                        </div>
                    </div>

                    <div class="flex flex-col items-center gap-2 w-full">
                        <div
                            class="w-12 h-12 bg-blue-500 rounded-lg border-2 border-black flex items-center justify-center flex-shrink-0 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                            <span class="text-[24px]">🕐</span>
                        </div>

                        <div class="flex flex-col gap-0.5">
                            <div id="clock-time"
                                class="text-4xl font-black text-[#1b1b18] tracking-[-1px] leading-none text-center">
                                00:00:<span class="text-blue-500">00</span>
                            </div>
                            <div id="clock-date" class="text-xs text-gray-600 font-bold text-center">
                                Loading...
                            </div>
                            <div id="clock-greeting"
                                class="text-[12px] text-black font-black px-3 py-1 bg-[#4ade80] border-2 border-black rounded-lg mt-1.5 text-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                Good Morning!
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 2: Current Task (Compact Horizontal) -->
            <div class="flex-shrink-0">
                <div
                    class="bg-blue-500 rounded-xl border-[3px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-4 flex items-center gap-4 transition-all duration-200 hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    <div class="flex items-center gap-3 flex-1">
                        <div class="text-2xl">📝</div>
                        <div class="flex-1">
                            <h3 class="text-sm font-black text-white mb-0.5">Tugas Saat Ini</h3>
                            <p class="text-xs text-white font-medium">Review project proposal and prepare presentation
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 min-w-[200px]">
                        <div class="flex-1 bg-white/30 rounded-full h-2 border-2 border-black">
                            <div class="bg-white h-full rounded-full transition-all duration-300 border-r-2 border-black"
                                style="width: 75%"></div>
                        </div>
                        <span class="text-xs font-black text-white whitespace-nowrap">75%</span>
                    </div>
                </div>
            </div>

            <!-- Row 3: Focus Mode + Quick Actions (Horizontal Compact) -->
            <div class="grid grid-cols-[1fr_2fr] gap-4 flex-shrink-0">
                <!-- Focus Mode (Compact) -->
                <div
                    class="bg-white rounded-xl border-[3px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-4 flex items-center gap-3 transition-all duration-200 hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    <div class="text-3xl">🎯</div>
                    <div class="flex-1">
                        <h3 class="text-sm font-black text-[#1b1b18] mb-1.5">Focus Mode</h3>
                        <button
                            class="px-4 py-1.5 bg-blue-500 text-white text-xs font-black rounded-lg border-2 border-black hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all duration-200">
                            Start Session
                        </button>
                    </div>
                </div>

                <!-- Quick Actions (Compact Grid) -->
                <div
                    class="bg-white rounded-xl border-[3px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-4 transition-all duration-200 hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    <h3 class="text-sm font-black text-[#1b1b18] mb-3">Quick Actions</h3>
                    <div class="grid grid-cols-4 gap-2">
                        <a href="#"
                            class="flex flex-col items-center justify-center p-3 bg-white border-2 border-black rounded-lg no-underline transition-all duration-200 cursor-pointer hover:bg-[#4ade80] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px]">
                            <span class="text-[20px] mb-1">➕</span>
                            <span class="text-[10px] font-black text-[#1b1b18] text-center">New Task</span>
                        </a>
                        <a href="#"
                            class="flex flex-col items-center justify-center p-3 bg-white border-2 border-black rounded-lg no-underline transition-all duration-200 cursor-pointer hover:bg-[#4ade80] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px]">
                            <span class="text-[20px] mb-1">📁</span>
                            <span class="text-[10px] font-black text-[#1b1b18] text-center">Project</span>
                        </a>
                        <a href="#"
                            class="flex flex-col items-center justify-center p-3 bg-white border-2 border-black rounded-lg no-underline transition-all duration-200 cursor-pointer hover:bg-[#4ade80] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px]">
                            <span class="text-[20px] mb-1">👥</span>
                            <span class="text-[10px] font-black text-[#1b1b18] text-center">Team</span>
                        </a>
                        <a href="#"
                            class="flex flex-col items-center justify-center p-3 bg-white border-2 border-black rounded-lg no-underline transition-all duration-200 cursor-pointer hover:bg-[#4ade80] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px]">
                            <span class="text-[20px] mb-1">📊</span>
                            <span class="text-[10px] font-black text-[#1b1b18] text-center">Reports</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Row 4: Recent Activity (Flexible Height with Internal Scroll) -->
            <div class="flex-1 overflow-hidden min-h-0">
                <div
                    class="bg-white rounded-xl border-[3px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-5 h-full flex flex-col">
                    <h3 class="text-sm font-black text-[#1b1b18] mb-3 pb-2 border-b-[3px] border-black flex-shrink-0">
                        Recent Activity</h3>

                    <!-- Scrollable Activity List -->
                    <div
                        class="flex-1 overflow-y-auto [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
                        <div
                            class="flex items-start gap-3 p-3 rounded-lg mb-2 transition-all duration-200 hover:bg-gray-50">
                            <div
                                class="w-8 h-8 rounded-lg flex items-center justify-center text-sm flex-shrink-0 bg-blue-50 text-blue-500">
                                ✓
                            </div>
                            <div class="flex-1">
                                <p class="text-[12px] text-[#1b1b18] font-medium mb-0.5">Completed task "Review project
                                    proposal"
                                </p>
                                <p class="text-[10px] text-gray-400">2 hours ago</p>
                            </div>
                        </div>

                        <div
                            class="flex items-start gap-3 p-3 rounded-lg mb-2 transition-all duration-200 hover:bg-gray-50">
                            <div
                                class="w-9 h-9 rounded-lg flex items-center justify-center text-base flex-shrink-0 bg-green-50 text-green-600">
                                📝
                            </div>
                            <div class="flex-1">
                                <p class="text-[12px] text-[#1b1b18] font-medium mb-0.5">Created new project "Website
                                    Redesign"
                                </p>
                                <p class="text-[10px] text-gray-400">5 hours ago</p>
                            </div>
                        </div>

                        <div
                            class="flex items-start gap-3 p-3 rounded-lg mb-2 transition-all duration-200 hover:bg-gray-50">
                            <div
                                class="w-9 h-9 rounded-lg flex items-center justify-center text-base flex-shrink-0 bg-purple-50 text-purple-600">
                                👥
                            </div>
                            <div class="flex-1">
                                <p class="text-[12px] text-[#1b1b18] font-medium mb-0.5">Added 3 team members to
                                    project
                                </p>
                                <p class="text-[10px] text-gray-400">Yesterday</p>
                            </div>
                        </div>

                        <div
                            class="flex items-start gap-3 p-2.5 rounded-lg mb-1.5 transition-all duration-200 hover:bg-gray-50">
                            <div
                                class="w-8 h-8 rounded-lg flex items-center justify-center text-sm flex-shrink-0 bg-orange-50 text-orange-600">
                                📅
                            </div>
                            <div class="flex-1">
                                <p class="text-[12px] text-[#1b1b18] font-medium mb-0.5">Scheduled meeting for tomorrow
                                </p>
                                <p class="text-[10px] text-gray-400">2 days ago</p>
                            </div>
                        </div>

                        <div
                            class="flex items-start gap-3 p-2.5 rounded-lg mb-1.5 transition-all duration-200 hover:bg-gray-50">
                            <div
                                class="w-8 h-8 rounded-lg flex items-center justify-center text-sm flex-shrink-0 bg-pink-50 text-pink-600">
                                🎉
                            </div>
                            <div class="flex-1">
                                <p class="text-[12px] text-[#1b1b18] font-medium mb-0.5">Completed milestone "Phase 1"
                                </p>
                                <p class="text-[10px] text-gray-400">3 days ago</p>
                            </div>
                        </div>

                        <div
                            class="flex items-start gap-3 p-2.5 rounded-lg mb-1.5 transition-all duration-200 hover:bg-gray-50">
                            <div
                                class="w-8 h-8 rounded-lg flex items-center justify-center text-sm flex-shrink-0 bg-indigo-50 text-indigo-600">
                                💼
                            </div>
                            <div class="flex-1">
                                <p class="text-[12px] text-[#1b1b18] font-medium mb-0.5">Updated task priorities
                                </p>
                                <p class="text-[10px] text-gray-400">4 days ago</p>
                            </div>
                        </div>

                        <div
                            class="flex items-start gap-3 p-2.5 rounded-lg transition-all duration-200 hover:bg-gray-50">
                            <div
                                class="w-8 h-8 rounded-lg flex items-center justify-center text-sm flex-shrink-0 bg-yellow-50 text-yellow-600">
                                ⭐
                            </div>
                            <div class="flex-1">
                                <p class="text-[12px] text-[#1b1b18] font-medium mb-0.5">Received positive feedback
                                </p>
                                <p class="text-[10px] text-gray-400">5 days ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>

        <!-- Column 3: Right Widgets (Fixed Width - 256px) -->
        @include('components.kalender')

    </div>

    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
