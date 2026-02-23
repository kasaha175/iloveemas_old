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
 * Clear all transaction data
 */
function clearTransactionData() {
    Swal.fire({
        title: 'Are you sure?',
        text: 'All transaction data will be cleared and cannot be restored!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, clear it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = baseUrl + 'transaction/clearData';
        }
    });
}

/**
 * Delete transaction
 * @param {string} noOrder - Transaction order number
 */
function deleteTransaction(noOrder) {
    Swal.fire({
        title: "Are you sure?",
        text: "The transaction will be deleted and cannot be restored!",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Cancel",
        denyButtonText: `Delete`,
    }).then((result) => {
        if (result.isDenied) {
            window.location.href = baseUrl + "transaction/delete-transaction/" + noOrder;
        } else {
            Swal.close();
        }
    });
}

/**
 * Update all transaction statuses
 */
function updateAllStatus() {
    Swal.fire({
        title: 'Are you sure?',
        text: 'This will update the status of all transactions to SELESAI.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, update it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: baseUrl + "transaction/updateAllStatus",
                method: "POST",
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'All transactions have been updated to SELESAI.',
                            icon: 'success'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.message || 'An error occurred while updating data.',
                            icon: 'error'
                        });
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to process the request. Please try again.',
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
