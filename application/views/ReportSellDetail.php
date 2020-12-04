<?php 
function nominal($angka){
    $jd = number_format($angka, 0, ',', '.');
    return $jd;
}
?>
<div class="col-md-12" style="margin-top:110px;">
<div style="color:#fff;margin-top:-30px;">
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>dashboard/" class="fa fa-home"></a>
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>dashboard/">Dashboard</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>report/">Report</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>report/sell/">Sell</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href=""><?=$title?></a> 
    </div>
    <h3 class="text-center" style="color:#fff">REPORT</h3>
    <h3 class="text-center" style="color:#fff">Transaction Sell <?=$title?></h3>
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
                                <h6 class="m-0 font-weight-bold text-primary">Transaction Detail <?=$title?></h6>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse show" id="collapseCardExample" style="">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table  class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                <th>
            No
            </th>
            <th>
            Material
            </th>
            <th>
            Type 
            </th>
            <th>
            Carat 
            </th >
            <th>
            Weight
            </th>
            <th>
            Price/Gr 
            </th >
            <th>
            Total Price
            </th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                            <th>
            No
            </th>
            <th>
            Material
            </th>
            <th>
            Type 
            </th>
            <th>
            Carat 
            </th >
            <th>
            Weight
            </th>
            <th>
            Price/Gr 
            </th >
            <th>
            Total Price
            </th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                            <?php $no=0; foreach($detail as $d){ $no++; ?>
                                                <tr>
                                                <td>
                            <?=$no?>
                        </td>
                         <td>
                            <?=$d->ti_material?>
                        </td>
                         <td>
                        <?=$d->ti_material_type?>
                        </td>
                         <td>
                        <?=$d->ti_carat?>
                        </td>
                         <td>
                        <?=$d->ti_weight?>
                        </td>
                         <td>
                        <?php if($d->ti_price!='-'){ echo nominal($d->ti_price);}else{echo $d->ti_price;}?>
                        </td>
                         <td>
                        <?=nominal($d->ti_price_total)?>
                        </td>
                                                
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>


                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                <a href="<?=base_url()?>report/sell/" class="btn btn-primary btn-icon-split btn-lg">
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
