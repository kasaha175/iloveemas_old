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
            <li class="breadcrumb-item active">Cabang</li>
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
                <h1 class="page-title-main">Cabang</h1>
                <div class="page-title-sub">
                    <span class="context-badge context-badge-master">
                        <i class="fas fa-database"></i> Master Data
                    </span>
                </div>
            </div>
            
            <!-- Primary Action - Add cabang -->
            <div class="action-toolbar-right">
                <a href="<?= base_url('master/addcabang') ?>" class="btn btn-success">
                    <i class="fas fa-plus"></i> Add cabang
                </a>
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
    
    <!-- Data Card -->
    <?php 
    $this->db->where('status', 'ENABLE');
    $this->db->order_by('id', 'DESC');
    $cabang = $this->db->get('tb_cabang')->result();
    ?>
    <div class="col-md-12">
        <div class="enterprise-card">
            <div class="enterprise-card-header">
                <h3 class="enterprise-card-title">
                    <i class="fas fa-store"></i> Cabang Data
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
                                <th>Cabang</th>
                                <th>Urutan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cabang as $key => $value): ?>
                                <tr>
                                    <td><?=$key+1?></td>
                                    <td class="action-column">
                                        <div class="action-button-group">
                                            <!-- Edit Button - Pencil Icon with Tooltip -->
                                            <a href="<?=base_url()?>master/detailCabang/<?=$value->id?>/" 
                                               class="btn-action btn-action-edit" 
                                               data-tooltip="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <!-- Delete Button - Trash Icon with Tooltip -->
                                            <a href="<?=base_url()?>master/deleteCabang/<?=$value->id?>/" 
                                               class="btn-action btn-action-delete" 
                                               data-tooltip="Delete"
                                               onclick="return confirm('Apakah Anda yakin?');">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td><?= $value->nama_cabang ?></td>
                                    <td><?= $value->urutan_cabang ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>

<!-- DataTable Initialization -->
<script>
$(document).ready(function() {
    // Initialize DataTable with reinitialization check
    if (!$.fn.DataTable.isDataTable('#dataTable')) {
        $('#dataTable').DataTable({
            responsive: true,
            autoWidth: false,
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search data...",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "Showing 0 to 0 of 0 entries",
                infoFiltered: "(filtered from _MAX_ total entries)",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                },
                emptyTable: "No data available in table",
                zeroRecords: "No matching records found"
            }
        });
    }
});
</script>
