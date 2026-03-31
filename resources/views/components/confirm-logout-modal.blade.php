{{-- Logout Confirmation Modal Component --}}
<div id="logoutConfirmModal" class="modal modal-logout" style="display: none;">
    <div class="modal-backdrop"></div>
    <div class="modal-content modal-confirm">
        <div class="modal-header">
            <h2 class="modal-title">Konfirmasi Logout</h2>
        </div>
        <div class="modal-body">
            <div class="confirm-icon">
                <i class="fas fa-sign-out-alt"></i>
            </div>
            <p class="confirm-text">Apakah Anda yakin ingin keluar dari aplikasi?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeLogoutModal()">
                <i class="fas fa-times"></i>
                Batal
            </button>
            <button type="button" class="btn btn-danger" onclick="confirmLogout()">
                <i class="fas fa-check"></i>
                Ya, Logout
            </button>
        </div>
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

    .modal.modal-logout .modal-content {
        min-width: 380px;
        max-width: 500px;
        width: 90%;
    }

    .modal-header {
        padding: 24px 24px 16px 24px;
        border-bottom: 1px solid #E8E4D0;
    }

    .modal-title {
        font-size: 20px;
        font-weight: 600;
        color: #333333;
        margin: 0;
        font-family: 'Poppins', sans-serif;
    }

    .modal-body {
        padding: 32px 24px;
        text-align: center;
    }

    .confirm-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        background: #FFE5E5;
        border-radius: 50%;
        margin: 0 auto 16px;
        animation: scaleIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
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

    .confirm-icon i {
        font-size: 28px;
        color: #E74C3C;
    }

    .confirm-text {
        font-size: 14px;
        color: rgba(0, 0, 0, 0.7);
        line-height: 1.6;
        margin: 0;
        font-family: 'Poppins', sans-serif;
    }

    .modal-footer {
        padding: 20px 24px;
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        border-top: 1px solid #E8E4D0;
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

    /* Responsive */
    @media (max-width: 768px) {
        .modal.modal-logout .modal-content {
            min-width: auto;
            max-width: 90%;
        }

        .modal-body {
            padding: 24px;
        }

        .modal-footer {
            flex-wrap: wrap;
        }

        .btn {
            flex: 1;
            min-width: 120px;
            justify-content: center;
        }
    }
</style>

<script>
    function openLogoutModal() {
        const modal = document.getElementById('logoutConfirmModal');
        if (modal) {
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
    }

    function closeLogoutModal() {
        const modal = document.getElementById('logoutConfirmModal');
        if (modal) {
            modal.classList.add('fade-out');
            setTimeout(() => {
                modal.style.display = 'none';
                modal.classList.remove('fade-out');
                document.body.style.overflow = 'auto';
            }, 300);
        }
    }

    function confirmLogout() {
        const logoutForm = document.getElementById('logout-form');
        if (logoutForm) {
            logoutForm.submit();
        }
    }

    // Close modal when clicking backdrop
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('logoutConfirmModal');
        if (modal) {
            const backdrop = modal.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.addEventListener('click', closeLogoutModal);
            }
        }
    });

    // Close modal on Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const modal = document.getElementById('logoutConfirmModal');
            if (modal && modal.style.display === 'block') {
                closeLogoutModal();
            }
        }
    });
</script>
