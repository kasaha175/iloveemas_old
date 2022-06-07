<?php 
function nominal($angka){
    $jd = number_format($angka, 2, ',', '.');
    return $jd;
}
?>
<div class="col-md-12" style="margin-top:110px;">
    <div style="color:#fff;margin-top:-30px;">
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>dashboard/" class="fa fa-home"></a>
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>dashboard/">Dashboard</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>master/">Master</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href="">Master  Cabang</a> 
    </div>
    <h3 class="text-center" style="color:#fff">MASTER</h3>
    <h3 class="text-center" style="color:#fff">Master Cabang</h3>
    <br>
    <div class="col-md-12" style="padding:0px 150px;">
        <div class="row">
            <div class="col-md-12" style="padding:10px 10px">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Accordion -->
                            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                                aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-primary"> Cabang Data </h6>
                            </a>
                            <?php if($this->session->userdata('status')=='success'){ ?>
                            <div class="col-md-12 mt-3">
                            <div class="alert alert-success alert-dismissible m-0">
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
                            <!-- Card Content - Collapse -->
                            <?php 
                            // $this->db->select('*, (SELECT m_name from tb_material where m_id = material_id) as nama_material');
                            $this->db->where('status', 'ENABLE');
                            $cabang = $this->db->get('tb_cabang')->result();
                            ?>
                            <!-- <pre>
                                <?php print_r($cabang) ?>
                            </pre> -->
                            <div class="collapse show" id="collapseCardExample" style="">
                                <div class="card-body">
                                <a href="<?= base_url('master/addcabang') ?>" class="text-info float-right mb-2">
                                    <span class="text"><span class="fas fa-user-plus"></span> Add Cabang</span>
                                </a>
                                    <div class="table-responsive">
                                        <table style="overflow:scroll; width: 100%;"  class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th style="width:5px;">No</th>
                                                    <th style="width:100px;">Action</th>
                                                    <!-- <th style="min-width:100px;">Id User</th> -->
                                                    <th style="min-width:100px;">Cabang</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($cabang as $key => $value): ?>
                                                    <tr>
                                                        <td><?=$key+1?></td>
                                                        <td>
                                                            <a href="<?=base_url()?>master/detailCabang/<?=$value->id?>/" class="btn btn-primary btn-circle btn-sm mr-2"><i class="fas fa-info"></i>
                                                            <a href="<?=base_url()?>master/deleteCabang/<?=$value->id?>/" onclick="return confirm('Apakan Anda yakin?');" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i>
                                                        </td>
                                                        <td>
                                                            <?= $value->nama_cabang ?>
                                                        </td>
                                                        
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                <a href="<?=base_url()?>report/" class="btn btn-primary btn-icon-split btn-lg">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Back</span>
                </a>
            </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    // Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable();
});
</script>