@extends('layouts.siswa')

@section('title', 'Riwayat Absensi')

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
        color: #333333;
        margin-bottom: 4px;
    }

    .header-subtitle {
        font-size: 11px;
        color: rgba(0, 0, 0, 0.6);
    }

    /* Summary Section */
    .summary-section {
        background: #F6F0D7;
        border-radius: 8px;
        padding: 12px 14px;
        box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.06);
        margin-bottom: 18px;
    }

    .summary-title {
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: #333333;
        margin-bottom: 10px;
        text-align: center;
    }

    .summary-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }

    .stat-box {
        background: #FFFFFF;
        border: 1px solid #D0C9A8;
        border-radius: 6px;
        padding: 10px;
        text-align: center;
        box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.04);
        transition: none;
    }

    .stat-box:hover {
        transform: none;
        box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.04);
    }

    .stat-value {
        font-family: 'Poppins', sans-serif;
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
    }

    .stat-label {
        font-family: 'Poppins', sans-serif;
        font-size: 11px;
        font-weight: 500;
        color: rgba(0, 0, 0, 0.7);
        text-transform: capitalize;
    }

    .stat-value-hadir {
        color: #05FF0D;
    }

    .stat-value-izin {
        color: #F4B400;
    }

    .stat-value-alfa {
        color: #F40000;
    }

    .stat-icon {
        width: 18px;
        height: 18px;
        background: rgba(0, 0, 0, 0.08);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        flex-shrink: 0;
    }

    /* Filter Section */
    .filter-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 14px;
        gap: 10px;
        flex-wrap: wrap;
    }

    .limit-label {
        font-size: 12px;
        font-weight: 500;
        color: rgba(0, 0, 0, 0.7);
    }

    .limit-select {
        padding: 6px 8px;
        border: 1px solid #9CAB84;
        background: #FFFFFF;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
        font-family: 'Poppins', sans-serif;
    }

    /* Table Section */
    .table-container {
        background: #F6F0D7;
        border: 1px solid #D0C9A8;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        background: #F6F0D7;
    }

    .table thead {
        background: #E8E4D0;
        border-bottom: 1px solid #D0C9A8;
    }

    .table th {
        padding: 10px 12px;
        text-align: left;
        font-weight: 600;
        font-size: 12px;
        color: rgba(0, 0, 0, 0.8);
        border-right: 1px solid #D0C9A8;
        font-family: 'Poppins', sans-serif;
    }

    .table th:last-child {
        border-right: none;
    }

    .table tbody tr {
        border-bottom: 1px solid #E8E4D0;
        transition: none;
    }

    .table tbody tr:hover {
        background: rgba(156, 171, 132, 0.08);
    }

    .table td {
        padding: 10px 12px;
        font-size: 12px;
        color: rgba(0, 0, 0, 0.7);
        border-right: 1px solid #E8E4D0;
    }

    .table td:last-child {
        border-right: none;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        font-weight: 700;
        font-size: 12px;
        color: #fff;
        min-width: 28px;
    }

    .status-hadir { background: #05FF0D; }
    .status-izin { background: #F4B400; color: #000; }
    .status-alfa { background: #F40000; }

    .status-text {
        font-weight: 500;
        text-transform: capitalize;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 24px 16px;
        background: #F6F0D7;
        border-radius: 8px;
        color: rgba(0, 0, 0, 0.6);
    }

    .empty-state i {
        font-size: 32px;
        margin-bottom: 10px;
        opacity: 0.5;
    }

    .empty-state p {
        font-size: 12px;
        margin: 6px 0;
    }

    /* Pagination Section */
    .pagination-section {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin-top: 14px;
        flex-wrap: wrap;
    }

    .pagination-btn {
        padding: 7px 9px;
        background: #9CAB84;
        color: #FFFFFF;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 11px;
        font-weight: 500;
        transition: none;
        font-family: 'Poppins', sans-serif;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .pagination-btn:hover {
        background: #7A8A5F;
    }

    .pagination-btn:disabled {
        background: #D0D0D0;
        cursor: not-allowed;
    }

    .pagination-info {
        font-size: 11px;
        color: rgba(0, 0, 0, 0.7);
        font-weight: 500;
    }

    /* Month Summary Box */
    .month-summary-box {
        background: #F6F0D7;
        border-radius: 8px;
        padding: 12px 14px;
        margin-top: 18px;
        box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.06);
    }

    .month-title {
        font-family: 'Poppins', sans-serif;
        font-size: 12px;
        font-weight: 600;
        color: rgba(0, 0, 0, 0.8);
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .month-stats {
        display: flex;
        gap: 10px;
        justify-content: flex-start;
        flex-wrap: wrap;
    }

    .month-stat {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
        padding: 8px 10px;
        background: #FFFFFF;
        border: 1px solid #D0C9A8;
        border-radius: 6px;
        box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.04);
        min-width: 65px;
    }

    .month-stat-badge {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 10px;
        color: #fff;
    }

    .month-stat-count {
        font-size: 14px;
        font-weight: 600;
        text-align: center;
    }

    .month-stat-label {
        font-size: 10px;
        text-align: center;
        color: rgba(0, 0, 0, 0.7);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .summary-stats {
            grid-template-columns: repeat(3, 1fr);
        }

        .table th,
        .table td {
            padding: 10px 12px;
            font-size: 12px;
        }

        .table th {
            font-size: 12px;
        }

        .status-badge {
            width: 28px;
            height: 28px;
            font-size: 12px;
        }
    }

    @media (max-width: 768px) {
        .filter-section {
            flex-direction: column;
            align-items: stretch;
        }

        .summary-stats {
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        .stat-box {
            padding: 10px;
        }

        .stat-value {
            font-size: 14px;
        }

        .stat-label {
            font-size: 10px;
        }

        .table-container {
            overflow-x: auto;
        }

        .table th,
        .table td {
            padding: 8px 10px;
            font-size: 11px;
        }

        .table th {
            font-size: 14px;
        }

        .status-badge {
            width: 32px;
            height: 32px;
            font-size: 14px;
        }

        .month-stats {
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .header-section {
            padding: 15px;
        }

        .header-title {
            font-size: 24px;
        }

        .summary-section {
            padding: 15px;
        }

        .summary-title {
            font-size: 20px;
        }

        .summary-stats {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .stat-box {
            padding: 12px;
        }

        .stat-value {
            font-size: 20px;
        }

        .stat-label {
            font-size: 11px;
        }

        .table {
            font-size: 12px;
        }

        .table th,
        .table td {
            padding: 8px 10px;
            font-size: 11px;
        }

        .table th {
            font-size: 12px;
        }

        .status-badge {
            width: 28px;
            height: 28px;
            font-size: 12px;
        }

        .pagination-section {
            gap: 5px;
        }

        .pagination-btn {
            padding: 8px 12px;
            font-size: 12px;
        }

        .pagination-info {
            font-size: 12px;
        }

        .month-summary-box {
            padding: 15px;
        }

        .month-stats {
            gap: 8px;
        }

        .month-stat {
            padding: 10px 12px;
            min-width: 70px;
        }
    }
</style>
@endsection

@section('content')
<div>
    <!-- Header Section -->
    <div class="header-section">
        <h1 class="header-title">Riwayat Kehadiran</h1>
        <p class="header-subtitle">Lihat histori absensi Anda</p>
    </div>

    <!-- Summary Stats Section -->
    <div class="summary-section">
        <h2 class="summary-title">Ringkasan Kehadiran</h2>
        <div class="summary-stats">
            <!-- Hadir -->
            <div class="stat-box">
                <div class="stat-value stat-value-hadir">
                    <span class="stat-icon" style="background: #05FF0D20; color: #05FF0D;">✓</span>
                    18
                </div>
                <div class="stat-label">Hadir</div>
            </div>

            <!-- Izin -->
            <div class="stat-box">
                <div class="stat-value stat-value-izin">
                    <span class="stat-icon" style="background: #F4B40020; color: #F4B400;">I</span>
                    2
                </div>
                <div class="stat-label">Izin</div>
            </div>

            <!-- Alfa -->
            <div class="stat-box">
                <div class="stat-value stat-value-alfa">
                    <span class="stat-icon" style="background: #F4000020; color: #F40000;">✕</span>
                    1
                </div>
                <div class="stat-label">Alfa</div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <div>
            <span class="limit-label">Tampilkan data</span>
            <select class="limit-select" id="limitSelect" onchange="changeLimit(this.value)">
                <option value="10" selected>10 data</option>
                <option value="25">25 data</option>
                <option value="50">50 data</option>
            </select>
            <span class="limit-label">per halaman</span>
        </div>
    </div>

    <!-- Attendance Table -->
    <div class="table-container">
        @if(true)
            <!-- Sample data table -->
            <table class="table">
                <thead>
                    <tr>
                        <th style="text-align: center; width: 15%;">Tanggal</th>
                        <th style="text-align: center; width: 15%;">Hari</th>
                        <th style="text-align: left; width: 35%;">Keterangan</th>
                        <th style="text-align: center; width: 16%;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Row 1 -->
                    <tr>
                        <td style="text-align: center;">01/02</td>
                        <td style="text-align: center;">Senin</td>
                        <td>Hadir sesuai jadwal</td>
                        <td style="text-align: center;">
                            <span class="status-badge status-hadir">✓</span>
                        </td>
                    </tr>

                    <!-- Row 2 -->
                    <tr>
                        <td style="text-align: center;">01/22</td>
                        <td style="text-align: center;">Rabu</td>
                        <td>Surat izin telah diterima sekolah</td>
                        <td style="text-align: center;">
                            <span class="status-badge status-izin">I</span>
                        </td>
                    </tr>

                    <!-- Row 3 -->
                    <tr>
                        <td style="text-align: center;">01/30</td>
                        <td style="text-align: center;">Senin</td>
                        <td>Tanpa keterangan</td>
                        <td style="text-align: center;">
                            <span class="status-badge status-alfa">✕</span>
                        </td>
                    </tr>

                    <!-- Row 4 -->
                    <tr>
                        <td style="text-align: center;">02/03</td>
                        <td style="text-align: center;">Senin</td>
                        <td>Hadir sesuai jadwal</td>
                        <td style="text-align: center;">
                            <span class="status-badge status-hadir">✓</span>
                        </td>
                    </tr>

                    <!-- Row 5 -->
                    <tr>
                        <td style="text-align: center;">02/04</td>
                        <td style="text-align: center;">Selasa</td>
                        <td>Hadir sesuai jadwal</td>
                        <td style="text-align: center;">
                            <span class="status-badge status-hadir">✓</span>
                        </td>
                    </tr>

                    <!-- Row 6 -->
                    <tr>
                        <td style="text-align: center;">02/05</td>
                        <td style="text-align: center;">Rabu</td>
                        <td>Hadir sesuai jadwal</td>
                        <td style="text-align: center;">
                            <span class="status-badge status-hadir">✓</span>
                        </td>
                    </tr>

                    <!-- Row 7 -->
                    <tr>
                        <td style="text-align: center;">02/06</td>
                        <td style="text-align: center;">Kamis</td>
                        <td>Hadir sesuai jadwal</td>
                        <td style="text-align: center;">
                            <span class="status-badge status-hadir">✓</span>
                        </td>
                    </tr>

                    <!-- Row 8 -->
                    <tr>
                        <td style="text-align: center;">02/10</td>
                        <td style="text-align: center;">Senin</td>
                        <td>Hadir sesuai jadwal</td>
                        <td style="text-align: center;">
                            <span class="status-badge status-hadir">✓</span>
                        </td>
                    </tr>

                    <!-- Row 9 -->
                    <tr>
                        <td style="text-align: center;">02/11</td>
                        <td style="text-align: center;">Selasa</td>
                        <td>Surat izin telah diterima sekolah</td>
                        <td style="text-align: center;">
                            <span class="status-badge status-izin">I</span>
                        </td>
                    </tr>

                    <!-- Row 10 -->
                    <tr>
                        <td style="text-align: center;">02/12</td>
                        <td style="text-align: center;">Rabu</td>
                        <td>Hadir sesuai jadwal</td>
                        <td style="text-align: center;">
                            <span class="status-badge status-hadir">✓</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <p>Tidak ada data kehadiran</p>
                <p style="font-size: 14px;">Mulai absensi Anda sekarang</p>
            </div>
        @endif
    </div>

    <!-- Pagination Section -->
    <div class="pagination-section">
        <button class="pagination-btn" id="prevBtn" onclick="prevPage()">
            <i class="fas fa-chevron-left"></i> Sebelumnya
        </button>

        <div class="pagination-info">
            Halaman <span id="currentPage">1</span> dari <span id="totalPages">5</span>
        </div>

        <button class="pagination-btn" id="nextBtn" onclick="nextPage()">
            Selanjutnya <i class="fas fa-chevron-right"></i>
        </button>
    </div>

    <!-- Month Summary -->
    <div class="month-summary-box">
        <div class="month-title">Bulan: Februari 2026</div>
        <div class="month-stats">
            <!-- Hadir Box -->
            <div class="month-stat">
                <div class="month-stat-badge" style="background: #05FF0D;">✓</div>
                <div class="month-stat-count">18</div>
                <div class="month-stat-label">Hadir</div>
            </div>

            <!-- Izin Box -->
            <div class="month-stat">
                <div class="month-stat-badge" style="background: #F4B400;">I</div>
                <div class="month-stat-count">2</div>
                <div class="month-stat-label">Izin</div>
            </div>

            <!-- Alfa Box -->
            <div class="month-stat">
                <div class="month-stat-badge" style="background: #F40000;">✕</div>
                <div class="month-stat-count">1</div>
                <div class="month-stat-label">Alfa</div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    let currentPage = 1;
    const totalPages = 5;
    const itemsPerPage = 10;

    function changeLimit(value) {
        console.log('Limit changed to:', value);
        currentPage = 1;
        updatePagination();
    }

    function nextPage() {
        if (currentPage < totalPages) {
            currentPage++;
            updatePagination();
        }
    }

    function prevPage() {
        if (currentPage > 1) {
            currentPage--;
            updatePagination();
        }
    }

    function updatePagination() {
        document.getElementById('currentPage').textContent = currentPage;
        document.getElementById('totalPages').textContent = totalPages;

        // Update button states
        document.getElementById('prevBtn').disabled = currentPage === 1;
        document.getElementById('nextBtn').disabled = currentPage === totalPages;

        console.log('Page:', currentPage);
    }

    // Initialize pagination
    window.addEventListener('load', function() {
        updatePagination();
    });
</script>
@endsection
