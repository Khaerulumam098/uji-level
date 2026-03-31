@extends('layouts.admin')

@section('title', 'Data Guru')

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
        align-items: center;
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
</style>
@endsection

@section('content')
    <!-- Header -->
    <div class="header-section">
        <div class="header-left">
            <h1 class="header-title">Data Guru</h1>
            <p class="header-subtitle">Kelola seluruh data guru sekolah</p>
        </div>
        <div class="header-right">
            <button class="btn-add" onclick="openAddGuruModal()">
                <i class="fas fa-plus"></i>
                Tambah Guru
            </button>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="search-filter">
        <input type="text" class="search-input" placeholder="Cari nama guru...">
    </div>

    <!-- Table -->
    <div class="table-container">
        <div class="table-header">
            <div class="table-header-cell" style="flex: 0 0 60px; text-align: center;">No</div>
            <div class="table-header-cell">Nama</div>
            <div class="table-header-cell" style="flex: 0 0 120px; text-align: center;">NIP</div>
            <div class="table-header-cell">Mata Pelajaran</div>
            <div class="table-header-cell" style="flex: 0 0 100px; text-align: center;">Jam Mengajar</div>
            <div class="table-header-cell" style="flex: 0 0 100px; text-align: center;">Aksi</div>
        </div>

        <div class="table-body">
            <!-- Row 1 -->
            <div class="table-row">
                <div class="table-cell" style="flex: 0 0 60px; text-align: center;">
                    <span class="table-cell-no">1</span>
                </div>
                <div class="table-cell">
                    <span>Rahmah S.pd</span>
                </div>
                <div class="table-cell" style="flex: 0 0 120px; text-align: center;">
                    <span>12345</span>
                </div>
                <div class="table-cell">
                    <span>Bahasa Indonesia</span>
                </div>
                <div class="table-cell" style="flex: 0 0 100px; text-align: center;">
                    <span>22</span>
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
                    <span>Humaeroh S.pd</span>
                </div>
                <div class="table-cell" style="flex: 0 0 120px; text-align: center;">
                    <span>12345</span>
                </div>
                <div class="table-cell">
                    <span>Matematika</span>
                </div>
                <div class="table-cell" style="flex: 0 0 100px; text-align: center;">
                    <span>21</span>
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
                    <span>Novitasari S.pd</span>
                </div>
                <div class="table-cell" style="flex: 0 0 120px; text-align: center;">
                    <span>12345</span>
                </div>
                <div class="table-cell">
                    <span>Ilmu Pengetahuan Alam</span>
                </div>
                <div class="table-cell" style="flex: 0 0 100px; text-align: center;">
                    <span>22</span>
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
                    <span>Siti Nurhaliza</span>
                </div>
                <div class="table-cell" style="flex: 0 0 120px; text-align: center;">
                    <span>12345</span>
                </div>
                <div class="table-cell">
                    <span>Pendidikan Jasmani</span>
                </div>
                <div class="table-cell" style="flex: 0 0 100px; text-align: center;">
                    <span>21</span>
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
            <button class="pagination-btn">&raquo;</button>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    // Modal Functions for Guru
    function openAddGuruModal() {
        const fields = [
            { name: 'nama', label: 'Nama Guru', type: 'text', required: true, placeholder: 'Masukkan nama guru' },
            { name: 'nip', label: 'NIP', type: 'text', required: true, placeholder: 'Nomor Induk Pegawai' },
            { name: 'mataPelajaran', label: 'Mata Pelajaran', type: 'text', required: true, placeholder: 'Misalnya: Matematika' },
            { name: 'jamMengajar', label: 'Jam Mengajar (Per Minggu)', type: 'number', required: true, placeholder: '0' }
        ];
        openActionModal('add', 'Tambah Guru Baru', fields);
    }

    function openEditGuruModal(id) {
        // Get data from table row
        const row = event.target.closest('.table-row');
        const cells = row.querySelectorAll('.table-cell');
        const data = {
            id: id,
            nama: cells[1].textContent.trim(),
            nip: cells[2].textContent.trim(),
            mataPelajaran: cells[3].textContent.trim(),
            jamMengajar: cells[4].textContent.trim()
        };

        const fields = [
            { name: 'nama', label: 'Nama Guru', type: 'text', required: true, placeholder: 'Masukkan nama guru' },
            { name: 'nip', label: 'NIP', type: 'text', required: true, placeholder: 'Nomor Induk Pegawai' },
            { name: 'mataPelajaran', label: 'Mata Pelajaran', type: 'text', required: true, placeholder: 'Misalnya: Matematika' },
            { name: 'jamMengajar', label: 'Jam Mengajar (Per Minggu)', type: 'number', required: true, placeholder: '0' }
        ];
        openActionModal('edit', 'Edit Data Guru', fields, data);
    }

    function openDeleteGuruModal(id) {
        const row = event.target.closest('.table-row');
        const cells = row.querySelectorAll('.table-cell');
        const guruName = cells[1].textContent.trim();

        const data = {
            id: id,
            itemName: guruName,
            deleteUrl: `/admin/guru/${id}`
        };
        const fields = [];
        openActionModal('delete', 'Hapus Guru', fields, data);
    }

    // Attach event listeners to all edit and delete buttons
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.table-actions .btn-action:not(.delete)').forEach((btn, index) => {
            btn.addEventListener('click', function() {
                openEditGuruModal(index + 1);
            });
        });

        document.querySelectorAll('.table-actions .btn-action.delete').forEach((btn, index) => {
            btn.addEventListener('click', function() {
                openDeleteGuruModal(index + 1);
            });
        });
    });
</script>

@include('components.confirm-logout-modal')
@include('components.action-modal')
@endsection
