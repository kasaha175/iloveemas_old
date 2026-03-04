<div class="col-md-12 master-detail-container transaction-list-page" style="padding-top: 90px;">

    <!-- Breadcrumb - dengan jarak dari navbar -->
    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <ol class="breadcrumb glass-breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url()?>dashboard/"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active">Transaction</li>
        </ol>
    </nav>
    
    <!-- Page Title -->
    <h3 class="page-title">TRANSACTION</h3>
    <h3 class="page-subtitle">Transaction Data</h3>
    
    <!-- Filter Card - 1 Row with col-4 -->
    <div class="col-md-12">
        <div class="card glass-card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-filter"></i> Filter Data</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-0">
                            <label class="filter-label"><i class="fas fa-tags"></i> Type</label>
                            <select id="filterType" class="filter-select">
                                <option value="">All</option>
                                <option value="SELL">SELL</option>
                                <option value="BUY">BUY</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-0">
                            <label class="filter-label"><i class="fas fa-calendar"></i> From</label>
                            <input type="date" id="filterDateFrom" class="filter-input">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-0">
                            <label class="filter-label"><i class="fas fa-calendar"></i> To</label>
                            <input type="date" id="filterDateTo" class="filter-input">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12" style="display: flex; justify-content: flex-end; gap: 10px;">
                        <button type="button" id="applyFilters" class="btn btn-primary btn-sm">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <button type="button" id="resetFilters" class="btn btn-secondary btn-sm">
                            <i class="fas fa-redo"></i> Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Action Buttons Card -->
    <div class="col-md-12 mt-4">
        <div class="card glass-card">
            <div class="card-body" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                <div>
                    <button class="btn btn-danger" onclick="updateSelectedStatus()">
                        <i class="fas fa-check"></i> Mark Selected Done
                    </button>
                    <button class="btn btn-warning" onclick="updateAllStatus()">
                        <i class="fas fa-check-double"></i> Mark All Done
                    </button>
                </div>
                <a href="<?= base_url('transaction') ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Transaction
                </a>
            </div>
        </div>
    </div>
    
    <!-- Data Table Card -->
    <div class="col-md-12 mt-4">
        <div class="card glass-card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-list"></i> Transaction Data</h6>
            </div>
            <div class="card-body">
                <!-- Enterprise Table -->
                <div class="table-responsive">
                    <table class="table table-bordered dataTable enterprise-table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAll"></th>
                                <th>No</th>
                                <th>Action</th>
                                <th>Transaction</th>
                                <th>No Order</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Qty</th>
                                <th>Price Total</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Back Button - dengan jarak dari footer -->
    <div class="col-md-12 mt-4 mb-4">
        <a href="<?=base_url()?>dashboard/" class="btn btn-primary btn-lg">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Dashboard</span>
        </a>
    </div>
</div>

<!-- DataTable Initialization - Using centralized datatables-init.js -->
<script>
var baseUrl = '<?= base_url() ?>';
var transactionTable;

$(document).ready(function() {
    // Initialize DataTable with checkbox column
    transactionTable = initServerDataTable('#dataTable', '<?= base_url('transaction/getTransactions') ?>', [
        { 
            data: 'checkbox', 
            orderable: false, 
            searchable: false,
            render: function(data, type, row) {
                return '<input type="checkbox" class="row-checkbox" value="' + row.no_order + '">';
            }
        },
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
    ]);
    
    // Handle "Select All" checkbox
    $('#selectAll').on('change', function() {
        $('.row-checkbox').prop('checked', $(this).prop('checked'));
    });
    
    // Handle individual checkbox changes
    $(document).on('change', '.row-checkbox', function() {
        if (!$(this).prop('checked')) {
            $('#selectAll').prop('checked', false);
        } else {
            // Check if all checkboxes are checked
            var allChecked = $('.row-checkbox').length === $('.row-checkbox:checked').length;
            $('#selectAll').prop('checked', allChecked);
        }
    });
    
    // Apply Filters
    $('#applyFilters').on('click', function() {
        applyFilters();
    });
    
    // Reset Filters
    $('#resetFilters').on('click', function() {
        $('#filterType').val('');
        $('#filterDateFrom').val('');
        $('#filterDateTo').val('');
        applyFilters();
    });
    
    // Apply filters function
    function applyFilters() {
        var type = $('#filterType').val();
        var dateFrom = $('#filterDateFrom').val();
        var dateTo = $('#filterDateTo').val();
        
        // Reload DataTable with new parameters
        transactionTable.ajax.url(baseUrl + 'transaction/getTransactions?type=' + type + '&date_from=' + dateFrom + '&date_to=' + dateTo).load();
    }
});

// Get selected transactions
function getSelectedTransactions() {
    var selected = [];
    $('.row-checkbox:checked').each(function() {
        selected.push($(this).val());
    });
    return selected;
}

// Update selected transactions to SELESAI
function updateSelectedStatus() {
    var selected = getSelectedTransactions();
    
    if (selected.length === 0) {
        Swal.fire({
            title: 'Tidak Ada Transaksi Dipilih',
            text: 'Silakan pilih minimal satu transaksi untuk diperbarui.',
            icon: 'warning'
        });
        return;
    }
    
    Swal.fire({
        title: 'Konfirmasi Pembaruan Status',
        text: 'Anda akan memperbarui ' + selected.length + ' transaksi menjadi status SELESAI.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Perbarui',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: baseUrl + "transaction/updateSelectedStatus",
                method: "POST",
                data: { no_orders: selected },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: response.message || 'Transaksi yang dipilih berhasil diperbarui menjadi SELESAI.',
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
</script>
