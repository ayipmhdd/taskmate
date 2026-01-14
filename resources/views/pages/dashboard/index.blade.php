<!DOCTYPE html>
<html lang="en" class="h-full bg-[#FDFDFC]">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - TaskMate</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Hide scrollbar in main content but keep scroll functionality */
        .main-content {
            scrollbar-width: none;
            /* Firefox */
            -ms-overflow-style: none;
            /* IE and Edge */
        }

        .main-content::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari, Opera */
        }

        /* Sidebar collapsed state */
        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar.collapsed .sidebar-text {
            display: none;
        }

        .sidebar.collapsed .profile-card {
            display: none;
        }

        .sidebar.collapsed .sidebar-header {
            justify-content: center;
        }

        .sidebar.collapsed .menu-item {
            text-align: center;
            padding: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar.collapsed .menu-icon {
            display: block;
        }

        /* Floating toggle button */
        .floating-toggle {
            position: fixed;
            top: 50%;
            left: 268px;
            /* 24px margin + 256px sidebar - 12px offset */
            transform: translateY(-50%);
            width: 26px;
            height: 26px;
            background: white;
            border: 1.5px solid #e5e5e5;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10001;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            opacity: 0;
            transition: left 0.3s ease, opacity 0.15s ease, background 0.1s ease, border-color 0.1s ease;
        }

        .toggle-hover-area {
            position: fixed;
            top: 0;
            left: 256px;
            /* 24px margin + 256px sidebar - 24px */
            width: 48px;
            height: 100%;
            z-index: 10000;
            transition: left 0.3s ease;
        }

        .toggle-hover-area:hover+.floating-toggle,
        .floating-toggle:hover {
            opacity: 1;
        }

        .floating-toggle:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        .floating-toggle:active {
            transform: translateY(-50%) scale(0.92);
        }

        .floating-toggle svg {
            width: 12px;
            height: 12px;
        }

        body.sidebar-collapsed .floating-toggle {
            left: 116px;
            /* 24px margin + 80px collapsed sidebar + 12px offset */
        }

        body.sidebar-collapsed .toggle-hover-area {
            left: 104px;
            /* 24px margin + 80px collapsed sidebar */
        }

        .menu-icon {
            display: none;
        }
    </style>
</head>

<body class="h-screen w-full font-sans antialiased text-[#1b1b18] overflow-hidden p-0 m-0 box-border">

    <!-- Floating Toggle Hover Area -->
    <div class="toggle-hover-area"></div>

    <!-- Floating Chevron Toggle Button -->
    <button class="floating-toggle" onclick="toggleSidebar()" aria-label="Toggle Sidebar">
        <svg id="chevronIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
            stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"></polyline>
        </svg>
    </button>

    <!-- Main Flexbox Container (Zero-Scroll Wrapper) -->
    <div class="flex h-screen w-full overflow-hidden">

        <!-- Column 1: Sidebar (Fixed Width - 256px when open, 80px when collapsed) -->
        <aside id="sidebar"
            class="sidebar flex-shrink-0 w-64 bg-white rounded-2xl m-6 mr-0 px-4 py-6 z-[100] overflow-y-auto shadow-[0_4px_20px_rgba(0,0,0,0.05)] border-2 border-gray-200 flex flex-col transition-all duration-300 [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
            <!-- Logo Header -->
            <div class="mb-6 sidebar-header flex items-center gap-3">
                <!-- Logo SVG -->
                <img src="{{ asset('assets/TaskMate.svg') }}" alt="TaskMate Logo" class="h-8 w-8 flex-shrink-0">

                <!-- Brand Text (Hidden when collapsed) -->
                <h1 class="sidebar-text text-xl font-black tracking-tight uppercase whitespace-nowrap">
                    <span class="text-gray-900">TASK</span><span class="text-blue-600">MATE</span>
                </h1>
            </div>

            <!-- Profile Card (Horizontal Layout) -->
            <div
                class="profile-card bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-4 mb-6 flex items-center gap-3">
                <!-- Avatar Circle (Left Side) -->
                <div
                    class="w-12 h-12 rounded-full bg-white flex items-center justify-center flex-shrink-0 text-xl font-bold text-blue-500 shadow-[0_4px_12px_rgba(0,0,0,0.1)]">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <!-- User Info (Right Side) -->
                <div class="sidebar-text flex-1 min-w-0">
                    <div class="text-white font-bold text-sm mb-0.5 truncate">
                        {{ Auth::user()->name }}
                    </div>
                    <div class="text-white/80 text-[10px] truncate">
                        {{ Auth::user()->email }}
                    </div>
                </div>
            </div>

            <!-- Menu Items -->
            <nav class="flex flex-col space-y-1">
                <x-menu-item active icon="🏠" label="Dashboard" href="#" />
                <x-menu-item icon="✓" label="Tasks" href="#" />
                <x-menu-item icon="📋" label="Boards" href="#" />
                <x-menu-item icon="⚙️" label="Settings" href="#" />
            </nav>

            <!-- Logout Button -->
            <div class="mt-auto pt-4 border-t border-gray-100">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full menu-item block px-4 py-3 rounded-lg text-sm font-semibold cursor-pointer transition-all duration-200 text-red-500 hover:bg-red-50 hover:text-red-600">
                        <span class="menu-icon hidden text-xl">🚪</span>
                        <span class="sidebar-text">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Column 2: Main Content (Flexible - flex-1) -->
        <main class="main-content flex-1 overflow-hidden transition-all duration-300 p-6 pl-6 flex flex-col gap-4">

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
                    class="bg-white rounded-[20px] border border-[rgba(25,20,0,0.08)] shadow-[0_8px_30px_rgba(0,0,0,0.02)] p-5 flex flex-col items-center justify-center transition-all duration-300 h-full hover:shadow-[0_8px_30px_rgba(59,130,246,0.08)] hover:border-[rgba(59,130,246,0.1)] relative">
                    <!-- Notification Icon (Top Right) -->
                    <div class="absolute top-4 right-4">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center cursor-pointer hover:shadow-lg transition-all duration-200">
                            <span class="text-[18px]">🔔</span>
                        </div>
                    </div>

                    <div class="flex flex-col items-center gap-2 w-full">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-[0_4px_12px_rgba(59,130,246,0.2)]">
                            <span class="text-[24px]">🕐</span>
                        </div>

                        <div class="flex flex-col gap-0.5">
                            <div id="clock-time"
                                class="text-4xl font-extrabold text-[#1b1b18] tracking-[-1px] leading-none text-center">
                                00:00:<span class="text-blue-500">00</span>
                            </div>
                            <div id="clock-date" class="text-xs text-gray-500 font-medium text-center">
                                Loading...
                            </div>
                            <div id="clock-greeting"
                                class="text-[12px] text-[#1b1b18] font-semibold px-3 py-1 bg-blue-50 rounded-lg mt-1.5 text-center">
                                Good Morning!
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 2: Current Task (Compact Horizontal) -->
            <div class="flex-shrink-0">
                <div
                    class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-[20px] shadow-[0_8px_30px_rgba(59,130,246,0.15)] p-4 flex items-center gap-4">
                    <div class="flex items-center gap-3 flex-1">
                        <div class="text-2xl">📝</div>
                        <div class="flex-1">
                            <h3 class="text-sm font-bold text-white mb-0.5">Tugas Saat Ini</h3>
                            <p class="text-xs text-white/90">Review project proposal and prepare presentation</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 min-w-[200px]">
                        <div class="flex-1 bg-white/20 rounded-full h-2">
                            <div class="bg-white h-2 rounded-full transition-all duration-300" style="width: 75%"></div>
                        </div>
                        <span class="text-xs font-semibold text-white whitespace-nowrap">75%</span>
                    </div>
                </div>
            </div>

            <!-- Row 3: Focus Mode + Quick Actions (Horizontal Compact) -->
            <div class="grid grid-cols-[1fr_2fr] gap-4 flex-shrink-0">
                <!-- Focus Mode (Compact) -->
                <div
                    class="bg-white rounded-[20px] border border-[rgba(25,20,0,0.08)] shadow-[0_8px_30px_rgba(0,0,0,0.02)] p-4 flex items-center gap-3">
                    <div class="text-3xl">🎯</div>
                    <div class="flex-1">
                        <h3 class="text-sm font-bold text-[#1b1b18] mb-1.5">Focus Mode</h3>
                        <button
                            class="px-4 py-1.5 bg-gradient-to-br from-blue-500 to-blue-600 text-white text-xs font-semibold rounded-lg hover:shadow-lg transition-all duration-200">
                            Start Session
                        </button>
                    </div>
                </div>

                <!-- Quick Actions (Compact Grid) -->
                <div
                    class="bg-white rounded-[20px] border border-[rgba(25,20,0,0.08)] shadow-[0_8px_30px_rgba(0,0,0,0.02)] p-4">
                    <h3 class="text-sm font-bold text-[#1b1b18] mb-3">Quick Actions</h3>
                    <div class="grid grid-cols-4 gap-2">
                        <a href="#"
                            class="flex flex-col items-center justify-center p-3 bg-gray-50 border border-gray-200 rounded-xl no-underline transition-all duration-200 cursor-pointer hover:bg-blue-50 hover:border-blue-500 hover:translate-y-[-2px] hover:shadow-[0_4px_12px_rgba(59,130,246,0.15)]">
                            <span class="text-[20px] mb-1">➕</span>
                            <span class="text-[10px] font-semibold text-[#1b1b18] text-center">New Task</span>
                        </a>
                        <a href="#"
                            class="flex flex-col items-center justify-center p-3 bg-gray-50 border border-gray-200 rounded-xl no-underline transition-all duration-200 cursor-pointer hover:bg-blue-50 hover:border-blue-500 hover:translate-y-[-2px] hover:shadow-[0_4px_12px_rgba(59,130,246,0.15)]">
                            <span class="text-[20px] mb-1">📁</span>
                            <span class="text-[10px] font-semibold text-[#1b1b18] text-center">Project</span>
                        </a>
                        <a href="#"
                            class="flex flex-col items-center justify-center p-3 bg-gray-50 border border-gray-200 rounded-xl no-underline transition-all duration-200 cursor-pointer hover:bg-blue-50 hover:border-blue-500 hover:translate-y-[-2px] hover:shadow-[0_4px_12px_rgba(59,130,246,0.15)]">
                            <span class="text-[20px] mb-1">👥</span>
                            <span class="text-[10px] font-semibold text-[#1b1b18] text-center">Team</span>
                        </a>
                        <a href="#"
                            class="flex flex-col items-center justify-center p-3 bg-gray-50 border border-gray-200 rounded-xl no-underline transition-all duration-200 cursor-pointer hover:bg-blue-50 hover:border-blue-500 hover:translate-y-[-2px] hover:shadow-[0_4px_12px_rgba(59,130,246,0.15)]">
                            <span class="text-[20px] mb-1">📊</span>
                            <span class="text-[10px] font-semibold text-[#1b1b18] text-center">Reports</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Row 4: Recent Activity (Flexible Height with Internal Scroll) -->
            <div class="flex-1 overflow-hidden min-h-0">
                <div
                    class="bg-white rounded-[20px] border border-[rgba(25,20,0,0.08)] shadow-[0_8px_30px_rgba(0,0,0,0.02)] p-5 h-full flex flex-col">
                    <h3 class="text-sm font-bold text-[#1b1b18] mb-3 pb-2 border-b-2 border-gray-100 flex-shrink-0">
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
        <aside class="flex-shrink-0 w-64 m-6 ml-0 z-[100] flex flex-col gap-4">
            <!-- Calendar Box -->
            <div
                class="bg-white rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,0.05)] border-2 border-gray-200 flex-[7] flex flex-col min-h-0">
                <!-- Calendar Header Image with Proper Alignment -->
                <div class="px-2.5 pt-2.5">
                    <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=250&h=140&fit=crop"
                        alt="Calendar header" class="w-full h-[140px] object-cover rounded-xl">
                </div>

                <div
                    class="px-2.5 pb-2.5 pt-3 flex-1 overflow-y-auto [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
                    <!-- Calendar Widget -->
                    <div class="mb-0 w-full">
                        <div class="flex items-center justify-center gap-1.5 mb-2">
                            <span id="calendar-month" class="text-xs font-bold text-[#1b1b18]">January</span>
                            <span id="calendar-year" class="text-xs font-normal text-gray-500">2026</span>
                        </div>

                        <div id="calendar-grid" class="grid grid-cols-7 gap-0 mt-0.5 w-full">
                            <!-- Calendar will be generated by JavaScript -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Agenda Box -->
            <div
                class="bg-white rounded-2xl p-3 shadow-[0_4px_20px_rgba(0,0,0,0.05)] border-2 border-gray-200 flex-[3] overflow-y-auto flex flex-col [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden min-h-0">
                <h3 class="text-xs font-bold text-[#1b1b18] mb-2 pb-2 border-b-2 border-gray-200">Today's Agenda</h3>
                <div class="text-center py-3 px-2 text-gray-400 text-[10px]">
                    No events scheduled for today
                </div>
            </div>
        </aside>

    </div>

    <script>
        // Toggle Sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const chevronIcon = document.getElementById('chevronIcon');

            sidebar.classList.toggle('collapsed');
            document.body.classList.toggle('sidebar-collapsed');

            // Update chevron direction instantly
            if (sidebar.classList.contains('collapsed')) {
                chevronIcon.innerHTML = '<polyline points="9 18 15 12 9 6"></polyline>';
            } else {
                chevronIcon.innerHTML = '<polyline points="15 18 9 12 15 6"></polyline>';
            }
        }

        // Digital Clock
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');

            const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                'October', 'November', 'December'
            ];

            const dayName = days[now.getDay()];
            const monthName = months[now.getMonth()];
            const date = now.getDate();
            const year = now.getFullYear();

            document.getElementById('clock-time').innerHTML =
                `${hours}:${minutes}:<span class="text-blue-500">${seconds}</span>`;
            document.getElementById('clock-date').textContent = `${dayName}, ${monthName} ${date}, ${year}`;

            // Update greeting
            const hour = now.getHours();
            let greeting = 'Good Evening!';
            if (hour < 12) greeting = 'Good Morning!';
            else if (hour < 18) greeting = 'Good Afternoon!';

            document.getElementById('clock-greeting').textContent = greeting;
        }

        // Calendar
        function generateCalendar() {
            const now = new Date();
            const year = now.getFullYear();
            const month = now.getMonth();
            const today = now.getDate();

            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                'October', 'November', 'December'
            ];
            document.getElementById('calendar-month').textContent = months[month];
            document.getElementById('calendar-year').textContent = year;

            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const daysInPrevMonth = new Date(year, month, 0).getDate();

            const calendarGrid = document.getElementById('calendar-grid');
            calendarGrid.innerHTML = '';

            // Day names
            const dayNames = ['S', 'M', 'T', 'W', 'T', 'F', 'S'];
            dayNames.forEach(day => {
                const dayEl = document.createElement('div');
                dayEl.className = 'text-center text-[8px] font-semibold text-gray-500 py-0.5';
                dayEl.textContent = day;
                calendarGrid.appendChild(dayEl);
            });

            // Previous month days
            for (let i = firstDay - 1; i >= 0; i--) {
                const dayEl = document.createElement('div');
                dayEl.className =
                    'aspect-[1.5/1] flex items-center justify-center text-[10px] rounded cursor-pointer transition-all duration-200 text-gray-300 hover:bg-gray-100';
                dayEl.textContent = daysInPrevMonth - i;
                calendarGrid.appendChild(dayEl);
            }

            // Current month days
            for (let day = 1; day <= daysInMonth; day++) {
                const dayEl = document.createElement('div');
                let classes =
                    'aspect-[1.5/1] flex items-center justify-center text-[10px] rounded cursor-pointer transition-all duration-200 hover:bg-gray-100';

                if (day === today) {
                    classes =
                        'aspect-[1.5/1] flex items-center justify-center text-[10px] rounded cursor-pointer transition-all duration-200 bg-blue-500 text-white font-bold';
                }

                dayEl.className = classes;
                dayEl.textContent = day;
                calendarGrid.appendChild(dayEl);
            }

            // Next month days
            const totalCells = calendarGrid.children.length - 7;
            const remainingCells = 42 - totalCells - 7;
            for (let day = 1; day <= remainingCells; day++) {
                const dayEl = document.createElement('div');
                dayEl.className =
                    'aspect-[1.5/1] flex items-center justify-center text-[10px] rounded cursor-pointer transition-all duration-200 text-gray-300 hover:bg-gray-100';
                dayEl.textContent = day;
                calendarGrid.appendChild(dayEl);
            }
        }

        // Initialize
        updateClock();
        setInterval(updateClock, 1000);
        generateCalendar();
    </script>

</body>

</html>
