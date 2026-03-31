@extends('layouts.auth')

@section('title', 'Pilih Role - Sistem Absensi')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    .role-container {
        width: 100%;
        max-width: 1200px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .logo-section {
        margin-bottom: 2rem;
        text-align: center;
    }

    .logo-img {
        max-width: 160px;
        height: auto;
        object-fit: contain;
    }

    .role-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .role-header h1 {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 32px;
        line-height: 40px;
        color: #333333;
        margin-bottom: 0.75rem;
    }

    .role-header p {
        font-family: 'Poppins', sans-serif;
        font-weight: 400;
        font-size: 16px;
        color: #666666;
    }

    .role-cards {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        width: 100%;
        max-width: 1500px;
        justify-content: center;
        align-items: stretch;
    }

    .role-card {
        background: #FFFFFF;
        border: 1px solid #E8E4D0;
        border-radius: 12px;
        padding: 2rem 1.5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        text-decoration: none;
        transition: all 0.2s ease;
        box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.06);
        width: 240px;
    }

    .role-card:hover {
        transform: translateY(-4px);
        box-shadow: 0px 8px 16px rgba(156, 171, 132, 0.15);
        border-color: #9CAB84;
    }

    .role-icon {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #9CAB84 0%, #8a9a72 100%);
        border-radius: 12px;
        color: #FFFFFF;
        font-size: 40px;
    }

    .role-card h2 {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 20px;
        line-height: 28px;
        color: #333333;
        margin: 0;
    }

    .role-btn {
        background: #9CAB84;
        border-radius: 8px;
        width: 100%;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 14px;
        color: #FFFFFF;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0px 2px 8px rgba(156, 171, 132, 0.3);
    }

    .role-btn:hover {
        background: #8a9a72;
        box-shadow: 0px 4px 12px rgba(156, 171, 132, 0.4);
    }

    .role-btn:active {
        transform: scale(0.98);
    }

    @media (max-width: 768px) {
        .role-header h1 { font-size: 24px; }
        .role-header p  { font-size: 14px; }
        .role-card { width: 100%; max-width: 280px; }
        .logo-img { max-width: 120px; }
    }
</style>

<div class="role-container">
    {{-- Logo Section --}}
    <div class="logo-section">
        <img src="{{ asset('image/logo-sekolah.png') }}" alt="Logo Sekolah" class="logo-img">
    </div>

    {{-- Header --}}
    <div class="role-header">
        <h1>Selamat Datang</h1>
        <p>Silahkan pilih peran Anda untuk masuk ke sistem absensi</p>
    </div>

    {{-- Role Cards --}}
    <div class="role-cards">

        {{-- Admin --}}
        <div class="role-card">
            <div class="role-icon">
                <i class="fas fa-user-tie"></i>
            </div>
            <h2>Admin</h2>
            <a href="{{ route('login', ['role' => 'admin']) }}" class="role-btn">Login</a>
        </div>

        {{-- Guru --}}
        <div class="role-card">
            <div class="role-icon">
                <i class="fas fa-chalkboard-user"></i>
            </div>
            <h2>Guru</h2>
            <a href="{{ route('login', ['role' => 'guru']) }}" class="role-btn">Login</a>
        </div>

        {{-- Siswa --}}
        <div class="role-card">
            <div class="role-icon">
                <i class="fa-solid fa-user-graduate"></i>
            </div>
            <h2>Siswa</h2>
            <a href="{{ route('login', ['role' => 'siswa']) }}" class="role-btn">Login</a>
        </div>

        {{-- Orang Tua --}}
        <div class="role-card">
            <div class="role-icon">
                <i class="fas fa-users"></i>
            </div>
            <h2>Orang Tua</h2>
            <a href="{{ route('login', ['role' => 'orangtua']) }}" class="role-btn">Login</a>
        </div>

    </div>
</div>
@endsection
