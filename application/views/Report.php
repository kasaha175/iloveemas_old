<div class="col-md-12" style="margin-top:110px;">
<div style="color:#fff;margin-top:-30px;">
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>dashboard/" class="fa fa-home"></a>
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>dashboard/">Dashboard</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>report/">Report</a> 
    </div>
        <h3 class="text-center" style="color:#fff">REPORT</h3>
    
    <br>
    <div class="col-md-12" style="padding:0px 350px;">
	
        <div class="row">
            <div class="col-md-6" style="padding:10px 10px">
                <a href="<?=base_url()?>report/buy/?dateStart=<?= date('Y-m-01'); ?>&dateEnd=<?= date('Y-m-t'); ?>" class="btn btn-lg btn-custom menu-box">
                    <span class="text">BUY</span>
                </a>
            </div>
            <div class="col-md-6" style="padding:10px 10px">
                <a href="<?=base_url()?>report/sell/?dateStart=<?= date('Y-m-01'); ?>&dateEnd=<?= date('Y-m-t'); ?>" class="btn btn-lg btn-custom menu-box">
                    <span class="text">SELL</span>
                </a>
            </div>
            <div class="col-md-6" style="padding:10px 10px">
                <a href="<?=base_url()?>report/buy-graph/" class="btn btn-lg btn-custom menu-box">
                    <span class="text">BUY GRAPH</span>
                </a>
            </div>
            <div class="col-md-6" style="padding:10px 10px">
                <a href="<?=base_url()?>report/sell-graph/" class="btn btn-lg btn-custom menu-box">
                    <span class="text">SELL GRAPH</span>
                </a>
            </div>
            <div class="col-md-12 mt-3">
                <a href="<?=base_url()?>dashboard/" class="btn btn-primary btn-icon-split btn-lg">
                    <span class="icon text-white-50">
                    <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Back</span>
                </a>
            </div>
        </div>
    </div>

	</div>