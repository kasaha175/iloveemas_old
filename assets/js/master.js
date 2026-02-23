/* ================================================
   MASTER.JS - Master Page Scripts
   ================================================ */

// Wait for DOM to be ready
document.addEventListener("DOMContentLoaded", function() {
    // Initialize Master page functionality
    initMasterPage();
});

/**
 * Initialize Master page functionality
 */
function initMasterPage() {
    console.log("Master page initialized");
    
    // Initialize DataTables if present
    initMasterDataTables();
}

/**
 * Initialize DataTables for Master pages
 */
function initMasterDataTables() {
    // Check if DataTable exists
    if ($('#dataTable').length) {
        initStandardDataTable('#dataTable');
    }
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
