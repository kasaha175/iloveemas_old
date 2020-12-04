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
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>report/">Report</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href="">Sell Graph</a> 
    </div>
    <h3 class="text-center" style="color:#fff">REPORT</h3>
    <h3 class="text-center" style="color:#fff">Transaction Sell Graph</h3>
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
                                <h6 class="m-0 font-weight-bold text-primary">Filter Data</h6>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse show" id="collapseCardExample" style="">
                                <div class="card-body">
                                <form action="<?=base_url()?>report/sell-graph/">
                                <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Material</label>
                                        <select class="form-control select2" name="material">
                                            <option value="">ALL</option>
                                        <?php foreach($materialData as $y){ ?>
                                            <?php if($this->input->get('material')!=$y->m_name){ ?>
                                            <option><?=$y->m_name?></option>
                                            <?php }else{ ?>
                                              <option selected><?=$y->m_name?></option>
                                            <?php } ?>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Year</label>
                                        <select class="form-control select2" name="year">
                                            <option value="">ALL</option>
                                        <?php foreach($yearData as $y){ ?>
                                            <?php if($this->input->get('year')!=$y->y_name){ ?>
                                            <option><?=$y->y_name?></option>
                                            <?php }else{ ?>
                                              <option selected><?=$y->y_name?></option>
                                            <?php } ?>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Filter?</label>
                                        <input required type="submit" class="btn btn-block btn-primary" value="Filter">
                                    </div>
                                </div>
                                </div>
                                </form>    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Accordion -->
                            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                                aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-primary">Transaction Data</h6>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse show" id="collapseCardExample" style="">
                                <div class="card-body">
                                <div class="data" style="height: 300px; width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Accordion -->
                            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                                aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-primary">Customer Data</h6>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse show" id="collapseCardExample" style="">
                                <div class="card-body">
                                <div class="customer" style="height: 300px; width: 100%;"></div>
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
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<script type="text/javascript">
$(function() {
    $(".data").CanvasJSChart({
        // title: {
        //  text: "Customer Transaction"
        // },
        // axisY: {
        //  title: "Total",
        //  includeZero: false
        // },
        axisX: {
            interval: 1
        },
    animationEnabled: true,
      exportEnabled: true, 
      indexLabelPlacement: "outside",  
        indexLabelOrientation: "horizontal",
        data: [
        {
            type: "line", //try changing to column, area
            indexLabel: "{label}: {y} ",
            dataPoints: [
                <?php foreach($data as $d){ ?>
          { label: "<?=($d->m_name)?>",  y: <?=intval($d->priceTotal)?> },
        <?php } ?>
            ]
        }
        ]
    });
});
</script>
<script type="text/javascript">
$(function() {
    $(".customer").CanvasJSChart({
        // title: {
        //  text: "Customer Transaction"
        // },
        // axisY: {
        //  title: "Total",
        //  includeZero: false
        // },
        axisX: {
            interval: 1
        },
    animationEnabled: true,
      exportEnabled: true, 
      indexLabelPlacement: "outside",  
        indexLabelOrientation: "horizontal",
        data: [
        {
            type: "line", //try changing to column, area
            indexLabel: "{label}: {y} ",
            dataPoints: [
                <?php foreach($dataCustomer as $d){ ?>
          { label: "<?=($d['month'])?>",  y: <?=intval($d['countTransaction'])?> },
        <?php } ?>
            ]
        }
        ]
    });
});
</script>
