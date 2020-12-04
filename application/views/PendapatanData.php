<?php foreach($userData as $aD){}; 
    function rupiah($angka){
        $hasil_rupiah = "Rp " . number_format($angka,0,'','.');
        return $hasil_rupiah;
     
    }
    
    ?>
    <body class="skin-blue sidebar-mini wysihtml5-supported" style="height: auto; min-height: 100%;">
   <div class="wrapper" style="height: auto; min-height: 100%;">
   <?=$sidebar?>
      <div class="content-wrapper" style="min-height: 960px;">
         <section class="content-header">
            <h1>
              DATA PENDAPATAN
            </h1>
         </section>
         <section class="content">
                <div class="row">
                    
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">
                                    Data Pendapatan
                                </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body chart-responsive">
                                <table style="overflow:scroll; display:block;" id="tableData" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Aksi</th>
                                            <th style="min-width:150px;">Devisi</th>
                                            <th style="min-width:100px;">Harga Beli</th>
                                            <th style="min-width:100px;">Harga Jual</th>   
                                            <th style="min-width:100px;">Keuntungan</th>
                                            <th>Jumlah Transaksi</th>  
                                            <th>Kuantiti Terjual</th>                         
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $no = 0;
                                        foreach($data as $a){
                                        $no++;  
                                        ?>
                                        <tr class="<?php if($this->input->get('id')==$a->u_rule){echo 'bg-blue';}?>">
                                            <td>
                                                <?php echo $no; ?>
                                            </td>
                                            <td>
                                            <a class="btn btn-flat btn-primary btn-xs btn-block" href="<?=base_url()?>pendapatan/data/?id=<?=$a->u_rule?>">Detail</a>
                                            </td>
                                            <td>
                                                <?=$a->u_rule?>
                                            </td>
                                            <td>
                                                <?=rupiah($a->hargaBeli)?>
                                            </td>
                                            <td>
                                                <?=rupiah($a->pendapatan)?>
                                            </td>
                                            <td>
                                                <?=rupiah($a->keuntungan)?>
                                            </td>
                                            <td>
                                                <?=$a->countTransaction?>
                                            </td>
                                            <td>
                                                <?=$a->countQuantity?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">
                                    Detail Pendapatan
                                </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body chart-responsive">
                                <table style="overflow:scroll; display:block;" id="tableDataa" class="table table-bordered table-striped">
                                <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal</th>
                                            <th>Bulan</th>
                                            <th>Tahun</th>
                                            <th>Jumlah Transaksi</th> 
                                            <th>Jumlah Quantiti</th> 
                                            <th>Jumlah Pendapatan</th>
                                            <th>Jumlah Harga Beli Produk</th> 
                                            <th>Keuntungan</th>                                
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $no = 0;
                                        foreach($detail as $a){
                                        $no++;  
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $no; ?>
                                            </td>
                                            <td>
                                                <?=date('d-m-Y',strtotime($a->date))?>
                                            </td>
                                            <td>
                                                <?=$a->month?>
                                            </td>
                                            <td>
                                                <?=$a->year?>
                                            </td>
                                            <td>
                                                <?=$a->countTransaction?>
                                            </td>
                                            <td>
                                                <?=$a->countQuantity?>
                                            </td>
                                            <td>
                                                <?=$a->pendapatan?>
                                            </td>
                                            <td>
                                                <?=$a->hargaBeli?>
                                            </td>
                                            <td>
                                                <?=$a->keuntungan?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
      </div>
      <!-- /.content-wrapper -->
      <footer class="main-footer">
         <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
         </div>
         <strong>Ngkene Bae Resto Purbalingga © 2019</strong> All rights
         reserved.
      </footer>
      
      <div class="control-sidebar-bg"></div>
   </div>
   </body>
   <script>
   $(document).ready(function() {
    $('#tableData').DataTable();
    });
    </script>
     <script>
   $(document).ready(function() {
    $('#tableDataa').DataTable();
    });
    </script>