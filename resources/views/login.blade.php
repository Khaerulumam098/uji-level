@extends('layouts.auth')

@section('title', 'Login ' . ucfirst($role) . ' - Sistem Absensi')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    .login-container {
        width: 100%;
        max-width: 420px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .login-logo {
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .login-logo img {
        max-width: 140px;
        height: auto;
        object-fit: contain;
    }

    .login-title {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 28px;
        line-height: 36px;
        color: #333333;
        margin-bottom: 1.5rem;
        text-align: center;
        text-transform: capitalize;
    }

    .login-form {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .input-group {
        position: relative;
        width: 100%;
    }

    .input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #999999;
        font-size: 16px;
    }

    .login-input {
        width: 100%;
        height: 48px;
        background: #F6F0D7;
        border: 1.5px solid #D0C9A8;
        border-radius: 6px;
        padding: 0 1rem 0 2.8rem;
        font-family: 'Poppins', sans-serif;
        font-weight: 400;
        font-size: 14px;
        color: #333333;
        outline: none;
        transition: all 0.2s ease;
    }

    .login-input::placeholder {
        color: rgba(51, 51, 51, 0.5);
    }

    .login-input:focus {
        border-color: #9CAB84;
        box-shadow: 0px 0px 0px 3px rgba(156, 171, 132, 0.08);
    }

    .login-btn {
        width: 100%;
        height: 44px;
        background: #9CAB84;
        border: none;
        border-radius: 6px;
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 16px;
        color: #FFFFFF;
        cursor: pointer;
        margin-top: 0.5rem;
        transition: all 0.2s ease;
        box-shadow: 0px 2px 8px rgba(156, 171, 132, 0.3);
    }

    .login-btn:hover {
        background: #8a9a72;
        box-shadow: 0px 4px 12px rgba(156, 171, 132, 0.4);
    }

    .login-btn:active {
        transform: scale(0.98);
    }

    .back-link {
        margin-top: 1.5rem;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        color: rgba(51, 51, 51, 0.6);
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: color 0.2s ease;
    }

    .back-link:hover {
        color: rgba(51, 51, 51, 0.9);
    }

    .error-msg {
        background: rgba(220, 53, 69, 0.08);
        border: 1px solid rgba(220, 53, 69, 0.25);
        border-radius: 6px;
        padding: 12px 14px;
        margin-bottom: 1rem;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        color: #992235;
        width: 100%;
        text-align: center;
    }
</style>

<div class="login-container">
    {{-- Logo --}}
    <div class="login-logo">
        <img src="{{ asset('image/logo-sekolah.png') }}" alt="Logo Sekolah">
    </div>

    {{-- Title --}}
    <h1 class="login-title">
        Login {{ ucfirst($role === 'orangtua' ? 'Orang Tua' : $role) }}
    </h1>

    {{-- Error --}}
    @if ($errors->any())
        <div class="error-msg">
            {{ $errors->first() }}
        </div>
    @endif

    @if (session('error'))
        <div class="error-msg">
            {{ session('error') }}
        </div>
    @endif

    {{-- Form --}}
    <form class="login-form" method="POST" action="{{ route('login.submit') }}">
        @csrf
        <input type="hidden" name="role" value="{{ $role }}">

        {{-- Username --}}
        <div class="input-group">
            <i class="fas fa-user input-icon"></i>
            <input
                type="text"
                name="username"
                class="login-input"
                placeholder="Username"
                value="{{ old('username') }}"
                autocomplete="username"
                required
            >
        </div>

        {{-- Password --}}
        <div class="input-group">
            <i class="fas fa-lock input-icon"></i>
            <input
                type="password"
                name="password"
                class="login-input"
                placeholder="Password"
                autocomplete="current-password"
                required
            >
        </div>

        {{-- Submit --}}
        <button type="submit" class="login-btn">Login</button>
    </form>

    {{-- Kembali --}}
    <a href="{{ route('role.select') }}" class="back-link">
        <i class="fas fa-arrow-left" style="font-size: 12px;"></i>
        Kembali ke pemilihan role
    </a>
</div>
@endsection
