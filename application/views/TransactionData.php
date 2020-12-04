<?php foreach($userData as $aD){}; ?>
    <body class="skin-blue sidebar-mini wysihtml5-supported" style="height: auto; min-height: 100%;">
   <div class="wrapper" style="height: auto; min-height: 100%;">
   <?=$sidebar?>
      <div class="content-wrapper" style="min-height: 960px;">
         <section class="content-header">
            <h1>
              DATA TRANSAKSI
            </h1>
         </section>
         <section class="content">
                <div class="row">
                    
                    <!-- /.col -->
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">
                                    Data Transaksi
                                </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body chart-responsive">
                                <table style="overflow:scroll; display:block;" id="tableData" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Aksi</th>
                                            <th style="min-width:100px;">Total Harga</th>
                                            <th style="min-width:200px;">Tanggal Dibuat</th>
                                            <th style="min-width:200px;">Creator</th>   
                                            <th style="min-width:400px;">Kode Transaksi</th>                                 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $no = 0;
                                        foreach($data as $a){
                                        $no++;  
                                        ?>
                                        <tr class="<?php if($this->input->get('id')==$a->t_id){echo 'bg-blue';}?>">
                                            <td>
                                                <?php echo $no; ?>
                                            </td>
                                            <td>
                                            <a class="btn btn-flat btn-warning btn-xs btn-block" target="_blank" href="<?=base_url()?>transaksi/invoice/<?=$a->t_id?>">Cetak Invoice</a>
                                            <a class="btn btn-flat btn-primary btn-xs btn-block" href="<?=base_url()?>transaksi/data/?id=<?=$a->t_id?>">Detail</a>
                                            </td>
                                            <td>
                                                <?=$a->t_price?>
                                            </td>
                                            <td>
                                                 <?=date('d-m-Y H:i:s', strtotime($a->t_date_created))?>
                                            </td>
                                            <td>
                                                <?=$a->creator?>
                                            </td>
                                            <td>
                                                <?=$a->t_code?>
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
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">
                                    Detail Transaksi
                                </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body chart-responsive">
                                <table style="overflow:scroll; display:block;" id="tableDataa" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Produk</th>
                                            <th>Harga</th>
                                            <th>Quantity</th>
                                            <th>Harga Total</th>
                                            <th>Tanggal Dibuat</th>    
                                            <th>Kode Transaksi</th>                              
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
                                                <?=$a->ti_p_name?>
                                            </td>
                                            <td>
                                                <?=$a->ti_p_price?>
                                            </td>
                                            <td>
                                                <?=$a->ti_quantity?>
                                            </td>
                                            <td>
                                                <?=$a->ti_p_price*$a->ti_quantity?>
                                            </td>
                                            <td>
                                                <?=date('D', strtotime($a->t_date_created))?>, <?=date('d-m-Y', strtotime($a->t_date_created))?>
                                            </td>
                                            <td>
                                                <?=$a->t_code?>
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