@extends('layouts.guru')

@section('title', 'Dashboard Guru')

@section('styles')
<style>
    /* Header Section */
    .header-section {
        background: #F6F0D7;
        border-radius: 10px;
        padding: 16px 20px;
        margin-bottom: 28px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .header-left {
        flex: 1;
    }

    .header-title {
        font-family: 'Poppins', sans-serif;
        font-size: 28px;
        font-weight: 600;
        color: rgba(0, 0, 0, 0.85);
        margin-bottom: 4px;
    }

    .header-subtitle {
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        font-weight: 500;
        color: rgba(0, 0, 0, 0.65);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .header-subtitle i {
        font-size: 13px;
    }

    .header-right {
        display: flex;
        gap: 12px;
    }

    .header-btn {
        padding: 10px 16px;
        background: #9CAB84;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: background 0.3s ease;
    }

    .header-btn:hover {
        background: #8B9A6F;
    }

    .header-btn i {
        font-size: 14px;
    }

    /* Main Grid */
    .main-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
        margin-bottom: 28px;
    }

    /* Card */
    .card {
        background: #F6F0D7;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        display: flex;
        align-items: center;
        gap: 16px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    .card-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #9CAB84 0%, #8B9A6F 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 28px;
        flex-shrink: 0;
    }

    .card-content {
        flex: 1;
    }

    .card-label {
        font-size: 12px;
        color: rgba(0, 0, 0, 0.65);
        font-weight: 500;
        margin-bottom: 4px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .card-value {
        font-size: 24px;
        font-weight: 700;
        color: #333333;
    }

    /* Stats Section */
    .stats-section {
        background: #F6F0D7;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        margin-bottom: 28px;
    }

    .stats-title {
        font-size: 18px;
        font-weight: 600;
        color: #333333;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .stats-title i {
        font-size: 20px;
        color: #9CAB84;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
    }

    .stat-item {
        padding: 16px;
        background: linear-gradient(135deg, #E8F5E9 0%, #F1F8F6 100%);
        border-left: 4px solid #9CAB84;
        border-radius: 6px;
    }

    .stat-label {
        font-size: 12px;
        color: rgba(0, 0, 0, 0.65);
        font-weight: 500;
        margin-bottom: 6px;
    }

    .stat-value {
        font-size: 22px;
        font-weight: 700;
        color: #333333;
    }

    /* Quick Links Section */
    .quick-links {
        background: #F6F0D7;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .quick-links-title {
        font-size: 18px;
        font-weight: 600;
        color: #333333;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .quick-links-title i {
        font-size: 20px;
        color: #9CAB84;
    }

    .links-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 12px;
    }

    .link-btn {
        padding: 12px 16px;
        background: #FFFFFF;
        border: 1px solid #D0C9A8;
        border-radius: 8px;
        color: #333333;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .link-btn:hover {
        background: #9CAB84;
        color: white;
        border-color: #9CAB84;
    }

    .link-btn i {
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .header-section {
            flex-direction: column;
            text-align: center;
            gap: 12px;
        }

        .header-right {
            width: 100%;
            justify-content: center;
        }

        .header-btn {
            width: 100%;
            justify-content: center;
        }

        .main-grid {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .links-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
@endsection

@section('content')
<!-- Header -->
<div class="header-section">
    <div class="header-left">
        <h1 class="header-title">Dashboard</h1>
        <p class="header-subtitle">
            <i class="fas fa-calendar-day"></i>
            Selamat datang, {{ session('name') }}
        </p>
    </div>
    <div class="header-right">
        <button class="header-btn" onclick="location.href='{{ route('guru.jadwal') }}'">
            <i class="fas fa-plus"></i>
            Pilih Jadwal
        </button>
    </div>
</div>

<!-- Cards Grid -->
<div class="main-grid">
    <!-- Total Kelas -->
    <div class="card">
        <div class="card-icon">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <div class="card-content">
            <div class="card-label">Total Kelas</div>
            <div class="card-value">4</div>
        </div>
    </div>

    <!-- Total Siswa -->
    <div class="card">
        <div class="card-icon">
            <i class="fas fa-users"></i>
        </div>
        <div class="card-content">
            <div class="card-label">Total Siswa</div>
            <div class="card-value">89</div>
        </div>
    </div>

    <!-- Mata Pelajaran -->
    <div class="card">
        <div class="card-icon">
            <i class="fas fa-book"></i>
        </div>
        <div class="card-content">
            <div class="card-label">Mata Pelajaran</div>
            <div class="card-value">3</div>
        </div>
    </div>
</div>

<!-- Statistics Section -->
<div class="stats-section">
    <h2 class="stats-title">
        <i class="fas fa-chart-line"></i>
        Statistik Bulan Ini
    </h2>
    <div class="stats-grid">
        <div class="stat-item">
            <div class="stat-label">Total Jadwal</div>
            <div class="stat-value">12</div>
        </div>
        <div class="stat-item">
            <div class="stat-label">Jadwal Selesai</div>
            <div class="stat-value">8</div>
        </div>
        <div class="stat-item">
            <div class="stat-label">Jadwal Mendatang</div>
            <div class="stat-value">4</div>
        </div>
    </div>
</div>

<!-- Quick Links -->
<div class="quick-links">
    <h2 class="quick-links-title">
        <i class="fas fa-lightning-bolt"></i>
        Akses Cepat
    </h2>
    <div class="links-grid">
        <a href="{{ route('guru.jadwal') }}" class="link-btn">
            <i class="fas fa-calendar-check"></i>
            Pilih Jadwal
        </a>
        <a href="{{ route('guru.absensi') }}" class="link-btn">
            <i class="fas fa-check-circle"></i>
            Input Absensi
        </a>
        <a href="{{ route('guru.rekap') }}" class="link-btn">
            <i class="fas fa-file-pdf"></i>
            Rekap Absensi
        </a>
        <a href="#" class="link-btn">
            <i class="fas fa-cog"></i>
            Pengaturan
        </a>
    </div>
</div>
@endsection
