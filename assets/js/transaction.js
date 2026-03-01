/* ================================================
   TRANSACTION.JS - Transaction Page Scripts
   ================================================
   
   IMPORTANT: DataTable initialization is handled in datatables-init.js
   This file only contains page-specific logic.
*/

// Wait for DOM to be ready
document.addEventListener("DOMContentLoaded", function() {
    initTransactionPage();
});

/**
 * Initialize Transaction page functionality
 */
function initTransactionPage() {
    console.log("Transaction page initialized");
    
    // Initialize any event handlers
    initTransactionEvents();
}

/**
 * Initialize Transaction event handlers
 */
function initTransactionEvents() {
    // Clear data button
    $('#clearDataBtn').on('click', function() {
        clearTransactionData();
    });
}

/**
 * Menghapus seluruh data transaksi
 */
function clearTransactionData() {
    Swal.fire({
        title: 'Konfirmasi Penghapusan Data',
        text: 'Seluruh data transaksi akan dihapus secara permanen dan tidak dapat dipulihkan kembali.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus Permanen',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = baseUrl + 'transaction/clearData';
        }
    });
}

/**
 * Menghapus satu transaksi berdasarkan nomor transaksi
 * @param {string} noOrder - Nomor transaksi
 */
function deleteTransaction(noOrder) {
    Swal.fire({
        title: 'Konfirmasi Penghapusan Transaksi',
        text: 'Transaksi ini akan dihapus secara permanen dan tidak dapat dipulihkan kembali.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Hapus Transaksi',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = baseUrl + "transaction/delete-transaction/" + noOrder;
        }
    });
}

/**
 * Memperbarui seluruh status transaksi menjadi SELESAI
 */
function updateAllStatus() {
    Swal.fire({
        title: 'Konfirmasi Pembaruan Status',
        text: 'Seluruh transaksi akan diperbarui menjadi status SELESAI. Tindakan ini berlaku untuk semua data transaksi.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Perbarui Semua',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: baseUrl + "transaction/updateAllStatus",
                method: "POST",
                dataType: "json",

                success: function (response) {

                    if (response.success) {

                        Swal.fire({
                            title: 'Berhasil',
                            text: response.message || 'Seluruh transaksi berhasil diperbarui menjadi SELESAI.',
                            icon: 'success'
                        }).then(() => {
                            location.reload();
                        });

                    } else {

                        Swal.fire({
                            title: 'Terjadi Kesalahan',
                            text: response.message || 'Terjadi kesalahan saat memperbarui data.',
                            icon: 'error'
                        });

                    }
                },

                error: function () {
                    Swal.fire({
                        title: 'Terjadi Kesalahan',
                        text: 'Permintaan tidak dapat diproses. Silakan coba kembali.',
                        icon: 'error'
                    });
                }
            });

        }
    });
}

// Make functions globally available
window.deleteTransaction = deleteTransaction;
window.updateAllStatus = updateAllStatus;
