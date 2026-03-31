@extends('layouts.siswa')

@section('title', 'Absen Siswa')

@section('styles')
<style>
    /* Header Section */
    .header-section {
        background: #F6F0D7;
        border-radius: 8px;
        padding: 12px 16px;
        margin-bottom: 18px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
    }

    .header-title {
        font-family: 'Poppins', sans-serif;
        font-size: 20px;
        font-weight: 600;
        color: rgba(0, 0, 0, 0.85);
        margin-bottom: 4px;
    }

    .header-subtitle {
        font-size: 11px;
        color: rgba(0, 0, 0, 0.6);
    }

    /* Modal/Card Container */
    .modal-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 300px);
        padding: 16px 0;
    }

    .form-card {
        background: #F6F0D7;
        border-radius: 8px;
        padding: 20px;
        max-width: 600px;
        width: 100%;
        box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.08);
    }

    .form-title {
        font-family: 'Poppins', sans-serif;
        font-size: 18px;
        font-weight: 600;
        color: #333333;
        text-align: center;
        margin-bottom: 18px;
    }

    /* ✅ PERBAIKAN: form-group flex column + full width
       agar label di atas dan input di bawah, tidak dipengaruhi framework */
    .form-card .form-group {
        display: flex !important;
        flex-direction: column !important;
        align-items: flex-start !important;
        width: 100% !important;
        margin-bottom: 14px;
        box-sizing: border-box;
    }

    /* ✅ PERBAIKAN: label eksplisit block & rata kiri */
    .form-card .form-label {
        font-family: 'Poppins', sans-serif;
        font-size: 12px;
        font-weight: 600;
        color: rgba(0, 0, 0, 0.8);
        margin-bottom: 6px !important;
        margin-right: 0 !important;
        display: block !important;
        width: 100% !important;
        text-align: left !important;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    /* ✅ PERBAIKAN UTAMA: form-control full width dengan !important
       agar tidak di-override Bootstrap atau framework lain */
    .form-card .form-control {
        width: 100% !important;
        max-width: 100% !important;
        padding: 10px 12px;
        font-size: 13px;
        border: 1px solid #D0C9A8;
        background: #FFFFFF;
        border-radius: 6px;
        font-family: 'Poppins', sans-serif;
        color: #333333;
        transition: none;
        box-sizing: border-box !important;
        display: block !important;
    }

    .form-card .form-control:focus {
        outline: none;
        border-color: #9CAB84;
        box-shadow: 0 0 0 3px rgba(156, 171, 132, 0.08);
    }

    .form-card .form-control::placeholder {
        color: rgba(51, 51, 51, 0.5);
    }

    /* Readonly input styling */
    .form-card .form-control:disabled,
    .form-card .form-control[readonly] {
        background: #f5f5f5;
        color: rgba(0, 0, 0, 0.6);
        cursor: not-allowed;
        border-color: #E0E0E0;
    }

    /* Select styling */
    .form-card select.form-control {
        cursor: pointer;
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-color: #FFFFFF;
        padding-right: 30px;
    }

    .form-card select.form-control option {
        padding: 8px;
        background: #fff;
        color: #333;
    }

    /* Location Info */
    .location-info-box {
        background: rgba(243, 210, 48, 0.12);
        border: 1px solid #F3D230;
        border-radius: 6px;
        padding: 12px;
        margin-bottom: 14px;
    }

    .location-info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
        font-size: 12px;
    }

    .location-info-row:last-child {
        margin-bottom: 0;
    }

    .location-label {
        font-weight: 500;
        color: rgba(0, 0, 0, 0.7);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .check-icon {
        width: 24px;
        height: 24px;
        background: #05FF0D;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 12px;
        font-weight: bold;
        flex-shrink: 0;
    }

    .location-value {
        font-weight: 500;
        color: #333333;
    }

    /* Submit Button */
    .submit-button {
        width: 100%;
        height: 38px;
        background: #9CAB84;
        border: none;
        border-radius: 6px;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        font-weight: 600;
        color: #FFFFFF;
        cursor: pointer;
        transition: none;
        display: block;
        margin: 16px auto 0;
    }

    .submit-button:hover {
        background: #7A8A5F;
    }

    .submit-button:active {
        transform: translateY(0);
    }

    /* Success Message */
    .alert {
        padding: 10px 12px;
        border-radius: 4px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        animation: slideIn 0.3s ease;
    }

    .alert-success {
        background: #c8e6c9;
        color: #2e7d32;
        border-left: 3px solid #4caf50;
    }

    .alert-error {
        background: #ffcdd2;
        color: #c62828;
        border-left: 3px solid #f44336;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Info Box */
    .info-box {
        background: #F6F0D7;
        border-left: 3px solid #9CAB84;
        padding: 10px 12px;
        border-radius: 4px;
        margin-bottom: 0;
        font-size: 11px;
        color: rgba(0, 0, 0, 0.7);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .info-box i {
        font-size: 13px;
        flex-shrink: 0;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .form-card {
            padding: 30px;
        }

        .form-title {
            font-size: 28px;
        }

        .form-card .form-label {
            font-size: 24px;
        }

        .form-card .form-control {
            font-size: 18px;
            padding: 12px 15px;
        }

        .location-info-row {
            font-size: 16px;
        }

        .submit-button {
            width: 150px;
            height: 50px;
            font-size: 24px;
        }
    }

    @media (max-width: 768px) {
        .modal-container {
            min-height: auto;
            padding: 10px;
        }

        .form-card {
            padding: 20px;
            border-radius: 8px;
        }

        .form-title {
            font-size: 24px;
            margin-bottom: 25px;
        }

        .form-card .form-label {
            font-size: 20px;
        }

        .form-card .form-group {
            margin-bottom: 20px;
        }

        .form-card .form-control {
            font-size: 16px;
            padding: 12px 15px;
        }

        .location-info-box {
            padding: 15px;
        }

        .location-info-row {
            font-size: 14px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .submit-button {
            width: 140px;
            height: 45px;
            font-size: 18px;
            margin-top: 30px;
        }
    }

    @media (max-width: 480px) {
        .header-section {
            padding: 15px;
        }

        .header-title {
            font-size: 24px;
        }

        .form-card {
            padding: 15px;
        }

        .form-title {
            font-size: 20px;
            margin-bottom: 20px;
        }

        .form-card .form-label {
            font-size: 18px;
        }

        .form-card .form-control {
            font-size: 14px;
            padding: 10px 12px;
        }

        .location-info-row {
            font-size: 12px;
        }

        .check-icon {
            width: 28px;
            height: 28px;
            font-size: 14px;
        }

        .submit-button {
            width: 120px;
            height: 40px;
            font-size: 16px;
            margin-top: 20px;
        }
    }
</style>
@endsection

@section('content')
<div>
    <!-- Header Section -->
    <div class="header-section">
        <h1 class="header-title">Absensi Siswa</h1>
        <p class="header-subtitle">Silakan lengkapi data absensi Anda</p>
    </div>

    <!-- Form Modal -->
    <div class="modal-container">
        <div class="form-card">
            <!-- Success Alert -->
            @if (session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Error Alert -->
            @if ($errors->any())
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <h2 class="form-title">Masukan Nama & Kelas</h2>

            <form action="#" method="POST" id="absenForm">
                @csrf

                <!-- Nama Field -->
                <div class="form-group">
                    <label class="form-label" for="nama">Nama</label>
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        class="form-control"
                        value="{{ session('name') }}"
                        readonly
                        disabled
                        placeholder="Nama Anda"
                    >
                    <div class="info-box" style="margin-top: 10px; font-size: 13px;">
                        <i class="fas fa-info-circle"></i> Nama tidak bisa diubah (dari akun Anda)
                    </div>
                </div>

                <!-- Kelas Field -->
                <div class="form-group">
                    <label class="form-label" for="kelas">Kelas</label>
                    <select id="kelas" name="kelas" class="form-control" required>
                        <option value="">Pilih Kelas...</option>
                        <option value="VII-A">VII-A</option>
                        <option value="VII-B">VII-B</option>
                        <option value="VII-C">VII-C</option>
                        <option value="VIII-A">VIII-A</option>
                        <option value="VIII-B">VIII-B</option>
                        <option value="VIII-C">VIII-C</option>
                        <option value="IX-A">IX-A</option>
                        <option value="IX-B">IX-B</option>
                        <option value="IX-C">IX-C</option>
                    </select>
                </div>

                <!-- Location Info -->
                <div class="location-info-box">
                    <div class="location-info-row">
                        <span class="location-label">
                            <span class="check-icon">✓</span>
                            Lokasi terdeteksi :
                        </span>
                        <span class="location-value">SMP IT YAPURA</span>
                    </div>
                    <div class="location-info-row">
                        <span class="location-label">
                            <span class="check-icon">✓</span>
                            Status :
                        </span>
                        <span class="location-value">Dalam area sekolah</span>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="submit-button">Simpan</button>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.getElementById('absenForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Simulate form submission
        const namaValue = document.getElementById('nama').value;
        const kelasValue = document.getElementById('kelas').value;

        if (!kelasValue) {
            alert('Silakan pilih kelas terlebih dahulu');
            return;
        }

        // Here you would normally send the data to the server
        console.log('Absensi submitted:', {
            nama: namaValue,
            kelas: kelasValue,
            lokasi: 'SMP IT YAPURA',
            timestamp: new Date().toISOString()
        });

        // Show success message simulation
        alert('Absensi berhasil dicatat!');
    });

    // Set kelas from user data if available
    window.addEventListener('load', function() {
        // You can set the kelas from server data here if needed
        // document.getElementById('kelas').value = '{{ session('kelas') ?? "" }}';
    });
</script>
@endsection
