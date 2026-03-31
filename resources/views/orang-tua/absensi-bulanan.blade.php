@extends('layouts.orang-tua')

@section('title', 'Rekap Bulanan - Orang Tua')
@section('page-title', 'Rekap Absensi Bulanan')

@section('styles')
<style>
    /* Page Header */
    .page-header {
        background: #F6F0D7;
        border-radius: 8px;
        padding: 12px 16px;
        margin-bottom: 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
    }

    .header-content {
        display: flex;
        align-items: center;
        gap: 12px;
        flex: 1;
    }

    .header-title {
        font-family: 'Poppins', sans-serif;
        font-size: 16px;
        font-weight: 600;
        color: #333333;
    }

    .header-subtitle {
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        font-weight: 500;
        color: #333333;
    }

    /* Filter Section */
    .filter-section {
        background: #F6F0D7;
        border: 1px solid #D0C9A8;
        border-radius: 6px;
        padding: 12px;
        margin-bottom: 18px;
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }

    .month-selector {
        background: #E8E4D0;
        border: 1px solid #D0C9A8;
        border-radius: 6px;
        padding: 8px 12px;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        font-weight: 600;
        color: #333333;
        cursor: pointer;
        min-width: 120px;
        text-align: center;
    }

    .nav-button {
        background: #F6F0D7;
        border: 1px solid #D0C9A8;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 14px;
        color: #333333;
        transition: none;
    }

    .nav-button:hover {
        background: #E8E4D0;
    }

    /* Main Summary Card */
    .summary-card {
        background: #F6F0D7;
        border: 1px solid #D0C9A8;
        border-radius: 8px;
        padding: 14px;
        margin-bottom: 18px;
    }

    .summary-header {
        background: #E8E4D0;
        border: 1px solid #D0C9A8;
        border-radius: 6px;
        padding: 12px;
        margin: -14px -14px 14px -14px;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: #333333;
    }

    /* Summary Grid */
    .summary-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }

    .summary-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        padding: 12px;
        background: #F6F0D7;
        border: 1px solid #E8E4D0;
        border-radius: 6px;
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
        color: #333333;
    }

    .summary-value {
        font-family: 'Poppins', sans-serif;
        font-size: 16px;
        font-weight: 700;
        color: #333333;
        text-align: center;
    }

    .summary-unit {
        font-family: 'Poppins', sans-serif;
        font-size: 11px;
        font-weight: 500;
        color: rgba(0, 0, 0, 0.7);
    }

    /* Divider */
    .divider {
        height: 1px;
        background: #D0C9A8;
        margin: 12px 0;
    }

    .divider-vertical {
        width: 1px;
        background: #D0C9A8;
        margin: 0 14px;
        min-height: 80px;
    }

    /* Attendance Details Grid */
    .details-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 14px;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #E8E4D0;
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .detail-label {
        font-family: 'Poppins', sans-serif;
        font-size: 12px;
        font-weight: 500;
        color: #333333;
    }

    .detail-value {
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: #333333;
        margin-right: 8px;
    }

    .detail-colon {
        font-weight: 500;
        color: rgba(0, 0, 0, 0.7);
        margin: 0 4px;
    }

    .detail-unit {
        font-family: 'Poppins', sans-serif;
        font-size: 11px;
        font-weight: 500;
        color: rgba(0, 0, 0, 0.7);
    }

    /* Status Icons Row */
    .status-icons-row {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 12px;
        padding-top: 12px;
        border-top: 1px solid #E8E4D0;
    }

    .status-icon-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .icon-badge {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 14px;
    }

    .icon-badge.hadir {
        background: #00BA00;
    }

    .icon-badge.izin {
        background: #F4B400;
    }

    .icon-badge.alfa {
        background: #F40800;
    }

    .status-icon-label {
        font-family: 'Poppins', sans-serif;
        font-size: 11px;
        font-weight: 500;
        color: rgba(0, 0, 0, 0.7);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .summary-grid {
            grid-template-columns: 1fr;
        }

        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .details-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .summary-grid {
            grid-template-columns: 1fr;
        }

        .filter-section {
            flex-direction: column;
            align-items: stretch;
        }

        .month-selector {
            width: 100%;
        }

        .header-title,
        .header-subtitle {
            font-size: 14px;
        }

        .summary-value {
            font-size: 14px;
        }

        .status-icons-row {
            flex-wrap: wrap;
        }
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="header-content">
        <h1 class="header-title">Ringkas</h1>
        <span style="font-size: 18px; color: rgba(0, 0, 0, 0.5);">&nbsp;</span>
        <h2 class="header-subtitle">Februari</h2>
    </div>
</div>

<!-- Filter Section -->
<div class="filter-section">
    <div style="display: flex; align-items: center; gap: 12px;">
        <button class="nav-button">
            <i class="fas fa-chevron-left"></i>
        </button>
        <div class="month-selector">
            <span>Februari</span>
        </div>
        <button class="nav-button">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</div>

<!-- Summary Card -->
<div class="summary-card">
    <div class="summary-header">
        <span><i class="fas fa-chart-pie" style="margin-right: 8px;"></i>Ringkas</span>
    </div>

    <div class="summary-grid">
        <div class="summary-item">
            <div class="summary-icon hadir">
                <i class="fas fa-check"></i>
            </div>
            <div class="summary-label">Hadir</div>
            <div>
                <div class="summary-value">18</div>
                <div class="summary-unit">Hari</div>
            </div>
        </div>

        <div class="summary-item">
            <div class="summary-icon izin">
                <i class="fas fa-file-contract"></i>
            </div>
            <div class="summary-label">Izin</div>
            <div>
                <div class="summary-value">5</div>
                <div class="summary-unit">Hari</div>
            </div>
        </div>

        <div class="summary-item">
            <div class="summary-icon alfa">
                <i class="fas fa-times"></i>
            </div>
            <div class="summary-label">Alfa</div>
            <div>
                <div class="summary-value">2</div>
                <div class="summary-unit">Hari</div>
            </div>
        </div>
    </div>
</div>

<!-- Detailed Information -->
<div class="summary-card">
    <div class="detail-item">
        <span class="detail-label">Hadir</span>
        <div style="display: flex; align-items: center;">
            <span class="detail-value" style="color: #00BA00;">18</span>
            <span class="detail-colon">:</span>
            <span class="detail-unit">Hari</span>
        </div>
    </div>

    <div class="detail-item">
        <span class="detail-label">Izin</span>
        <div style="display: flex; align-items: center;">
            <span class="detail-value" style="color: #F4B400;">5</span>
            <span class="detail-colon">:</span>
            <span class="detail-unit">Hari</span>
        </div>
    </div>

    <div class="detail-item">
        <span class="detail-label">Alfa</span>
        <div style="display: flex; align-items: center;">
            <span class="detail-value" style="color: #F40800;">2</span>
            <span class="detail-colon">:</span>
            <span class="detail-unit">Hari</span>
        </div>
    </div>

    <div class="status-icons-row">
        <div class="status-icon-item">
            <div class="icon-badge hadir">
                <i class="fas fa-check"></i>
            </div>
            <span class="status-icon-label">Hadir</span>
        </div>

        <div class="status-icon-item">
            <div class="icon-badge izin">
                <i class="fas fa-exclamation"></i>
            </div>
            <span class="status-icon-label">Izin</span>
        </div>

        <div class="status-icon-item">
            <div class="icon-badge alfa">
                <i class="fas fa-times"></i>
            </div>
            <span class="status-icon-label">Alfa</span>
        </div>
    </div>
</div>

<!-- Monthly Statistics -->
<div class="summary-card">
    <div class="summary-header">
        <span><i class="fas fa-bar-chart" style="margin-right: 8px;"></i>Statistik Bulanan</span>
    </div>

    <div class="details-grid" style="margin-top: 16px;">
        <div>
            <div class="detail-item">
                <span class="detail-label">Total Hari Sekolah</span>
                <span class="detail-value">25</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Persentase Kehadiran</span>
                <span class="detail-value" style="color: #00BA00;">85%</span>
            </div>
        </div>

        <div>
            <div class="detail-item">
                <span class="detail-label">Catatan Penting</span>
                <span class="detail-value" style="color: #9CAB84;">Baik</span>
            </div>
        </div>
    </div>
</div>
@endsection
