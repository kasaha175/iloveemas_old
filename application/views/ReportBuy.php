<?php 
function nominal($angka){
    $jd = number_format($angka, 0, ',', '.');
    return $jd;
}
?>
<div class="col-md-12 report-detail-container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb glass-breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url()?>dashboard/"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?=base_url()?>report/">Report</a></li>
            <li class="breadcrumb-item active">Buy</li>
        </ol>
    </nav>
    
    <!-- Page Title -->
    <h3 class="page-title">REPORT</h3>
    <h3 class="page-subtitle">Transaction Buy</h3>
    
    <!-- Filter Card -->
    <div class="col-md-12">
        <div class="card glass-card">
            <div class="card-header" data-toggle="collapse" data-target="#filterCard">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-filter"></i> Filter Data</h6>
            </div>
            <div class="collapse show" id="filterCard">
                <div class="card-body">
<form action="<?=base_url()?>report/buy/">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Start Date</label>
                                    <?php if(empty($this->input->get('dateStart'))){ ?>
                                        <input name="dateStart" required type="date" value="<?=date('Y-m-d')?>" class="form-control glass-input">
                                    <?php }else{ ?>
                                        <input name="dateStart" required type="date" value="<?=$this->input->get('dateStart')?>" class="form-control glass-input">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">End Date</label>
                                    <?php if(empty($this->input->get('dateEnd'))){ ?>
                                        <input name="dateEnd" required type="date" value="<?=date('Y-m-d')?>" class="form-control glass-input">
                                    <?php }else{ ?>
                                        <input name="dateEnd" required type="date" value="<?=$this->input->get('dateEnd')?>" class="form-control glass-input">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control glass-input">
                                        <option value="">All Status</option>
                                        <option value="SELESAI" <?=($this->input->get('status') == 'SELESAI') ? 'selected' : ''?>>SELESAI</option>
                                        <option value="PROSES" <?=($this->input->get('status') == 'PROSES') ? 'selected' : ''?>>PROSES</option>
                                        <option value="CHECKOUT" <?=($this->input->get('status') == 'CHECKOUT') ? 'selected' : ''?>>CHECKOUT</option>
                                        <option value="VOID" <?=($this->input->get('status') == 'VOID') ? 'selected' : ''?>>VOID</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-filter"></i> Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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
                <div class="table-responsive">
                    <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Action</th>
                                <th>No Order</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Created By</th>
                                <th>Receive By</th>
                                <th>Customer</th>
                                <th>Qtt</th>
                                <th>Price Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no=0; foreach($data as $a){ $no++; ?>
                            <tr>
                                <td><?=$no?></td>
                                <td class="action-buttons">
                                    <a href="#" class="btn btn-danger btn-circle btn-sm" title="Delete" onclick="deleteTransaction(<?= $a->t_id ?>, '<?=$a->t_no_order?>', 'buy')">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    <a href="#" class="btn btn-info btn-circle btn-sm" title="Detail" onclick="openDetailModal(<?= $a->t_id ?>, 'buy')">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-warning btn-circle btn-sm" title="Edit" data-toggle="modal" data-target="#modalEdit" onclick="openModalEdit(<?= $a->t_id ?>)">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                                <td><?=$a->t_no_order?></td>
                                <td><span class="badge badge-<?=strtolower($a->t_status)?>"><?=$a->t_status?></span></td>
                                <td><?=$a->t_date_created?></td>
                                <td><?=$a->nameCreator?></td>
                                <td><?=$a->nameReceive?></td>
                                <td><?=$a->nameCustomer?></td>
                                <td><?=$a->t_qtt?></td>
                                <td>IDR <?=nominal(floatval($a->t_price_total) + floatval($a->t_price_admin ?? 0))?></td>
                            </tr>
                            
                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal<?=$a->t_id?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Ready to Delete?</h5>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Delete transaction <b><?=$a->t_no_order?></b>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <a href="<?=base_url()?>transaction/buy-delete-transaction/<?=$a->t_id?>" class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Back Button -->
    <div class="col-md-12 mt-4 text-center">
        <a href="<?=base_url()?>report/" class="btn btn-primary btn-lg">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Report</span>
        </a>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Perubahan</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <input type="hidden" name="type" id="type" value="buy">
                    <input type="hidden" name="id" value="" id="edit_id">
                    <div class="form-group">
                        <label>Alasan Perubahan</label>
                        <textarea name="alasan" id="alasan" class="form-control glass-input"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Kata Sandi</label>
                        <input type="password" name="password" id="password" class="form-control glass-input">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btn-primary" onclick="submitKonfirmasi()">
                    <i class="fas fa-save"></i> Submit
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle text-warning"></i> Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus transaksi <b id="deleteNoOrder"></b>?</p>
                <p class="text-muted small">Status transaksi akan diubah menjadi VOID.</p>
                <input type="hidden" id="deleteTransactionId">
                <input type="hidden" id="deleteTransactionType">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                    <i class="fas fa-trash-alt"></i> Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Detail Transaction Modal -->
<div class="modal fade" id="transactionDetailModal" tabindex="-1" role="dialog" aria-labelledby="transactionDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content glass-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="transactionDetailModalLabel">
                    <i class="fas fa-receipt"></i> Transaction Detail
                    <span id="modalTransactionType" class="badge badge-info ml-2">BUY</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #fff;">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalDetailBody">
                <!-- Loading State -->
                <div id="modalLoading" class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <p class="mt-3 text-muted">Loading transaction data...</p>
                </div>
                
                <!-- Content (will be populated by JS) -->
                <div id="modalContent" style="display: none;">
                    <!-- Transaction Info Card -->
                    <div class="card glass-card mb-3">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold"><i class="fas fa-info-circle"></i> Transaction Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <span class="info-label">No Order:</span>
                                        <span class="info-value" id="detailNoOrder">-</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <span class="info-label">Date:</span>
                                        <span class="info-value" id="detailDate">-</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <span class="info-label">Status:</span>
                                        <span class="info-value" id="detailStatus">-</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <span class="info-label">Cabang:</span>
                                        <span class="info-value" id="detailCabang">-</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Customer & Kasir Info -->
                    <div class="row">
                        <!-- Customer Info -->
                        <div class="col-md-6">
                            <div class="card glass-card mb-3">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold"><i class="fas fa-user"></i> Customer Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="info-item">
                                        <span class="info-label">Name:</span>
                                        <span class="info-value" id="detailCustomer">-</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Kasir Info -->
                        <div class="col-md-6">
                            <div class="card glass-card mb-3">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold"><i class="fas fa-user-tie"></i> Kasir Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="info-item">
                                        <span class="info-label">Created By:</span>
                                        <span class="info-value" id="detailCreatedBy">-</span>
                                    </div>
                                    <div class="info-item mt-2">
                                        <span class="info-label">Received By:</span>
                                        <span class="info-value" id="detailReceiveBy">-</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Transaction Items -->
                    <div class="card glass-card mb-3">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold"><i class="fas fa-box"></i> Transaction Items</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="detailItemsTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Material</th>
                                            <th>Type</th>
                                            <th>Carat</th>
                                            <th>Weight</th>
                                            <th>Price/Gr</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detailItemsBody">
                                        <!-- Items will be populated here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Summary & PDF -->
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card glass-card">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold"><i class="fas fa-calculator"></i> Summary</h6>
                                </div>
                                <div class="card-body">
                                    <div class="summary-row">
                                        <span class="summary-label">Total Quantity:</span>
                                        <span class="summary-value" id="detailTotalQty">-</span>
                                    </div>
                                    <div class="summary-row">
                                        <span class="summary-label">Sub Total:</span>
                                        <span class="summary-value" id="detailSubTotal">-</span>
                                    </div>
                                    <div class="summary-row">
                                        <span class="summary-label">Admin Fee:</span>
                                        <span class="summary-value" id="detailAdminFee">-</span>
                                    </div>
                                    <div class="summary-row">
                                        <span class="summary-label">Payment Method:</span>
                                        <span class="summary-value" id="detailPaymentMethod">-</span>
                                    </div>
                                    <div class="summary-row total">
                                        <span class="summary-label">Grand Total:</span>
                                        <span class="summary-value" id="detailTotalPrice">-</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card glass-card h-100">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold"><i class="fas fa-file-pdf"></i> Invoice</h6>
                                </div>
                                <div class="card-body d-flex align-items-center justify-content-center">
                                    <a id="detailPdfLink" href="#" target="_blank" class="btn btn-primary btn-block">
                                        <i class="fas fa-file-pdf"></i> View PDF
                                    </a>
                                    <span id="detailNoPdf" class="text-muted" style="display: none;">No PDF available</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
.report-detail-container {
    padding: 100px 20px 40px;
    max-width: 1400px;
    margin: 0 auto;
}

.page-title {
    text-align: center;
    color: #A8F1FF;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 10px;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.page-subtitle {
    text-align: center;
    color: #A8F1FF;
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 30px;
}

.card.glass-card {
    margin-bottom: 20px;
}

.card-header {
    background: rgba(255, 255, 255, 0.05);
    border-bottom: 1px solid var(--glass-border);
    padding: 15px 20px;
    cursor: pointer;
}

.card-header h6 {
    color: var(--turquoise-surf);
    margin: 0;
}

.card-header:hover {
    background: rgba(255, 255, 255, 0.1);
}

.card-body {
    padding: 20px;
}

.action-buttons {
    display: flex;
    gap: 5px;
    justify-content: center;
}

.badge-selesai, .badge-completed {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.75rem;
}

.badge-proses, .badge-process {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.75rem;
}

.badge-checkout {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
    color: white;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.75rem;
}

.badge-void {
    background: linear-gradient(135deg, #6b7280, #4b5563);
    color: white;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.75rem;
}

/* Modal Styles */
.glass-modal {
    background: var(--card-gradient) !important;
    backdrop-filter: var(--glass-blur) !important;
    border: 1px solid var(--glass-border) !important;
    border-radius: 16px !important;
}

.glass-modal .modal-header {
    background: linear-gradient(180deg, rgba(255,255,255,0.1) 0%, transparent 100%) !important;
    border-bottom: 1px solid var(--glass-border) !important;
    border-radius: 16px 16px 0 0 !important;
    padding: 16px 20px !important;
}

.glass-modal .modal-header .modal-title {
    color: var(--text-primary) !important;
    font-weight: 600 !important;
}

.glass-modal .modal-body {
    padding: 20px !important;
    color: var(--text-light) !important;
}

.glass-modal .modal-footer {
    background: linear-gradient(0deg, rgba(255,255,255,0.05) 0%, transparent 100%) !important;
    border-top: 1px solid var(--glass-border) !important;
    border-radius: 0 0 16px 16px !important;
    padding: 14px 20px !important;
}

.glass-modal .close {
    color: var(--text-muted) !important;
    font-size: 1.5rem !important;
    font-weight: 300 !important;
    opacity: 0.7 !important;
}

.glass-modal .close:hover {
    color: #fff !important;
    opacity: 1 !important;
}

/* Info Item Styles */
.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.info-item:last-child {
    border-bottom: none;
}

.info-label {
    color: var(--text-secondary);
    font-size: 0.9rem;
    font-weight: 500;
}

.info-value {
    color: var(--text-primary);
    font-size: 0.9rem;
    font-weight: 600;
    text-align: right;
}

/* Summary Styles */
.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.summary-row:last-child {
    border-bottom: none;
}

.summary-row.total {
    border-top: 2px solid var(--turquoise-surf);
    border-bottom: none;
    padding-top: 15px;
    margin-top: 10px;
}

.summary-label {
    color: var(--text-secondary);
    font-size: 1rem;
    font-weight: 500;
}

.summary-value {
    color: var(--text-primary);
    font-size: 1.1rem;
    font-weight: 700;
}

.summary-row.total .summary-value {
    color: var(--turquoise-surf);
    font-size: 1.3rem;
}

/* Loading spinner */
.spinner-border {
    width: 3rem;
    height: 3rem;
    border-width: 0.3em;
}

@media (max-width: 768px) {
    .report-detail-container {
        padding: 90px 15px 30px;
    }
    
    .page-title {
        font-size: 1.5rem;
    }
    
    .page-subtitle {
        font-size: 1.2rem;
    }
    
    .action-buttons {
        flex-wrap: wrap;
    }
}
</style>

<script>
function submitKonfirmasi(){
    Swal.fire({
        title: 'Mohon Tunggu Sebentar',
        html: '<i class="fa fa-spin fa-refresh"></i>',
        showConfirmButton: false,
    });
    if($('#alasan').val() == null){
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Alasan Tidak Boleh Kosong',
        });
    }
    $.ajax({
        url: "<?= base_url('transaction/confirm-edit') ?>",
        method: "POST",
        data: {
            type: $('#type').val(),
            id: $('#edit_id').val(),
            alasan: $('#alasan').val(),
            password: $('#password').val(),
        },
        success: function (data) {
            var res = JSON.parse(data);
            console.log(res);
            if(res.status == 'gagal'){
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Kata Sandi Salah!',
                });
            }
            else{
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Mohon Tunggu Sebentar',
                });
                window.location.href="<?= base_url('transaction/redirect/') ?>"+res.no_transaksi
            }
        }
    });
}

function openModalEdit(t_id){
    $('#edit_id').val(t_id);
}

// Function to show delete confirmation modal
function deleteTransaction(id, noOrder, type) {
    $('#deleteTransactionId').val(id);
    $('#deleteTransactionType').val(type);
    $('#deleteNoOrder').text(noOrder);
    $('#deleteModal').modal('show');
}

// Function to confirm delete (change status to VOID)
function confirmDelete() {
    const id = $('#deleteTransactionId').val();
    const type = $('#deleteTransactionType').val();
    
    Swal.fire({
        title: 'Mohon Tunggu Sebentar',
        html: '<i class="fa fa-spin fa-refresh"></i>',
        showConfirmButton: false,
    });
    
    $.ajax({
        url: "<?= base_url('report/updateTransactionStatus') ?>",
        method: "POST",
        data: {
            id: id,
            type: type,
            status: 'VOID'
        },
        dataType: 'json',
        success: function(res) {
            console.log(res);
            $('#deleteModal').modal('hide');
            
            if(res.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Status transaksi berhasil diubah menjadi VOID',
                }).then((result) => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: res.message || 'Gagal mengubah status transaksi',
                });
            }
        },
        error: function(xhr, status, error) {
            $('#deleteModal').modal('hide');
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan: ' + error,
            });
        }
    });
}

// Function to open detail modal
function openDetailModal(transactionId, type) {
    // Show modal
    $('#transactionDetailModal').modal('show');
    
    // Reset modal content
    $('#modalLoading').show();
    $('#modalContent').hide();
    
    // Set transaction type badge
    $('#modalTransactionType').text(type.toUpperCase());
    
    // Debug: log the URL
    console.log('Fetching from: <?= base_url('report/getBuyTransactionDetail') ?>?id=' + transactionId);
    
    // Fetch data from API
    $.ajax({
        url: "<?= base_url('report/getBuyTransactionDetail') ?>",
        type: 'GET',
        data: { id: transactionId },
        dataType: 'json',
        success: function(response) {
            console.log('Response:', response);
            $('#modalLoading').hide();
            
            if (response.status === 'success') {
                $('#modalContent').show();
                
                const data = response.data;
                const transaction = data.transaction;
                const items = data.items;
                
                // Populate transaction info
                $('#detailNoOrder').text(transaction.no_order || '-');
                $('#detailDate').text(transaction.date_created ? formatDate(transaction.date_created) : '-');
                $('#detailStatus').html(getStatusBadge(transaction.status));
                $('#detailCabang').text(transaction.cabang || '-');
                
                // Populate customer info
                $('#detailCustomer').text(transaction.customer_name || '-');
                
                // Populate kasir info
                $('#detailCreatedBy').text(transaction.created_by || '-');
                $('#detailReceiveBy').text(transaction.receive_by || '-');
                
                // Populate items table
                populateItemsTable(items);
                
                // Populate summary
                $('#detailTotalQty').text(transaction.qtt || '0');
                $('#detailSubTotal').text('IDR ' + nominal(transaction.price_total));
                $('#detailAdminFee').text('IDR ' + nominal(transaction.admin_fee));
                $('#detailPaymentMethod').text(transaction.payment_method || '-');
                $('#detailTotalPrice').text('IDR ' + nominal(transaction.grand_total));
                
                // Handle PDF link
                if (transaction.pdf_path && transaction.pdf_filename) {
                    $('#detailPdfLink').show();
                    $('#detailNoPdf').hide();
                    $('#detailPdfLink').attr('href', '<?= base_url() ?>' + transaction.pdf_path);
                } else {
                    $('#detailPdfLink').hide();
                    $('#detailNoPdf').show();
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message || 'Failed to load transaction data'
                });
            }
        },
        error: function(xhr, status, error) {
            console.log('XHR:', xhr);
            console.log('Status:', status);
            console.log('Error:', error);
            $('#modalLoading').hide();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to connect to server: ' + error
            });
        }
    });
}

// Populate items table
function populateItemsTable(items) {
    const tbody = $('#detailItemsBody');
    tbody.empty();
    
    if (items && items.length > 0) {
        let no = 1;
        items.forEach(function(item) {
            const row = `
                <tr>
                    <td>${no}</td>
                    <td>${item.ti_material || '-'}</td>
                    <td>${item.ti_material_type || '-'}</td>
                    <td>${item.ti_carat || '-'}</td>
                    <td>${item.ti_weight || '0'}</td>
                    <td>${item.ti_price !== '-' ? 'IDR ' + nominal(item.ti_price) : '-'}</td>
                    <td>IDR ${nominal(item.ti_price_total)}</td>
                </tr>
            `;
            tbody.append(row);
            no++;
        });
    } else {
        tbody.html('<tr><td colspan="7" class="text-center">No items found</td></tr>');
    }
}

// Format date
function formatDate(dateString) {
    if (!dateString) return '-';
    const date = new Date(dateString);
    const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
    return date.toLocaleDateString('id-ID', options);
}

// Get status badge HTML
function getStatusBadge(status) {
    const statusLower = (status || '').toLowerCase();
    let badgeClass = 'badge-secondary';
    
    if (statusLower === 'completed' || statusLower === 'selesai') {
        badgeClass = 'badge-selesai';
    } else if (statusLower === 'proses' || statusLower === 'process') {
        badgeClass = 'badge-proses';
    } else if (statusLower === 'checkout') {
        badgeClass = 'badge-checkout';
    } else if (statusLower === 'void') {
        badgeClass = 'badge-void';
    }
    
    return `<span class="badge ${badgeClass}">${status || '-'}</span>`;
}

// Format number to Indonesian Rupiah
function nominal(angka) {
    if (!angka || isNaN(angka)) return '0';
    return new Intl.NumberFormat('id-ID').format(angka);
}

// Initialize DataTable using centralized function
$(document).ready(function () {
    initDataTable('#dataTable', {
        dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, 100, -1 ],
            [ '10 rows', '25 rows', '50 rows', '100 rows', 'Show all' ]
        ],
        buttons: [
            {
                extend: 'copyHtml5',
                text: '<i class="fa fa-clipboard"></i> Copy',
                className: 'btn btn-primary',
            },
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'A4',
                text: '<i class="fa fa-file-pdf-o"></i> PDF',
                className: 'btn btn-primary',
            },
            {
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel-o"></i> Excel',
                className: 'btn btn-primary',
            },
            {
                extend: 'csvHtml5',
                text: '<i class="fa fa-file-text-o"></i> CSV',
                className: 'btn btn-primary',
            },
            {
                extend: 'pageLength',
                text: '<i class="fa fa-list"></i> Show',
                className: 'btn btn-primary',
            }
        ],
    });
});
</script>
