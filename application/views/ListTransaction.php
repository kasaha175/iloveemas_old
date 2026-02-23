<div class="col-md-12 master-detail-container">

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
                <button class="btn btn-danger" onclick="updateAllStatus()">
                    <i class="fas fa-check"></i> Mark All Done
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
                <!-- Enterprise Table -->
                <div class="enterprise-table-container">
                    <table class="table table-bordered dataTable enterprise-table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
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
$(document).ready(function() {
    initServerDataTable('#dataTable', '<?= base_url('transaction/getTransactions') ?>', [
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
});
</script>
