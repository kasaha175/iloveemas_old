/* ================================================
   CABANG.JS - cabang Page Scripts
   ================================================
   
   IMPORTANT: DataTable initialization is handled in datatables-init.js
   This file only contains page-specific logic.
*/

// Wait for DOM to be ready
document.addEventListener("DOMContentLoaded", function() {
    initCabangPage();
});

/**
 * Initialize cabang page functionality
 */
function initCabangPage() {
    console.log("cabang page initialized");
    
    // Initialize form handlers
    initCabangForms();
}

/**
 * Initialize cabang form handlers
 */
function initCabangForms() {
    // Check if there's a form with id 'myForm' AND it belongs to cabang pages
    if ($('#myForm').length) {
        var formAction = $('#myForm').attr('action') || '';
        if (formAction.indexOf('save-cabang') !== -1 || formAction.indexOf('save-update-cabang') !== -1) {
            $('#myForm').off('submit').on('submit', function(e) {
                e.preventDefault();
                handleCabangFormSubmit($(this));
            });
        }
    }
}

/**
 * Handle cabang form submission
 * @param {jQuery} $form - jQuery form object
 */
function handleCabangFormSubmit($form) {
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
                    window.location.href = baseUrl + 'master/cabang/';
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
                
                // Show field-specific errors
                if (response.message.includes('Nama')) {
                    $('#error-nama_cabang').text(response.message);
                } else if (response.message.includes('Urutan')) {
                    $('#error-urutan_cabang').text(response.message);
                }
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
 * Delete cabang with confirmation
 * @param {number} id - cabang ID
 * @param {string} url - Delete URL
 */
function deleteCabang(id, url) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: 'Data cabang akan dihapus secara permanen!',
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
window.deleteCabang = deleteCabang;
