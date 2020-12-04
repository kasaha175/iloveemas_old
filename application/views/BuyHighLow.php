<div class="col-md-12" style="margin-top:110px;">
<div style="color:#fff;margin-top:-30px;">
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>dashboard/" class="fa fa-home"></a>
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>dashboard/">Dashboard</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>transaction/">Transaction</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>transaction/buy/">Buy</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href=""><?=$kode = ucwords($this->uri->segment(3))?></a> 
    </div>
        <h3 class="text-center" style="color:#fff">BUY</h3>
        <h3 class="text-center" style="color:#fff">Choose Material</h3>
    <br>
    <div class="col-md-12" style="padding:0px 150px;">
    <div class="row">
    
            
                <div class="col-md-4">
                    <a href="<?=base_url()?>transaction/buy/<?=$this->db->query("SELECT m_id from tb_material WHERE m_name='$kode'")->row("m_id")?>/?t=high" style="text-decoration: none;" class="btn btn-lg btn-custom menu-box mb-3">
					<span class="text">HIGH MATERIAL</span>
				</a>
                </div>
                <div class="col-md-4">
                <a href="<?=base_url()?>transaction/buy/<?=$this->db->query("SELECT m_id from tb_material WHERE m_name='$kode'")->row("m_id")?>/?t=low" style="text-decoration: none;" class="btn btn-lg btn-custom menu-box mb-3">
					<span class="text">LOW MATERIAL</span>
				</a>

            </div>
            
          
            
                        <div class="col-md-12 mt-3">
                <a href="<?=base_url()?>transaction/buy/" class="btn btn-primary btn-icon-split btn-lg">
                    <span class="icon text-white-50">
                    <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Back</span>
                </a>
            </div>
        </div>


    </div>

	</div>