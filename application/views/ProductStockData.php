<?php foreach($userData as $aD){}; ?>
    <body class="skin-blue sidebar-mini wysihtml5-supported" style="height: auto; min-height: 100%;">
   <div class="wrapper" style="height: auto; min-height: 100%;">
   <?=$sidebar?>
      <div class="content-wrapper" style="min-height: 960px;">
         <section class="content-header">
            <h1>
              TAMBAH STOK PRODUK
            </h1>
         </section>
         <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">
                                    Tambah Stok Produk
                                </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body chart-responsive">
                                <form action="<?=base_url()?>produk/tambah-stok-process" method="POST">
                                    <div class="form-group">
                                        <p>Nama Produk</p>
                                        <select required name="id" class="form-control">
                                            <?php foreach($select as $d){ ?>
                                            <option value="<?=$d->p_id?>"><?=$d->p_name?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <p>Stok Masuk</p>
                                        <input required class="form-control" type="number" name="stock">
                                    </div>
                                    <div class="form-group">
                                        <p>Tipe Pembelian</p>
                                        <select required class="form-control" name="pay_type">
                                            <option>Bayar Tunai</option>
                                            <option>Bayar Belakang</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-flat btn-primary btn-block" type="submit" value="Tambah Data">
                                    </div>
                                </form>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">
                                    Histori Stok Keluar/Masuk Produk
                                </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body chart-responsive">
                                <table style="overflow:scroll; display:block;" id="tableData" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Type</th>
                                            <th>Nama Produk</th>
                                            <th>Stok Masuk</th>
                                            <th>Stok Keluar</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Creator</th> 
                                            <th>Tipe Pembelian</th> 
                                            <th>Kode Produk</th>                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $no = 0;
                                        foreach($data as $a){
                                        $no++;  
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $no; ?>
                                            </td>
                                            <td>
                                                <?php if(!empty($a->ps_stock_in)){
                                                    echo "Pembelian";
                                                }else{
                                                    echo "Penjualan";
                                                }                             
                                                ?>
                                            </td>
                                            <td>
                                                <?=$a->p_name?>
                                            </td>
                                            <td>
                                                <?=$a->ps_stock_in?>
                                            </td>
                                            <td>
                                                <?=$a->ps_stock_out?>
                                            </td>
                                            <td>
                                                <?=date('D', strtotime($a->ps_date_created))?>, <?=date('d-m-Y', strtotime($a->ps_date_created))?> <?=date('H:i:s', strtotime($a->ps_date_created))?>
                                            </td>
                                            <td>
                                                <?=$a->creator?>
                                            </td>
                                            <td>
                                                <?=$a->ps_pay_type?>
                                            </td>
                                            <td>
                                                <?=$a->p_code?>
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
         <strong>Keboen Kopi Karanganjar © 2018</strong> All rights
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