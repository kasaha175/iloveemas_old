<style>
                    .bordering{
                        width:50%;
                        border: 1px solid #fff;
                        text-align:left;
                        padding-left:5px;
                        color:#fff;
                    }
                    .input-box{
                        height:35px;
                        padding:10px;
                        background: #EEE;
                        margin: 0px;
                        padding: 0px;
                        border: none;
                        margin-bottom: 0px;
                        width:100%;
                    }
                </style>
<div class="col-md-12" style="margin-top:110px;">
<div style="color:#fff;margin-top:-30px;">
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>dashboard/" class="fa fa-home"></a>
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>dashboard/">Dashboard</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>archive/">Archive</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>archive/sell/">Sell</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href=""><?=ucwords(str_replace('-',' ',$this->input->get("key")))?></a> 
    </div>
        <h3 class="text-center" style="color:#fff">ARCHIVE / SELL / 
        <?php 
        if($this->input->get("key")=="lm"){
            echo "LM";
        }else if($this->input->get("key")=="material-au"){
            echo "MATERIAL AU";
        }else if($this->input->get("key")=="material-ag"){
            echo "MATERIAL AG";
        }
        else if($this->input->get("key")=="material-ubs"){
            echo "UBS";
        }
        ?>
        </h3>
    
    <br>
    <div class="col-md-12" style="padding:0px 350px;">
        <div class="row">
            <div class="col-md-12" style="padding:10px 10px">
                <form action="<?=base_url()?>archive/sell/save/" id="myForm">
                    <input type="hidden" name="key" required class="form-control" value="<?=$this->input->get("key")?>">
                    <div class="form-group text-center">
                        <label style="color:#fff;">
                        <?php 
        if($this->input->get("key")=="lm"){
            echo "LM";
        }else if($this->input->get("key")=="material-au"){
            echo "MATERIAL AU";
        }else if($this->input->get("key")=="material-ag"){
            echo "MATERIAL AG";
        }else if($this->input->get("key")=="material-ubs"){
            echo "UBS";
        }
        
        ?></label>



<?php 
        if($this->input->get("key")=="lm"){ ?>
         
         <table style="width:100%;border: 1px solid black;" cellspacing="3" cellpadding="3">
                            <thead>
                                <tr>
                                    <th class="bordering">Name</th>
                                    <th class="bordering">Value</th>
                                </tr>
                            </thead>
                            <tbody>

                          
                                <tr>
                                    <td class="bordering">0.5 Gr</td>
                                    <td class="bordering"><input class="input-box" type="number" step="any" name="f_nol5" required  value="<?=$f_nol5?>"></td>
                                </tr>
                                <tr>
                                    <td class="bordering">1 Gr</td>
                                    <td class="bordering"><input class="input-box" type="number" step="any" name="f_1" required  value="<?=$f_1?>"></td>
                                </tr>
                                <tr>
                                    <td class="bordering">2 Gr</td>
                                    <td class="bordering"><input class="input-box" type="number" step="any" name="f_2" required  value="<?=$f_2?>"></td>
                                </tr>
                                <tr>
                                    <td class="bordering">2.5 Gr</td>
                                    <td class="bordering"><input class="input-box" type="number" step="any" name="f_2_coma_5" required  value="<?=$f_2_coma_5?>"></td>
                                </tr>
                                <tr>
                                    <td class="bordering">3 Gr</td>
                                    <td class="bordering"><input class="input-box" type="number" step="any" name="f_3" required  value="<?=$f_3?>"></td>
                                </tr>
                                <tr>
                                    <td class="bordering">5 Gr</td>
                                    <td class="bordering"><input class="input-box" type="number" step="any" name="f_5" required  value="<?=$f_5?>"></td>
                                </tr>
                                <tr>
                                    <td class="bordering">10 Gr</td>
                                    <td class="bordering"><input class="input-box" type="number" step="any" name="f_10" required  value="<?=$f_10?>"></td>
                                </tr>
                                <tr>
                                    <td class="bordering">25 Gr</td>
                                    <td class="bordering"><input class="input-box" type="number" step="any" name="f_25" required  value="<?=$f_25?>"></td>
                                </tr>
                                <tr>
                                    <td class="bordering">50 Gr</td>
                                    <td class="bordering"><input class="input-box" type="number" step="any" name="f_50" required  value="<?=$f_50?>"></td>
                                </tr>
                                <tr>
                                    <td class="bordering">100 Gr</td>
                                    <td class="bordering"><input class="input-box" type="number" step="any" name="f_100" required  value="<?=$f_100?>"></td>
                                </tr>
                                <tr>
                                    <td class="bordering">250 Gr</td>
                                    <td class="bordering"><input class="input-box" type="number" step="any" name="f_250" required  value="<?=$f_250?>"></td>
                                </tr>
                                <tr>
                                    <td class="bordering">500 Gr</td>
                                    <td class="bordering"><input class="input-box" type="number" step="any" name="f_500" required  value="<?=$f_500?>"></td>
                                </tr>
                                <tr>
                                    <td class="bordering">1000 Gr</td>
                                    <td class="bordering"><input class="input-box" type="number" step="any" name="f_1000" required  value="<?=$f_1000?>"></td>
                                </tr>
                           
                
                                
                            </tbody>
                        </table>
        <?php }else if($this->input->get("key")=="material-au"){ ?>
            <input type="number" step="any" name="value" required class="form-control" value="<?=$value?>">
        <?php }else if($this->input->get("key")=="material-ag"){ ?>
             <input type="number" step="any" name="value" required class="form-control" value="<?=$value?>">
        <?php }else if($this->input->get("key")=="material-ubs"){ ?>
             <input type="number" step="any" name="value" required class="form-control" value="<?=$value?>">
        <?php } ?>
                      
                        
                    </div>
                </form>
            </div>
            <div class="col-md-12 mt-3 text-center">
                <a href="<?=base_url()?>archive/sell/" class="btn btn-primary btn-icon-split btn-lg mr-3">
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
                <a href="<?=base_url()?>archive/sell/?key=<?=$this->input->get("key")?>&type=change" class="btn btn-warning btn-icon-split btn-lg">
                    <span class="icon text-white-50">
                    <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Ganti Potongan</span>
                </a>
            </div>
        </div>
    </div>

    </div>
    
    
<script>
    jQuery(function ($) {
        // Num Pad Input
	// ********************
	$('.input-box').keyboard({
		layout: 'num',
		restrictInput : true, // Prevent keys not in the displayed keyboard from being typed in
		preventPaste : true,  // prevent ctrl-v and right click
		autoAccept : true
	});
    prettyPrint();

    });
</script>