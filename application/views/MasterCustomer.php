<?php 
function nominal($angka){
    $jd = number_format($angka, 2, ',', '.');
    return $jd;
}
?>
<div class="col-md-12 master-detail-container">
    <!-- Breadcrumb - Consistent Format with / -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb glass-breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url()?>dashboard/"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?=base_url()?>master/">Master</a></li>
            <li class="breadcrumb-item active">Customer</li>
        </ol>
    </nav>
    
    <!-- Page Header Container -->
    <div class="page-header-container">
        <div class="page-header-row">
            <!-- Page Title Group -->
            <div class="page-title-group">
                <h1 class="page-title-main">Customer</h1>
                <div class="page-title-sub">
                    <span class="context-badge context-badge-master">
                        <i class="fas fa-database"></i> Master Data
                    </span>
                </div>
            </div>
            
            <!-- Primary Action - Add Customer -->
            <div class="action-toolbar-right">
                <a href="<?= base_url('transaction/new-customer/?key=add') ?>" class="btn-primary-enterprise">
                    <i class="fas fa-user-plus"></i> Add Customer
                </a>
            </div>
        </div>
    </div>
    
    <!-- Alert Messages -->
    <?php if($this->session->userdata('status')=='success'){ ?>
    <div class="enterprise-alert enterprise-alert-success">
        <i class="fas fa-check-circle"></i>
        <?=$this->session->userdata('message')?>
    </div>
    <?php } 
    $data_session = array(
        'status' => '',
        'message' => "",
    );
    $this->session->set_userdata($data_session); ?>
    
    <!-- Data Card - Enterprise Style -->
    <div class="col-md-12">
        <div class="enterprise-card">
            <div class="enterprise-card-header">
                <h3 class="enterprise-card-title">
                    <i class="fas fa-users"></i> Customer Data
                </h3>
            </div>
            <div class="enterprise-card-body">
                <!-- Enterprise Table -->
                <div class="enterprise-table-container">
                    <table class="table table-bordered dataTable enterprise-table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th style="width: 120px; text-align: center;">Action</th>
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
                                <td class="action-column">
                                    <div class="action-button-group">
                                        <!-- Edit Button - Pencil Icon with Tooltip -->
                                        <a href="<?=base_url()?>master/customer/<?=$a->c_id?>/" 
                                           class="btn-action btn-action-edit" 
                                           data-tooltip="Edit Customer">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <!-- Delete Button - Trash Icon with Tooltip -->
                                        <a href="javascript:void(0)" 
                                           class="btn-action btn-action-delete btn-delete-customer" 
                                           data-id="<?=$a->c_id?>" 
                                           data-name="<?=$a->c_no_order?>"
                                           data-tooltip="Delete Customer">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
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
    
    <!-- Back Button - Secondary -->
    <div class="col-md-12 mt-4 text-center">
        <a href="<?=base_url()?>master/" class="btn-secondary-enterprise btn-lg-enterprise">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Master</span>
        </a>
    </div>
</div>

<style>
/* Override table styles for enterprise look */
#dataTable thead th {
    background: rgba(255, 255, 255, 0.08) !important;
    border-bottom: 2px solid var(--glass-border) !important;
    color: var(--turquoise-surf) !important;
    padding: 14px 16px !important;
    font-weight: 600 !important;
    text-transform: uppercase;
    font-size: 12px !important;
    position: sticky;
    top: 0;
    z-index: 10;
}

#dataTable tbody tr {
    border-bottom: 1px solid var(--glass-border) !important;
    transition: all 0.2s ease;
}

#dataTable tbody tr:hover {
    background: var(--glass-bg-hover) !important;
}

#dataTable tbody td {
    padding: 12px 16px !important;
    color: var(--text-primary) !important;
    border: none !important;
    vertical-align: middle;
    font-size: 14px;
}

.master-detail-container {
    padding: 90px 20px 40px;
    max-width: 1200px;
    margin: 0 auto;
}

.mt-4 {
    margin-top: 24px;
}
</style>

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
