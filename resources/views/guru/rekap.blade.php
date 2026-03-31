@extends('layouts.guru')

@section('title', 'Rekap Absensi')

@section('styles')
<style>
    /* Header */
    .page-header {
        background: #F6F0D7;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 28px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .header-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
    }

    .page-title {
        font-size: 28px;
        font-weight: 600;
        color: #333333;
        margin: 0;
    }

    .header-actions {
        display: flex;
        gap: 8px;
    }

    .header-btn {
        padding: 8px 14px;
        background: #9CAB84;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .header-btn:hover {
        background: #8B9A6F;
    }

    .header-btn i {
        font-size: 13px;
    }

    .page-subtitle {
        font-size: 13px;
        color: rgba(0, 0, 0, 0.65);
    }

    /* Filter Section */
    .filter-section {
        background: #F6F0D7;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        display: flex;
        gap: 16px;
        align-items: flex-end;
        flex-wrap: wrap;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
        min-width: 150px;
    }

    .filter-label {
        font-size: 12px;
        font-weight: 600;
        color: #333333;
        text-transform: uppercase;
    }

    .filter-select {
        padding: 8px 12px;
        border: 1px solid #D0C9A8;
        border-radius: 6px;
        font-size: 13px;
        font-family: 'Poppins', sans-serif;
        background: white;
        color: #333333;
        cursor: pointer;
    }

    .filter-select:hover {
        border-color: #9CAB84;
    }

    .filter-btn {
        padding: 8px 16px;
        background: #9CAB84;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .filter-btn:hover {
        background: #8B9A6F;
    }

    .filter-reset {
        background: #E8E6DC;
        color: #333333;
    }

    .filter-reset:hover {
        background: #D0C9A8;
    }

    /* Table Container */
    .table-container {
        background: #F6F0D7;
        border-radius: 12px;
        padding: 0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    thead th {
        background: #E8E4D0;
        padding: 12px;
        text-align: center;
        font-weight: 600;
        color: #333333;
        border-bottom: 2px solid #D0C9A8;
        white-space: nowrap;
    }

    thead th:first-child {
        text-align: left;
    }

    tbody td {
        padding: 12px;
        border-bottom: 1px solid #D0C9A8;
        color: #333333;
    }

    tbody td:first-child {
        text-align: left;
    }

    tbody td:not(:first-child) {
        text-align: center;
    }

    tbody tr:hover {
        background: #FAFAF8;
    }

    tbody tr:last-child td {
        border-bottom: none;
    }

    /* Class Name Column */
    .class-info {
        font-weight: 500;
        min-width: 120px;
    }

    .class-date {
        font-size: 12px;
        color: rgba(0, 0, 0, 0.65);
    }

    /* Number Cells */
    .number-cell {
        font-weight: 500;
    }

    /* Action Buttons */
    .action-cell {
        text-align: center;
        min-width: 80px;
    }

    .action-btn {
        padding: 6px 10px;
        border: none;
        border-radius: 4px;
        font-size: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .action-btn.view {
        background: #E3F2FD;
        color: #1976D2;
    }

    .action-btn.view:hover {
        background: #1976D2;
        color: white;
    }

    .action-btn.edit {
        background: #FFF3E0;
        color: #E65100;
    }

    .action-btn.edit:hover {
        background: #E65100;
        color: white;
    }

    /* Stats Card */
    .stats-card {
        background: #F6F0D7;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        margin-bottom: 24px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 16px;
    }

    .stat-item {
        text-align: center;
        padding: 16px;
        background: linear-gradient(135deg, #E8F5E9 0%, #F1F8F6 100%);
        border-radius: 8px;
        border-left: 4px solid #9CAB84;
    }

    .stat-label {
        font-size: 12px;
        color: rgba(0, 0, 0, 0.65);
        font-weight: 500;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .stat-value {
        font-size: 24px;
        font-weight: 700;
        color: #333333;
    }

    /* Export Section */
    .export-section {
        margin-top: 24px;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary {
        background: #9CAB84;
        color: white;
    }

    .btn-primary:hover {
        background: #8B9A6F;
        transform: translateY(-2px);
    }

    .btn-secondary {
        background: #E8E6DC;
        color: #333333;
        border: 1px solid #D0C9A8;
    }

    .btn-secondary:hover {
        background: #D0C9A8;
    }

    .btn i {
        font-size: 14px;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 40px;
        color: rgba(0, 0, 0, 0.65);
    }

    .empty-state-icon {
        font-size: 48px;
        margin-bottom: 12px;
        color: #D0C9A8;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        table {
            font-size: 12px;
        }

        thead th,
        tbody td {
            padding: 10px;
        }

        .filter-section {
            gap: 12px;
        }

        .filter-group {
            min-width: 120px;
        }
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 16px;
        }

        .header-top {
            flex-direction: column;
            gap: 12px;
        }

        .page-title {
            font-size: 22px;
        }

        .header-actions {
            width: 100%;
            flex-wrap: wrap;
        }

        .header-btn {
            flex: 1;
            justify-content: center;
        }

        .filter-section {
            flex-direction: column;
        }

        .filter-group {
            width: 100%;
        }

        .filter-select,
        .filter-btn {
            width: 100%;
        }

        .table-container {
            border-radius: 0;
            margin: 0 -24px;
            width: calc(100% + 48px);
        }

        table {
            font-size: 11px;
        }

        thead th,
        tbody td {
            padding: 8px;
        }

        .stats-card {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .stat-item {
            padding: 12px;
        }

        .stat-value {
            font-size: 18px;
        }

        .export-section {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }

        .action-btn {
            padding: 4px 6px;
            font-size: 11px;
        }
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="header-top">
        <div>
            <h1 class="page-title">Rekap Absensi</h1>
            <p class="page-subtitle">Laporan ringkas kehadiran siswa dari setiap kelas</p>
        </div>
        <div class="header-actions">
            <button type="button" class="header-btn" onclick="printReport()">
                <i class="fas fa-print"></i>
                Cetak
            </button>
            <button type="button" class="header-btn" onclick="exportReport()">
                <i class="fas fa-download"></i>
                Export
            </button>
        </div>
    </div>
</div>

<!-- Statistics Summary -->
<div class="stats-card">
    <div class="stat-item">
        <div class="stat-label">Total Absensi Dicatat</div>
        <div class="stat-value">4</div>
    </div>
    <div class="stat-item">
        <div class="stat-label">Total Siswa Terdaftar</div>
        <div class="stat-value">89</div>
    </div>
    <div class="stat-item">
        <div class="stat-label">Rata-rata Kehadiran</div>
        <div class="stat-value">92%</div>
    </div>
    <div class="stat-item">
        <div class="stat-label">Perbaruan Terakhir</div>
        <div class="stat-value">Hari Ini</div>
    </div>
</div>

<!-- Filter Section -->
<div class="filter-section">
    <div class="filter-group">
        <label class="filter-label">Kelas</label>
        <select class="filter-select">
            <option value="">Semua Kelas</option>
            <option value="VII-A">VII A</option>
            <option value="VII-B">VII B</option>
            <option value="VIII-A">VIII A</option>
        </select>
    </div>
    <div class="filter-group">
        <label class="filter-label">Bulan</label>
        <select class="filter-select">
            <option value="">Semua Bulan</option>
            <option value="01">Januari</option>
            <option value="02">Februari</option>
            <option value="03">Maret</option>
        </select>
    </div>
    <div class="filter-group">
        <label class="filter-label">Tahun</label>
        <select class="filter-select">
            <option value="">Tahun Ini</option>
            <option value="2025">2025</option>
            <option value="2024">2024</option>
        </select>
    </div>
    <button type="button" class="filter-btn" onclick="applyFilter()">
        <i class="fas fa-search"></i>
        Filter
    </button>
    <button type="button" class="filter-btn filter-reset" onclick="resetFilter()">
        <i class="fas fa-redo"></i>
        Reset
    </button>
</div>

<!-- Recap Table -->
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th style="text-align: left;">Tanggal</th>
                <th>Kelas</th>
                <th style="text-align: center; width: 70px;">
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <span>Hadir</span>
                    </div>
                </th>
                <th style="text-align: center; width: 70px;">
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <span>Sakit</span>
                    </div>
                </th>
                <th style="text-align: center; width: 70px;">
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <span>Izin</span>
                    </div>
                </th>
                <th style="text-align: center; width: 70px;">
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <span>Alfa</span>
                    </div>
                </th>
                <th style="text-align: center; width: 80px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Record 1 -->
            <tr>
                <td style="text-align: left;">
                    <div class="class-info">01/02</div>
                </td>
                <td>VII A</td>
                <td class="number-cell">22</td>
                <td class="number-cell">0</td>
                <td class="number-cell">0</td>
                <td class="number-cell">0</td>
                <td class="action-cell">
                    <button type="button" class="action-btn view" onclick="viewRecapDetail(1, '01/02', 'VII A', '22', '0', '0', '0')" title="Lihat">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button type="button" class="action-btn edit" onclick="editRecapDetail(1, '01/02', 'VII A', '22', '0', '0', '0')" title="Edit">
                        <i class="fas fa-edit"></i>
                    </button>
                </td>
            </tr>

            <!-- Record 2 -->
            <tr>
                <td style="text-align: left;">
                    <div class="class-info">01/03</div>
                </td>
                <td>VII B</td>
                <td class="number-cell">20</td>
                <td class="number-cell">2</td>
                <td class="number-cell">0</td>
                <td class="number-cell">0</td>
                <td class="action-cell">
                    <button type="button" class="action-btn view" onclick="viewRecapDetail(2, '01/03', 'VII B', '20', '2', '0', '0')" title="Lihat">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button type="button" class="action-btn edit" onclick="editRecapDetail(2, '01/03', 'VII B', '20', '2', '0', '0')" title="Edit">
                        <i class="fas fa-edit"></i>
                    </button>
                </td>
            </tr>

            <!-- Record 3 -->
            <tr>
                <td style="text-align: left;">
                    <div class="class-info">01/04</div>
                </td>
                <td>IX B</td>
                <td class="number-cell">20</td>
                <td class="number-cell">1</td>
                <td class="number-cell">1</td>
                <td class="number-cell">0</td>
                <td class="action-cell">
                    <button type="button" class="action-btn view" onclick="viewRecapDetail(3, '01/04', 'IX B', '20', '1', '1', '0')" title="Lihat">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button type="button" class="action-btn edit" onclick="editRecapDetail(3, '01/04', 'IX B', '20', '1', '1', '0')" title="Edit">
                        <i class="fas fa-edit"></i>
                    </button>
                </td>
            </tr>

            <!-- Record 4 -->
            <tr>
                <td style="text-align: left;">
                    <div class="class-info">01/05</div>
                </td>
                <td>IX A</td>
                <td class="number-cell">18</td>
                <td class="number-cell">4</td>
                <td class="number-cell">1</td>
                <td class="number-cell">1</td>
                <td class="action-cell">
                    <button type="button" class="action-btn view" onclick="viewRecapDetail(4, '01/05', 'IX A', '18', '4', '1', '1')" title="Lihat">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button type="button" class="action-btn edit" onclick="editRecapDetail(4, '01/05', 'IX A', '18', '4', '1', '1')" title="Edit">
                        <i class="fas fa-edit"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Export Section -->
<div class="export-section">
    <button type="button" class="btn btn-secondary" onclick="goHome()">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Dashboard
    </button>
    <button type="button" class="btn btn-primary" onclick="exportToExcel()">
        <i class="fas fa-file-excel"></i>
        Export ke Excel
    </button>
</div>

@include('components.action-modal')
@endsection

@section('scripts')
<script>
    function viewRecapDetail(id, tanggal, kelas, hadir, sakit, izin, alfa) {
        const fields = [
            { name: 'tanggal', type: 'text', label: 'Tanggal', required: false },
            { name: 'kelas', type: 'text', label: 'Kelas', required: false },
            { name: 'hadir', type: 'text', label: 'Hadir', required: false },
            { name: 'sakit', type: 'text', label: 'Sakit', required: false },
            { name: 'izin', type: 'text', label: 'Izin', required: false },
            { name: 'alfa', type: 'text', label: 'Alfa', required: false }
        ];

        const data = {
            tanggal: tanggal,
            kelas: kelas,
            hadir: hadir,
            sakit: sakit,
            izin: izin,
            alfa: alfa
        };

        openActionModal('view', `Rekap Absensi - ${kelas} (${tanggal})`, fields, data);
    }

    function editRecapDetail(id, tanggal, kelas, hadir, sakit, izin, alfa) {
        currentModalData = { recapId: id };

        const fields = [
            { name: 'tanggal', type: 'text', label: 'Tanggal', required: false },
            { name: 'kelas', type: 'text', label: 'Kelas', required: false },
            { name: 'hadir', type: 'number', label: 'Hadir', required: true, placeholder: 'Jumlah siswa hadir' },
            { name: 'sakit', type: 'number', label: 'Sakit', required: true, placeholder: 'Jumlah siswa sakit' },
            { name: 'izin', type: 'number', label: 'Izin', required: true, placeholder: 'Jumlah siswa izin' },
            { name: 'alfa', type: 'number', label: 'Alfa', required: true, placeholder: 'Jumlah siswa alfa' }
        ];

        const data = {
            tanggal: tanggal,
            kelas: kelas,
            hadir: hadir,
            sakit: sakit,
            izin: izin,
            alfa: alfa
        };

        openActionModal('edit', `Edit Rekap - ${kelas} (${tanggal})`, fields, data);
    }

    function applyFilter() {
        console.log('Apply filter');
    }

    function resetFilter() {
        document.querySelectorAll('.filter-select').forEach(select => {
            select.value = '';
        });
        console.log('Filter reset');
    }

    function printReport() {
        window.print();
    }

    function exportReport() {
        console.log('Export report');
    }

    function exportToExcel() {
        console.log('Export to Excel');
    }

    function goHome() {
        window.location.href = '{{ route('guru.home') }}';
    }

    // Override modal form submission
    const originalHandleFormSubmit = window.handleFormSubmit;
    window.handleFormSubmit = function(event) {
        if (currentModalAction === 'edit') {
            event.preventDefault();
            const form = document.getElementById('actionForm');
            const recapId = currentModalData.recapId;

            // Prepare form data
            const submitForm = document.createElement('form');
            submitForm.method = 'POST';
            submitForm.action = `/guru/rekap/${recapId}`;
            const csrfToken = '{{ csrf_token() }}';
            submitForm.innerHTML = `
                <input type="hidden" name="_token" value="${csrfToken}">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="hadir" value="${form.hadir.value}">
                <input type="hidden" name="sakit" value="${form.sakit.value}">
                <input type="hidden" name="izin" value="${form.izin.value}">
                <input type="hidden" name="alfa" value="${form.alfa.value}">
            `;
            document.body.appendChild(submitForm);
            submitForm.submit();
        } else {
            originalHandleFormSubmit(event);
        }
    };
</script>
@endsection
