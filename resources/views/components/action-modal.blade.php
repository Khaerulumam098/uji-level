{{-- Generic Action Modal Component --}}
<div id="actionModal" class="modal modal-action" style="display: none;">
    <div class="modal-backdrop"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title" id="modalTitle">Modal Title</h2>
            <button type="button" class="modal-close" onclick="closeActionModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="actionForm" method="POST" onsubmit="handleFormSubmit(event)">
            @csrf
            @method('POST')
            <div class="modal-body">
                <div id="formFields">
                    <!-- Dynamic form fields will be inserted here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeActionModal()">
                    <i class="fas fa-times"></i>
                    Batal
                </button>
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-save"></i>
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    /* Modal Base Styles */
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        animation: modalFadeIn 0.3s ease-in-out;
    }

    @keyframes modalFadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .modal-backdrop {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        animation: backdropFadeIn 0.3s ease-in-out;
    }

    @keyframes backdropFadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 0.5;
        }
    }

    .modal-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #FFFFFF;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.16);
        z-index: 10000;
        animation: slideInUp 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translate(-50%, calc(-50% + 20px));
        }
        to {
            opacity: 1;
            transform: translate(-50%, -50%);
        }
    }

    /* Action Modal Specific */
    .modal-action .modal-content {
        min-width: 500px;
        max-width: 600px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
    }

    .modal-close {
        background: none;
        border: none;
        color: #999;
        font-size: 18px;
        cursor: pointer;
        padding: 0;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .modal-close:hover {
        color: #333;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 24px;
        border-bottom: 1px solid #E8E4D0;
    }

    .modal-title {
        font-size: 20px;
        font-weight: 600;
        color: #333333;
        margin: 0;
        font-family: 'Poppins', sans-serif;
        text-align: left;
    }

    .modal-body {
        padding: 24px;
    }

    .modal-body .delete-confirm {
        margin: 8px 0;
    }

    .modal-footer {
        padding: 20px 24px;
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        border-top: 1px solid #E8E4D0;
    }

    /* Form Fields Styling */
    .form-field {
        margin-bottom: 16px;
    }

    .form-field:last-child {
        margin-bottom: 0;
    }

    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #333333;
        margin-bottom: 6px;
        text-transform: capitalize;
        text-align: left;
    }

    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #D0C9A8;
        border-radius: 6px;
        font-size: 13px;
        font-family: 'Poppins', sans-serif;
        color: #333333;
        background: #FFFFFF;
        transition: all 0.3s ease;
        box-sizing: border-box;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        outline: none;
        border-color: #9CAB84;
        box-shadow: 0 0 0 3px rgba(156, 171, 132, 0.1);
    }

    .form-input::placeholder {
        color: rgba(0, 0, 0, 0.5);
    }

    .form-select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        padding-right: 30px;
        cursor: pointer;
    }

    .form-select option {
        padding: 8px;
        background: #fff;
        color: #333;
    }

    .form-textarea {
        resize: vertical;
        min-height: 100px;
    }

    .form-group {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .form-group.full {
        grid-template-columns: 1fr;
    }

    .form-group .form-field {
        margin-bottom: 0;
    }

    .form-error {
        color: #E74C3C;
        font-size: 12px;
        margin-top: 4px;
        display: none;
    }

    .form-input.readonly,
    .form-select.readonly,
    .form-textarea.readonly {
        background: #f5f5f5;
        color: rgba(0, 0, 0, 0.6);
        border-color: #E0E0E0;
        cursor: not-allowed;
    }

    .form-input.readonly:focus,
    .form-select.readonly:focus,
    .form-textarea.readonly:focus {
        border-color: #E0E0E0;
        box-shadow: none;
    }

    .form-input.error,
    .form-select.error,
    .form-textarea.error {
        border-color: #E74C3C;
    }

    .form-input.error ~ .form-error,
    .form-select.error ~ .form-error,
    .form-textarea.error ~ .form-error {
        display: block;
    }

    .btn-primary {
        background: #9CAB84;
        color: #FFFFFF;
    }

    .btn-primary:hover {
        background: #8B9A6F;
        transform: translateY(-2px);
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: 'Poppins', sans-serif;
    }

    .btn i {
        font-size: 12px;
    }

    .btn-secondary {
        background: #E8E6DC;
        color: #333333;
        border: 1px solid #D0C9A8;
    }

    .btn-secondary:hover {
        background: #D0C9A8;
        transform: translateY(-2px);
    }

    .btn-danger {
        background: #E74C3C;
        color: #FFFFFF;
    }

    .btn-danger:hover {
        background: #C0392B;
        transform: translateY(-2px);
    }

    /* Close animation */
    .modal.fade-out {
        animation: modalFadeOut 0.3s ease-in-out forwards;
    }

    @keyframes modalFadeOut {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
        }
    }

    .modal.fade-out .modal-content {
        animation: slideOutDown 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    }

    @keyframes slideOutDown {
        from {
            opacity: 1;
            transform: translate(-50%, -50%);
        }
        to {
            opacity: 0;
            transform: translate(-50%, calc(-50% + 20px));
        }
    }

    .delete-confirm {
        text-align: center;
        padding: 10px 0;
    }

    .delete-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #FFE5E5 0%, #FFD4D4 100%);
        border-radius: 50%;
        margin: 0 auto 24px;
        animation: scaleIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .delete-icon i {
        font-size: 36px;
        color: #E74C3C;
    }

    .delete-title {
        font-size: 22px;
        font-weight: 700;
        color: #333333;
        margin: 0 0 16px 0;
        font-family: 'Poppins', sans-serif;
    }

    .delete-message {
        font-size: 13px;
        color: rgba(0, 0, 0, 0.65);
        margin: 0 0 16px 0;
        font-family: 'Poppins', sans-serif;
    }

    .delete-item-preview {
        background: #FFF5F5;
        border: 2px solid #FFE5E5;
        border-radius: 8px;
        padding: 14px 16px;
        margin-bottom: 20px;
        display: inline-block;
        max-width: 100%;
        word-break: break-word;
    }

    .delete-item-name {
        font-size: 14px;
        font-weight: 600;
        color: #E74C3C;
        word-break: break-word;
        display: block;
    }

    .delete-warning {
        font-size: 13px;
        color: rgba(0, 0, 0, 0.7);
        line-height: 1.6;
        margin: 0;
        font-family: 'Poppins', sans-serif;
        padding: 0 10px;
    }

    .delete-warning strong {
        color: #E74C3C;
        font-weight: 600;
    }

    @keyframes scaleIn {
        from {
            transform: scale(0.5);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* Scrollbar styling */
    .modal-action .modal-content::-webkit-scrollbar {
        width: 6px;
    }

    .modal-action .modal-content::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .modal-action .modal-content::-webkit-scrollbar-thumb {
        background: #9CAB84;
        border-radius: 3px;
    }

    .modal-action .modal-content::-webkit-scrollbar-thumb:hover {
        background: #8B9A6F;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .modal-action .modal-content {
            min-width: auto;
            max-width: 95%;
        }

        .form-group {
            grid-template-columns: 1fr;
        }

        .modal-header {
            padding: 16px;
        }

        .modal-body {
            padding: 16px;
        }

        .modal-footer {
            flex-wrap: wrap;
            gap: 8px;
        }

        .btn {
            flex: 1;
            min-width: 100px;
        }
    }
</style>

<script>
    let currentModalAction = null;
    let currentModalData = null;

    // Escape HTML to prevent XSS
    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, m => map[m]);
    }

    function openActionModal(action, title, fields, data = null) {
        currentModalAction = action;
        currentModalData = data;

        const modal = document.getElementById('actionModal');
        const modalTitle = document.getElementById('modalTitle');
        const formFields = document.getElementById('formFields');
        const actionForm = document.getElementById('actionForm');
        const submitBtn = document.getElementById('submitBtn');
        const modalFooter = document.querySelector('.modal-footer');
        const cancelBtn = modalFooter.querySelector('.btn-secondary');

        modalTitle.textContent = title;
        formFields.innerHTML = '';

        // Set up form
        if (action === 'delete') {
            actionForm.style.display = 'block';
            submitBtn.style.display = 'block';
            const itemName = data && data.itemName ? data.itemName : 'item ini';
            formFields.innerHTML = `
                <div class="delete-confirm">
                    <div class="delete-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h3 class="delete-title">Hapus Data?</h3>
                    <p class="delete-message">Anda akan menghapus:</p>
                    <div class="delete-item-preview">
                        <span class="delete-item-name">${escapeHtml(itemName)}</span>
                    </div>
                    <p class="delete-warning">Tindakan ini <strong>tidak dapat dibatalkan</strong>. Data yang dihapus akan hilang secara permanen.</p>
                </div>
            `;
            submitBtn.innerHTML = '<i class="fas fa-trash"></i> Ya, Hapus';
            submitBtn.className = 'btn btn-danger';
            cancelBtn.innerHTML = '<i class="fas fa-times"></i> Batal';
        } else if (action === 'view') {
            actionForm.style.display = 'block';
            submitBtn.style.display = 'none';

            // Build form fields dynamically for view
            fields.forEach(field => {
                const fieldHTML = buildFormField(field, data, true);
                formFields.innerHTML += fieldHTML;
            });
            cancelBtn.innerHTML = '<i class="fas fa-times"></i> Tutup';
        } else {
            actionForm.style.display = 'block';
            submitBtn.style.display = 'block';
            submitBtn.innerHTML = action === 'add' ? '<i class="fas fa-save"></i> Tambah' : '<i class="fas fa-save"></i> Perbarui';
            submitBtn.className = 'btn btn-primary';
            cancelBtn.innerHTML = '<i class="fas fa-times"></i> Batal';

            // Build form fields dynamically
            fields.forEach(field => {
                const fieldHTML = buildFormField(field, data, false);
                formFields.innerHTML += fieldHTML;
            });
        }

        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    function buildFormField(field, data, isReadOnly = false) {
        const value = data && data[field.name] ? data[field.name] : '';
        const baseClass = `form-field`;
        const readonlyClass = isReadOnly ? ' readonly' : '';

        switch (field.type) {
            case 'text':
            case 'email':
            case 'number':
                return `
                    <div class="${baseClass}">
                        <label class="form-label">${field.label}</label>
                        <input type="${field.type}" class="form-input${readonlyClass}" name="${field.name}"
                               value="${value}" ${field.required ? 'required' : ''} ${isReadOnly ? 'readonly' : ''}
                               placeholder="${field.placeholder || ''}">
                        <div class="form-error">${field.errorMsg || 'Field ini wajib diisi'}</div>
                    </div>
                `;
            case 'select':
                let optionsHTML = `<option value="">-- Pilih ${field.label} --</option>`;
                field.options.forEach(opt => {
                    optionsHTML += `<option value="${opt.value}" ${value === opt.value ? 'selected' : ''}>${opt.label}</option>`;
                });
                return `
                    <div class="${baseClass}">
                        <label class="form-label">${field.label}</label>
                        <select class="form-select${readonlyClass}" name="${field.name}" ${field.required ? 'required' : ''} ${isReadOnly ? 'disabled' : ''}>
                            ${optionsHTML}
                        </select>
                        <div class="form-error">${field.errorMsg || 'Field ini wajib dipilih'}</div>
                    </div>
                `;
            case 'textarea':
                return `
                    <div class="${baseClass} full">
                        <label class="form-label">${field.label}</label>
                        <textarea class="form-textarea${readonlyClass}" name="${field.name}"
                                  ${field.required ? 'required' : ''} ${isReadOnly ? 'readonly' : ''}
                                  placeholder="${field.placeholder || ''}">${value}</textarea>
                        <div class="form-error">${field.errorMsg || 'Field ini wajib diisi'}</div>
                    </div>
                `;
            default:
                return '';
        }
    }

    function closeActionModal() {
        const modal = document.getElementById('actionModal');
        if (modal) {
            modal.classList.add('fade-out');
            setTimeout(() => {
                modal.style.display = 'none';
                modal.classList.remove('fade-out');
                document.body.style.overflow = 'auto';
            }, 300);
        }
    }

    function handleFormSubmit(event) {
        event.preventDefault();

        // Validate form
        const form = document.getElementById('actionForm');
        const inputs = form.querySelectorAll('.form-input, .form-select, .form-textarea');
        let isValid = true;

        inputs.forEach(input => {
            if (input.hasAttribute('required') && !input.value.trim()) {
                input.classList.add('error');
                isValid = false;
            } else {
                input.classList.remove('error');
            }
        });

        if (!isValid) {
            return;
        }

        // Handle submission
        if (currentModalAction === 'delete') {
            if (currentModalData && currentModalData.deleteUrl) {
                // Submit delete request
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
        } else {
            // Submit add/edit form
            const formData = new FormData(form);

            // You can add custom handling here
            console.log('Form submitted:', {
                action: currentModalAction,
                data: Object.fromEntries(formData)
            });

            // For demo, just close the modal
            // In production, submit to your API/endpoint
            closeActionModal();
        }
    }

    // Close modal when clicking backdrop
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('actionModal');
        if (modal) {
            const backdrop = modal.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.addEventListener('click', closeActionModal);
            }
        }
    });

    // Close modal on Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const modal = document.getElementById('actionModal');
            if (modal && modal.style.display === 'block') {
                closeActionModal();
            }
        }
    });

    // Remove error class on input
    document.addEventListener('input', function(event) {
        if (event.target.classList.contains('form-input') ||
            event.target.classList.contains('form-select') ||
            event.target.classList.contains('form-textarea')) {
            event.target.classList.remove('error');
        }
    });
</script>
