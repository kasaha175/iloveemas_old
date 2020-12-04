<?php foreach($userData as $aD){}; ?>
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
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">
                                    Data Pendapatan
                                </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body chart-responsive">
                            <!-- <table style="overflow:scroll; display:block;" id="tableData" class="table table-bordered table-striped"> -->
                            <table id="tableData" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal</th>
                                            <th>Bulan</th>
                                            <th>Tahun</th>
                                            <th>Jumlah Transaksi</th> 
                                            <th>Jumlah Quantiti</th> 
                                            <th>Jumlah Pendapatan</th>                          
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