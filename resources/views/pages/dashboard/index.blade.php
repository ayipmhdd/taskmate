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

        /* Container Frame Utama */
        .page-frame-container {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            z-index: 9999;
        }

        /* Border putih di sekeliling (Background Frame) */
        .frame-border {
            position: absolute;
            background: white;
        }

        .frame-border-top {
            top: 0;
            left: 0;
            right: 0;
            height: 20px;
        }

        .frame-border-left {
            top: 0;
            left: 0;
            bottom: 0;
            width: 20px;
        }

        .frame-border-right {
            top: 0;
            right: 0;
            bottom: 0;
            width: 20px;
        }

        /* Border bawah putih hanya muncul saat di akhir scroll */
        .frame-border-bottom {
            bottom: 0;
            left: 0;
            right: 0;
            height: 20px;
            background: white;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .frame-border-bottom.visible {
            opacity: 1;
        }

        /* Garis Border Hitam Utama */
        .page-border {
            position: fixed;
            top: 20px;
            left: 20px;
            right: 20px;
            bottom: 0;
            /* Default: nyambung ke bawah layar */
            border-left: 2px solid #1b1b18;
            border-right: 2px solid #1b1b18;
            border-top: 2px solid #1b1b18;
            border-bottom: none;
            /* Hilangkan garis bawah saat scrolling */
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
            pointer-events: none;
            z-index: 10000;
            transition: bottom 0.3s ease, border-radius 0.3s ease;
        }

        /* Kondisi saat mencapai dasar halaman (Sesuai Video 2) */
        .page-border.at-bottom {
            bottom: 20px;
            /* Tarik ke atas agar ada gap 20px */
            border-bottom: 2px solid #1b1b18;
            /* Munculkan garis bawah */
            border-bottom-left-radius: 20px;
            /* Bulatkan sudut */
            border-bottom-right-radius: 20px;
        }

        body {
            padding: 20px 20px 0 20px;
            /* Padding bawah diatur dinamis via content */
            box-sizing: border-box;
        }

        /* Sidebar fixed di kiri */
        .sidebar {
            position: fixed;
            top: 40px;
            /* 20px frame + 20px spacing */
            left: 40px;
            /* 20px frame + 20px spacing */
            width: 220px;
            bottom: 40px;
            /* 20px frame + 20px spacing */
            background: white;
            border-radius: 16px;
            padding: 24px 16px;
            z-index: 100;
            overflow-y: auto;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 2px solid #e5e5e5;
            display: flex;
            flex-direction: column;
            transition: width 0.3s ease, padding 0.3s ease;
        }

        /* Sidebar collapsed state */
        .sidebar.collapsed {
            width: 80px;
            padding: 24px 12px;
        }

        /* Toggle button di main content */
        .sidebar-toggle-main {
            width: 40px;
            height: 40px;
            background: white;
            border: 2px solid #e5e5e5;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }

        .sidebar-toggle-main:hover {
            background: #f3f4f6;
            border-color: #d1d5db;
        }

        .sidebar-toggle-main:active {
            transform: scale(0.95);
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
            margin-bottom: 24px;
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

        /* Main content area dengan margin untuk sidebar */
        .main-content {
            margin-left: 280px;
            /* 220px sidebar + 60px gap */
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        /* Main content when sidebar collapsed */
        body.sidebar-collapsed .main-content {
            margin-left: 140px;
            /* 80px sidebar + 60px gap */
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
    </style>
</head>

<body class="h-full font-sans antialiased text-[#1b1b18]">

    <div class="page-frame-container">
        <div class="frame-border frame-border-top"></div>
        <div class="frame-border frame-border-left"></div>
        <div class="frame-border frame-border-right"></div>
        <div class="frame-border frame-border-bottom"></div>
    </div>

    <div class="page-border"></div>

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
        <!-- Content -->
        <div class="mb-12">
            <div class="flex items-center gap-4 mb-2">
                <!-- Toggle Button -->
                <button class="sidebar-toggle-main" onclick="toggleSidebar()">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 5h14M3 10h14M3 15h14" stroke="#1b1b18" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </button>

                <h2 class="text-4xl font-black tracking-tight">
                    Selamat datang, {{ Auth::user()->name }}! 👋
                </h2>
            </div>
            <p class="text-gray-500 font-medium">
                Apa yang ingin kamu kerjakan hari ini di TaskMate?
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div
                class="group bg-white p-8 rounded-2xl border border-[#19140015] shadow-[0_8px_30px_rgb(0,0,0,0.02)] hover:shadow-[0_8px_30_rgb(59,130,246,0.08)] transition-all border-l-4 border-l-blue-600">
                <div class="flex flex-col h-full">
                    <h3 class="text-xl font-bold mb-3">Tugas & Kanban</h3>
                    <p class="text-gray-500 text-sm mb-6 leading-relaxed">
                        Kelola semua tugasmu dalam satu papan visual. Geser tugas dari 'To Do' ke 'Done' dengan mudah.
                    </p>
                    <div class="mt-auto">
                        <a href="{{ route('tasks.index') }}"
                            class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 rounded-xl bg-blue-600 text-white text-sm font-bold shadow-lg shadow-blue-600/20 hover:bg-blue-700 transition-all active:scale-[0.98]">
                            Buka Papan Kanban
                        </a>
                    </div>
                </div>
            </div>

            <div
                class="group bg-white p-8 rounded-2xl border border-[#19140015] shadow-[0_8px_30px_rgb(0,0,0,0.02)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] transition-all">
                <div class="flex flex-col h-full">
                    <h3 class="text-xl font-bold mb-3">Manajemen Board</h3>
                    <p class="text-gray-500 text-sm mb-6 leading-relaxed">
                        Buat dan atur kategori papan proyekmu agar tetap terorganisir dengan rapi.
                    </p>
                    <div class="mt-auto flex gap-3">
                        <a href="{{ route('boards.index') }}"
                            class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 rounded-xl border border-[#19140035] text-sm font-bold text-gray-700 hover:bg-gray-50 transition-all active:scale-[0.98]">
                            Lihat Semua Board
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12 p-8 bg-blue-50/50 rounded-2xl border border-blue-100 flex items-center justify-between mb-10">
            <div>
                <p class="text-blue-800 font-bold">Produktivitas Tip:</p>
                <p class="text-blue-600/80 text-sm">Fokus pada satu tugas utama hari ini untuk hasil maksimal!</p>
            </div>
            <div class="hidden sm:block text-3xl">🚀</div>
        </div>
    </div>

    <script>
        function checkScrollPosition() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const scrollHeight = document.documentElement.scrollHeight;
            const clientHeight = document.documentElement.clientHeight;

            // Toleransi 5px untuk mendeteksi apakah sudah mentok bawah
            const isAtBottom = scrollTop + clientHeight >= scrollHeight - 5;

            const pageBorder = document.querySelector('.page-border');
            const bottomFrame = document.querySelector('.frame-border-bottom');

            if (isAtBottom) {
                pageBorder.classList.add('at-bottom');
                bottomFrame.classList.add('visible');
            } else {
                pageBorder.classList.remove('at-bottom');
                bottomFrame.classList.remove('visible');
            }
        }

        window.addEventListener('scroll', checkScrollPosition);
        window.addEventListener('load', checkScrollPosition);
        window.addEventListener('resize', checkScrollPosition);

        // Toggle sidebar function
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
            document.body.classList.toggle('sidebar-collapsed');
        }
    </script>
</body>

</html>
