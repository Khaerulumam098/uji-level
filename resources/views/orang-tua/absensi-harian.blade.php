@extends('layouts.orang-tua')

@section('title', 'Absensi Harian - Orang Tua')
@section('page-title', 'Absensi Harian')

@section('styles')
<style>
    /* Page Title */
    .page-header {
        background: #F6F0D7;
        border-radius: 8px;
        padding: 12px 16px;
        margin-bottom: 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
    }

    .header-title {
        font-family: 'Poppins', sans-serif;
        font-size: 18px;
        font-weight: 600;
        color: #333333;
        text-shadow: none;
    }

    /* Info Section */
    .info-section {
        background: #F6F0D7;
        border: 1px solid #D0C9A8;
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 18px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .info-label {
        font-family: 'Poppins', sans-serif;
        font-size: 12px;
        font-weight: 500;
        color: #333333;
    }

    .info-value {
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        font-weight: 700;
        color: #333333;
    }

    /* Main Content Card */
    .content-card {
        background: #F6F0D7;
        border-radius: 8px;
        padding: 14px;
        margin-bottom: 18px;
        filter: drop-shadow(0px 1px 3px rgba(0, 0, 0, 0.08));
    }

    .card-header {
        background: #E8E4D0;
        border-radius: 6px;
        padding: 12px;
        margin: -14px -14px 14px -14px;
        border-bottom: 1px solid #D0C9A8;
    }

    .card-title {
        font-family: 'Poppins', sans-serif;
        font-size: 16px;
        font-weight: 600;
        color: #333333;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-title i {
        font-size: 18px;
    }

    /* Status Display */
    .status-display {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 14px;
    }

    .status-badge {
        background: #00BA00;
        color: white;
        padding: 10px 16px;
        border-radius: 6px;
        font-family: 'Poppins', sans-serif;
        font-size: 24px;
        font-weight: 700;
        text-align: center;
        min-width: 80px;
    }

    .status-badge.izin {
        background: #F4B400;
    }

    .status-badge.alfa {
        background: #F40800;
    }

    /* Detail Info */
    .detail-info {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 0;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        font-weight: 500;
        color: #333333;
    }

    .detail-icon {
        width: 28px;
        height: 28px;
        background: rgba(156, 171, 132, 0.3);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        color: #9CAB84;
    }

    /* Horizontal Divider */
    .divider {
        height: 1px;
        background: #D0C9A8;
        margin: 12px 0;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .info-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .header-title {
            font-size: 28px;
        }
    }

    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }

        .status-display {
            flex-direction: column;
            align-items: flex-start;
        }

        .header-title {
            font-size: 24px;
        }

        .card-title {
            font-size: 20px;
        }

        .detail-info {
            font-size: 14px;
        }
    }
</style>
@endsection

@section('content')
<!-- Page Title -->
<div class="page-header">
    <div>
        <h1 class="header-title">Absensi Hari Ini</h1>
    </div>
</div>

<!-- Student Information -->
<div class="info-section">
    <div class="info-grid">
        <div class="info-item">
            <span class="info-label">Nama Anak :</span>
            <span class="info-value">Andi Pratama</span>
        </div>
        <div class="info-item">
            <span class="info-label">Kelas :</span>
            <span class="info-value">VII B</span>
        </div>
        <div class="info-item">
            <span class="info-label">Tanggal :</span>
            <span class="info-value">Senin, 3 Februari 2026</span>
        </div>
    </div>
</div>

<!-- Attendance Status Card -->
<div class="content-card">
    <div class="card-header">
        <div class="card-title">
            <i class="fas fa-check-circle" style="color: #00BA00;"></i>
            <span>Hadir</span>
        </div>
    </div>

    <!-- Status Display -->
    <div class="status-display">
        <div class="status-badge">
            <i class="fas fa-check"></i>
        </div>
        <div>
            <div style="font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: 700; color: #000000; margin-bottom: 4px;">
                Status Kehadiran
            </div>
            <div style="font-family: 'Poppins', sans-serif; font-size: 14px; color: rgba(0, 0, 0, 0.65);">
                Anak Anda telah hadir hari ini
            </div>
        </div>
    </div>

    <div class="divider"></div>

    <!-- Attendance Details -->
    <div style="margin-top: 20px;">
        <div class="detail-info">
            <div class="detail-icon">
                <i class="fas fa-door-open"></i>
            </div>
            <div>
                <div style="font-family: 'Poppins', sans-serif; font-size: 14px; color: rgba(0, 0, 0, 0.65); margin-bottom: 2px;">
                    Masuk Pukul
                </div>
                <div style="font-family: 'Poppins', sans-serif; font-size: 18px; font-weight: 600; color: #000000;">
                    06.55
                </div>
            </div>
        </div>

        <div class="detail-info" style="margin-top: 16px;">
            <div class="detail-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div>
                <div style="font-family: 'Poppins', sans-serif; font-size: 14px; color: rgba(0, 0, 0, 0.65); margin-bottom: 2px;">
                    Jam Input
                </div>
                <div style="font-family: 'Poppins', sans-serif; font-size: 18px; font-weight: 600; color: #000000;">
                    07.00
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Alternative Status Examples (Hidden by default) -->
<!--
<div class="content-card">
    <div class="card-header">
        <div class="card-title">
            <i class="fas fa-file-contract" style="color: #F4B400;"></i>
            <span>Izin</span>
        </div>
    </div>

    <div class="status-display">
        <div class="status-badge izin">
            <i class="fas fa-file-contract"></i>
        </div>
        <div>
            <div style="font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: 700; color: #000000; margin-bottom: 4px;">
                Status Kehadiran
            </div>
            <div style="font-family: 'Poppins', sans-serif; font-size: 14px; color: rgba(0, 0, 0, 0.65);">
                Anak Anda memiliki surat izin
            </div>
        </div>
    </div>

    <div class="divider"></div>

    <div class="detail-info">
        <div class="detail-icon" style="background: rgba(244, 180, 0, 0.2); color: #F4B400;">
            <i class="fas fa-file-contract"></i>
        </div>
        <div>
            <div style="font-family: 'Poppins', sans-serif; font-size: 14px; color: rgba(0, 0, 0, 0.65); margin-bottom: 2px;">
                Keterangan Izin
            </div>
            <div style="font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 600; color: #000000;">
                Surat di terima
            </div>
        </div>
    </div>
</div>

<div class="content-card">
    <div class="card-header">
        <div class="card-title">
            <i class="fas fa-ban" style="color: #F40800;"></i>
            <span>Alfa</span>
        </div>
    </div>

    <div class="status-display">
        <div class="status-badge alfa">
            <i class="fas fa-times"></i>
        </div>
        <div>
            <div style="font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: 700; color: #000000; margin-bottom: 4px;">
                Status Kehadiran
            </div>
            <div style="font-family: 'Poppins', sans-serif; font-size: 14px; color: rgba(0, 0, 0, 0.65);">
                Anak Anda belum hadir
            </div>
        </div>
    </div>

    <div class="divider"></div>

    <div class="detail-info">
        <div class="detail-icon" style="background: rgba(244, 8, 0, 0.2); color: #F40800;">
            <i class="fas fa-info-circle"></i>
        </div>
        <div>
            <div style="font-family: 'Poppins', sans-serif; font-size: 14px; color: rgba(0, 0, 0, 0.65); margin-bottom: 2px;">
                Keterangan
            </div>
            <div style="font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 600; color: #000000;">
                Tidak ada keterangan
            </div>
        </div>
    </div>
</div>
-->
@endsection
