<?php 
function nominal($angka){
    $jd = number_format($angka, 0, ',', '.');
    return $jd;
}
?>
<div class="col-md-12" style="margin-top:110px;">
<div style="color:#fff;margin-top:-30px;">
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>dashboard/" class="fa fa-home"></a>
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>dashboard/">Dashboard</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>report/">Report</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href="">Sell</a> 
    </div>
    <h3 class="text-center" style="color:#fff">REPORT</h3>
    <h3 class="text-center" style="color:#fff">Transaction Sell</h3>
    <br>
    <div class="col-md-12" style="padding:0px 150px;">
        <div class="row">

        <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Accordion -->
                            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                                aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-primary">Filter Data</h6>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse show" id="collapseCardExample" style="">
                                <div class="card-body">
                                <form action="<?=base_url()?>report/sell/">
                                <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Start Date</label>
                                        <?php if(empty($this->input->get('dateStart'))){ ?>
                                            <input name="dateStart" required type="date" value="<?=date('Y-m-d')?>" class="form-control">
                                        <?php }else{ ?>
                                            <input name="dateStart" required type="date" value="<?=$this->input->get('dateStart')?>" class="form-control">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">End Date</label>
                                        <?php if(empty($this->input->get('dateEnd'))){ ?>
                                            <input name="dateEnd" required type="date" value="<?=date('Y-m-d')?>" class="form-control">
                                        <?php }else{ ?>
                                            <input name="dateEnd" required type="date" value="<?=$this->input->get('dateEnd')?>" class="form-control">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Filter?</label>
                                        <input required type="submit" class="btn btn-block btn-primary" value="Filter">
                                    </div>
                                </div>
                                </div>
                                </form>    
                                </div>
                            </div>
                        </div>
                    </div>



            <div class="col-md-12" style="padding:10px 10px">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Accordion -->
                            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                                aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-primary">Transaction Data</h6>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse show" id="collapseCardExample" style="">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table style="overflow:scroll; display:block;"  class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th style="min-width:150px;">Action</th>
                                                    <th style="min-width:100px;">No Order</th>
                                                    <th style="min-width:100px;">Status</th>
                                                    <th style="min-width:100px;">Date</th>
                                                    <th style="min-width:100px;">Created By</th>
                                                    <th style="min-width:100px;">Receive By</th>
                                                    <th style="min-width:100px;">Customer</th>
                                                    <th >Qtt</th>
                                                    <th style="min-width:100px;">Price Total</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                    <th>No</th>
                                                    <th>Action</th>
                                                    <th>No Order</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th>Created By</th>
                                                    <th>Receive By</th>
                                                    <th>Customer</th>
                                                    <th>Qtt</th>
                                                    <th>Price Total</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                            <?php $no=0; foreach($data as $a){ $no++; ?>
                                                <tr>
                                                    <td><?=$no?></td>
                                                    <td>
                                                    <a href="#" data-toggle="modal" data-target="#deleteModal<?=$a->t_id?>"  class="btn btn-danger btn-circle btn-sm mr-2"><i class="fas fa-trash"></i>
                                                    <a href="<?=base_url()?>report/sell-print/<?=$a->t_id?>/" class="btn btn-success btn-circle btn-sm mr-2"><i class="fas fa-print"></i>
                                                    <a href="<?=base_url()?>report/sell/<?=$a->t_id?>/" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-info"></i>
                                                     </td>
                                                    <td><?=$a->t_no_order?></td>
                                                    <td><?=$a->t_status?></td>
                                                    <td><?=$a->t_date_created?></td>
                                                    <td><?=$a->nameCreator?></td>
                                                    <td><?=$a->nameReceive?></td>
                                                    <td><?=$a->nameCustomer?></td>
                                                    <td><?=$a->t_qtt?></td>
                                                    <td>IDR <?=nominal($a->t_price_total)?></td>
                                                    <div class="modal fade" id="deleteModal<?=$a->t_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document" style="top: 84px;">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">Select "Delete" below if you are ready to delete transaction <b><?=$a->t_no_order?></b> ?</div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                                <a class="btn btn-danger" href="<?=base_url()?>transaction/sell-delete-transaction/<?=$a->t_id?>">Delete</a>
                                                    </div> </div> </div> </div>
                                                
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                        


                                    </div>


                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                <a href="<?=base_url()?>report/" class="btn btn-primary btn-icon-split btn-lg">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Back</span>
                </a>
            </div>

                </div>
            </div>

        </div>

    </div>

</div>

<script>
    $(document).ready(function () {
       
        $('#dataTable').DataTable({
            dom: 'Bfrtip',
            lengthMenu: [
                [ 10, 25, 50, 100, -1 ],
                [ '10 rows', '25 rows', '50 rows', '100 rows', 'Show all' ]
            ],
            buttons: [
                {
                    extend: 'copyHtml5',
                    text: '<i class="fa fa-clipboard"></i> Copy',
                    titleAttr: 'Copiar',
                    className: 'btn btn-default btn-flat',
                    exportOptions: {
                        columns: [0,2,3,4,5,6,7,8,9]
                    },
                },
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    text: '<i class="fa fa-file-pdf-o"></i> PDF',
                    titleAttr: 'PDF',
                    className: 'btn btn-default btn-flat',
                    exportOptions: {
                        columns: [0,2,3,4,5,6,7,8,9]
                    },
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                    titleAttr: 'Excel',
                    className: 'btn btn-default btn-flat',
                    exportOptions: {
                        columns: [0,2,3,4,5,6,7,8,9]
                    },
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fa fa-file-text-o"></i> CSV',
                    titleAttr: 'CSV',
                    className: 'btn btn-default btn-flat',
                    exportOptions: {
                        columns: [0,2,3,4,5,6,7,8,9]
                    },
                },
                {
                    extend: 'pageLength',
                    titleAttr: 'Record Show',
                    className: 'selectTable btn btn-default btn-flat'
                }
            ],
        });
        $('#dataTable_filter').addClass('col-md-12');
    });
   
</script>