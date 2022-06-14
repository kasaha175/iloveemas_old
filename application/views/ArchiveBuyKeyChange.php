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
<?php 
    foreach($data as $d){};
    foreach($data2 as $dd){};  
?>
<form action="<?=base_url()?>archive/buy/save/" id="myForm">
<div class="col-md-12" style="margin-top:110px;">
        <h3 class="text-center" style="color:#fff">ARCHIVE BUY / 
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
        ?> / GANTI POTONGAN
        </h3>
    <br>
    <div class="row">

    
        <div class="<?= ($this->input->get("key")=="rti-au")?'col-md-6':'col-md-12' ?>" style="">
            <div class="row">
                <div class="col-md-12" <?= ($this->input->get("key")=="rti-au")?'':'style="padding:0px 350px;"' ?>>
                    
                    
                        <input type="hidden" name="key" required class="form-control" value="<?=$this->input->get("key")?>">
                        <input type="hidden" name="type" required class="form-control" value="change">
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
                                }else if($this->input->get("key")=="rti-ru"){
                                    echo "RTI RU";
                                }
                            ?></label>
                            <table style="width:100%;border: 1px solid black;" cellspacing="3" cellpadding="3">
                                <thead>
                                <?php if($this->input->get("key")=="rti-pt" || $this->input->get("key")=="rti-ag" || $this->input->get("key")=="rti-ru"){ ?>
                                    <tr>
                                        <th style="text-align:center;" colspan="2" class="bordering">High Material</th>
                                        <th style="text-align:center;" colspan="2" class="bordering">Low Material</th>
                                    </tr>
                                    <tr>
                                        <th class="bordering">Name</th>
                                        <th class="bordering">Value</th>
                                        <th class="bordering">Name</th>
                                        <th class="bordering">Value</th>
                                    </tr>
                                <?php }else{ ?>
                                    <tr>
                                        <th style="text-align:center;" colspan="2" class="bordering">Material</th>
                                    </tr>
                                    <tr>
                                        <th class="bordering">Name</th>
                                        <th class="bordering">Value</th>
                                    </tr>
                                <?php } ?>
                                </thead>
                                <tbody>
                                <?php if($this->input->get("key")=="rti-au"){ ?>
                                    <tr>
                                        <td class="bordering">k24 (99.9)</td>
                                        <td class="bordering"><input class="input-box" type="number" step="any" name="h" required  value="<?=$d->h?>"></td>
                                    </tr>
                                    <tr>
                                        <td class="bordering">k24 (99)</td>
                                        <td class="bordering"><input class="input-box" type="number" step="any" name="a" required  value="<?=$d->a?>"></td>
                                    </tr>
                                    <tr>
                                        <td class="bordering">k2 k23</td>
                                        <td class="bordering"><input class="input-box" type="number" step="any" name="b" required  value="<?=$d->b?>"></td>
                                    </tr>
                                    <tr>
                                        <td class="bordering">material au</td>
                                        <td class="bordering"><input class="input-box" type="number" step="any" name="c" required  value="<?=$d->c?>"></td>
                                    </tr>
                                    <tr style="display: none">
                                        <td class="bordering">lm baru</td>
                                        <td class="bordering"><input class="input-box" type="number" step="any" name="d" required  value="<?=$d->d?>"></td>
                                    </tr>
                                    <tr>
                                        <td class="bordering">lm retro</td>
                                        <td class="bordering"><input class="input-box" type="number" step="any" name="e" required  value="<?=$d->e?>"></td>
                                    </tr>
                                    <tr>
                                        <td class="bordering">cust. profesional</td>
                                        <td class="bordering"><input class="input-box" type="number" step="any" name="f" required  value="<?=$d->f?>"></td>
                                    </tr>
                                    <tr>
                                        <td class="bordering">Pembelian UBS</td>
                                        <td class="bordering"><input class="input-box" type="number" step="any" name="g" required  value="<?=$d->g?>"></td>
                                    </tr>
                                    <tr>
                                        <td class="bordering">Gold Bar 99</td>
                                        <td class="bordering"><input class="input-box" type="number" step="any" name="gb_99" required  value="<?=$d->gb_99?>"></td>
                                    </tr>
                                    <tr>
                                        <td class="bordering">Gold Bar 99,9</td>
                                        <td class="bordering"><input class="input-box" type="number" step="any" name="gb_99_9" required  value="<?=$d->gb_99_9?>"></td>
                                    </tr>
                                <?php }else if($this->input->get("key")=="rti-pt"){ ?>
                                    <tr>
                                    <td class="bordering">Pt</td>
                                    <td class="bordering"><input class="input-box" type="number" step="any" name="a" required  value="<?=$d->a?>"></td>
                                    <td class="bordering">Pt</td>
                                    <td class="bordering"><input class="input-box" type="number" step="any" name="aa" required  value="<?=$dd->a?>"></td>
                                    </tr>
                                    <tr>
                                    <td class="bordering">Pd</td>
                                    <td class="bordering"><input class="input-box" type="number" step="any" name="b" required  value="<?=$d->b?>"></td>
                                    <td class="bordering">Pd</td>
                                    <td class="bordering"><input class="input-box" type="number" step="any" name="bb" required  value="<?=$dd->b?>"></td>
                                    </tr>
                                    <tr>
                                    <td class="bordering">Rh</td>
                                    <td class="bordering"><input class="input-box" type="number" step="any" name="c" required  value="<?=$d->c?>"></td>
                                    <td class="bordering">Rh</td>
                                    <td class="bordering"><input class="input-box" type="number" step="any" name="cc" required  value="<?=$dd->c?>"></td>
                                    </tr>
                                    <tr>
                                    <td class="bordering">Ir</td>
                                    <td class="bordering"><input class="input-box" type="number" step="any" name="d" required  value="<?=$d->d?>"></td>
                                    <td class="bordering">Ir</td>
                                    <td class="bordering"><input class="input-box" type="number" step="any" name="dd" required  value="<?=$dd->d?>"></td>
                                    </tr>
                                <?php }else if($this->input->get("key")=="rti-ag"){ ?>
                                    <tr>
                                        <td class="bordering">Potongan Ag</td>
                                        <td class="bordering"><input class="input-box" type="number" step="any" name="a" required  value="<?=$d->a?>"></td>
                                        <td class="bordering">Potongan Ag</td>
                                        <td class="bordering"><input class="input-box" type="number" step="any" name="aa" required  value="<?=$dd->a?>"></td>
                                    </tr>
                                <?php }else if($this->input->get("key")=="rti-lm"){ ?>
                                <?php }else if($this->input->get("key")=="rti-ru"){ ?>
                                    <tr>
                                        <td class="bordering">Potongan Ru</td>
                                        <td class="bordering"><input class="input-box" type="number" step="any" name="a" required  value="<?=$d->a?>"></td>
                                        <td class="bordering">Potongan Ru</td>
                                        <td class="bordering"><input class="input-box" type="number" step="any" name="aa" required  value="<?=$dd->a?>"></td>
                                    </tr>
                                <?php  }?>
                                </tbody>
                            </table>
                            <!-- <input type="number" step="any" name="value" required class="form-control" value="<?=$value?>"> -->
                        </div>
                    
                </div>
                
            </div>
        </div>
        <?php if($this->input->get("key")=="rti-au"){ ?>
            <div class="col-md-6">
                <div class="text-center">

                    <label style="color:#fff; text-align: center; ">Potongan LM Certi</label>
                </div>
                <table style="width:100%;border: 1px solid black;" cellspacing="3" cellpadding="3">
                    <thead>
                    
                        <tr>
                            <th style="text-align:center;" colspan="2" class="bordering">Material</th>
                        </tr>
                        <tr>
                            <th class="bordering">Name</th>
                            <th class="bordering">Value</th>
                        </tr>
                    
                    </thead>
                    <tbody>
                        <?php 
                        $potongan_lm = json_decode($d->potongan_lm, true);
                        
                        $tahun_mulai = 2018;
                        // $d=mktime(11, 14, 54, 8, 12, 2023);
                        while ($tahun_mulai <= date('Y')+1) { ?>
                            <tr>
                                <td class="bordering">LM Certi <?= $tahun_mulai; ?></td>
                                <td class="bordering"><input class="input-box" type="number" step="any" name="potongan_lm[<?= $tahun_mulai; ?>]" required  value="<?= $potongan_lm[$tahun_mulai] ?>"></td>
                            </tr>
                            
                        <?php $tahun_mulai++; } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
    <div class="col-md-12 mt-3 text-center">
                <a href="<?=base_url()?>archive/buy/?key=<?=$this->input->get('key')?>" class="btn btn-primary btn-icon-split btn-lg mr-3">
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
            </div>
</div>
</form>
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