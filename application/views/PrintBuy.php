<?php 
    foreach($data as $a){};
    function nominal($angka){
        $jd = number_format($angka, 0, ',', '.');
        return $jd;
    }
    function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil.' rupiah';
	}
 
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="" xml:lang="">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="https://fonts.googleapis.com/css?family=Gothic+A1:700&display=swap" rel="stylesheet">
    <style>
      table {
        border-collapse: collapse;
      }
      body{
          font-family: 'Gothic A1', sans-serif;
      }
      input[type=checkbox] {
        transform: scale(1.5);
      }
    </style>
    <title><?=$title?></title>
  </head>
  <body vlink="blue" link="blue" style="background-color:#A0A0A0;">
    <div style="width:918px;min-height:1188px;background-color:#fff;">
        
      <div style="padding:5px;margin:0px;" id="printHide">
        <a id="doPrint" href="#!"
          ><img
            src="<?=base_url()?>assets/offline/print.png"
            alt=""
            style="width:30px;float:right;"
        /></a>
        <!-- <a href="<?=base_url()?>report/sell/"> -->
            <img src="<?=base_url()?>assets/offline/back.png" alt="" style="width:30px;float:right;cursor: pointer;" onclick="clickBack();"/>
        <!-- </a> -->
      </div>
      <div style="padding:45px;margin:0px;" id="printNow">
        <div style="width:100%">
          <div style="padding-right:5px; width:50%; display:inline-block;vertical-align:text-top;">
            <div style="border:1px #000 solid">
              <p style="margin:5px; font-size:25px; text-align:center;">
                PT Muara Logam Indonesia
              </p>
            </div>
            <div
              style="padding-left:5px; padding-top:1px; border-bottom:1px #000 solid;border-left:1px #000 solid;border-right:1px #000 solid;border-bottom:1px #000 solid"
            >
              <p style="">
                <input type="checkbox" />
                I Love Emas Jakarta : Ruko Sky Terrace Blok B, Jl. Tanah Lot,
                Daan Mogot Baru
              </p>
              <p style="">
                <input type="checkbox" />
                I Love Emas Bali : Jl. Gunung Soputan 36B, Denpasar Barat, Bali
              </p>
              <p style="">
                <input type="checkbox" />
                I Love Emas Surabaya: Cito Mall Surabaya, Lt UG Blok UB 5/10 
              </p>
              <p style="">
                <input type="checkbox" />
                I Love Emas Bekasi : Lt. GF 48-49 Revo Town Mall Bekasi Lt. GF 48-49, Pekayon Jaya, Kec. Bekasi Sel., Kota Bks, Jawa Barat
              </p>
            </div>
          </div>
          <div style="padding-left:68px; padding-right:5px; width:40%; display:inline-block;vertical-align:text-top;margin-top: 27px;">
            <div>
              <p style="margin:5px; font-size:18px; text-align:center;">
                <b>Purchase Payment</b>
              </p>
            </div>
            <div>
              <div style="padding-right:5px; width:45%; display:inline-block;">
                <div style="border:1px #000 solid">
                  <p style="margin:5px; text-align:center;">
                    Payment Date
                  </p>
                </div>
                <div
                  style="text-align:center; min-height:55px; padding-top:1px; border-bottom:1px #000 solid;border-left:1px #000 solid;border-right:1px #000 solid;border-bottom:1px #000 solid"
                ><?=date('Y-m-d', strtotime($a->t_date_created))?></div>
              </div>
              <div style="padding-right:5px; width:45%; display:inline-block;">
                <div style="border:1px #000 solid">
                  <p style="margin:5px; text-align:center;">
                    Invoice Number
                  </p>
                </div>
                <div
                  style="text-align:center; min-height:55px; padding-top:1px; border-bottom:1px #000 solid;border-left:1px #000 solid;border-right:1px #000 solid;border-bottom:1px #000 solid"
                ><?=$a->t_no_order?></div>
              </div>
            </div>
          </div>
        </div>

        <div style="width:100%;margin-top:15px;">
          <div style="padding-right:5px; width:50%; display:inline-block;vertical-align:text-top;">
            <div style="border:1px #000 solid">
              <p style="margin:5px; ">
                Vendor : 
              </p>
              <hr>
              <p style="margin:5px; ">
                Name : <?=ucwords(strtolower($a->nameCustomer))?>
              </p>
              <p style="margin:5px; ">
                Id Number : <?=strtoupper($a->c_id_number)?>
              </p>
              <p style="margin:5px; ">
                Address : <?=ucwords(strtolower($a->c_address))?>
              </p>
              <p style="margin:5px; ">
                Phone Number :  <?=$a->c_phone?>
              </p>
            </div>
          </div>
        </div>

        <div style="width:100%;margin-top:15px;">
            <table style="padding-right:5px; width:96%; display:inline-block;vertical-align:text-top;">
                <tr>
                    <td style="padding:10px 0px; min-width:30px; border: 1px solid black;">
                        No
                    </td>
                    <td style="padding-left:5px; min-width:125px; border: 1px solid black;">
                        Material
                    </td>
                    <td style="padding-left:5px; min-width:110px; border: 1px solid black;">
                        Type
                    </td>
                    <td style="padding-left:5px; min-width:100px; border: 1px solid black;">
                        Carat/Percentage
                    </td>
                    <td style="padding-left:5px; min-width:100px; border: 1px solid black;">
                        Weight (gr)
                    </td>
                    <td style="padding-left:5px; min-width:145px; border: 1px solid black;">
                        Price/gr (Rp)
                    </td>
                    <td style="padding-left:5px; min-width:145px; border: 1px solid black;">
                        Amount (Rp)
                    </td>
                </tr>
                <?php $no=0; foreach($detail as $d){ $no++; ?>
                <?php if($no>27){ break; }else{ ?>
                <tr>
                    <td style="padding-left:5px; min-width:30px; border: 1px solid black;">
                        <?=$no?>
                    </td>
                    <td style="padding-left:5px; min-width:125px; border: 1px solid black;">
                    <?php if($d->ti_material=='Cust. Profesion'){ echo 'Gold'; }else{ echo $d->ti_material;} ?>
                    </td>
                    <td style="padding-left:5px; min-width:110px; border: 1px solid black;">
                    <?=$d->ti_material_type?>
                    </td>
                    <td style="padding-left:5px; min-width:100px; border: 1px solid black;">
                    <?=$d->ti_carat?>
                    </td>
                    <td style="padding-left:5px; min-width:100px; border: 1px solid black;">
                    <?=$d->ti_weight?>
                    </td>
                    <td style="padding-left:5px; min-width:145px; border: 1px solid black;">
                    <?php if($d->ti_price!='-'){ echo nominal($d->ti_price);}else{echo $d->ti_price;}?>
                    </td>
                    <td style="padding-left:5px; min-width:145px; border: 1px solid black;text-align:right;">
                    <?=nominal($d->ti_price_total)?>
                    </td>
                </tr>
                <?php }} ?>
            </table>
        </div>
        
        <?php if(count($detail)>27){?>

        <div style="width:100%;margin-top:0px;">
            <table style="padding-right:5px; width:96%; display:inline-block;vertical-align:text-top;">   
                <?php $no=0; foreach($detail as $d){ $no++; ?>
                <?php if($no>=74){break;}else if($no<=27){ }else{ ?>
                <tr>
                    <td style="padding-left:5px; min-width:30px; border: 1px solid black;">
                        <?=$no?>
                    </td>
                    <td style="padding-left:5px; min-width:125px; border: 1px solid black;">
                    <?=$d->ti_material?>
                    </td>
                    <td style="padding-left:5px; min-width:110px; border: 1px solid black;">
                    <?=$d->ti_material_type?>
                    </td>
                    <td style="padding-left:5px; min-width:136px; border: 1px solid black;">
                    <?=$d->ti_carat?>
                    </td>
                    <td style="padding-left:5px; min-width:100px; border: 1px solid black;">
                    <?=$d->ti_weight?>
                    </td>
                    <td style="padding-left:5px; min-width:145px; border: 1px solid black;">
                    <?php if($d->ti_price!='-'){ echo nominal($d->ti_price);}else{echo $d->ti_price;}?>
                    </td>
                    <td style="padding-left:5px; min-width:145px; border: 1px solid black;text-align:right;">
                    <?=nominal($d->ti_price_total)?>
                    </td>
                </tr>
                <?php }} ?>
            </table>
        </div>
        
        <?php } ?>

        <?php if(count($detail)>74){?>

        <div style="width:100%;margin-top:0px;">
            <table style="padding-right:5px; width:96%; display:inline-block;vertical-align:text-top;">   
                <?php $no=0; foreach($detail as $d){ $no++; ?>
                <?php if($no<74){ }else{ ?>
                <tr>
                    <td style="padding-left:5px; min-width:30px; border: 1px solid black;text-align:right;">
                        <?=$no?>
                    </td>
                    <td style="padding-left:5px; min-width:125px; border: 1px solid black;">
                    <?=$d->ti_material?>
                    </td>
                    <td style="padding-left:5px; min-width:110px; border: 1px solid black;">
                    <?=$d->ti_material_type?>
                    </td>
                    <td style="padding-left:5px; min-width:136px; border: 1px solid black;">
                    <?=$d->ti_carat?>
                    </td>
                    <td style="padding-left:5px; min-width:100px; border: 1px solid black;">
                    <?=$d->ti_weight?>
                    </td>
                    <td style="padding-left:5px; min-width:145px; border: 1px solid black;">
                    <?php if($d->ti_price!='-'){ echo nominal($d->ti_price);}else{echo $d->ti_price;}?>
                    </td>
                    <td style="padding-left:5px; min-width:145px; border: 1px solid black;">
                    <?=nominal($d->ti_price_total)?>
                    </td>
                </tr>
                <?php }} ?>
            </table>
        </div>
        
        <?php } ?>

        <div style="width:100%;margin-top:0px;">
            <table style="padding-right:5px; width:96%; display:inline-block;vertical-align:text-top;">
               
                <tr>
                    <td style="padding-left:5px; min-width:30px; border: 1px solid black;">
                        #
                    </td>
                    <td style="padding-left:5px; min-width:125px; border: 1px solid black;">
                    ADMIN
                    </td>
                    <td style="padding-left:5px; min-width:110px; border: 1px solid black;">
                    
                    </td>
                    <td style="padding-left:5px; min-width:136px; border: 1px solid black;">
                    
                    </td>
                    <td style="padding-left:5px; min-width:100px; border: 1px solid black;">
                    
                    </td>
                    <td style="padding-left:5px; min-width:145px; border: 1px solid black;">
                   
                    </td>
                    <td style="padding-left:5px; min-width:145px; border: 1px solid black;text-align:right;">
                    <?=nominal($a->t_price_admin)?>
                    </td>
                </tr>
                
                <tr>
                    <td style="min-width:465px; border: 1px solid black;" colspan="5">
                    <span><input style="margin:10px 5px 10px 5px;" type="checkbox"><span>Cash</span></span>
                    <span><input style="margin:10px 5px 10px 65px;" type="checkbox"><span>Credit</span></span>
                    <span><input style="margin:10px 5px 10px 65px;" type="checkbox"><span>Debit</span></span>
                    <span><input style="margin:10px 5px 10px 65px;" type="checkbox"><span>Transfer</span></span>
                    </td>
                    <td style="min-width:145px; border: 1px solid black;text-align:center;" rowspan="2">
                    TOTAL
                    </td>
                    <td style="padding-left:5px; min-width:145px; border: 1px solid black;text-align:right;" rowspan="2">
                    <?=nominal($a->t_price_total+$a->t_price_admin)?>
                    </td>
                </tr>
                <tr>
                    <td style="padding:10px 0px 10px 10px; min-width:465px; border: 1px solid black;" colspan="5">
                    Memo
                    </td>
                </tr>
                <tr>
                    <td style="padding:10px 0px 10px 10px; min-width:465px; border: 1px solid black;" colspan="5">
                        <p>1.	Barang	yang	sudah	dibeli/dijual	tidak	dapat	dikembalikan.</p>
                        <p>2.	Tidak	menerima	penjualan/pembelian	untuk	anak	dibawah	usia	18th,	kecuali	dengan						disertai	surat	lengkap	dan/atau	disertai	dengan	persetujuan	orang	tua/wali	secara	 tertulis	</p>
                        <p>3.	Hanya	membeli/menjual	barang	(perhiasan/logam	mulia)	yang	legal	berdasarkan							data	keterangan	penjual/pembeli	saat	transaksi	jual/beli	</p>
                        <p>4.	Tidak	bertanggung	jawab	baik	secara	hukum	pidana	maupun	perdata	atas	transaksi 						penjualan/pembelian	barang	(perhiasan/Logam	Mulia)	jika	dikemudian	hari	barang								tersebut	hasil	curian,	penipuan,	penggelapan,	dll		</p>
                    </td>
                    <td style="vertical-align:top; padding-left:5px; min-width:145px;">
                        <p style="text-align:center;">
                            Received By
                        </p>
                        <p style="text-align:center;margin-top:150px;">
                           <?=strtoupper(strtolower($a->nameCustomer))?>
                        </p>
                        <p style="text-align:center;margin-top:-25px;">
                            --------------
                        </p>
                    </td>
                    <td style="vertical-align:top; padding-left:5px; min-width:145px;">
                        <p style="text-align:center;">
                            Paid By
                        </p>
                        <p style="text-align:center;margin-top:150px;">
                            I LOVE EMAS
                        </p>
                        <p style="text-align:center;margin-top:-25px;">
                            --------------
                        </p>
                    </td>
                </tr>
                
            </table>
        </div>


        
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script>
        $("#doPrint").click(function() {
          var printContents = document.getElementById("printNow").innerHTML;
          var originalContents = document.body.innerHTML;
          document.body.innerHTML = printContents;
          window.print();
          // ajaxdestroy();
          clickBack();
        });
        function ajaxdestroy() {
            jQuery.ajax({
              url: '<?= base_url('transaction/chart-destroy') ?>',
              success: function(data, textStatus, xhr) {
                window.location.href = '<?=base_url()?>report/buy';
              },
            });
            
        }
        function clickBack() {
            // window.history.back();
            window.location.href = "<?= base_url('dashboard') ?>";
        }
      </script>
    </div>
  </body>
</html>
