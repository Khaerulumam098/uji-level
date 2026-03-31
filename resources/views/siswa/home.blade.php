@extends('layouts.siswa')

@section('title', 'Home Siswa')

@section('styles')
<style>
    /* Header Section */
    .header-section {
        background: #F6F0D7;
        border-radius: 10px;
        padding: 14px 18px;
        margin-bottom: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
    }

    .header-left {
        flex: 1;
    }

    .header-title {
        font-family: 'Poppins', sans-serif;
        font-size: 24px;
        font-weight: 600;
        color: rgba(0, 0, 0, 0.85);
        margin-bottom: 6px;
    }

    .header-date {
        font-family: 'Poppins', sans-serif;
        font-size: 12px;
        font-weight: 500;
        color: rgba(0, 0, 0, 0.65);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .header-date i {
        font-size: 14px;
    }

    /* Main Container */
    .main-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 24px;
    }

    /* Location Card */
    .location-card {
        background: #F6F0D7;
        border-radius: 10px;
        padding: 16px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
        overflow: hidden;
    }

    .location-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
        padding-bottom: 10px;
        border-bottom: 1px solid #E8E4D0;
    }

    .location-icon {
        width: 40px;
        height: 40px;
        background: #9CAB84;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #FFFFFF;
        font-size: 18px;
    }

    .location-title {
        font-size: 18px;
        font-weight: 600;
        color: #333333;
        font-family: 'Poppins', sans-serif;
    }

    .map-container {
        width: 100%;
        height: 160px;
        background: #e0e0e0;
        border-radius: 6px;
        margin-bottom: 10px;
        overflow: hidden;
        border: 1px solid #D0C9A8;
    }

    #map {
        width: 100%;
        height: 100%;
    }

    .location-info {
        background: rgba(243, 210, 48, 0.15);
        padding: 15px;
        border-radius: 8px;
        margin-top: 12px;
        border: 1px solid #F3D230;
    }

    .location-info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        font-size: 14px;
    }

    .location-info-row:last-child {
        margin-bottom: 0;
    }

    .location-label {
        font-weight: 500;
        color: rgba(0, 0, 0, 0.7);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .location-value {
        font-weight: 500;
        color: #000;
    }

    .check-icon {
        width: 28px;
        height: 28px;
        background: #05FF0D;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 14px;
        font-weight: bold;
        flex-shrink: 0;
    }

    /* Status Card */
    .status-card {
        background: #F6F0D7;
        border-radius: 8px;
        padding: 14px 16px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .status-header {
        padding-bottom: 10px;
        border-bottom: 1px solid #E8E4D0;
        margin-bottom: 12px;
    }

    .status-title {
        font-size: 16px;
        font-weight: 600;
        color: #333333;
        font-family: 'Poppins', sans-serif;
    }

    .summary-section {
        margin-bottom: 12px;
    }

    .summary-title {
        font-size: 12px;
        font-weight: 600;
        color: rgba(0, 0, 0, 0.8);
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .summary-items {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 10px;
        background: rgba(156, 171, 132, 0.15);
        border-radius: 4px;
        border-left: 3px solid #9CAB84;
    }

    .summary-item-label {
        font-size: 12px;
        font-weight: 500;
        color: rgba(0, 0, 0, 0.8);
    }

    .summary-item-value {
        font-size: 13px;
        font-weight: 700;
        color: #9CAB84;
    }

    /* Warning Box */
    .warning-box {
        background: #fff9e6;
        border-left: 3px solid #F4B400;
        border-radius: 6px;
        padding: 12px 14px;
        margin: 15px 0;
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .warning-icon {
        color: #F4B400;
        font-size: 16px;
        flex-shrink: 0;
    }

    .warning-text {
        font-size: 13px;
        color: #333333;
        font-weight: 500;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 10px;
        margin-top: 16px;
    }

    .btn-action {
        flex: 1;
        padding: 10px 12px;
        background: #9CAB84;
        color: #FFFFFF;
        border: none;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: none;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        min-height: 38px;
    }

    .btn-action:hover {
        background: #7A8A5F;
    }

    .btn-action i {
        font-size: 14px;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .main-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .header-section {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .header-title {
            font-size: 20px;
        }

        .header-date {
            font-size: 12px;
        }
    }

    @media (max-width: 768px) {
        .location-info {
            padding: 12px;
        }

        .location-info-row {
            font-size: 12px;
            flex-wrap: wrap;
            gap: 8px;
        }

        .header-title {
            font-size: 18px;
        }

        .status-card {
            padding: 12px;
        }

        .action-buttons {
            flex-direction: column;
        }
    }

    @media (max-width: 480px) {
        .header-section {
            padding: 15px;
        }

        .header-title {
            font-size: 20px;
        }

        .header-date {
            font-size: 14px;
        }

        .location-card, .status-card {
            padding: 15px;
            border-radius: 10px;
        }

        .map-container {
            height: 180px;
        }

        .location-title {
            font-size: 22px;
        }

        .location-info-row {
            font-size: 14px;
        }
    }
</style>
@endsection

@section('content')
<div>
    <!-- Header Section -->
    <div class="header-section">
        <div class="header-left">
            <h1 class="header-title">Absensi Hari Ini</h1>
            <div class="header-date">
                <i class="fas fa-calendar-alt"></i>
                <span id="current-date"></span>
            </div>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="main-grid">
        <!-- Location Card -->
        <div class="location-card">
            <div class="location-header">
                <div class="location-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h2 class="location-title">Lokasi terdeteksi</h2>
            </div>

            <div class="map-container">
                <div id="map"></div>
            </div>

            <div class="location-info">
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
        </div>

        <!-- Status Card -->
        <div class="status-card">
            <div class="status-header">
                <h2 class="status-title">Ringkasan</h2>
            </div>

            <div class="summary-section">
                <h3 class="summary-title">Status Hari Ini</h3>
                <div class="summary-items">
                    <div class="summary-item">
                        <span class="summary-item-label">Kehadiran</span>
                        <span class="summary-item-value">Belum Absen</span>
                    </div>
                </div>
            </div>

            <div class="summary-section">
                <h3 class="summary-title">Total Kehadiran Bulan Ini</h3>
                <div class="summary-items">
                    <div class="summary-item">
                        <span class="summary-item-label">Hadir</span>
                        <span class="summary-item-value">18</span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-item-label">Sakit</span>
                        <span class="summary-item-value">2</span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-item-label">Alfa</span>
                        <span class="summary-item-value">1</span>
                    </div>
                </div>
            </div>

            <div class="warning-box">
                <i class="fas fa-exclamation-circle warning-icon"></i>
                <span class="warning-text">Absensi hanya bisa dilakukan dengan lokasi sesuai</span>
            </div>

            <div class="action-buttons">
                <a href="{{ route('siswa.absen') }}" class="btn-action">
                    <i class="fas fa-calendar-check"></i>
                    Absen
                </a>
                <a href="{{ route('siswa.riwayat') }}" class="btn-action">
                    <i class="fas fa-history"></i>
                    Riwayat
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Format tanggal
    document.getElementById('current-date').textContent = new Intl.DateTimeFormat('id-ID', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    }).format(new Date());

    // Google Maps - Monas Jakarta
    function initMap() {
        const monasLocation = { lat: -6.1751, lng: 106.8270 };

        const map = new google.maps.Map(document.getElementById('map'), {
            zoom: 16,
            center: monasLocation,
            styles: [
                {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [{"color": "#e9e9e9"}, {"lightness": 17}]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry",
                    "stylers": [{"color": "#f5f5f5"}, {"lightness": 20}]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [{"color": "#ffffff"}, {"lightness": 17}]
                }
            ]
        });

        const marker = new google.maps.Marker({
            position: monasLocation,
            map: map,
            title: 'SMP IT YAPURA',
            icon: {
                path: google.maps.SymbolPath.CIRCLE,
                scale: 10,
                fillColor: '#9CAB84',
                fillOpacity: 1,
                strokeColor: '#fff',
                strokeWeight: 2
            }
        });

        const infoWindow = new google.maps.InfoWindow({
            content: '<div style="background: #f6f0d7; padding: 10px; border-radius: 5px; font-weight: 500;">SMP IT YAPURA</div>'
        });

        marker.addListener('click', () => {
            infoWindow.open(map, marker);
        });
    }

    // Initialize map when page loads
    window.addEventListener('load', initMap);
</script>
@endsection
