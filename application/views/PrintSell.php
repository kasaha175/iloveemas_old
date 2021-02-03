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
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-4/css/bootstrap.min.css') ?>">
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="<?= base_url('assets/bootstrap-4/js/bootstrap.min.js') ?>"></script>
    <title><?=$title?></title>
  </head>
  <body vlink="blue" link="blue" style="background-color:#A0A0A0;">
    <style>
        @font-face {
          font-family: 'Poppins';
          src: url(<?= base_url('assets/Poppins-SemiBold.ttf') ?>);
        }
        body{
            font-family: 'Poppins' !important;
            font-size: 15px;
        }
        .table-bordered {
            border: 2px solid !important;
        }
        .table-bordered td, .table-bordered th {
            border: 2px solid !important;
        }
        .table thead th {
            vertical-align: bottom !important;
            border: 2px solid !important;
        }
        .no-margin p{
            margin: 0px !important; 
        }
        @media print {
            .table-bordered {
                border: 2px solid !important;
            }
            .table-bordered td, .table-bordered th {
                border: 2px solid !important;
            }
            .table thead th {
                vertical-align: bottom;
                border: 2px solid !important;
            }
            .no-margin p{
                margin: 0px !important; 
            }
        }
    </style>
    <div style="width:918px;min-height:1188px;background-color:#fff;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
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
                </div>
            </div>
        </div>
        <div class="container" id="printNow">
            <div class="row">
                <div class="col-md-6">
                    <div style="border: 2px solid">
                        <table class="table table-sm table-borderless" border="0">
                            <thead class="text-center">
                                <tr>
                                    <th colspan="3" style="font-size: 18px; border-bottom: 2px solid">PT Muara Logam Indonesia</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 25px;"><input type="checkbox" /></td>
                                    <td>
                                        I Love Emas Jakarta : Ruko Sky Terrace Blok B, Jl. Tanah Lot,
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 25px;"><input type="checkbox" /></td>
                                    <td>
                                        I Love Emas Bali : Jl. Gunung Soputan 36B, Denpasar Barat, Bali
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 25px;"><input type="checkbox" /></td>
                                    <td>
                                        I Love Emas Surabaya: Cito Mall Surabaya, Lt UG Blok UB 5/10
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 25px;"><input type="checkbox" /></td>
                                    <td>
                                        I Love Emas Bekasi : Lt. GF 48-49 Revo Town Mall Bekasi Lt. GF 48-49, Pekayon Jaya, Kec. Bekasi Sel., Kota Bks, Jawa Barat
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <b>Customer Receipt</b><br>
                    <div class="row">
                        <div class="col-6">
                            <table class="table table-sm table-borderless" border="2">
                                <thead class="text-center">
                                    <tr>
                                        <th style="font-size: 18px; border-bottom: 2px solid">Payment Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <?=date('Y-m-d', strtotime($a->t_date_created))?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-6">
                            <table class="table table-sm table-borderless" border="2">
                                <thead class="text-center">
                                    <tr>
                                        <th style="font-size: 18px; border-bottom: 2px solid">Invoice Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <?=$a->t_no_order?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div style="border: 2px solid">
                        <table class="table table-sm table-borderless" border="0">
                            <thead class="text-center">
                                <tr>
                                    <th colspan="3" style="font-size: 18px; border-bottom: 2px solid">Bill To : </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 150px;">Name</td>
                                    <td style="width: 5px;"> : </td>
                                    <td><?=ucwords(strtolower($a->nameCustomer))?> (<?=strtoupper($a->c_id_number)?>)</td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;">Address</td>
                                    <td style="width: 5px;"> : </td>
                                    <td><?=ucwords(strtolower($a->c_address))?></td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;">Resident Address</td>
                                    <td style="width: 5px;"> : </td>
                                    <td><?=$a->c_resident_address?></td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;">Phone Number</td>
                                    <td style="width: 5px;"> : </td>
                                    <td><?=$a->c_phone?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-sm table-bordered" border="2" style="border: 2px solid !important; margin-top: 10px;">
                        <thead class="text-center">
                            <tr style="border-bottom: 2px solid;">
                                <th style="width: 15px;border: 2px solid !important">No</th>
                                <th style="border: 2px solid !important;border: 2px solid !important;">Material</th>
                                <th style="border: 2px solid !important;border: 2px solid !important;">Type</th>
                                <th style="border: 2px solid !important;border: 2px solid !important;">Carat/Percentage</th>
                                <th style="border: 2px solid !important;border: 2px solid !important;">Weight (gr)</th>
                                <th style="border: 2px solid !important;border: 2px solid !important;">Price/gr (Rp)</th>
                                <th style="border: 2px solid !important;border: 2px solid !important;">Amount (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=0; foreach($detail as $d){ $no++; ?>
                                <?php if($no>27){ break; }else{ ?>
                                <tr>
                                    <td style="border: 2px solid !important;">
                                        <?=$no?>
                                    </td>
                                    <td style="border: 2px solid !important;" >
                                        <?php if($d->ti_material=='Cust. Profesion'){ echo 'Gold'; }else{ echo $d->ti_material;} ?>
                                    </td>
                                    <td  style="border: 2px solid !important;">
                                        <?=$d->ti_material_type?>
                                    </td>
                                    <td style="border: 2px solid !important;" >
                                        <?=$d->ti_carat?>
                                    </td>
                                    <td style="border: 2px solid !important;" >
                                        <?=$d->ti_weight?>
                                    </td>
                                    <td style="border: 2px solid !important;" >
                                        <?php if($d->ti_price!='-'){ echo nominal($d->ti_price);}else{echo $d->ti_price;}?>
                                    </td>
                                    <td style="border: 2px solid !important;" >
                                        <?=nominal($d->ti_price_total)?>
                                    </td>
                                </tr>
                                <?php }
                            } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="border: 2px solid !important;">#</th>
                                <th style="border: 2px solid !important;" colspan="5">Admin</th>
                                <td style="padding-left:5px; min-width:145px; border: 1px solid black;text-align:right;border: 2px solid !important;">
                                    <?=nominal($a->t_price_admin)?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <span><input style="margin:10px 5px 10px 5px;border: 2px solid !important;" type="checkbox"><span>Cash</span></span>
                                    <span><input style="margin:10px 5px 10px 65px;border: 2px solid !important;" type="checkbox"><span>Credit</span></span>
                                    <span><input style="margin:10px 5px 10px 65px;border: 2px solid !important;" type="checkbox"><span>Debit</span></span>
                                    <span><input style="margin:10px 5px 10px 65px;border: 2px solid !important;" type="checkbox"><span>Transfer</span></span>
                                </td>
                                <td>
                                    TOTAL
                                </td>
                                <td>
                                    <?=nominal($a->t_price_total+$a->t_price_admin)?>
                                </td>
                            </tr>
                        </tfoot>        
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table table-sm table-borderless" border="2">
                        <thead class="text-center">
                            <tr>
                                <th style="font-size: 18px; border-bottom: 2px solid">Syarat & Ketentuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?php 
                                    $this->db->order_by('tm_priority', 'asc');
                                    $memo = $this->db->get('tb_memo')->result();
                                    foreach ($memo as $key => $value): ?>
                                        <div class="no-margin text-justify"><?= $value->tm_value ?></div>
                                    <?php endforeach ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row justify-content-md-center text-center">
                <div class="col-4">
                    Received By
                    <br>
                    <br>
                    <br>
                    <br>
                    I LOVE EMAS
                    <br>
                    --------------
                </div>
                <div class="col-4">
                    Paid By
                    <br>
                    <br>
                    <br>
                    <br>
                    <?=strtoupper(strtolower($a->nameCustomer))?>
                    <br>
                    --------------
                </div>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    </div>
    <script>
        $("#doPrint").click(function() {
          var printContents = document.getElementById("printNow").innerHTML;
          var originalContents = document.body.innerHTML;
          document.body.innerHTML = printContents;
          $('body').css('background-color', '#fff');
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