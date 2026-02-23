/* ================================================
   MEMO.JS - Memo Page Scripts
   ================================================ */

// Wait for DOM to be ready
document.addEventListener("DOMContentLoaded", function() {
    initMemoPage();
});

/**
 * Initialize Memo page functionality
 */
function initMemoPage() {
    console.log("Memo page initialized");
    
    // Initialize DataTables if present
    initMemoDataTables();
    
    // Initialize form handlers
    initMemoForms();
}

/**
 * Initialize DataTables for Memo pages
 */
function initMemoDataTables() {
    if ($('#dataTable').length) {
        initStandardDataTable('#dataTable');
    }
}

/**
 * Initialize Memo form handlers
 */
function initMemoForms() {
    // Check if there's a form with id 'myForm'
    if ($('#myForm').length) {
        $('#myForm').on('submit', function(e) {
            e.preventDefault();
            handleMemoFormSubmit($(this));
        });
    }
}

/**
 * Handle Memo form submission
 * @param {jQuery} $form - jQuery form object
 */
function handleMemoFormSubmit($form) {
    Swal.fire({
        title: 'Menyimpan Data...',
        text: 'Mohon tunggu sebentar',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
        },
        customClass: {
            popup: 'glass-swal-popup'
        }
    });
    
    $.ajax({
        url: $form.attr('action'),
        type: 'POST',
        dataType: 'json',
        data: $form.serialize(),
        success: function(response) {
            if (response.status === 'success') {
                Swal.fire({
                    title: 'Berhasil!',
                    text: response.message,
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#00b4d8',
                    customClass: {
                        popup: 'glass-swal-popup'
                    }
                }).then((result) => {
                    window.location.href = baseUrl + 'master/memo/';
                });
            } else {
                Swal.fire({
                    title: 'Gagal!',
                    text: response.message,
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#dc3545',
                    customClass: {
                        popup: 'glass-swal-popup'
                    }
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                title: 'Gagal!',
                text: 'Terjadi kesalahan saat menyimpan data',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#dc3545',
                customClass: {
                    popup: 'glass-swal-popup'
                }
            });
        }
    });
}

/**
 * Delete memo with confirmation
 * @param {number} id - Memo ID
 * @param {string} url - Delete URL
 */
function deleteMemo(id, url) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: 'Data memo akan dihapus secara permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        customClass: {
            popup: 'glass-swal-popup'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}

// Make functions globally available
window.deleteMemo = deleteMemo;
