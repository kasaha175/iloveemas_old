<div class="col-md-12" style="margin-top:110px;">
<div style="color:#fff;margin-top:-30px;">
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>dashboard/" class="fa fa-home"></a>
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>dashboard/">Dashboard</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>archive/">Archive</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>archive/buy/">Buy</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href=""><?=ucwords(str_replace('-',' ',$this->input->get("key")))?></a> 
    </div>
        <h3 class="text-center" style="color:#fff">ARCHIVE BUY
        <?php 
        if($this->input->get("key")=="rti-au"){
            echo "RTI AU";
        }else if($this->input->get("key")=="rti-pt"){
            echo "RTI PT";
        }else if($this->input->get("key")=="rti-ag"){
            echo "RTI AG";
        }else if($this->input->get("key")=="rti-lm"){
            echo "RTI LM";
        }else if($this->input->get("key")=="rti-ru"){
            echo "RTI RU";
        }
        ?>
        </h3>
    
    <br>
    <div class="col-md-12" style="padding:0px 350px;">
        <div class="row">
            <div class="col-md-12" style="padding:10px 10px">
                <form action="<?=base_url()?>archive/buy/save/" id="myForm">
                    <input type="hidden" name="key" required class="form-control" value="<?=$this->input->get("key")?>">
                    <div class="form-group text-center">
                        <label style="color:#fff;"><?php 
        if($this->input->get("key")=="rti-au"){
            echo "RTI AU";
        }else if($this->input->get("key")=="rti-pt"){
            echo "RTI PT";
        }else if($this->input->get("key")=="rti-ag"){
            echo "RTI AG";
        }else if($this->input->get("key")=="rti-lm"){
            echo "RTI LM";
        }
        ?></label>
                        <input type="number" step="any" name="value" required class="form-control input-box" value="<?=$value?>">
                      
                    </div>
                </form>
            </div>
            <div class="col-md-12 mt-3 text-center">
                <a href="<?=base_url()?>archive/buy/" class="btn btn-primary btn-icon-split btn-lg mr-3">
                    <span class="icon text-white-50">
                    <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Back</span>
                </a>
                <a href="#" onclick="document.getElementById('myForm').submit();" class="btn btn-success btn-icon-split btn-lg mr-3">
                    <span class="icon text-white-50">
                    <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Save</span>
                </a>
                <?php if($this->input->get("key")!="rti-ta"){ ?>
                    <a href="<?=base_url()?>archive/buy/?key=<?=$this->input->get("key")?>&type=change" class="btn btn-warning btn-icon-split btn-lg">
                        <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                        </span>
                        <span class="text">Ganti Potongan</span>
                    </a>
                <?php } ?>
                
            </div>
        </div>
    </div>

    </div>
    <script>
    jQuery(function ($) {
        // Num Pad Input
	// ********************
	

    });
</script>