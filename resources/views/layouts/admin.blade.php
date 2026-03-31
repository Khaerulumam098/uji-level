<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Absensi Sekolah</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600&family=Telex:wght@400&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- XLSX Library for Excel Export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.min.js"></script>

    <!-- HTML2PDF Library for PDF Export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

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
        .container-admin {
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

        .menu-section-title {
            padding: 8px 16px;
            font-size: 10px;
            font-weight: 700;
            color: rgba(0, 0, 0, 0.5);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 6px;
            margin-bottom: 6px;
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

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
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

        .navbar-title {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 600;
            color: #333333;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 12px;
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

            .navbar-title {
                font-size: 14px;
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
    <div class="container-admin">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <img src="{{ asset('image/logo-sekolah.png') }}" alt="Logo Sekolah">
                </div>
            </div>
            <nav class="sidebar-menu">
                <div class="menu-section-title">Menu Utama</div>
                <a href="{{ route('admin.home') }}" class="sidebar-item @if(Route::currentRouteName() == 'admin.home') active @endif">
                    <i class="fas fa-calendar"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.data-siswa') }}" class="sidebar-item @if(Route::currentRouteName() == 'admin.data-siswa') active @endif">
                    <i class="fas fa-user-graduate"></i>
                    <span>Data Siswa</span>
                </a>
                <a href="{{ route('admin.data-kelas') }}" class="sidebar-item @if(Route::currentRouteName() == 'admin.data-kelas') active @endif">
                    <i class="fas fa-school"></i>
                    <span>Data Kelas</span>
                </a>
                <a href="{{ route('admin.data-guru') }}" class="sidebar-item @if(Route::currentRouteName() == 'admin.data-guru') active @endif">
                    <i class="fas fa-chalkboard-user"></i>
                    <span>Data Guru</span>
                </a>
                <a href="{{ route('admin.data-jadwal') }}" class="sidebar-item @if(Route::currentRouteName() == 'admin.data-jadwal') active @endif">
                    <i class="fas fa-clock"></i>
                    <span>Data Jadwal</span>
                </a>
                <a href="{{ route('admin.manajemen-pengguna') }}" class="sidebar-item @if(Route::currentRouteName() == 'admin.manajemen-pengguna') active @endif">
                    <i class="fas fa-users"></i>
                    <span>Manajemen Pengguna</span>
                </a>
            </nav>
            <div class="sidebar-footer">
                <form action="{{ route('logout') }}" method="POST" style="width: 100%;" id="logout-form" onsubmit="return false;">
                    @csrf
                    <button type="button" onclick="openLogoutModal();" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Navbar -->
            <navbar class="top-navbar">
                <div class="navbar-left">
                    <button class="navbar-toggle" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="navbar-title">Welcome - Admin</h1>
                </div>
                <div class="navbar-right">
                    <div class="navbar-user">
                        <div class="user-info">
                            <h3>Admin</h3>
                            <p>Administrator</p>
                        </div>
                        <div class="user-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                    <div class="navbar-icons">
                        <i class="fas fa-bell"></i>
                        <i class="fas fa-gear"></i>
                    </div>
                </div>
            </navbar>

            <!-- Content -->
            <div class="content">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        // Sidebar Toggle
        const sidebarToggle = document.getElementById('sidebarToggle') || document.querySelector('.navbar-toggle');
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.main-content');

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('sidebar-collapsed');

                // Save state to localStorage
                const isCollapsed = sidebar.classList.contains('collapsed');
                localStorage.setItem('sidebarCollapsed-admin', isCollapsed);
            });
        }

        // Restore sidebar state on page load
        window.addEventListener('load', () => {
            const isCollapsed = localStorage.getItem('sidebarCollapsed-admin') === 'true';
            if (isCollapsed) {
                sidebar.classList.add('collapsed');
                mainContent.classList.add('sidebar-collapsed');
            }
        });

        // Close sidebar when clicking on a link (mobile)
        if (window.innerWidth <= 768) {
            document.querySelectorAll('.sidebar-item').forEach(item => {
                item.addEventListener('click', () => {
                    setTimeout(() => {
                        sidebar.classList.add('collapsed');
                        mainContent.classList.add('sidebar-collapsed');
                        localStorage.setItem('sidebarCollapsed-admin', true);
                    }, 100);
                });
            });
        }
    </script>

    {{-- Include Modal Components --}}
    @include('components.confirm-logout-modal')
    @include('components.action-modal')

    {{-- Yield child view scripts --}}
    @yield('scripts')
</body>
</html>
