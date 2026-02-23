/* ================================================
   TRANSACTION.JS - Transaction Page Scripts
   ================================================ */

// Wait for DOM to be ready
document.addEventListener("DOMContentLoaded", function() {
    initTransactionPage();
});

/**
 * Initialize Transaction page functionality
 */
function initTransactionPage() {
    console.log("Transaction page initialized");
    
    // Initialize DataTables if present
    initTransactionDataTables();
    
    // Initialize any event handlers
    initTransactionEvents();
}

/**
 * Initialize DataTables for Transaction pages
 */
function initTransactionDataTables() {
    // Check if DataTable exists
    if ($('#dataTable').length) {
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: baseUrl + 'transaction/getTransactions',
                type: "POST",
            },
            columns: [
                { data: 'no', orderable: false, searchable: false },
                { data: 'action', orderable: false, searchable: false },
                { data: 'transaction' },
                { data: 'no_order' },
                { data: 'status' },
                { data: 'date' },
                { data: 'customer' },
                { data: 'qty' },
                {
                    data: 'price_total',
                    render: function (data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            return 'IDR ' + new Intl.NumberFormat('id-ID').format(data || 0);
                        }
                        return data;
                    }
                }
            ]
        });
    }
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
