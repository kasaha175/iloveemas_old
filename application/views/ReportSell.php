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
            <li class="breadcrumb-item active">Sell</li>
        </ol>
    </nav>
    
    <!-- Page Title -->
    <h3 class="page-title">REPORT</h3>
    <h3 class="page-subtitle">Transaction Sell</h3>
    
    <!-- Filter Card -->
    <div class="col-md-12">
        <div class="card glass-card">
            <div class="card-header" data-toggle="collapse" data-target="#filterCard">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-filter"></i> Filter Data</h6>
            </div>
            <div class="collapse show" id="filterCard">
                <div class="card-body">
<form action="<?=base_url()?>report/sell/">
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
                                    <a href="#" data-toggle="modal" data-target="#deleteModal<?=$a->t_id?>" class="btn btn-danger btn-circle btn-sm" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="<?=base_url()?>report/sell-print/<?=$a->t_id?>/" class="btn btn-success btn-circle btn-sm" title="Print">
                                        <i class="fas fa-print"></i>
                                    </a>
                                    <a href="<?=base_url()?>report/sell/<?=$a->t_id?>/" class="btn btn-info btn-circle btn-sm" title="Detail">
                                        <i class="fas fa-info"></i>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#modalEdit" onclick="openModalEdit(<?= $a->t_id ?>)" class="btn btn-warning btn-circle btn-sm" title="Edit">
                                        <i class="fa fa-pencil"></i>
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
                                            <a href="<?=base_url()?>transaction/sell-delete-transaction/<?=$a->t_id?>" class="btn btn-danger">Delete</a>
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
                    <input type="hidden" name="type" id="type" value="sell">
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
                    <i class="fa fa-save"></i> Submit
                </button>
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
    color: var(--text-primary);
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 10px;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.page-subtitle {
    text-align: center;
    color: var(--turquoise-surf);
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

$(document).ready(function () {
    $('#dataTable').DataTable({
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
