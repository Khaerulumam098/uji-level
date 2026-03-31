@extends('layouts.guru')

@section('title', 'Input Absensi')

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
        margin-bottom: 16px;
    }

    .page-title {
        font-size: 28px;
        font-weight: 600;
        color: #333333;
        margin: 0;
    }

    .header-info {
        display: flex;
        gap: 20px;
        font-size: 13px;
    }

    .header-info-item {
        display: flex;
        align-items: center;
        gap: 6px;
        color: rgba(0, 0, 0, 0.65);
    }

    .header-info-item i {
        font-size: 14px;
        color: #9CAB84;
    }

    .header-info-value {
        color: #333333;
        font-weight: 600;
    }

    .page-subtitle {
        font-size: 13px;
        color: rgba(0, 0, 0, 0.65);
    }

    /* Table Container */
    .table-container {
        background: #F6F0D7;
        border-radius: 12px;
        padding: 0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    thead th {
        background: #E8E4D0;
        padding: 14px;
        text-align: left;
        font-weight: 600;
        color: #333333;
        border-bottom: 2px solid #D0C9A8;
        white-space: nowrap;
    }

    tbody td {
        padding: 12px 14px;
        border-bottom: 1px solid #D0C9A8;
        color: #333333;
    }

    tbody tr:hover {
        background: #FAFAF8;
    }

    tbody tr:last-child td {
        border-bottom: none;
    }

    /* Student Name Column */
    .student-name {
        font-weight: 500;
        min-width: 150px;
    }

    /* Attendance Cells */
    .attendance-cell {
        text-align: center;
        min-width: 80px;
    }

    .attendance-radio {
        margin: 0 4px;
    }

    .attendance-radio input[type="radio"] {
        cursor: pointer;
        width: 16px;
        height: 16px;
        margin: 0;
    }

    .attendance-label {
        display: block;
        font-size: 12px;
        color: rgba(0, 0, 0, 0.65);
        margin-top: 4px;
        text-transform: capitalize;
    }

    /* Action Buttons */
    .action-cell {
        text-align: center;
        min-width: 100px;
    }

    .action-btn {
        padding: 6px 10px;
        border: none;
        border-radius: 4px;
        font-size: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin: 0 2px;
    }

    .action-btn.edit {
        background: #E3F2FD;
        color: #1976D2;
    }

    .action-btn.edit:hover {
        background: #1976D2;
        color: white;
    }

    .action-btn.view {
        background: #E8F5E9;
        color: #2E7D32;
    }

    .action-btn.view:hover {
        background: #2E7D32;
        color: white;
    }

    /* Save Button */
    .save-section {
        margin-top: 24px;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    .btn {
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-size: 14px;
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
        font-size: 15px;
    }

    /* Status Badge */
    .status-badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 600;
        margin-right: 4px;
    }

    .status-hadir {
        background: #E8F5E9;
        color: #2E7D32;
    }

    .status-sakit {
        background: #E3F2FD;
        color: #1565C0;
    }

    .status-izin {
        background: #FFF3E0;
        color: #E65100;
    }

    .status-alfa {
        background: #FFEBEE;
        color: #C62828;
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

        .attendance-cell {
            min-width: 60px;
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
            font-size: 20px;
        }

        .header-info {
            flex-direction: column;
            gap: 8px;
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

        .student-name {
            min-width: 120px;
        }

        .attendance-cell {
            min-width: 50px;
        }

        .action-cell {
            min-width: 80px;
        }

        .save-section {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="header-top">
        <h1 class="page-title">Input Absensi</h1>
        <div class="header-info">
            <div class="header-info-item">
                <i class="fas fa-graduation-cap"></i>
                <span>Kelas: <span class="header-info-value">VII B</span></span>
            </div>
            <div class="header-info-item">
                <i class="fas fa-book"></i>
                <span>Pelajaran: <span class="header-info-value">IPA</span></span>
            </div>
            <div class="header-info-item">
                <i class="fas fa-calendar-day"></i>
                <span>Jadwal: <span class="header-info-value">Senin, Jam ke-2</span></span>
            </div>
        </div>
    </div>
    <p class="page-subtitle">Silakan isi informasi kehadiran siswa untuk jadwal kelas yang dipilih</p>
</div>

<!-- Attendance Table -->
<form method="POST" action="{{ route('guru.absensi') }}">
    @csrf
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style="text-align: left; width: 50px;">No</th>
                    <th style="text-align: left;">Nama Siswa</th>
                    <th class="attendance-cell">
                        <div style="display: flex; flex-direction: column; align-items: center;">
                            <span>Hadir</span>
                        </div>
                    </th>
                    <th class="attendance-cell">
                        <div style="display: flex; flex-direction: column; align-items: center;">
                            <span>Sakit</span>
                        </div>
                    </th>
                    <th class="attendance-cell">
                        <div style="display: flex; flex-direction: column; align-items: center;">
                            <span>Izin</span>
                        </div>
                    </th>
                    <th class="attendance-cell">
                        <div style="display: flex; flex-direction: column; align-items: center;">
                            <span>Alfa</span>
                        </div>
                    </th>
                    <th class="action-cell">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Student 1 -->
                <tr>
                    <td>1</td>
                    <td class="student-name">Andi Pramata</td>
                    <td class="attendance-cell">
                        <input type="radio" name="student_1" value="hadir" class="attendance-radio">
                    </td>
                    <td class="attendance-cell">
                        <input type="radio" name="student_1" value="sakit" class="attendance-radio">
                    </td>
                    <td class="attendance-cell">
                        <input type="radio" name="student_1" value="izin" class="attendance-radio">
                    </td>
                    <td class="attendance-cell">
                        <input type="radio" name="student_1" value="alfa" class="attendance-radio">
                    </td>
                    <td class="action-cell">
                        <button type="button" class="action-btn view" onclick="viewStudent(1, 'Andi Pramata')" title="Lihat">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button type="button" class="action-btn edit" onclick="editStudent(1, 'Andi Pramata')" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>

                <!-- Student 2 -->
                <tr>
                    <td>2</td>
                    <td class="student-name">Assifa Maulida</td>
                    <td class="attendance-cell">
                        <input type="radio" name="student_2" value="hadir" class="attendance-radio" checked>
                    </td>
                    <td class="attendance-cell">
                        <input type="radio" name="student_2" value="sakit" class="attendance-radio">
                    </td>
                    <td class="attendance-cell">
                        <input type="radio" name="student_2" value="izin" class="attendance-radio">
                    </td>
                    <td class="attendance-cell">
                        <input type="radio" name="student_2" value="alfa" class="attendance-radio">
                    </td>
                    <td class="action-cell">
                        <button type="button" class="action-btn view" onclick="viewStudent(2, 'Assifa Maulida')" title="Lihat">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button type="button" class="action-btn edit" onclick="editStudent(2, 'Assifa Maulida')" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>

                <!-- Student 3 -->
                <tr>
                    <td>3</td>
                    <td class="student-name">Nazwa Fadillah</td>
                    <td class="attendance-cell">
                        <input type="radio" name="student_3" value="hadir" class="attendance-radio" checked>
                    </td>
                    <td class="attendance-cell">
                        <input type="radio" name="student_3" value="sakit" class="attendance-radio">
                    </td>
                    <td class="attendance-cell">
                        <input type="radio" name="student_3" value="izin" class="attendance-radio">
                    </td>
                    <td class="attendance-cell">
                        <input type="radio" name="student_3" value="alfa" class="attendance-radio">
                    </td>
                    <td class="action-cell">
                        <button type="button" class="action-btn view" onclick="viewStudent(3, 'Nazwa Fadillah')" title="Lihat">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button type="button" class="action-btn edit" onclick="editStudent(3, 'Nazwa Fadillah')" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>

                <!-- Student 4 -->
                <tr>
                    <td>4</td>
                    <td class="student-name">Amanda Salsa</td>
                    <td class="attendance-cell">
                        <input type="radio" name="student_4" value="hadir" class="attendance-radio" checked>
                    </td>
                    <td class="attendance-cell">
                        <input type="radio" name="student_4" value="sakit" class="attendance-radio">
                    </td>
                    <td class="attendance-cell">
                        <input type="radio" name="student_4" value="izin" class="attendance-radio">
                    </td>
                    <td class="attendance-cell">
                        <input type="radio" name="student_4" value="alfa" class="attendance-radio">
                    </td>
                    <td class="action-cell">
                        <button type="button" class="action-btn view" onclick="viewStudent(4, 'Amanda Salsa')" title="Lihat">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button type="button" class="action-btn edit" onclick="editStudent(4, 'Amanda Salsa')" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>

                <!-- Student 5 -->
                <tr>
                    <td>5</td>
                    <td class="student-name">Budi Santoso</td>
                    <td class="attendance-cell">
                        <input type="radio" name="student_5" value="hadir" class="attendance-radio">
                    </td>
                    <td class="attendance-cell">
                        <input type="radio" name="student_5" value="sakit" class="attendance-radio" checked>
                    </td>
                    <td class="attendance-cell">
                        <input type="radio" name="student_5" value="izin" class="attendance-radio">
                    </td>
                    <td class="attendance-cell">
                        <input type="radio" name="student_5" value="alfa" class="attendance-radio">
                    </td>
                    <td class="action-cell">
                        <button type="button" class="action-btn view" onclick="viewStudent(5, 'Budi Santoso')" title="Lihat">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button type="button" class="action-btn edit" onclick="editStudent(5, 'Budi Santoso')" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Save Section -->
    <div class="save-section">
        <button type="button" class="btn btn-secondary" onclick="goBack()">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </button>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i>
            Simpan Absensi
        </button>
    </div>
</form>

@include('components.action-modal')
@endsection

@section('scripts')
<script>
    function viewStudent(id, name) {
        const fields = [
            { name: 'nama', type: 'text', label: 'Nama Siswa', required: false },
            { name: 'kehadiran', type: 'text', label: 'Status Kehadiran', required: false },
            { name: 'keterangan', type: 'textarea', label: 'Keterangan', required: false }
        ];

        const attendanceValue = document.querySelector(`input[name="student_${id}"]:checked`)?.value || 'Tidak ada';
        const statuses = {
            'hadir': 'Hadir',
            'sakit': 'Sakit',
            'izin': 'Izin',
            'alfa': 'Alfa'
        };

        const data = {
            nama: name,
            kehadiran: statuses[attendanceValue] || attendanceValue,
            keterangan: ''
        };

        openActionModal('view', `Detail Kehadiran - ${name}`, fields, data);
    }

    function editStudent(id, name) {
        currentModalData = { studentId: id };

        const fields = [
            { name: 'nama', type: 'text', label: 'Nama Siswa', required: false },
            {
                name: 'kehadiran',
                type: 'select',
                label: 'Status Kehadiran',
                required: true,
                options: [
                    { value: 'hadir', label: 'Hadir' },
                    { value: 'sakit', label: 'Sakit' },
                    { value: 'izin', label: 'Izin' },
                    { value: 'alfa', label: 'Alfa' }
                ]
            },
            {
                name: 'keterangan',
                type: 'textarea',
                label: 'Keterangan',
                required: false,
                placeholder: 'Masukkan keterangan jika ada'
            }
        ];

        const attendanceValue = document.querySelector(`input[name="student_${id}"]:checked`)?.value || '';
        const data = {
            nama: name,
            kehadiran: attendanceValue,
            keterangan: ''
        };

        openActionModal('edit', `Edit Kehadiran - ${name}`, fields, data);
    }

    function goBack() {
        window.history.back();
    }

    // Override modal form submission
    const originalHandleFormSubmit = window.handleFormSubmit;
    window.handleFormSubmit = function(event) {
        if (currentModalAction === 'edit') {
            event.preventDefault();
            const form = document.getElementById('actionForm');
            const studentId = currentModalData.studentId;
            const kehadiran = form.kehadiran.value;

            // Update the radio button in main form
            const radioButton = document.querySelector(`input[name="student_${studentId}"][value="${kehadiran}"]`);
            if (radioButton) {
                radioButton.checked = true;
            }

            closeActionModal();
        } else {
            originalHandleFormSubmit(event);
        }
    };
</script>
@endsection
