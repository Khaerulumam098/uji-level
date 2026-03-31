@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('styles')
<style>
    /* Header Section */
    .header-section {
        background: #F6F0D7;
        border-radius: 10px;
        padding: 18px 22px;
        margin-bottom: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
        border: 1px solid #E8E4D0;
    }

    .header-actions {
        display: flex;
        gap: 8px;
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

    .header-left {
        flex: 1;
    }

    .header-title {
        font-family: 'Telex', sans-serif;
        font-size: 26px;
        font-weight: 400;
        color: #000000;
        margin-bottom: 8px;
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

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 28px;
    }

    .stat-card {
        background: #F6F0D7;
        border-radius: 12px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
        border: 1px solid #E8E4D0;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #9CAB84 0%, #8B9A6F 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #FFFFFF;
        font-size: 28px;
        flex-shrink: 0;
    }

    .stat-content {
        flex: 1;
    }

    .stat-label {
        font-size: 12px;
        font-weight: 500;
        color: rgba(0, 0, 0, 0.65);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }

    .stat-number {
        font-size: 28px;
        font-weight: 700;
        color: #000000;
    }

    /* Main Grid */
    .main-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
        margin-bottom: 24px;
    }

    /* Activity Section */
    .activity-section {
        background: #F6F0D7;
        border-radius: 12px;
        padding: 22px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
        border: 1px solid #E8E4D0;
    }

    .section-title {
        font-size: 16px;
        font-weight: 600;
        color: #000000;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-title i {
        color: #9CAB84;
        font-size: 18px;
    }

    .activity-item {
        padding: 12px 0;
        border-bottom: 1px solid #E8E4D0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 36px;
        height: 36px;
        background: rgba(156, 171, 132, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9CAB84;
        font-size: 16px;
        flex-shrink: 0;
    }

    .activity-info {
        flex: 1;
        min-width: 0;
    }

    .activity-text {
        font-size: 13px;
        color: #333333;
        font-weight: 500;
    }

    .activity-time {
        font-size: 11px;
        color: rgba(0, 0, 0, 0.55);
        margin-top: 2px;
    }

    /* Right Sidebar */
    .right-sidebar {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    /* Quick Actions */
    .quick-actions {
        background: #F6F0D7;
        border-radius: 12px;
        padding: 22px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
        border: 1px solid #E8E4D0;
    }

    .action-btn {
        width: 100%;
        background: #9CAB84;
        color: #FFFFFF;
        border: none;
        border-radius: 8px;
        padding: 12px 14px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-bottom: 10px;
    }

    .action-btn:last-child {
        margin-bottom: 0;
    }

    .action-btn:hover {
        background: #8B9A6F;
        transform: translateY(-1px);
    }

    .action-btn i {
        font-size: 14px;
    }

    /* Recent Users */
    .recent-users {
        background: #F6F0D7;
        border-radius: 12px;
        padding: 22px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
        border: 1px solid #E8E4D0;
    }

    .user-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid #E8E4D0;
    }

    .user-item:last-child {
        border-bottom: none;
    }

    .user-avatar-small {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #9CAB84 0%, #8B9A6F 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #FFFFFF;
        font-size: 14px;
        font-weight: 600;
        flex-shrink: 0;
    }

    .user-info-small {
        flex: 1;
        min-width: 0;
    }

    .user-name {
        font-size: 12px;
        font-weight: 600;
        color: #333333;
    }

    .user-role {
        font-size: 11px;
        color: rgba(0, 0, 0, 0.55);
        margin-top: 2px;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .main-grid {
            grid-template-columns: 1fr;
        }

        .right-sidebar {
            flex-direction: row;
        }

        .quick-actions,
        .recent-users {
            flex: 1;
            min-width: 0;
        }
    }

    @media (max-width: 768px) {
        .header-section {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .right-sidebar {
            flex-direction: column;
        }
    }
</style>
@endsection

@section('content')
    <!-- Header -->
    <div class="header-section">
        <div class="header-left">
            <h1 class="header-title">Dashboard Admin</h1>
            <div class="header-date">
                <i class="fas fa-calendar-alt"></i>
                <span id="current-date"></span>
            </div>
        </div>
        <div class="header-actions">
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

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Total Siswa</div>
                <div class="stat-number">450</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-chalkboard-user"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Total Guru</div>
                <div class="stat-number">35</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-school"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Total Kelas</div>
                <div class="stat-number">15</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Total Jadwal</div>
                <div class="stat-number">120</div>
            </div>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="main-grid">
        <!-- Activity Section -->
        <div class="activity-section">
            <h2 class="section-title">
                <i class="fas fa-history"></i>
                Aktivitas Terbaru
            </h2>

            <div class="activity-item">
                <div class="activity-icon">
                    <i class="fas fa-plus-circle"></i>
                </div>
                <div class="activity-info">
                    <div class="activity-text">Menambahkan siswa baru: "Ahmad Ridho"</div>
                    <div class="activity-time">2 jam yang lalu</div>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-icon">
                    <i class="fas fa-edit"></i>
                </div>
                <div class="activity-info">
                    <div class="activity-text">Memperbarui data guru: "Ibu Rahmah"</div>
                    <div class="activity-time">5 jam yang lalu</div>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-icon">
                    <i class="fas fa-trash"></i>
                </div>
                <div class="activity-info">
                    <div class="activity-text">Menghapus jadwal kelas 9A</div>
                    <div class="activity-time">1 hari yang lalu</div>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="activity-info">
                    <div class="activity-text">Menambahkan pengguna baru: "Zaskia Admin"</div>
                    <div class="activity-time">2 hari yang lalu</div>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="activity-info">
                    <div class="activity-text">Verifikasi data kelas 9B selesai</div>
                    <div class="activity-time">3 hari yang lalu</div>
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="right-sidebar">
            <!-- Quick Actions -->
            <div class="quick-actions">
                <h2 class="section-title">
                    <i class="fas fa-flash"></i>
                    Aksi Cepat
                </h2>
                <button class="action-btn">
                    <i class="fas fa-plus"></i>
                    Tambah Siswa
                </button>
                <button class="action-btn">
                    <i class="fas fa-plus"></i>
                    Tambah Guru
                </button>
                <button class="action-btn">
                    <i class="fas fa-plus"></i>
                    Tambah Kelas
                </button>
                <button class="action-btn">
                    <i class="fas fa-plus"></i>
                    Tambah Jadwal
                </button>
            </div>

            <!-- Recent Users -->
            <div class="recent-users">
                <h2 class="section-title">
                    <i class="fas fa-users"></i>
                    Pengguna Baru
                </h2>

                <div class="user-item">
                    <div class="user-avatar-small">AD</div>
                    <div class="user-info-small">
                        <div class="user-name">Admin</div>
                        <div class="user-role">Administrator</div>
                    </div>
                </div>

                <div class="user-item">
                    <div class="user-avatar-small">ZA</div>
                    <div class="user-info-small">
                        <div class="user-name">Zaskia</div>
                        <div class="user-role">Guru</div>
                    </div>
                </div>

                <div class="user-item">
                    <div class="user-avatar-small">FA</div>
                    <div class="user-info-small">
                        <div class="user-name">Faisal</div>
                        <div class="user-role">Guru</div>
                    </div>
                </div>

                <div class="user-item">
                    <div class="user-avatar-small">RH</div>
                    <div class="user-info-small">
                        <div class="user-name">Reyhan</div>
                        <div class="user-role">Admin</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Set current date
        function setCurrentDate() {
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const today = new Date().toLocaleDateString('id-ID', options);
            document.getElementById('current-date').textContent = today;
        }

        setCurrentDate();

        // Export to Excel
        function exportToExcel() {
            const ws = XLSX.utils.table_to_sheet(document.querySelector('.stats-grid'));
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Dashboard");
            XLSX.writeFile(wb, "dashboard_admin.xlsx");
        }

        // Export to PDF
        function exportToPDF() {
            const element = document.querySelector('.main-grid');
            const opt = {
                margin: 10,
                filename: 'dashboard_admin.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { orientation: 'portrait', unit: 'mm', format: 'a4' }
            };
            html2pdf().set(opt).from(element).save();
        }
    </script>
@endsection
