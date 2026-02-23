/* ================================================
   MASTER.JS - Master Page Scripts
   ================================================
   
   IMPORTANT: DataTable initialization is handled in datatables-init.js
   This file only contains page-specific logic.
*/

// Wait for DOM to be ready
document.addEventListener("DOMContentLoaded", function() {
    initMasterPage();
});

/**
 * Initialize Master page functionality
 */
function initMasterPage() {
    console.log("Master page initialized");
    // Add Master-specific initialization here if needed
}

/**
 * Delete customer with confirmation
 * @param {number} id - Customer ID
 * @param {string} name - Customer name
 */
function deleteCustomer(id, name) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: 'Data customer ' + name + ' akan dihapus secara permanen!',
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
            showLoading();
            
            $.ajax({
                url: baseUrl + 'master/delete-customer-swal/',
                type: 'POST',
                dataType: 'json',
                data: { id: id },
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#28a745',
                            customClass: {
                                popup: 'glass-swal-popup'
                            }
                        }).then((result) => {
                            window.location.href = baseUrl + 'master/customer/';
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
                        text: 'Terjadi kesalahan saat menghapus data',
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
    });
}

// Make functions globally available
window.deleteCustomer = deleteCustomer;
