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
            <!-- Page Title Group -->
            <div class="page-title-group">
                <h1 class="page-title-main">Cabang</h1>
                <div class="page-title-sub">
                    <span class="context-badge context-badge-master">
                        <i class="fas fa-database"></i> Master Data
                    </span>
                </div>
            </div>
            
            <!-- Primary Action - Add Cabang -->
            <div class="action-toolbar-right">
                <a href="<?= base_url('master/addcabang') ?>" class="btn-primary-enterprise">
                    <i class="fas fa-plus"></i> Add Cabang
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
                                <th style="width: 50px;">No</th>
                                <th style="width: 120px; text-align: center;">Action</th>
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
    
    <!-- Back Button - Secondary -->
    <div class="col-md-12 mt-4 text-center">
        <a href="<?=base_url()?>master/" class="btn-secondary-enterprise btn-lg-enterprise">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Master</span>
        </a>
    </div>
</div>

<style>
/* Override table styles for enterprise look */
#dataTable thead th {
    background: rgba(255, 255, 255, 0.08) !important;
    border-bottom: 2px solid var(--glass-border) !important;
    color: var(--turquoise-surf) !important;
    padding: 14px 16px !important;
    font-weight: 600 !important;
    text-transform: uppercase;
    font-size: 12px !important;
    position: sticky;
    top: 0;
    z-index: 10;
}

#dataTable tbody tr {
    border-bottom: 1px solid var(--glass-border) !important;
    transition: all 0.2s ease;
}

#dataTable tbody tr:hover {
    background: var(--glass-bg-hover) !important;
}

#dataTable tbody td {
    padding: 12px 16px !important;
    color: var(--text-primary) !important;
    border: none !important;
    vertical-align: middle;
    font-size: 14px;
}

.master-detail-container {
    padding: 90px 20px 40px;
    max-width: 1200px;
    margin: 0 auto;
}

.mt-4 {
    margin-top: 24px;
}
</style>
