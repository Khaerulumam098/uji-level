<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Orang Tua') - Absensi Sekolah</title>

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
        .container-orang-tua {
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
            gap: 20px;
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
            margin-left: auto;
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
                width: 100%;
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .content {
                padding: 16px;
            }
        }

        @media (max-width: 640px) {
            .content {
                padding: 12px;
            }

            .navbar-user {
                gap: 8px;
            }

            .user-info h3 {
                font-size: 12px;
            }

            .user-info p {
                font-size: 10px;
            }
        }
    </style>

    @yield('styles')
</head>

<body>
    <div class="container-orang-tua">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <img src="{{ asset('image/logo-sekolah.png') }}" alt="Logo Sekolah">
                </div>
            </div>

            <nav class="sidebar-menu">
                <a href="{{ route('orang-tua.home') }}" class="sidebar-item {{ request()->routeIs('orang-tua.home') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('orang-tua.absensi-harian') }}" class="sidebar-item {{ request()->routeIs('orang-tua.absensi-harian') ? 'active' : '' }}">
                    <i class="fas fa-calendar-day"></i>
                    <span>Absensi Harian</span>
                </a>
                <a href="{{ route('orang-tua.absensi-bulanan') }}" class="sidebar-item {{ request()->routeIs('orang-tua.absensi-bulanan') ? 'active' : '' }}">
                    <i class="fas fa-calendar-check"></i>
                    <span>Rekap Bulanan</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <form method="POST" action="{{ route('logout') }}" style="width: 100%;" id="logout-form" onsubmit="return false;">
                    @csrf
                    <button type="button" onclick="openLogoutModal();" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content" id="mainContent">
            <!-- Top Navbar -->
            <div class="top-navbar">
                <button class="navbar-toggle" id="navbarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="navbar-user">
                    <div class="user-avatar">
                        {{ strtoupper(substr(auth()->user()->name ?? 'OT', 0, 1)) }}
                    </div>
                    <div class="user-info">
                        <h3>{{ auth()->user()->name ?? 'Orang Tua' }}</h3>
                        <p>Orang Tua</p>
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

    <script>
        const navbarToggle = document.getElementById('navbarToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');

        navbarToggle?.addEventListener('click', function () {
            sidebar.classList.toggle('active');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function (e) {
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(e.target) && !navbarToggle.contains(e.target)) {
                    sidebar.classList.remove('active');
                }
            }
        });
    </script>

    {{-- Include Modal Components --}}
    @include('components.confirm-logout-modal')
    @include('components.action-modal')
</body>

</html>
