<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Guru') - Absensi Sekolah</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600&family=Telex:wght@400&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #C5D89D;
            min-height: 100vh;
            color: #000;
        }

        /* Container Utama */
        .container-guru {
            display: flex;
            min-height: 100vh;
            gap: 0;
            position: relative;
        }

        /* Sidebar Fixed */
        .sidebar {
            width: 250px;
            background: #F6F0D7;
            border-right: 1px solid #D0C9A8;
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
            z-index: 1000;
            transition: transform 0s;
        }

        .sidebar.collapsed {
            transform: translateX(-250px);
            transition: transform 0s;
        }

        .sidebar-header {
            padding: 16px;
            border-bottom: 1px solid #D0C9A8;
            height: 140px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #9CAB84 0%, #8B9A6F 100%);
            flex-shrink: 0;
        }

        .sidebar-logo {
            width: 100%;
            height: 100%;
            max-width: 110px;
            max-height: 110px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .sidebar-menu {
            flex: 1;
            padding: 12px 0;
            display: flex;
            flex-direction: column;
            gap: 0;
            overflow-y: auto;
        }

        .sidebar-item {
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            transition: none;
            color: #333333;
            text-decoration: none;
            font-size: 14px;
            border-left: 3px solid transparent;
            position: relative;
            white-space: nowrap;
        }

        .sidebar-item:hover {
            background: rgba(156, 171, 132, 0.25);
            border-left-color: #9CAB84;
        }

        .sidebar-item.active {
            background: rgba(156, 171, 132, 0.4);
            border-left-color: #9CAB84;
            font-weight: 600;
        }

        .sidebar-item i {
            width: 20px;
            text-align: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .sidebar-footer {
            padding: 12px;
            border-top: 1px solid #D0C9A8;
            margin-top: auto;
            flex-shrink: 0;
        }

        .logout-btn {
            width: 100%;
            background: #F6F0D7;
            border: 1px solid #D0C9A8;
            border-radius: 6px;
            padding: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            color: rgba(0, 0, 0, 0.7);
        }

        .logout-btn:hover {
            background: #9CAB84;
            color: #FFFFFF;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #C5D89D;
            margin-left: 250px;
            position: relative;
            transition: margin-left 0s;
        }

        .main-content.sidebar-collapsed {
            margin-left: 0;
            transition: margin-left 0s;
        }

        /* Top Navbar Fixed */
        .top-navbar {
            background: #F6F0D7;
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border-bottom: 1px solid #D0C9A8;
            position: sticky;
            top: 0;
            z-index: 100;
            flex-shrink: 0;
        }

        .navbar-toggle {
            background: none;
            border: none;
            color: #333333;
            font-size: 18px;
            cursor: pointer;
            padding: 8px;
            display: none;
            transition: none;
        }

        .navbar-toggle:hover {
            color: #9CAB84;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
        }

        .user-info h3 {
            font-size: 14px;
            font-weight: 600;
            color: #333333;
        }

        .user-info p {
            font-size: 11px;
            color: rgba(0, 0, 0, 0.55);
            margin-top: 1px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: #9CAB84;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FFFFFF;
            font-size: 16px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .navbar-icons {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .navbar-icons i {
            font-size: 16px;
            cursor: pointer;
            color: #333333;
            transition: none;
        }

        .navbar-icons i:hover {
            color: #9CAB84;
        }

        /* Content Area */
        .content {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 24px;
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #9CAB84;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #7A8A5F;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .sidebar {
                width: 220px;
            }

            .main-content {
                margin-left: 220px;
            }

            .content {
                padding: 20px;
            }
        }

        @media (max-width: 768px) {
            .navbar-toggle {
                display: block;
            }

            .sidebar {
                width: 240px;
            }

            .main-content {
                margin-left: 0;
            }

            .main-content.sidebar-expanded {
                margin-left: 240px;
            }

            .sidebar.collapsed {
                transform: translateX(-240px);
            }

            .top-navbar {
                padding: 10px 15px;
                gap: 8px;
            }

            .user-info h3 {
                font-size: 12px;
            }

            .user-avatar {
                width: 36px;
                height: 36px;
                font-size: 14px;
            }

            .navbar-icons {
                gap: 8px;
            }

            .navbar-icons i {
                font-size: 14px;
            }

            .content {
                padding: 15px;
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                width: 100%;
                max-width: 240px;
            }

            .sidebar.collapsed {
                transform: translateX(-100%);
            }

            .sidebar-header {
                height: 100px;
                padding: 12px;
            }

            .sidebar-logo {
                max-width: 80px;
                max-height: 80px;
            }

            .sidebar-item {
                padding: 10px 12px;
                font-size: 12px;
                gap: 8px;
            }

            .sidebar-item i {
                width: 16px;
                font-size: 14px;
            }

            .sidebar-footer {
                padding: 8px;
            }

            .logout-btn {
                padding: 8px;
                font-size: 11px;
                gap: 4px;
            }

            .top-navbar {
                padding: 8px 12px;
            }

            .navbar-user {
                gap: 8px;
            }

            .user-info h3 {
                font-size: 11px;
            }

            .user-info p {
                font-size: 9px;
            }

            .user-avatar {
                width: 32px;
                height: 32px;
                font-size: 12px;
            }

            .navbar-icons {
                gap: 6px;
            }

            .navbar-icons i {
                font-size: 12px;
            }

            .content {
                padding: 12px;
            }
        }
    </style>

    @yield('styles')
</head>
<body>
    <div class="container-guru">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <img src="{{ asset('image/logo-sekolah.png') }}" alt="Logo Sekolah">
                </div>
            </div>

            <div class="sidebar-menu">
                <a href="{{ route('guru.home') }}" class="sidebar-item {{ request()->routeIs('guru.home') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('guru.jadwal') }}" class="sidebar-item {{ request()->routeIs('guru.jadwal') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Pilih Jadwal</span>
                </a>
                <a href="{{ route('guru.absensi') }}" class="sidebar-item {{ request()->routeIs('guru.absensi') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Input Absensi</span>
                </a>
                <a href="{{ route('guru.rekap') }}" class="sidebar-item {{ request()->routeIs('guru.rekap') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i>
                    <span>Rekap Absensi</span>
                </a>
            </div>

            <div class="sidebar-footer">
                <form action="{{ route('logout') }}" method="POST" style="width: 100%;" id="logout-form" onsubmit="return false;">
                    @csrf
                    <button type="button" onclick="openLogoutModal();" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Navbar -->
            <div class="top-navbar">
                <button class="navbar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="navbar-user">
                    <div class="user-avatar">{{ substr(session('name'), 0, 1) }}</div>
                    <div class="user-info">
                        <h3>{{ session('name') }}</h3>
                        <p>Guru</p>
                    </div>
                </div>
                <div class="navbar-icons">
                    <i class="fas fa-bell"></i>
                </div>
            </div>

            <!-- Content -->
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>

    @yield('scripts')

    <script>
        // Sidebar Toggle
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.main-content');

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('sidebar-collapsed');

                // Save state to localStorage
                const isCollapsed = sidebar.classList.contains('collapsed');
                localStorage.setItem('sidebar-collapsed-guru', isCollapsed);
            });

            // Load state from localStorage on page load
            const wasCollapsed = localStorage.getItem('sidebar-collapsed-guru') === 'true';
            if (wasCollapsed) {
                sidebar.classList.add('collapsed');
                mainContent.classList.add('sidebar-collapsed');
            }
        }
    </script>

    {{-- Include Modal Components --}}
    @include('components.confirm-logout-modal')
    @include('components.action-modal')
</body>
</html>
