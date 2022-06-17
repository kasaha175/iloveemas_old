<div class="col-md-12" style="margin-top:110px;">
    <div style="color:#fff;margin-top:-30px;">
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>dashboard/" class="fa fa-home"></a>
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>dashboard/">Dashboard</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>transaction/">Transaction</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href="">Potongan</a> 
    </div>
    <!-- <h3 class="text-center" style="color:#fff">TRANSACTION</h3> -->
    <h3 class="text-center" style="color:#fff">Potongan</h3>
    <br>
    <div class="col-md-12" style="padding:0px 150px;">
        <div class="row">
            <div class="col-md-8 offset-md-2" style="padding:10px 10px">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Accordion -->
                            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                                aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-primary">Potongan</h6>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse show" id="collapseCardExample" style="">
                                <div class="card-body">
                                    <form action="<?=base_url('master/save-update-potongan')?>" method="post" id="myForm">
                                        <input type="hidden" class="form-control" name="id" value="<?= $potongan->id ?>">
                                        <div class="form-group">
                                            <label>Nama Potongan</label>
                                            <input type="text" class="form-control" name="dt[nama]" value="<?= $potongan->nama ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Material</label>
                                            <select class="form-control select2" name="dt[material_id]">
                                                <option value="">-- Pilih --</option>
                                                <?php 
                                                $material = $this->db->get('tb_material')->result();
                                                foreach ($material as $key => $item): ?>
                                                    <option value="<?= $item->m_id ?>" <?= ($potongan->material_id == $item->m_id)?"selected":"" ?>><?= $item->m_name ?></option>
                                                <?php endforeach; ?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input type="text" class="form-control" name="dt[harga_buy]" value="<?= $potongan->harga ?>">
                                            <small><i class="fa fa-info"></i> Tambahkan "-" untuk pengurangan harga transaksi</small>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label>Harga Sell</label>
                                            <input type="text" class="form-control" name="dt[harga_sell]" value="<?= $potongan->harga_sell ?>">
                                            <small><i class="fa fa-info"></i> Tambahkan "-" untuk pengurangan harga transaksi</small>
                                        </div> -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                    <a href="#" onclick="document.getElementById('myForm').submit();" 
                                                        class="btn btn-primary btn-icon-split btn-lg btn-block">
                                                        <span class="text">Save</span>
                                                    </a>
                                                    </div>
                                                    <div class="col-md-4">
                                                    <a href="<?=base_url()?>master/customer/"
                                                        class="btn btn-primary btn-icon-split btn-lg btn-block">
                                                       <span class="text">Back</span>
                                                    </a>
                                                    </div>
                                               </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#materialType").select2();
    $(".select2").select2();
</script>
<script>
    $('.select2').select2();
    jQuery(function ($) {
        renderTextArea();
        
    });
</script>