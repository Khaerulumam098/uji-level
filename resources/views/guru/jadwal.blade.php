@extends('layouts.guru')

@section('title', 'Pilih Jadwal')

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

    .page-title {
        font-size: 28px;
        font-weight: 600;
        color: #333333;
        margin: 0;
    }

    .page-subtitle {
        font-size: 13px;
        color: rgba(0, 0, 0, 0.65);
        margin-top: 6px;
    }

    /* Form Container */
    .form-container {
        background: #F6F0D7;
        border-radius: 12px;
        padding: 28px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        max-width: 700px;
        margin: 0 auto;
    }

    /* ✅ form-row: Kelas & Mata Pelajaran berdampingan 2 kolom */
    .form-row {
        display: grid !important;
        grid-template-columns: 1fr 1fr !important;
        gap: 20px !important;
        width: 100%;
        margin-bottom: 24px;
    }

    /* ✅ form-group: label di atas, input di bawah — paksa dengan !important
       agar tidak di-override Bootstrap/framework lain */
    .form-container .form-group {
        display: flex !important;
        flex-direction: column !important;
        align-items: flex-start !important;
        justify-content: flex-start !important;
        width: 100% !important;
        margin-bottom: 0 !important;
    }

    /* ✅ Jadwal full width di bawah, margin bottom sendiri */
    .form-container .form-group-full {
        display: flex !important;
        flex-direction: column !important;
        align-items: flex-start !important;
        width: 100% !important;
        margin-bottom: 24px !important;
    }

    /* ✅ Label: block, rata kiri, di atas input */
    .form-container .form-label {
        display: block !important;
        width: 100% !important;
        text-align: left !important;
        font-size: 14px;
        font-weight: 600;
        color: #333333;
        margin-bottom: 8px !important;
        margin-right: 0 !important;
        text-transform: capitalize;
    }

    /* ✅ Select: full lebar container, bukan melayang ke kanan */
    .form-container .form-select {
        width: 100% !important;
        padding: 12px 14px;
        border: 1px solid #D0C9A8;
        border-radius: 8px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        background: white;
        color: #333333;
        cursor: pointer;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        box-sizing: border-box !important;
    }

    .form-container .form-select:hover {
        border-color: #9CAB84;
    }

    .form-container .form-select:focus {
        outline: none;
        border-color: #9CAB84;
        box-shadow: 0 0 0 3px rgba(156, 171, 132, 0.1);
    }

    .form-container .form-select option {
        padding: 8px;
        background: white;
        color: #333333;
    }

    /* Button Group */
    .button-group {
        display: flex;
        gap: 12px;
        margin-top: 32px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn {
        padding: 12px 28px;
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
        flex: 1;
        justify-content: center;
        min-width: 150px;
    }

    .btn-primary:hover {
        background: #8B9A6F;
        transform: translateY(-2px);
    }

    .btn-primary i {
        font-size: 15px;
    }

    .btn-secondary {
        background: #E8E6DC;
        color: #333333;
        border: 1px solid #D0C9A8;
    }

    .btn-secondary:hover {
        background: #D0C9A8;
    }

    /* Schedule List */
    .schedule-list {
        margin-top: 40px;
    }

    .schedule-title {
        font-size: 18px;
        font-weight: 600;
        color: #333333;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .schedule-title i {
        color: #9CAB84;
    }

    .schedule-item {
        background: white;
        border: 1px solid #D0C9A8;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .schedule-item:hover {
        background: #F9F7F1;
        border-color: #9CAB84;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    }

    .schedule-info {
        flex: 1;
    }

    .schedule-class {
        font-size: 15px;
        font-weight: 600;
        color: #333333;
        margin-bottom: 4px;
    }

    .schedule-details {
        font-size: 13px;
        color: rgba(0, 0, 0, 0.65);
        display: flex;
        gap: 20px;
    }

    .schedule-details span {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .schedule-details i {
        font-size: 12px;
        color: #9CAB84;
    }

    .schedule-action {
        display: flex;
        gap: 8px;
    }

    .action-btn {
        width: 36px;
        height: 36px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .action-btn.edit {
        background: #E3F2FD;
        color: #1976D2;
    }

    .action-btn.edit:hover {
        background: #1976D2;
        color: white;
    }

    .action-btn.delete {
        background: #FFEBEE;
        color: #C62828;
    }

    .action-btn.delete:hover {
        background: #C62828;
        color: white;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
    }

    .empty-state-icon {
        font-size: 48px;
        color: #D0C9A8;
        margin-bottom: 16px;
    }

    .empty-state-text {
        font-size: 14px;
        color: rgba(0, 0, 0, 0.65);
        margin-bottom: 16px;
    }

    @media (max-width: 768px) {
        .form-container {
            padding: 20px;
        }

        /* Di mobile, Kelas & Mata Pelajaran kembali ke 1 kolom */
        .form-row {
            grid-template-columns: 1fr !important;
        }

        .button-group {
            flex-direction: column;
        }

        .btn-primary {
            width: 100%;
        }

        .schedule-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .schedule-action {
            width: 100%;
            justify-content: flex-end;
        }
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<div class="page-header">
    <h1 class="page-title">Pilih Kelas & Jadwal</h1>
    <p class="page-subtitle">Pilih kelas, mata pelajaran, dan jadwal untuk mengisi absensi</p>
</div>

<!-- Form Container -->
<div class="form-container">
    <form method="POST" action="{{ route('guru.jadwal') }}">
        @csrf

        <!-- Kelas & Mata Pelajaran: berdampingan 2 kolom -->
        <div class="form-row">
            <!-- Kelas Selection -->
            <div class="form-group">
                <label for="kelas" class="form-label">
                    <i class="fas fa-graduation-cap"></i> Kelas
                </label>
                <select id="kelas" name="kelas" class="form-select" required>
                    <option value="">-- Pilih Kelas --</option>
                    <option value="VII-A">VII A</option>
                    <option value="VII-B">VII B</option>
                    <option value="VIII-A">VIII A</option>
                    <option value="VIII-B">VIII B</option>
                    <option value="IX-A">IX A</option>
                    <option value="IX-B">IX B</option>
                </select>
            </div>

            <!-- Mata Pelajaran Selection -->
            <div class="form-group">
                <label for="matapelajaran" class="form-label">
                    <i class="fas fa-book"></i> Mata Pelajaran
                </label>
                <select id="matapelajaran" name="matapelajaran" class="form-select" required>
                    <option value="">-- Pilih Mata Pelajaran --</option>
                    <option value="IPA">IPA</option>
                    <option value="Matematika">Matematika</option>
                    <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                    <option value="Bahasa Inggris">Bahasa Inggris</option>
                    <option value="PKN">PKN</option>
                </select>
            </div>
        </div>

        <!-- Jadwal Selection: full width di bawah -->
        <div class="form-group-full">
            <label for="jadwal" class="form-label">
                <i class="fas fa-clock"></i> Jadwal Kelas
            </label>
            <select id="jadwal" name="jadwal" class="form-select" required>
                <option value="">-- Pilih Jadwal --</option>
                <option value="senin-jam-1">Senin, Jam ke-1 (07:00 - 08:30)</option>
                <option value="senin-jam-2">Senin, Jam ke-2 (08:30 - 10:00)</option>
                <option value="selasa-jam-1">Selasa, Jam ke-1 (07:00 - 08:30)</option>
                <option value="selasa-jam-2">Selasa, Jam ke-2 (08:30 - 10:00)</option>
                <option value="rabu-jam-1">Rabu, Jam ke-1 (07:00 - 08:30)</option>
                <option value="rabu-jam-2">Rabu, Jam ke-2 (08:30 - 10:00)</option>
            </select>
        </div>

        <!-- Buttons -->
        <div class="button-group">
            <button type="button" class="btn btn-primary" onclick="openAddScheduleModal()">
                <i class="fas fa-plus"></i>
                Tambah Jadwal
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-arrow-right"></i>
                Lanjut to Absensi
            </button>
        </div>
    </form>

    <!-- Schedule List -->
    <div class="schedule-list">
        <h3 class="schedule-title">
            <i class="fas fa-list"></i>
            Jadwal Tersimpan
        </h3>

        <!-- Schedule Item 1 -->
        <div class="schedule-item">
            <div class="schedule-info">
                <div class="schedule-class">VII B - IPA</div>
                <div class="schedule-details">
                    <span><i class="fas fa-calendar-day"></i> Senin, Jam ke-2</span>
                    <span><i class="fas fa-users"></i> 22 Siswa</span>
                    <span><i class="fas fa-clock"></i> 08:30 - 10:00</span>
                </div>
            </div>
            <div class="schedule-action">
                <button type="button" class="action-btn edit" onclick="openViewScheduleModal(1, 'VII B', 'IPA', 'Senin, Jam ke-2', '22')" title="Lihat">
                    <i class="fas fa-eye"></i>
                </button>
                <button type="button" class="action-btn edit" onclick="openEditScheduleModal(1, 'VII-B', 'IPA', 'senin-jam-2')" title="Edit">
                    <i class="fas fa-edit"></i>
                </button>
                <button type="button" class="action-btn delete" onclick="openDeleteScheduleModal(1, 'VII B - IPA')" title="Hapus">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>

        <!-- Schedule Item 2 -->
        <div class="schedule-item">
            <div class="schedule-info">
                <div class="schedule-class">IX B - Matematika</div>
                <div class="schedule-details">
                    <span><i class="fas fa-calendar-day"></i> Rabu, Jam ke-1</span>
                    <span><i class="fas fa-users"></i> 20 Siswa</span>
                    <span><i class="fas fa-clock"></i> 07:00 - 08:30</span>
                </div>
            </div>
            <div class="schedule-action">
                <button type="button" class="action-btn edit" onclick="openViewScheduleModal(2, 'IX B', 'Matematika', 'Rabu, Jam ke-1', '20')" title="Lihat">
                    <i class="fas fa-eye"></i>
                </button>
                <button type="button" class="action-btn edit" onclick="openEditScheduleModal(2, 'IX-B', 'Matematika', 'rabu-jam-1')" title="Edit">
                    <i class="fas fa-edit"></i>
                </button>
                <button type="button" class="action-btn delete" onclick="openDeleteScheduleModal(2, 'IX B - Matematika')" title="Hapus">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>

        <!-- Schedule Item 3 -->
        <div class="schedule-item">
            <div class="schedule-info">
                <div class="schedule-class">VIII A - Bahasa Inggris</div>
                <div class="schedule-details">
                    <span><i class="fas fa-calendar-day"></i> Selasa, Jam ke-2</span>
                    <span><i class="fas fa-users"></i> 25 Siswa</span>
                    <span><i class="fas fa-clock"></i> 08:30 - 10:00</span>
                </div>
            </div>
            <div class="schedule-action">
                <button type="button" class="action-btn edit" onclick="openViewScheduleModal(3, 'VIII A', 'Bahasa Inggris', 'Selasa, Jam ke-2', '25')" title="Lihat">
                    <i class="fas fa-eye"></i>
                </button>
                <button type="button" class="action-btn edit" onclick="openEditScheduleModal(3, 'VIII-A', 'Bahasa Inggris', 'selasa-jam-2')" title="Edit">
                    <i class="fas fa-edit"></i>
                </button>
                <button type="button" class="action-btn delete" onclick="openDeleteScheduleModal(3, 'VIII A - Bahasa Inggris')" title="Hapus">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    </div>
</div>

@include('components.action-modal')
@endsection

@section('scripts')
<script>
    // Jadwal Modal Functions
    function openAddScheduleModal() {
        const fields = [
            {
                name: 'kelas',
                type: 'select',
                label: 'Kelas',
                required: true,
                options: [
                    { value: 'VII-A', label: 'VII A' },
                    { value: 'VII-B', label: 'VII B' },
                    { value: 'VIII-A', label: 'VIII A' },
                    { value: 'VIII-B', label: 'VIII B' },
                    { value: 'IX-A', label: 'IX A' },
                    { value: 'IX-B', label: 'IX B' }
                ]
            },
            {
                name: 'matapelajaran',
                type: 'select',
                label: 'Mata Pelajaran',
                required: true,
                options: [
                    { value: 'IPA', label: 'IPA' },
                    { value: 'Matematika', label: 'Matematika' },
                    { value: 'Bahasa Indonesia', label: 'Bahasa Indonesia' },
                    { value: 'Bahasa Inggris', label: 'Bahasa Inggris' },
                    { value: 'PKN', label: 'PKN' }
                ]
            },
            {
                name: 'jadwal',
                type: 'select',
                label: 'Jadwal Kelas',
                required: true,
                options: [
                    { value: 'senin-jam-1', label: 'Senin, Jam ke-1 (07:00 - 08:30)' },
                    { value: 'senin-jam-2', label: 'Senin, Jam ke-2 (08:30 - 10:00)' },
                    { value: 'selasa-jam-1', label: 'Selasa, Jam ke-1 (07:00 - 08:30)' },
                    { value: 'selasa-jam-2', label: 'Selasa, Jam ke-2 (08:30 - 10:00)' },
                    { value: 'rabu-jam-1', label: 'Rabu, Jam ke-1 (07:00 - 08:30)' },
                    { value: 'rabu-jam-2', label: 'Rabu, Jam ke-2 (08:30 - 10:00)' }
                ]
            }
        ];
        openActionModal('add', 'Tambah Jadwal Baru', fields);
    }

    function openEditScheduleModal(id, kelas, matapelajaran, jadwal) {
        currentModalData = { scheduleId: id };

        const fields = [
            {
                name: 'kelas',
                type: 'select',
                label: 'Kelas',
                required: true,
                options: [
                    { value: 'VII-A', label: 'VII A' },
                    { value: 'VII-B', label: 'VII B' },
                    { value: 'VIII-A', label: 'VIII A' },
                    { value: 'VIII-B', label: 'VIII B' },
                    { value: 'IX-A', label: 'IX A' },
                    { value: 'IX-B', label: 'IX B' }
                ]
            },
            {
                name: 'matapelajaran',
                type: 'select',
                label: 'Mata Pelajaran',
                required: true,
                options: [
                    { value: 'IPA', label: 'IPA' },
                    { value: 'Matematika', label: 'Matematika' },
                    { value: 'Bahasa Indonesia', label: 'Bahasa Indonesia' },
                    { value: 'Bahasa Inggris', label: 'Bahasa Inggris' },
                    { value: 'PKN', label: 'PKN' }
                ]
            },
            {
                name: 'jadwal',
                type: 'select',
                label: 'Jadwal Kelas',
                required: true,
                options: [
                    { value: 'senin-jam-1', label: 'Senin, Jam ke-1 (07:00 - 08:30)' },
                    { value: 'senin-jam-2', label: 'Senin, Jam ke-2 (08:30 - 10:00)' },
                    { value: 'selasa-jam-1', label: 'Selasa, Jam ke-1 (07:00 - 08:30)' },
                    { value: 'selasa-jam-2', label: 'Selasa, Jam ke-2 (08:30 - 10:00)' },
                    { value: 'rabu-jam-1', label: 'Rabu, Jam ke-1 (07:00 - 08:30)' },
                    { value: 'rabu-jam-2', label: 'Rabu, Jam ke-2 (08:30 - 10:00)' }
                ]
            }
        ];

        const data = { kelas: kelas, matapelajaran: matapelajaran, jadwal: jadwal };
        openActionModal('edit', 'Edit Jadwal', fields, data);
    }

    function openViewScheduleModal(id, kelas, matapelajaran, jadwal, siswa) {
        const fields = [
            { name: 'kelas', type: 'text', label: 'Kelas', required: false },
            { name: 'matapelajaran', type: 'text', label: 'Mata Pelajaran', required: false },
            { name: 'jadwal', type: 'text', label: 'Jadwal', required: false },
            { name: 'siswa', type: 'text', label: 'Jumlah Siswa', required: false }
        ];

        const data = { kelas: kelas, matapelajaran: matapelajaran, jadwal: jadwal, siswa: siswa };
        openActionModal('view', 'Detail Jadwal', fields, data);
    }

    function openDeleteScheduleModal(id, itemName) {
        currentModalData = {
            deleteUrl: `/guru/jadwal/${id}`,
            itemName: itemName,
            scheduleId: id
        };
        openActionModal('delete', 'Hapus Jadwal', [], null);
    }

    // Override modal form submission
    const originalHandleFormSubmit = window.handleFormSubmit;
    window.handleFormSubmit = function(event) {
        if (currentModalAction === 'delete') {
            event.preventDefault();
            if (currentModalData && currentModalData.deleteUrl) {
                const deleteForm = document.createElement('form');
                deleteForm.method = 'POST';
                deleteForm.action = currentModalData.deleteUrl;
                deleteForm.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                document.body.appendChild(deleteForm);
                deleteForm.submit();
            }
        } else if (currentModalAction === 'add' || currentModalAction === 'edit') {
            event.preventDefault();
            const form = document.getElementById('actionForm');
            const url = currentModalAction === 'add' ? '{{ route("guru.jadwal") }}' : `/guru/jadwal/${currentModalData.scheduleId}`;
            const method = currentModalAction === 'add' ? 'POST' : 'PUT';

            const submitForm = document.createElement('form');
            submitForm.method = 'POST';
            submitForm.action = url;
            const csrfToken = '{{ csrf_token() }}';
            submitForm.innerHTML = `
                <input type="hidden" name="_token" value="${csrfToken}">
                ${method === 'PUT' ? '<input type="hidden" name="_method" value="PUT">' : ''}
                <input type="hidden" name="kelas" value="${form.kelas.value}">
                <input type="hidden" name="matapelajaran" value="${form.matapelajaran.value}">
                <input type="hidden" name="jadwal" value="${form.jadwal.value}">
            `;
            document.body.appendChild(submitForm);
            submitForm.submit();
        } else {
            originalHandleFormSubmit(event);
        }
    };
</script>
@endsection
