
<div class="col-md-12" style="margin-top:110px;">
    <div style="color:#fff;margin-top:-30px;">
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>dashboard/" class="fa fa-home"></a>
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>dashboard/">Dashboard</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>transaction/">Transaction</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href="">New Syarat & ketentuan</a> 
    </div>
    <!-- <h3 class="text-center" style="color:#fff">TRANSACTION</h3> -->
    <h3 class="text-center" style="color:#fff">Edit Syarat & ketentuan</h3>
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
                                <h6 class="m-0 font-weight-bold text-primary">Edit Syarat & ketentuan</h6>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse show" id="collapseCardExample" style="">
                                <div class="card-body">
                                    <form action="<?=base_url('master/update-memo')?>" method="post" id="myForm">
                                        <input type="hidden" name="id" value="<?= $memo->tm_id ?>">
                                        <div class="form-group">
                                            <label>Isi Syarat & ketentuan</label>
                                            <textarea class="form-control summernote" name="dt[tm_value]"><?= $memo->tm_value ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Priority</label>
                                            <input type="number" id="tm_priority" required class="form-control" name="dt[tm_priority]" value="<?= $memo->tm_priority ?>">
                                        </div>
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
<!-- <script type="text/javascript">
    $("#materialType").select2();
    $(".select2").select2();
</script> -->
<script>

    jQuery(function ($) {
        renderTextArea();
        
    });
</script>