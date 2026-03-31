@extends('layouts.orang-tua')

@section('title', 'Dashboard Orang Tua')
@section('page-title', 'Dashboard')

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
    }

    .header-user {
        text-align: right;
    }

    .header-user-name {
        font-family: 'Poppins', sans-serif;
        font-size: 16px;
        font-weight: 600;
        color: #333333;
    }

    /* Main Grid */
    .dashboard-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        margin-bottom: 18px;
    }

    /* Status Card */
    .status-card {
        background: #F6F0D7;
        border: 1px solid #D0C9A8;
        border-radius: 8px;
        padding: 14px;
        display: flex;
        gap: 14px;
        align-items: center;
    }

    .status-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #9CAB84 0%, #8B9A6F 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
        flex-shrink: 0;
    }

    .status-content {
        flex: 1;
    }

    .status-label {
        font-family: 'Poppins', sans-serif;
        font-size: 12px;
        font-weight: 500;
        color: rgba(0, 0, 0, 0.7);
        margin-bottom: 2px;
    }

    .status-value {
        font-family: 'Poppins', sans-serif;
        font-size: 16px;
        font-weight: 700;
        color: #333333;
    }

    .info-section {
        background: #F6F0D7;
        border: 1px solid #D0C9A8;
        border-radius: 8px;
        padding: 14px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid #E8E4D0;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        font-weight: 500;
        color: #333333;
    }

    .info-value {
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        font-weight: 700;
        color: #333333;
    }

    /* Summary Cards Grid */
    .summary-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 12px;
    }

    .summary-card {
        background: #F6F0D7;
        border: 1px solid #D0C9A8;
        border-radius: 6px;
        padding: 12px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }

    .summary-icon {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: white;
        font-weight: bold;
    }

    .summary-icon.hadir {
        background: #00BA00;
    }

    .summary-icon.izin {
        background: #F4B400;
    }

    .summary-icon.alfa {
        background: #F40800;
    }

    .summary-label {
        font-family: 'Poppins', sans-serif;
        font-size: 11px;
        font-weight: 500;
        color: rgba(0, 0, 0, 0.7);
    }

    .summary-value {
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        font-weight: 700;
        color: #333333;
    }

    /* Chart Card */
    .chart-card {
        background: #F6F0D7;
        border: 1px solid #D0C9A8;
        border-radius: 8px;
        padding: 14px;
    }

    .chart-title {
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: #333333;
        margin-bottom: 14px;
        text-align: center;
    }

    .chart-container {
        position: relative;
        width: 200px;
        height: 200px;
        margin: 0 auto;
    }

    .pie-chart {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: conic-gradient(
            #00BA00 0deg 306deg,
            #F4B400 306deg 342deg,
            #F40800 342deg 360deg
        );
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .pie-chart::after {
        content: '';
        position: absolute;
        width: 110px;
        height: 110px;
        background: #F6F0D7;
        border-radius: 50%;
    }

    .pie-value {
        position: absolute;
        font-family: 'Poppins', sans-serif;
        font-size: 20px;
        font-weight: 700;
        color: #333333;
        z-index: 1;
    }

    .legend {
        display: flex;
        justify-content: center;
        gap: 16px;
        margin-top: 14px;
        flex-wrap: wrap;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-family: 'Poppins', sans-serif;
        font-size: 12px;
        font-weight: 500;
    }

    .legend-color {
        width: 16px;
        height: 16px;
        border-radius: 50%;
    }

    .legend-color.hadir {
        background: #00BA00;
    }

    .legend-color.izin {
        background: #F4B400;
    }

    .legend-color.alfa {
        background: #F40800;
    }

    /* Recent Activity */
    .recent-section {
        background: #F6F0D7;
        border: 1px solid #D0C9A8;
        border-radius: 8px;
        padding: 14px;
    }

    .section-header {
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: #333333;
        margin-bottom: 12px;
        padding-bottom: 10px;
        border-bottom: 1px solid #E8E4D0;
    }

    .activity-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #E8E4D0;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-info {
        flex: 1;
    }

    .activity-date {
        font-family: 'Poppins', sans-serif;
        font-size: 12px;
        font-weight: 500;
        color: #333333;
        margin-bottom: 3px;
    }

    .activity-detail {
        font-family: 'Poppins', sans-serif;
        font-size: 11px;
        font-weight: 500;
        color: rgba(0, 0, 0, 0.65);
    }

    .activity-status {
        padding: 5px 10px;
        border-radius: 16px;
        font-family: 'Poppins', sans-serif;
        font-size: 11px;
        font-weight: 600;
    }

    .activity-status.hadir {
        background: rgba(0, 186, 0, 0.15);
        color: #00BA00;
    }

    .activity-status.izin {
        background: rgba(244, 180, 0, 0.15);
        color: #F4B400;
    }

    .activity-status.alfa {
        background: rgba(244, 8, 0, 0.15);
        color: #F40800;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }

        .summary-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .header-user {
            text-align: left;
            width: 100%;
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
        }

        .status-card {
            flex-direction: column;
            text-align: center;
        }

        .summary-grid {
            grid-template-columns: 1fr;
        }

        .chart-container {
            width: 200px;
            height: 200px;
        }
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div>
        <h1 class="header-title">Dashboard Orang Tua</h1>
    </div>
    <div class="header-user">
        <p class="header-user-name">{{ auth()->user()->name ?? 'Orang Tua' }}</p>
    </div>
</div>

<!-- Student Info Section -->
<div class="status-card" style="margin-bottom: 24px; grid-column: 1 / -1;">
    <div class="status-icon">
        <i class="fas fa-user-circle"></i>
    </div>
    <div style="flex: 1;">
        <div class="info-row" style="border-bottom: none; padding: 0;">
            <span class="info-label">Nama Anak :</span>
            <span class="info-value">Andi Pratama</span>
        </div>
        <div class="info-row" style="border-bottom: none; padding: 0; margin-top: 8px;">
            <span class="info-label">Kelas :</span>
            <span class="info-value">VII B</span>
        </div>
    </div>
</div>

<!-- Main Dashboard Grid -->
<div class="dashboard-grid">
    <!-- Today's Status -->
    <div class="info-section">
        <div style="font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 600; color: #000; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid #E8E4D0;">
            Hadir Hari Ini
        </div>
        <div style="text-align: center; padding: 16px 0;">
            <div style="font-size: 48px; font-weight: 700; color: #00BA00; margin-bottom: 8px;">
                <i class="fas fa-check-circle"></i>
            </div>
            <div style="font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: 700; color: #000;">
                Hadir
            </div>
            <div style="font-family: 'Poppins', sans-serif; font-size: 14px; color: rgba(0, 0, 0, 0.65); margin-top: 8px;">
                Masuk : 06.55 | Input : 07.00
            </div>
        </div>
    </div>

    <!-- Monthly Summary -->
    <div class="info-section">
        <div style="font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 600; color: #000; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid #E8E4D0;">
            Bulan Ini
        </div>
        <div class="summary-grid" style="margin-top: 12px;">
            <div class="summary-card">
                <div class="summary-icon hadir">18</div>
                <div class="summary-label">Hadir</div>
                <div class="summary-value">Hari</div>
            </div>
            <div class="summary-card">
                <div class="summary-icon izin">5</div>
                <div class="summary-label">Izin</div>
                <div class="summary-value">Hari</div>
            </div>
            <div class="summary-card">
                <div class="summary-icon alfa">2</div>
                <div class="summary-label">Alfa</div>
                <div class="summary-value">Hari</div>
            </div>
        </div>
    </div>
</div>

<!-- Monthly Report Chart -->
<div class="chart-card" style="margin-bottom: 24px;">
    <h3 class="chart-title">Rekap Absensi Bulanan - Februari</h3>
    <div style="display: flex; flex-direction: column; align-items: center;">
        <div class="chart-container">
            <div class="pie-chart">
                <div class="pie-value">85%</div>
            </div>
        </div>
        <div class="legend" style="margin-top: 24px;">
            <div class="legend-item">
                <div class="legend-color hadir"></div>
                <span>85% Hadir</span>
            </div>
            <div class="legend-item">
                <div class="legend-color izin"></div>
                <span>10% Izin</span>
            </div>
            <div class="legend-item">
                <div class="legend-color alfa"></div>
                <span>5% Alfa</span>
            </div>
        </div>
    </div>
</div>

<!-- Daily Attendance Monitoring -->
<div class="recent-section">
    <div class="section-header">
        <i class="fas fa-list" style="margin-right: 8px;"></i>
        Pantau Kehadiran Harian
    </div>

    <div class="activity-item">
        <div class="activity-info">
            <div class="activity-date">Senin, 3 Februari</div>
            <div class="activity-detail">
                <i class="fas fa-clock" style="margin-right: 6px;"></i>
                07.00
            </div>
        </div>
        <div class="activity-status hadir">Hadir</div>
    </div>

    <div class="activity-item">
        <div class="activity-info">
            <div class="activity-date">Selasa, 4 Februari</div>
            <div class="activity-detail">
                <i class="fas fa-file-contract" style="margin-right: 6px;"></i>
                Surat di terima
            </div>
        </div>
        <div class="activity-status izin">Izin</div>
    </div>

    <div class="activity-item">
        <div class="activity-info">
            <div class="activity-date">Rabu, 5 Februari</div>
            <div class="activity-detail">
                <i class="fas fa-ban" style="margin-right: 6px;"></i>
                Tidak ada keterangan
            </div>
        </div>
        <div class="activity-status alfa">Alfa</div>
    </div>

    <div style="text-align: center; margin-top: 20px; padding-top: 16px; border-top: 1px solid #E8E4D0;">
        <a href="#" style="font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 500; color: #00BA00; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
            <i class="fas fa-arrow-right"></i>
            <span>Lihat Selengkapnya</span>
        </a>
    </div>
</div>
@endsection
