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
            <li class="breadcrumb-item active">Syarat & Ketentuan</li>
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
                <h1 class="page-title-main">Syarat & Ketentuan</h1>
                <div class="page-title-sub">
                    <span class="context-badge context-badge-master">
                        <i class="fas fa-database"></i> Master Data
                    </span>
                </div>
            </div>
            
            <!-- Primary Action - Add Memo -->
            <div class="action-toolbar-right">
                <a href="<?= base_url('master/addMemo') ?>" class="btn btn-success">
                    <i class="fas fa-plus"></i> Add Syarat & Ketentuan
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
    $this->db->order_by('tm_id', 'DESC');
    $memo = $this->db->get('tb_memo')->result();
    ?>
    <div class="col-md-12">
        <div class="enterprise-card">
            <div class="enterprise-card-header">
                <h3 class="enterprise-card-title">
                    <i class="fas fa-file-alt"></i> Syarat & Ketentuan Data
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
                                <th>Syarat & Ketentuan</th>
                                <th>Priority</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($memo as $key => $value): ?>
                                <tr>
                                    <td><?=$key+1?></td>
                                    <td class="action-column">
                                        <div class="action-button-group">
                                            <!-- Edit Button - Pencil Icon with Tooltip -->
                                            <a href="<?=base_url()?>master/detailMemo/<?=$value->tm_id?>/" 
                                               class="btn-action btn-action-edit" 
                                               data-tooltip="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <!-- Delete Button - Trash Icon with Tooltip -->
                                            <a href="<?=base_url()?>master/deleteMemo/<?=$value->tm_id?>/" 
                                               class="btn-action btn-action-delete" 
                                               data-tooltip="Delete"
                                               onclick="return confirm('Apakah Anda yakin?');">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td><?= $value->tm_value ?></td>
                                    <td><?= $value->tm_priority ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
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
        order: [[3, 'desc']] // Order by priority (newest/highest first)
    });
});
</script>
