<?php 
function nominal($angka){
    $jd = number_format($angka, 2, ',', '.');
    return $jd;
}
?>
<div class="col-md-12 master-detail-container">
    <!-- Breadcrumb - Consistent Format with / -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb glass-breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url()?>dashboard/"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?=base_url()?>master/">Master</a></li>
            <li class="breadcrumb-item active">Customer</li>
        </ol>
    </nav>
    
    <!-- Page Header Container -->
    <div class="page-header-container">
        <div class="page-header-row">
            <!-- Back Button and Page Title Group -->
            <div class="page-title-group">
                <a href="<?=base_url()?>master/" class="btn btn-secondary btn-back-standard mb-3">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back</span>
                </a>
                <h1 class="page-title-main">Customer</h1>
                <div class="page-title-sub">
                    <span class="context-badge context-badge-master">
                        <i class="fas fa-database"></i> Master Data
                    </span>
                </div>
            </div>
            
            <!-- Primary Action - Add Customer -->
            <div class="action-toolbar-right">
                <a href="<?= base_url('transaction/new-customer/?key=add') ?>" class="btn btn-success">
                    <i class="fas fa-user-plus"></i> Add Customer
                </a>
                <button id="downloadCustomerExcelBtn" class="btn btn-primary" onclick="downloadCustomerExcelWithProgress()">
                    <i class="fas fa-file-excel"></i> Download Excel
                </button>
            </div>

        </div>
    </div>
    
    <!-- Alert Messages -->
    <?php if($this->session->userdata('status')=='success'){ ?>
    <div class="enterprise-alert enterprise-alert-success">
        <i class="fas fa-check-circle"></i>
        <?=$this->session->userdata('message')?>
    </div>
    <?php } 
    $data_session = array(
        'status' => '',
        'message' => "",
    );
    $this->session->set_userdata($data_session); ?>
    
    <!-- Data Card - Enterprise Style -->
    <div class="col-md-12">
        <div class="enterprise-card">
            <div class="enterprise-card-header">
                <h3 class="enterprise-card-title">
                    <i class="fas fa-users"></i> Customer Data
                </h3>
            </div>
            <div class="enterprise-card-body">
                <!-- Enterprise Table -->
                <div class="enterprise-table-container">
                    <table class="table table-bordered dataTable enterprise-table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th class="text-center" style="width: 120px;">Action</th>
                                <th>No Order</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Resident Address</th>
                                <th>Phone</th>
                                <th>Date Created</th>
                                <th>Created By</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>

<!-- DataTable Initialization - Using centralized datatables-init.js -->
<script>
$(document).ready(function() {
    initDataTable('#dataTable', {
        serverSide: true,
        processing: true,
        ajax: {
            url: '<?= base_url("master/customer_datatable") ?>',
            type: 'GET'
        },
        order: [[2, 'asc']], // Default order by No Order
        columns: [
            { data: null, orderable: false, searchable: false, render: function(data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }},
            { data: null, orderable: false, searchable: false, render: function(data, type, row) {
                return `
                    <div class="action-button-group">
                        <a href="<?=base_url()?>master/customer/${row.c_id}/" class="btn-action btn-action-edit" data-tooltip="Edit Customer">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn-action btn-action-delete btn-delete-customer" data-id="${row.c_id}" data-name="${row.c_no_order}" data-tooltip="Delete Customer">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>`;
            }},
            { data: 'c_no_order' },
            { data: 'c_name' },
            { data: 'c_address' },
            { data: 'c_resident_address' },
            { data: 'c_phone' },
            { data: 'c_date_created' },
            { data: null, render: function(data) { return data.c_u_id ? 'User ID: ' + data.c_u_id : 'N/A'; } }
        ]
    });
});

function downloadCustomerExcelWithProgress() {
    let progress = 0;
    Swal.fire({
        title: 'Preparing Excel File',
        html: 'Please wait while we generate the customer report... <b>0%</b>',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
            const b = Swal.getHtmlContainer().querySelector('b');
            let timerInterval = setInterval(() => {
                progress += Math.random() * 15 + 5;
                if (progress > 95) progress = 95;
                b.textContent = Math.floor(progress) + '%';
            }, 150);
            
            setTimeout(() => {
                clearInterval(timerInterval);
                b.textContent = '100% - Redirecting...';
                setTimeout(() => {
                    window.location.href = '<?= base_url('master/export-customer-excel') ?>';
                    Swal.close();
                }, 500);
            }, 2500);
        }
    });
}
</script>

