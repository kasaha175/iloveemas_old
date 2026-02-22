<?php 
function nominal($angka){
    $jd = number_format($angka, 2, ',', '.');
    return $jd;
}
?>
<div class="col-md-12 master-detail-container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb glass-breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url()?>dashboard/"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?=base_url()?>master/">Master</a></li>
            <li class="breadcrumb-item active">Cabin</li>
        </ol>
    </nav>
    
    <!-- Page Title -->
    <h3 class="page-title">MASTER</h3>
    <h3 class="page-subtitle">Master Cabin</h3>
    
    <!-- Alert Messages -->
    <?php if($this->session->userdata('status')=='success'){ ?>
    <div class="col-md-12">
        <div class="alert glass-alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?=$this->session->userdata('message')?>
        </div>
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
        <div class="card glass-card">
            <div class="card-header" data-toggle="collapse" data-target="#cabangData">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-store"></i> Cabin Data</h6>
            </div>
            <div class="collapse show" id="cabangData">
                <div class="card-body">
                    <!-- Add Cabin Button -->
                    <a href="<?= base_url('master/addcabang') ?>" class="btn btn-info float-right mb-3">
                        <i class="fas fa-plus"></i> Add Cabin
                    </a>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width:5px;">No</th>
                                    <th style="width:100px;">Action</th>
                                    <th>Cabin</th>
                                    <th>Urutan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cabang as $key => $value): ?>
                                    <tr>
                                        <td><?=$key+1?></td>
                                        <td class="action-buttons">
                                            <a href="<?=base_url()?>master/detailCabang/<?=$value->id?>/" class="btn btn-info btn-circle btn-sm" title="Detail">
                                                <i class="fas fa-info"></i>
                                            </a>
                                            <a href="<?=base_url()?>master/deleteCabang/<?=$value->id?>/" onclick="return confirm('Apakah Anda yakin?');" class="btn btn-danger btn-circle btn-sm" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </a>
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
    
    <!-- Back Button -->
    <div class="col-md-12 mt-4 text-center">
        <a href="<?=base_url()?>master/" class="btn btn-primary btn-lg">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Master</span>
        </a>
    </div>
</div>
