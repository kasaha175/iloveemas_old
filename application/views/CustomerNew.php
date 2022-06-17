<div class="col-md-12" style="margin-top:110px;">
    <div style="color:#fff;margin-top:-30px;">
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>dashboard/" class="fa fa-home"></a>
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>dashboard/">Dashboard</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>transaction/">Transaction</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href="">New Customer</a> 
    </div>
    <h3 class="text-center" style="color:#fff">TRANSACTION</h3>
    <h3 class="text-center" style="color:#fff">New Customer</h3>
    <br>
    <div class="col-md-12" style="padding:0px 150px;">
        <div class="row">
            <div class="col-md-6 offset-md-3" style="padding:10px 10px">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Accordion -->
                            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                                aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-primary">NEW CUSTOMER</h6>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse show" id="collapseCardExample" style="">
                                <div class="card-body">
                                    <form action="<?=base_url()?>transaction/new-customer-process/" method="post" id="myForm">
                                        <div class="form-group">
                                            <label>NAME</label>
                                            <input type="hidden" class="form-control" name="key" value="<?=$this->input->get('key')?>">
                                            <input id="u_name" type="text" required class="form-control" name="name">
                                        </div>
                                        <div class="form-group">
                                            <label>ID NUMBER (KTP)</label>
                                            <input type="text" id="u_id_number" required class="form-control" name="idNumber">
                                        </div>
                                        <div class="form-group">
                                            <label>ADDRESS</label>
                                            <textarea id="u_address" required class="form-control" name="address" value=""></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>RESIDENT ADDRESS</label>
                                            <textarea id="u_resident_address" required class="form-control" name="resident_address" value=""></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>PHONE</label>
                                            <input id="u_phone" type="text" required class="form-control" name="phone">
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
<script type="text/javascript">
    $("#materialType").select2();
    $(".select2").select2();
</script>

<script>
    jQuery(function ($) {

        

    });
</script>