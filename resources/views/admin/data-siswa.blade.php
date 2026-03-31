@extends('layouts.admin')

@section('title', 'Data Siswa')

@section('styles')
<style>
    /* Header Section */
    .header-section {
        background: #F6F0D7;
        border-radius: 12px;
        padding: 18px 22px;
        margin-bottom: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
        border: 1px solid #E8E4D0;
    }

    .header-left {
        flex: 1;
    }

    .header-title {
        font-family: 'Telex', sans-serif;
        font-size: 26px;
        font-weight: 400;
        color: #000000;
        margin-bottom: 6px;
    }

    .header-subtitle {
        font-size: 12px;
        color: rgba(0, 0, 0, 0.65);
    }

    .header-right {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .btn-add {
        background: #9CAB84;
        color: #FFFFFF;
        border: none;
        border-radius: 8px;
        padding: 10px 16px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-add:hover {
        background: #8B9A6F;
        transform: translateY(-1px);
    }

    /* Search & Filter */
    .search-filter {
        background: #F6F0D7;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 20px;
        border: 1px solid #E8E4D0;
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        align-items: flex-end;
    }

    .filter-actions {
        display: flex;
        gap: 8px;
        margin-left: auto;
        align-items: center;
    }

    .export-btn {
        padding: 10px 16px;
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
        justify-content: center;
        gap: 6px;
        height: 40px;
    }

    .export-btn:hover {
        background: #8B9A6F;
    }

    .export-btn i {
        font-size: 13px;
    }

    .search-input {
        flex: 1;
        min-width: 200px;
        padding: 10px 14px;
        border: 1px solid #D0C9A8;
        border-radius: 6px;
        font-size: 13px;
        background: #FFFFFF;
        color: #333333;
    }

    .search-input::placeholder {
        color: rgba(0, 0, 0, 0.5);
    }

    .search-input:focus {
        outline: none;
        border-color: #9CAB84;
        box-shadow: 0 0 0 3px rgba(156, 171, 132, 0.1);
    }

    /* Table Container */
    .table-container {
        background: #F6F0D7;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
        border: 1px solid #E8E4D0;
    }

    .table-header {
        background: #D9D9D9;
        display: flex;
        gap: 0;
        padding: 0;
        border-bottom: 1px solid #C0C0C0;
    }

    .table-header-cell {
        flex: 1;
        padding: 14px 16px;
        font-size: 13px;
        font-weight: 600;
        color: #000000;
        text-align: left;
        border-right: 1px solid #C0C0C0;
    }

    .table-header-cell:last-child {
        border-right: none;
    }

    .table-body {
        max-height: 600px;
        overflow-y: auto;
    }

    .table-row {
        display: flex;
        gap: 0;
        padding: 0;
        border-bottom: 1px solid #E8E4D0;
        transition: all 0.2s ease;
    }

    .table-row:hover {
        background: rgba(156, 171, 132, 0.1);
    }

    .table-row:last-child {
        border-bottom: none;
    }

    .table-cell {
        flex: 1;
        padding: 14px 16px;
        font-size: 13px;
        color: #333333;
        display: flex;
        align-items: center;
        border-right: 1px solid #E8E4D0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .table-cell:last-child {
        border-right: none;
    }

    .table-cell-no {
        font-weight: 600;
        color: #9CAB84;
    }

    .table-cell-name {
        font-weight: 500;
        white-space: normal;
        text-overflow: clip;
    }

    .table-cell-badge {
        background: rgba(156, 171, 132, 0.2);
        color: #9CAB84;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        width: fit-content;
    }

    /* Actions Column */
    .table-actions {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .btn-action {
        background: none;
        border: none;
        color: #9CAB84;
        cursor: pointer;
        font-size: 14px;
        padding: 6px;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-action:hover {
        color: #8B9A6F;
        transform: scale(1.1);
    }

    .btn-action.delete {
        color: #d62828;
    }

    .btn-action.delete:hover {
        color: #bf2200;
    }

    /* Pagination */
    .pagination {
        display: flex;
        justify-content: center;
        gap: 8px;
        padding: 20px;
        background: #F6F0D7;
        border-top: 1px solid #E8E4D0;
    }

    .pagination-btn {
        padding: 8px 12px;
        border: 1px solid #D0C9A8;
        background: #FFFFFF;
        color: #333333;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
        transition: all 0.2s ease;
    }

    .pagination-btn:hover {
        background: #9CAB84;
        color: #FFFFFF;
        border-color: #9CAB84;
    }

    .pagination-btn.active {
        background: #9CAB84;
        color: #FFFFFF;
        border-color: #9CAB84;
    }

    /* No Data */
    .no-data {
        text-align: center;
        padding: 40px;
        color: rgba(0, 0, 0, 0.5);
    }

    .no-data i {
        font-size: 48px;
        margin-bottom: 16px;
        opacity: 0.3;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .search-filter {
            flex-direction: column;
        }

        .search-input {
            width: 100%;
            min-width: unset;
        }

        .header-section {
            flex-wrap: wrap;
            gap: 12px;
        }
    }

    @media (max-width: 768px) {
        .table-cell {
            font-size: 12px;
            padding: 10px 12px;
        }

        .table-header-cell {
            font-size: 11px;
            padding: 10px 12px;
        }

        .table-row {
            display: none;
        }

        .table-container {
            display: flex;
            flex-direction: column;
        }

        .table-body {
            max-height: unset;
        }

        /* Card view for mobile */
        .data-card {
            background: #F6F0D7;
            border: 1px solid #E8E4D0;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .data-card-info {
            flex: 1;
        }

        .data-card-name {
            font-weight: 600;
            color: #000000;
            margin-bottom: 4px;
        }

        .data-card-details {
            font-size: 12px;
            color: rgba(0, 0, 0, 0.65);
        }
    }
</style>
@endsection

@section('content')
    <!-- Header -->
    <div class="header-section">
        <div class="header-left">
            <h1 class="header-title">Data Siswa</h1>
            <p class="header-subtitle">Kelola seluruh data siswa sekolah</p>
        </div>
        <div class="header-right">
            <button class="btn-add" onclick="openAddSiswaModal()">
                <i class="fas fa-plus"></i>
                Tambah Siswa
            </button>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="search-filter">
        <input type="text" class="search-input" placeholder="Cari nama siswa...">
        <select class="search-input" style="flex: 0 1 150px;">
            <option>Semua Kelas</option>
            <option>9A</option>
            <option>9B</option>
            <option>9C</option>
            <option>8A</option>
            <option>8B</option>
        </select>
        <div class="filter-actions">
            <button class="export-btn" onclick="exportToExcel()">
                <i class="fas fa-file-excel"></i>
                Export Excel
            </button>
            <button class="export-btn" onclick="exportToPDF()">
                <i class="fas fa-file-pdf"></i>
                Export PDF
            </button>
        </div>
    </div>

    <!-- Table -->
    <div class="table-container">
        <div class="table-header">
            <div class="table-header-cell" style="flex: 0 0 60px; text-align: center;">No</div>
            <div class="table-header-cell">Nama Siswa</div>
            <div class="table-header-cell" style="flex: 0 0 100px; text-align: center;">Kelas</div>
            <div class="table-header-cell" style="flex: 0 0 80px; text-align: center;">Absen</div>
            <div class="table-header-cell">Wali Kelas</div>
            <div class="table-header-cell" style="flex: 0 0 100px; text-align: center;">Aksi</div>
        </div>

        <div class="table-body">
            <!-- Row 1 -->
            <div class="table-row">
                <div class="table-cell" style="flex: 0 0 60px; text-align: center;">
                    <span class="table-cell-no">1</span>
                </div>
                <div class="table-cell">
                    <span class="table-cell-name">Ahmad Ridho</span>
                </div>
                <div class="table-cell" style="flex: 0 0 100px; text-align: center;">
                    <span class="table-cell-badge">9A</span>
                </div>
                <div class="table-cell" style="flex: 0 0 80px; text-align: center;">
                    <span>P</span>
                </div>
                <div class="table-cell">
                    <span>Rahmah S.pd</span>
                </div>
                <div class="table-cell" style="flex: 0 0 100px; text-align: center;">
                    <div class="table-actions">
                        <button class="btn-action" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action delete" title="Hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Row 2 -->
            <div class="table-row">
                <div class="table-cell" style="flex: 0 0 60px; text-align: center;">
                    <span class="table-cell-no">2</span>
                </div>
                <div class="table-cell">
                    <span class="table-cell-name">Siti Nurhaliza</span>
                </div>
                <div class="table-cell" style="flex: 0 0 100px; text-align: center;">
                    <span class="table-cell-badge">9B</span>
                </div>
                <div class="table-cell" style="flex: 0 0 80px; text-align: center;">
                    <span>I</span>
                </div>
                <div class="table-cell">
                    <span>Humaeroh S.pd</span>
                </div>
                <div class="table-cell" style="flex: 0 0 100px; text-align: center;">
                    <div class="table-actions">
                        <button class="btn-action" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action delete" title="Hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Row 3 -->
            <div class="table-row">
                <div class="table-cell" style="flex: 0 0 60px; text-align: center;">
                    <span class="table-cell-no">3</span>
                </div>
                <div class="table-cell">
                    <span class="table-cell-name">Budi Santoso</span>
                </div>
                <div class="table-cell" style="flex: 0 0 100px; text-align: center;">
                    <span class="table-cell-badge">9C</span>
                </div>
                <div class="table-cell" style="flex: 0 0 80px; text-align: center;">
                    <span>P</span>
                </div>
                <div class="table-cell">
                    <span>Novitasari S.pd</span>
                </div>
                <div class="table-cell" style="flex: 0 0 100px; text-align: center;">
                    <div class="table-actions">
                        <button class="btn-action" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action delete" title="Hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Row 4 -->
            <div class="table-row">
                <div class="table-cell" style="flex: 0 0 60px; text-align: center;">
                    <span class="table-cell-no">4</span>
                </div>
                <div class="table-cell">
                    <span class="table-cell-name">Dewi Lestari</span>
                </div>
                <div class="table-cell" style="flex: 0 0 100px; text-align: center;">
                    <span class="table-cell-badge">8A</span>
                </div>
                <div class="table-cell" style="flex: 0 0 80px; text-align: center;">
                    <span>P</span>
                </div>
                <div class="table-cell">
                    <span>Rahmah S.pd</span>
                </div>
                <div class="table-cell" style="flex: 0 0 100px; text-align: center;">
                    <div class="table-actions">
                        <button class="btn-action" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action delete" title="Hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Row 5 -->
            <div class="table-row">
                <div class="table-cell" style="flex: 0 0 60px; text-align: center;">
                    <span class="table-cell-no">5</span>
                </div>
                <div class="table-cell">
                    <span class="table-cell-name">Eka Putri Wijaya</span>
                </div>
                <div class="table-cell" style="flex: 0 0 100px; text-align: center;">
                    <span class="table-cell-badge">8B</span>
                </div>
                <div class="table-cell" style="flex: 0 0 80px; text-align: center;">
                    <span>I</span>
                </div>
                <div class="table-cell">
                    <span>Humaeroh S.pd</span>
                </div>
                <div class="table-cell" style="flex: 0 0 100px; text-align: center;">
                    <div class="table-actions">
                        <button class="btn-action" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action delete" title="Hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <button class="pagination-btn">&laquo;</button>
            <button class="pagination-btn active">1</button>
            <button class="pagination-btn">2</button>
            <button class="pagination-btn">3</button>
            <button class="pagination-btn">&raquo;</button>
        </div>
    </div>

    <script>
        // Modal Functions for Siswa
        function openAddSiswaModal() {
            const fields = [
                { name: 'nama', label: 'Nama Siswa', type: 'text', required: true, placeholder: 'Masukkan nama siswa' },
                { name: 'kelas', label: 'Kelas', type: 'select', required: true,
                  options: [
                    { value: '9A', label: '9A' },
                    { value: '9B', label: '9B' },
                    { value: '9C', label: '9C' },
                    { value: '8A', label: '8A' },
                    { value: '8B', label: '8B' }
                  ]
                },
                { name: 'absen', label: 'Nomor Absen', type: 'text', required: true, placeholder: 'Misalnya: P, I, A' },
                { name: 'waliKelas', label: 'Wali Kelas', type: 'text', required: true, placeholder: 'Masukkan nama wali kelas' }
            ];
            openActionModal('add', 'Tambah Siswa Baru', fields);
        }

        function openEditSiswaModal(id) {
            // Get data from table row
            const row = event.target.closest('.table-row');
            const cells = row.querySelectorAll('.table-cell');
            const data = {
                id: id,
                nama: cells[1].textContent.trim(),
                kelas: cells[2].textContent.trim(),
                absen: cells[3].textContent.trim(),
                waliKelas: cells[4].textContent.trim()
            };

            const fields = [
                { name: 'nama', label: 'Nama Siswa', type: 'text', required: true, placeholder: 'Masukkan nama siswa' },
                { name: 'kelas', label: 'Kelas', type: 'select', required: true,
                  options: [
                    { value: '9A', label: '9A' },
                    { value: '9B', label: '9B' },
                    { value: '9C', label: '9C' },
                    { value: '8A', label: '8A' },
                    { value: '8B', label: '8B' }
                  ]
                },
                { name: 'absen', label: 'Nomor Absen', type: 'text', required: true, placeholder: 'Misalnya: P, I, A' },
                { name: 'waliKelas', label: 'Wali Kelas', type: 'text', required: true, placeholder: 'Masukkan nama wali kelas' }
            ];
            openActionModal('edit', 'Edit Data Siswa', fields, data);
        }

        function openDeleteSiswaModal(id) {
            const row = event.target.closest('.table-row');
            const nama = row.querySelector('.table-cell-name').textContent.trim();

            const data = {
                id: id,
                itemName: nama,
                deleteUrl: `/admin/siswa/${id}`
            };
            const fields = [];
            openActionModal('delete', 'Hapus Siswa', fields, data);
        }

        // Attach event listeners to all edit and delete buttons
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.table-actions .btn-action:not(.delete)').forEach((btn, index) => {
                btn.addEventListener('click', function() {
                    openEditSiswaModal(index + 1);
                });
            });

            document.querySelectorAll('.table-actions .btn-action.delete').forEach((btn, index) => {
                btn.addEventListener('click', function() {
                    openDeleteSiswaModal(index + 1);
                });
            });
        });

        // Export to Excel
        function exportToExcel() {
            const ws = XLSX.utils.table_to_sheet(document.querySelector('.table-container'));
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Data Siswa");
            XLSX.writeFile(wb, "data_siswa.xlsx");
        }

        // Export to PDF
        function exportToPDF() {
            const element = document.querySelector('.table-container');
            const opt = {
                margin: 10,
                filename: 'data_siswa.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { orientation: 'landscape', unit: 'mm', format: 'a4' }
            };
            html2pdf().set(opt).from(element).save();
        }
    </script>

@include('components.confirm-logout-modal')
@include('components.action-modal')
@endsection
