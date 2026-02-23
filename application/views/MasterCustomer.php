<?php 
function nominal($angka){
    $jd = number_format($angka, 2, ',', '.');
    return $jd;
}
?>
<div class="col-md-12 master-detail-container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb glass-breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url()?>dashboard/"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?=base_url()?>master/">Master</a></li>
            <li class="breadcrumb-item active">Customer</li>
        </ol>
    </nav>
    
    <!-- Page Title -->
    <h3 class="page-title">MASTER</h3>
    <h3 class="page-subtitle">Master Customer</h3>
    
    <!-- Alert Messages -->
    <?php if($this->session->userdata('status')=='success'){ ?>
    <div class="col-md-12">
        <div class="alert glass-alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?=$this->session->userdata('message')?>
        </div>
    </div>
    <?php } 
    $data_session = array(
        'status' => '',
        'message' => "",
    );
    $this->session->set_userdata($data_session); ?>
    
    <!-- Data Card -->
    <div class="col-md-12">
        <div class="card glass-card">
            <div class="card-header" data-toggle="collapse" data-target="#customerData">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-users"></i> Customer Data</h6>
            </div>
            <div class="collapse show" id="customerData">
                <div class="card-body">
                    <!-- Add Customer Button -->
                    <a href="<?= base_url('transaction/new-customer/?key=add') ?>" class="btn btn-info float-right mb-3">
                        <i class="fas fa-user-plus"></i> Add Customer
                    </a>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Action</th>
                                    <th>No Order</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Resident Address</th>
                                    <th>Phone</th>
                                    <th>Date Created</th>
                                    <th>Created By</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no=0; foreach($customer as $a){ $no++; ?>
                                <tr>
                                    <td><?=$no?></td>
                                    <td class="action-buttons">
                                        <a href="<?=base_url()?>master/customer/<?=$a->c_id?>/" class="btn btn-info btn-circle btn-sm" title="Detail">
                                            <i class="fas fa-info"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-circle btn-sm btn-delete-customer" data-id="<?=$a->c_id?>" data-name="<?=$a->c_no_order?>" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                    <td><?=$a->c_no_order?></td>
                                    <td><?=$a->c_name?></td>
                                    <td><?=$a->c_address?></td>
                                    <td><?=$a->c_resident_address?></td>
                                    <td><?=$a->c_phone?></td>
                                    <td><?=$a->c_date_created?></td>
                                    <td><?=$a->u_name?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Back Button -->
    <div class="col-md-12 mt-4 text-center">
        <a href="<?=base_url()?>master/" class="btn btn-primary btn-lg">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Master</span>
        </a>
    </div>
</div>

<script>
jQuery(function($) {
    $('.btn-delete-customer').on('click', function(e) {
        e.preventDefault();
        
        var id = $(this).data('id');
        var name = $(this).data('name');
        
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data customer akan dihapus secara permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'glass-swal-popup'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menghapus Data...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                    customClass: {
                        popup: 'glass-swal-popup'
                    }
                });
                
                $.ajax({
                    url: '<?=base_url()?>master/delete-customer-swal/',
                    type: 'POST',
                    dataType: 'json',
                    data: { id: id },
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#28a745',
                                customClass: {
                                    popup: 'glass-swal-popup'
                                }
                            }).then((result) => {
                                window.location.href = '<?=base_url()?>master/customer/';
                            });
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#dc3545',
                                customClass: {
                                    popup: 'glass-swal-popup'
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat menghapus data',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#dc3545',
                            customClass: {
                                popup: 'glass-swal-popup'
                            }
                        });
                    }
                });
            }
        });
    });
});
</script>
