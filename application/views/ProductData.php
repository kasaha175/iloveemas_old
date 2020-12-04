<?php foreach($userData as $aD){}; ?>
    <body class="skin-blue sidebar-mini wysihtml5-supported" style="height: auto; min-height: 100%;">
   <div class="wrapper" style="height: auto; min-height: 100%;">
   <?=$sidebar?>
      <div class="content-wrapper" style="min-height: 960px;">
         <section class="content-header">
            <h1>
              TAMBAH PRODUK
            </h1>
         </section>
         <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">
                                    Tambah Produk
                                </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body chart-responsive">
                                <form action="<?=base_url()?>produk/tambah-process" method="POST">
                                    <div class="form-group">
                                        <p>Nama Produk</p>
                                        <input required class="form-control" type="text" name="name">
                                    </div>
                                    <div class="form-group">
                                        <p>Harga</p>
                                        <input required class="form-control" type="number" name="price_in">
                                    </div>
                                    <div class="form-group">
                                        <p>Kategori</p>
                                        <select required class="form-control" name="category">
                                            <option>Makanan</option>
                                            <option>Minuman</option>
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
                                    Data Produk
                                </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body chart-responsive">
                                <table style="overflow:scroll; display:block;" id="tableData" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Aksi</th>
                                            <th>Kategori</th>
                                            <th style="min-width:200px;">Nama Produk</th>
                                            <th>Harga</th>
                                            <th style="min-width:150px;">Tanggal Dibuat</th>
                                            <th style="min-width:150px;">Creator</th>        
                                            <th style="min-width:200px;">Kode Produk</th>                                   
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
                                                <a class="btn btn-block btn-xs btn-flat btn-warning" data-toggle="modal" data-target="#modal-danger<?=$a->p_id?>">Hapus</a>
                                                <div class="modal modal-warning fade" id="modal-danger<?=$a->p_id?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Hapus Data</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah Anda ingin menghapus data dengan nama <?=$a->p_name?></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a type="button" class="btn btn-outline pull-left" href="<?=base_url()?>produk/hapus-process/<?=$a->p_id?>/" >Hapus</a>
                                                        <a type="button" class="btn btn-outline" data-dismiss="modal">Batal</a>
                                                    </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <?=$a->p_category?>
                                            </td>
                                            <td contenteditable class="p_name" data-id7="<?=$a->p_id?>">
                                               <?=$a->p_name?>
                                            </td>
                                            <td contenteditable class="p_price" data-id9="<?=$a->p_id?>">
                                                <?=$a->p_price?>
                                            </td>
                                            <td>
                                                <?=date('D', strtotime($a->p_date_created))?>, <?=date('d-m-Y', strtotime($a->p_date_created))?>
                                            </td>
                                            <td>
                                                <?=$a->creator?>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.0.1/sweetalert.min.js"></script> <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.0.1/sweetalert.min.css">

<script type="text/javascript">
  $(document).ready(function(){ 
function edit_datass(id, text) 
   { 
      $.ajax({ 
        url:"https://andromeda.playon-id.com/index.php/InvoiceController/updateInvoice/", 
        method:"POST", 
        data:{id:id, text:text}, 
        dataType:"text", 
        success:function(data){ 
            //alert(data);
			//swal("Update Success!", "You update maintenance data!", "success");		 
			 } 
      }); 
   } 
   
   $(document).on('change', '#s_pic', function(){ 
      var id = $(this).data("id9"); 
      var s_pic = $(this).val();
     
	 edit_datass(id,s_pic); 
   });
   
   
 }); 
 
</script>

<script type="text/javascript">
  $(document).ready(function(){ 
   
   
   function edit_data(id, text, column_name) 
   { 
      $.ajax({ 
        url:"<?=base_url()?>index.php/ProductController/updateLive/", 
        method:"POST", 
        data:{id:id, text:text, column_name:column_name}, 
        dataType:"text", 
        success:function(data){ 
            swal("Update Success!", "You update spom data!", "success");		 
		    } 
      }); 
   } 
	
    $(document).on('blur', '.p_name', function(){ 
      var id = $(this).data("id7"); 
      var p_name = $(this).text(); 
      edit_data(id,p_name, "p_name"); 
    });
    $(document).on('blur', '.p_price_in', function(){ 
      var id = $(this).data("id8"); 
      var p_price_in = $(this).text(); 
      edit_data(id,p_price_in, "p_price_in"); 
    });
    $(document).on('blur', '.p_price', function(){ 
      var id = $(this).data("id9"); 
      var p_price = $(this).text(); 
      edit_data(id,p_price, "p_price"); 
    });

 }); 
 
</script>