<!DOCTYPE html>
<html lang="en" class="h-full bg-[#FDFDFC]">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - TaskMate</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Sembunyikan scrollbar tapi tetap bisa scroll */
        html {
            overflow-y: scroll;
            scrollbar-width: none;
            /* Firefox */
            -ms-overflow-style: none;
            /* IE and Edge */
        }

        html::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari, Opera */
        }



        /* Global Spacing System: 24px base unit */
        :root {
            --spacing-unit: 24px;
            --sidebar-width: 220px;
            --sidebar-collapsed-width: 80px;
            --right-sidebar-width: 260px;
        }

        body {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        /* Sidebar fixed di kiri - Consistent spacing */
        .sidebar {
            position: fixed;
            top: var(--spacing-unit);
            left: var(--spacing-unit);
            width: var(--sidebar-width);
            bottom: var(--spacing-unit);
            background: white;
            border-radius: 16px;
            padding: var(--spacing-unit) 16px;
            z-index: 100;
            overflow-y: auto;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 2px solid #e5e5e5;
            display: flex;
            flex-direction: column;
            transition: width 0.3s ease, padding 0.3s ease;
        }

        /* Sidebar collapsed state - INSTANT transition */
        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
            padding: var(--spacing-unit) 12px;
        }

        /* Floating Chevron Toggle Button - Aligned with spacing system */
        .floating-toggle {
            position: fixed;
            top: 50%;
            left: calc(var(--spacing-unit) + var(--sidebar-width) + (var(--spacing-unit) / 2));
            /* 24px edge + 220px sidebar + 12px (center of gap) = 256px */
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
            transition: opacity 0.15s ease, background 0.1s ease, border-color 0.1s ease;
            pointer-events: auto;
        }

        /* Hover area trigger - wider invisible area */
        .toggle-hover-area {
            position: fixed;
            top: 0;
            left: calc(var(--spacing-unit) + var(--sidebar-width));
            /* Start at sidebar edge: 24px + 220px = 244px */
            width: calc(var(--spacing-unit) * 2);
            /* Cover the gap area: 48px */
            height: 100%;
            z-index: 10000;
            pointer-events: auto;
        }

        /* Show button on hover */
        .toggle-hover-area:hover+.floating-toggle,
        .floating-toggle:hover {
            opacity: 1;
        }

        /* Button hover effect */
        .floating-toggle:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        /* Button active effect */
        .floating-toggle:active {
            transform: translateY(-50%) scale(0.92);
        }

        /* Chevron icon */
        .floating-toggle svg {
            width: 12px;
            height: 12px;
            transition: none;
            /* Instant icon change */
        }

        /* Position when sidebar collapsed */
        body.sidebar-collapsed .floating-toggle {
            left: calc(var(--spacing-unit) + var(--sidebar-collapsed-width) + (var(--spacing-unit) / 2));
            /* 24px edge + 80px sidebar + 12px (center of gap) = 116px */
        }

        body.sidebar-collapsed .toggle-hover-area {
            left: calc(var(--spacing-unit) + var(--sidebar-collapsed-width));
            /* 24px + 80px = 104px */
        }

        /* Hide text when collapsed */
        .sidebar.collapsed .sidebar-text {
            display: none;
        }

        /* Hide profile card completely when collapsed */
        .sidebar.collapsed .profile-card {
            display: none;
        }

        /* Logo icon when collapsed */
        .sidebar-logo-icon {
            display: none;
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border-radius: 12px;
            color: white;
            font-size: 24px;
            font-weight: bold;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .sidebar.collapsed .sidebar-logo-icon {
            display: flex;
        }

        /* Menu items with icons when collapsed */
        .sidebar.collapsed .menu-item {
            text-align: center;
            padding: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .menu-icon {
            display: none;
            font-size: 20px;
        }

        .sidebar.collapsed .menu-icon {
            display: block;
        }

        /* Hide scrollbar di sidebar */
        .sidebar::-webkit-scrollbar {
            display: none;
        }

        .sidebar {
            scrollbar-width: none;
        }

        /* Profile card di sidebar */
        .profile-card {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border-radius: 12px;
            padding: 20px 16px;
            margin-bottom: var(--spacing-unit);
            text-align: center;
        }

        .profile-avatar {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            font-size: 24px;
            font-weight: bold;
            color: #3b82f6;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .profile-name {
            color: white;
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 4px;
        }

        .profile-email {
            color: rgba(255, 255, 255, 0.8);
            font-size: 11px;
            word-break: break-all;
        }

        /* Menu items */
        .menu-item {
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            color: #6b7280;
        }

        .menu-item:hover {
            background: #f3f4f6;
            color: #1b1b18;
        }

        .menu-item.active {
            background: #eff6ff;
            color: #3b82f6;
            font-weight: 600;
        }

        /* Main content area - Consistent 24px gap on all sides */
        .main-content {
            margin-left: calc(var(--sidebar-width) + var(--spacing-unit) * 2);
            /* 220px sidebar + 24px left edge + 24px gap = 268px */
            margin-right: calc(var(--right-sidebar-width) + var(--spacing-unit) * 2);
            /* 260px right sidebar + 24px right edge + 24px gap = 308px */
            margin-top: var(--spacing-unit);
            /* 24px top spacing */
            padding: 0;
            transition: none;
        }

        /* Main content when sidebar collapsed */
        body.sidebar-collapsed .main-content {
            margin-left: calc(var(--sidebar-collapsed-width) + var(--spacing-unit) * 2);
            /* 80px sidebar + 24px left edge + 24px gap = 128px */
        }

        /* Right sidebar container - Consistent spacing */
        .right-sidebar {
            position: fixed;
            top: var(--spacing-unit);
            right: var(--spacing-unit);
            width: var(--right-sidebar-width);
            bottom: var(--spacing-unit);
            z-index: 100;
            display: flex;
            flex-direction: column;
            gap: var(--spacing-unit);
        }

        /* Calendar box - 70% of height */
        .calendar-box {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 2px solid #e5e5e5;
            flex: 7;
            display: flex;
            flex-direction: column;
        }

        /* Instant sidebar transition */
        .sidebar {
            transition: width 0s, padding 0s !important;
            /* 0 delay - instant */
        }

        /* Calendar header image - dengan margin sama di semua sisi */
        .calendar-image {
            width: calc(100% - 24px);
            height: 130px;
            object-fit: cover;
            display: block;
            margin: 12px;
            border-radius: 12px;
        }

        /* Calendar content */
        .calendar-content {
            padding: 0 16px 16px 16px;
            flex: 1;
            overflow-y: auto;
        }

        /* Hide scrollbar in calendar */
        .calendar-content::-webkit-scrollbar {
            display: none;
        }

        .calendar-content {
            scrollbar-width: none;
        }

        /* Calendar widget */
        .calendar-widget {
            margin-bottom: 0;
        }

        /* Calendar header - horizontal layout */
        .calendar-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 0;
        }

        .calendar-month {
            font-size: 16px;
            font-weight: 700;
            color: #1b1b18;
        }

        .calendar-year {
            font-size: 16px;
            font-weight: 400;
            color: #6b7280;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 0;
            margin-top: 6px;
        }

        .calendar-day-name {
            text-align: center;
            font-size: 8px;
            font-weight: 600;
            color: #6b7280;
            padding: 2px 0;
        }

        .calendar-day {
            aspect-ratio: 1.5 / 1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .calendar-day:hover {
            background: #f3f4f6;
        }

        .calendar-day.today {
            background: #3b82f6;
            color: white;
            font-weight: 700;
        }

        .calendar-day.other-month {
            color: #d1d5db;
        }

        /* Agenda box - 30% of height */
        .agenda-box {
            background: white;
            border-radius: 16px;
            padding: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 2px solid #e5e5e5;
            flex: 3;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        /* Hide scrollbar in agenda */
        .agenda-box::-webkit-scrollbar {
            display: none;
        }

        .agenda-box {
            scrollbar-width: none;
        }

        /* Agenda section */
        .agenda-section {
            flex: 1;
        }

        .agenda-title {
            font-size: 14px;
            font-weight: 700;
            color: #1b1b18;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e5e5e5;
        }

        .agenda-empty {
            text-align: center;
            padding: 24px 12px;
            color: #9ca3af;
            font-size: 13px;
        }

        .agenda-item {
            padding: 12px;
            background: #f9fafb;
            border-radius: 8px;
            margin-bottom: 8px;
            border-left: 3px solid #3b82f6;
        }

        .agenda-item-title {
            font-size: 13px;
            font-weight: 600;
            color: #1b1b18;
            margin-bottom: 4px;
        }

        .agenda-item-time {
            font-size: 11px;
            color: #6b7280;
        }

        /* Top bar di dalam content area */
        .top-bar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 16px;
            margin-bottom: 32px;
            padding: 16px 0;
        }

        /* Welcome Card Styles */
        .welcome-card {
            background: white;
            border-radius: 20px;
            border: 1px solid rgba(25, 20, 0, 0.08);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.02);
            padding: var(--spacing-unit) 32px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            transition: all 0.3s ease;
            height: 100%;
        }

        .welcome-card:hover {
            box-shadow: 0 8px 30px rgba(59, 130, 246, 0.08);
            border-color: rgba(59, 130, 246, 0.1);
        }

        .welcome-header {
            margin-bottom: 8px;
        }

        .welcome-title {
            font-size: 24px;
            font-weight: 800;
            color: #1b1b18;
            line-height: 1.3;
        }

        .welcome-subtitle {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .stats-section {
            margin-top: auto;
        }

        .stats-label {
            font-size: 10px;
            font-weight: 700;
            color: #9ca3af;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .stats-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: #f0fdf4;
            border: 1px solid #86efac;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            color: #16a34a;
        }

        .stats-badge-icon {
            font-size: 10px;
        }

        /* Two Column Grid for Top Section */
        .dashboard-top-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--spacing-unit);
            margin-bottom: var(--spacing-unit);
        }

        /* Digital Clock Container - Updated for grid */
        .digital-clock-container {
            background: white;
            border-radius: 20px;
            border: 1px solid rgba(25, 20, 0, 0.08);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.02);
            padding: var(--spacing-unit) 32px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            height: 100%;
        }

        .digital-clock-container:hover {
            box-shadow: 0 8px 30px rgba(59, 130, 246, 0.08);
            border-color: rgba(59, 130, 246, 0.1);
        }

        .clock-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            width: 100%;
        }

        .clock-icon-wrapper {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
        }

        .clock-icon {
            font-size: 28px;
        }

        .clock-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .clock-time {
            font-size: 48px;
            font-weight: 800;
            color: #1b1b18;
            letter-spacing: -1px;
            line-height: 1;
            text-align: center;
        }

        .clock-seconds {
            color: #3b82f6;
        }

        .clock-date {
            font-size: 14px;
            color: #6b7280;
            font-weight: 500;
            text-align: center;
        }

        .clock-greeting {
            font-size: 13px;
            color: #1b1b18;
            font-weight: 600;
            padding: 6px 14px;
            background: #eff6ff;
            border-radius: 8px;
            margin-top: 8px;
            text-align: center;
        }

        /* Quick Actions Styles */
        .quick-actions-container {
            background: white;
            border-radius: 20px;
            border: 1px solid rgba(25, 20, 0, 0.08);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.02);
            padding: var(--spacing-unit);
            margin-bottom: var(--spacing-unit);
        }

        .quick-actions-title {
            font-size: 16px;
            font-weight: 700;
            color: #1b1b18;
            margin-bottom: 16px;
        }

        .quick-actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
        }

        .quick-action-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px 16px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .quick-action-btn:hover {
            background: #eff6ff;
            border-color: #3b82f6;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }

        .quick-action-icon {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .quick-action-label {
            font-size: 13px;
            font-weight: 600;
            color: #1b1b18;
            text-align: center;
        }

        /* Recent Activity Styles */
        .recent-activity-container {
            background: white;
            border-radius: 20px;
            border: 1px solid rgba(25, 20, 0, 0.08);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.02);
            padding: var(--spacing-unit);
            margin-bottom: var(--spacing-unit);
        }

        .recent-activity-title {
            font-size: 16px;
            font-weight: 700;
            color: #1b1b18;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 2px solid #f3f4f6;
        }

        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 8px;
            transition: background 0.2s ease;
        }

        .activity-item:hover {
            background: #f9fafb;
        }

        .activity-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .activity-icon.blue {
            background: #eff6ff;
            color: #3b82f6;
        }

        .activity-icon.green {
            background: #f0fdf4;
            color: #16a34a;
        }

        .activity-icon.purple {
            background: #faf5ff;
            color: #9333ea;
        }

        .activity-content {
            flex: 1;
        }

        .activity-text {
            font-size: 13px;
            color: #1b1b18;
            font-weight: 500;
            margin-bottom: 4px;
        }

        .activity-time {
            font-size: 11px;
            color: #9ca3af;
        }

        .activity-empty {
            text-align: center;
            padding: 32px 16px;
            color: #9ca3af;
            font-size: 13px;
        }

        /* Responsive Design - Consistent spacing on all screen sizes */
        @media (max-width: 768px) {

            /* Reduce spacing unit for mobile */
            :root {
                --spacing-unit: 16px;
            }

            body {
                padding: var(--spacing-unit);
            }

            /* Hide sidebars on mobile, show only main content */
            .sidebar,
            .right-sidebar,
            .floating-toggle,
            .toggle-hover-area {
                display: none;
            }

            /* Full width main content on mobile */
            .main-content {
                margin-left: 0;
                margin-right: 0;
                padding: 0;
            }

            /* Stack columns on mobile */
            .dashboard-top-grid {
                grid-template-columns: 1fr;
            }

            /* Clock container adjustments */
            .digital-clock-container {
                padding: var(--spacing-unit);
            }

            .clock-time {
                font-size: 36px;
            }

            .clock-icon-wrapper {
                width: 48px;
                height: 48px;
            }

            .clock-icon {
                font-size: 24px;
            }

            /* Welcome card mobile adjustments */
            .welcome-card {
                padding: var(--spacing-unit);
            }

            .welcome-title {
                font-size: 20px;
            }
        }

        /* Tablet adjustments */
        @media (min-width: 769px) and (max-width: 1024px) {
            :root {
                --spacing-unit: 20px;
                --sidebar-width: 180px;
                --right-sidebar-width: 220px;
            }
        }

        /* Desktop - show greeting */
        @media (min-width: 1024px) {
            .clock-greeting {
                display: block;
            }
        }
    </style>
</head>

<body class="h-full font-sans antialiased text-[#1b1b18]">

    <!-- Floating Toggle Hover Area -->
    <div class="toggle-hover-area"></div>

    <!-- Floating Chevron Toggle Button -->
    <button class="floating-toggle" onclick="toggleSidebar()" aria-label="Toggle Sidebar">
        <svg id="chevronIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
            stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"></polyline>
        </svg>
    </button>

    <!-- Sidebar Fixed -->
    <aside class="sidebar" id="sidebar">
        <div class="mb-6">
            <h1 class="text-xl font-black tracking-tight uppercase sidebar-text">
                Task<span class="text-blue-600">Mate</span>
            </h1>
            <!-- Logo icon for collapsed state -->
            <div class="sidebar-logo-icon">T</div>
        </div>

        <!-- Profile Card -->
        <div class="profile-card">
            <div class="profile-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="profile-name sidebar-text">
                {{ Auth::user()->name }}
            </div>
            <div class="profile-email sidebar-text">
                {{ Auth::user()->email }}
            </div>
        </div>

        <nav class="space-y-1">
            <div class="menu-item active">
                <span class="menu-icon">🏠</span>
                <span class="sidebar-text">Dashboard</span>
            </div>
            <div class="menu-item">
                <span class="menu-icon">✓</span>
                <span class="sidebar-text">Tasks</span>
            </div>
            <div class="menu-item">
                <span class="menu-icon">📋</span>
                <span class="sidebar-text">Boards</span>
            </div>
            <div class="menu-item">
                <span class="menu-icon">⚙️</span>
                <span class="sidebar-text">Settings</span>
            </div>
        </nav>

        <!-- Logout Button -->
        <div class="mt-auto pt-4 border-t border-gray-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full menu-item text-red-500 hover:bg-red-50 hover:text-red-600 font-semibold">
                    <span class="menu-icon">🚪</span>
                    <span class="sidebar-text">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="main-content">

        <!-- Two Column Grid: Welcome Card & Digital Clock -->
        <div class="dashboard-top-grid">
            <!-- Welcome Card (Left Column) -->
            <div class="welcome-card">
                <div class="welcome-header">
                    <h2 class="welcome-title">Selamat Datang Kembali,<br>{{ Auth::user()->name }}</h2>
                </div>
                <p class="welcome-subtitle">
                    Kelola tugas Anda dengan efisien, pantau progress, dan raih produktivitas maksimal hari ini.
                </p>
                <div class="stats-section">
                    <div class="stats-label">Status Produktivitas</div>
                    <div class="stats-badge">
                        <span class="stats-badge-icon">📈</span>
                        <span>Meningkat (vs minggu lalu)</span>
                    </div>
                </div>
            </div>

            <!-- Digital Clock (Right Column) -->
            <div class="digital-clock-container">
                <div class="clock-content">
                    <div class="clock-icon-wrapper">
                        <div class="clock-icon">⏰</div>
                    </div>
                    <div class="clock-info">
                        <div class="clock-time">
                            <span id="hours">00</span>:<span id="minutes">00</span>:<span id="seconds"
                                class="clock-seconds">00</span>
                        </div>
                        <div class="clock-date" id="dateDisplay">Loading...</div>
                        <div class="clock-greeting" id="greeting">Selamat Bekerja! 🚀</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions-container">
            <h3 class="quick-actions-title">Aksi Cepat</h3>
            <div class="quick-actions-grid">
                <a href="{{ route('tasks.index') }}" class="quick-action-btn">
                    <div class="quick-action-icon">✅</div>
                    <div class="quick-action-label">Lihat Tugas</div>
                </a>
                <a href="{{ route('boards.index') }}" class="quick-action-btn">
                    <div class="quick-action-icon">📋</div>
                    <div class="quick-action-label">Kelola Board</div>
                </a>
                <a href="#" class="quick-action-btn" onclick="alert('Fitur segera hadir!'); return false;">
                    <div class="quick-action-icon">📊</div>
                    <div class="quick-action-label">Statistik</div>
                </a>
                <a href="#" class="quick-action-btn" onclick="alert('Fitur segera hadir!'); return false;">
                    <div class="quick-action-icon">⚙️</div>
                    <div class="quick-action-label">Pengaturan</div>
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="recent-activity-container">
            <h3 class="recent-activity-title">Aktivitas Terbaru</h3>
            <div class="activity-list">
                <div class="activity-item">
                    <div class="activity-icon blue">
                        <span>✓</span>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">Anda menyelesaikan tugas "Setup Project"</div>
                        <div class="activity-time">2 jam yang lalu</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon green">
                        <span>+</span>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">Board baru "Q1 2026 Goals" telah dibuat</div>
                        <div class="activity-time">5 jam yang lalu</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon purple">
                        <span>★</span>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">Anda mencapai streak 7 hari produktif!</div>
                        <div class="activity-time">Kemarin</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Right Sidebar Container -->
    <div class="right-sidebar">
        <!-- Calendar Box -->
        <div class="calendar-box">
            <!-- Header Image -->
            <img src="{{ Vite::asset('resources/images/calendar-header.jpg') }}" alt="Calendar Header"
                class="calendar-image"
                onerror="this.src='https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&h=200&fit=crop'">

            <!-- Calendar Content -->
            <div class="calendar-content">
                <div class="calendar-widget">
                    <div class="calendar-header">
                        <div class="calendar-month" id="calendarMonth">Januari</div>
                        <div class="calendar-year" id="calendarYear">2026</div>
                    </div>

                    <div class="calendar-grid">
                        <!-- Day names -->
                        <div class="calendar-day-name">Min</div>
                        <div class="calendar-day-name">Sen</div>
                        <div class="calendar-day-name">Sel</div>
                        <div class="calendar-day-name">Rab</div>
                        <div class="calendar-day-name">Kam</div>
                        <div class="calendar-day-name">Jum</div>
                        <div class="calendar-day-name">Sab</div>

                        <!-- Days will be appended by JavaScript -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Agenda Box -->
        <div class="agenda-box">
            <div class="agenda-section">
                <div class="agenda-title">Agenda Hari Ini</div>
                <div class="agenda-empty">
                    Tidak ada agenda hari ini
                </div>
                <!-- Example agenda items (hidden by default) -->
                <!-- <div class="agenda-item">
                    <div class="agenda-item-title">Meeting Tim</div>
                    <div class="agenda-item-time">09:00 - 10:00</div>
                </div> -->
            </div>
        </div>
    </div>

    <script>
        // Real-time Digital Clock
        function updateClock() {
            const now = new Date();

            // Get time components
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');

            // Update time display
            document.getElementById('hours').textContent = hours;
            document.getElementById('minutes').textContent = minutes;
            document.getElementById('seconds').textContent = seconds;

            // Get date components
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            const dayName = days[now.getDay()];
            const date = now.getDate();
            const monthName = months[now.getMonth()];
            const year = now.getFullYear();

            // Update date display
            const dateString = `${dayName}, ${date} ${monthName} ${year}`;
            document.getElementById('dateDisplay').textContent = dateString;

            // Update greeting based on time
            const greetingEl = document.getElementById('greeting');
            const hour = now.getHours();

            if (hour >= 5 && hour < 11) {
                greetingEl.textContent = 'Selamat Pagi! ☀️';
            } else if (hour >= 11 && hour < 15) {
                greetingEl.textContent = 'Selamat Siang! 🌤️';
            } else if (hour >= 15 && hour < 18) {
                greetingEl.textContent = 'Selamat Sore! 🌅';
            } else {
                greetingEl.textContent = 'Selamat Malam! 🌙';
            }
        }

        // Update clock immediately and then every second
        updateClock();
        setInterval(updateClock, 1000);

        // Toggle sidebar function with chevron icon change
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const chevronIcon = document.getElementById('chevronIcon');
            const isCollapsed = sidebar.classList.toggle('collapsed');
            document.body.classList.toggle('sidebar-collapsed');

            // Change chevron direction instantly
            if (isCollapsed) {
                // Chevron Right (>) when collapsed
                chevronIcon.innerHTML = '<polyline points="9 18 15 12 9 6"></polyline>';
            } else {
                // Chevron Left (<) when expanded
                chevronIcon.innerHTML = '<polyline points="15 18 9 12 15 6"></polyline>';
            }
        }

        // Generate calendar
        function generateCalendar() {
            const now = new Date();
            const year = now.getFullYear();
            const month = now.getMonth();
            const today = now.getDate();

            // Month names in Indonesian
            const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            // Update header
            document.getElementById('calendarMonth').textContent = monthNames[month];
            document.getElementById('calendarYear').textContent = year;

            // Get first day of month and total days
            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const daysInPrevMonth = new Date(year, month, 0).getDate();

            // Get the grid container
            const grid = document.querySelector('.calendar-grid');

            // Remove old date elements (keep day names)
            const oldDates = grid.querySelectorAll('.calendar-day');
            oldDates.forEach(el => el.remove());

            // Previous month days
            for (let i = firstDay - 1; i >= 0; i--) {
                const dayEl = document.createElement('div');
                dayEl.className = 'calendar-day other-month';
                dayEl.textContent = daysInPrevMonth - i;
                grid.appendChild(dayEl);
            }

            // Current month days
            for (let day = 1; day <= daysInMonth; day++) {
                const dayEl = document.createElement('div');
                dayEl.className = day === today ? 'calendar-day today' : 'calendar-day';
                dayEl.textContent = day;
                grid.appendChild(dayEl);
            }

            // Next month days to fill the grid
            const totalCells = Math.ceil((firstDay + daysInMonth) / 7) * 7;
            const remainingCells = totalCells - (firstDay + daysInMonth);
            for (let day = 1; day <= remainingCells; day++) {
                const dayEl = document.createElement('div');
                dayEl.className = 'calendar-day other-month';
                dayEl.textContent = day;
                grid.appendChild(dayEl);
            }
        }

        // Initialize calendar on page load
        window.addEventListener('load', generateCalendar);
    </script>
</body>

</html>
