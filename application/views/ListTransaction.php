<div class="col-md-12 master-detail-container transaction-list-page">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb glass-breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url()?>dashboard/"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active">Transaction</li>
        </ol>
    </nav>
    
    <!-- Page Header Container -->
    <div class="page-header-container">
        <div class="page-header-row">
            <!-- Page Title Group -->
            <div class="page-title-group">
                <h1 class="page-title-main">Transaction</h1>
                <div class="page-title-sub">
                    <span class="context-badge context-badge-transaction">
                        <i class="fas fa-exchange-alt"></i> Transaction Data
                    </span>
                </div>
            </div>
            
            <!-- Primary Action -->
            <div class="action-toolbar-right">
                <button class="btn btn-danger" onclick="updateSelectedStatus()">
                    <i class="fas fa-check"></i> Mark Selected Done
                </button>
                <button class="btn btn-warning" onclick="updateAllStatus()">
                    <i class="fas fa-check-double"></i> Mark All Done
                </button>
                <a href="<?= base_url('transaction') ?>" class="btn-primary-enterprise">
                    <i class="fas fa-plus"></i> Add Transaction
                </a>
            </div>
        </div>
    </div>
    
    <!-- Alert Messages -->
    <?php if($this->session->userdata('status')=='success'): ?>
    <div class="enterprise-alert enterprise-alert-success">
        <i class="fas fa-check-circle"></i>
        <?=$this->session->userdata('message')?>
    </div>
    <?php 
    $data_session = array('status' => '', 'message' => "");
    $this->session->set_userdata($data_session); 
    endif; ?>
    
    <!-- Data Card - Enterprise Style -->
    <div class="col-md-12">
        <div class="enterprise-card">
            <div class="enterprise-card-header">
                <h3 class="enterprise-card-title">
                    <i class="fas fa-list"></i> Transaction Data
                </h3>
            </div>
            <div class="enterprise-card-body">
                <!-- Filter Section -->
                <div class="transaction-filters mb-4">
                    <!-- Baris 1: Type + From Date -->
                    <div class="filter-group">
                        <div class="filter-item">
                            <label class="filter-label"><i class="fas fa-tags"></i> Type</label>
                            <select id="filterType" class="filter-select">
                                <option value="">All</option>
                                <option value="SELL">SELL</option>
                                <option value="BUY">BUY</option>
                            </select>
                        </div>
                        <div class="filter-item">
                            <label class="filter-label"><i class="fas fa-calendar"></i> From</label>
                            <input type="date" id="filterDateFrom" class="filter-input">
                        </div>
                        <div class="filter-item">
                            <label class="filter-label"><i class="fas fa-calendar"></i> To</label>
                            <input type="date" id="filterDateTo" class="filter-input">
                        </div>
                        <div class="filter-buttons">
                            <button type="button" id="applyFilters" class="btn btn-primary btn-sm">
                                <i class="fas fa-filter"></i>
                            </button>
                            <button type="button" id="resetFilters" class="btn btn-secondary btn-sm">
                                <i class="fas fa-redo"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Enterprise Table -->
                <div class="enterprise-table-container">
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
    
    <!-- Back Button -->
    <div class="mt-4 text-center">
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
