<div class="col-md-12 form-container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb glass-breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url()?>dashboard/"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?=base_url()?>master/">Master</a></li>
            <li class="breadcrumb-item active">Edit Syarat & Ketentuan</li>
        </ol>
    </nav>
    
    <!-- Page Title -->
    <h3 class="page-title">EDIT SYARAT & KETENTUAN</h3>
    
    <!-- Form Card -->
    <div class="col-md-12">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card glass-card">
                    <div class="card-header" data-toggle="collapse" data-target="#formCard">
                        <h6 class="m-0 font-weight-bold"><i class="fas fa-edit"></i> Edit Syarat & Ketentuan</h6>
                    </div>
                    <div class="collapse show" id="formCard">
                        <div class="card-body">
                            <form action="<?=base_url('master/update-memo')?>" method="post" id="myForm">
                                <input type="hidden" name="id" value="<?= $memo->tm_id ?>">
                                <div class="form-group">
                                    <label>Isi Syarat & Ketentuan <span class="text-danger">*</span></label>
                                    <textarea class="form-control glass-input summernote" name="dt[tm_value]"><?= $memo->tm_value ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Priority <span class="text-danger">*</span></label>
                                    <input type="number" id="tm_priority" class="form-control glass-input" name="dt[tm_priority]" value="<?= $memo->tm_priority ?>">
                                    <small class="text-danger" id="error-priority"></small>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6 mb-3">
                                        <button type="submit" class="btn btn-success btn-lg btn-block">
                                            <i class="fas fa-save"></i> Save
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="<?=base_url()?>master/memo/" class="btn btn-secondary btn-lg btn-block">
                                            <i class="fas fa-arrow-left"></i> Back
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
jQuery(function($) {
    $('#myForm').on('submit', function(e) {
        e.preventDefault();
        
        // Clear previous errors
        $('#error-priority').text('');
        
        Swal.fire({
            title: 'Mengupdate Data...',
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
            url: $(this).attr('action'),
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
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
                        window.location.href = '<?=base_url()?>master/memo/';
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
                    
                    // Show field-specific errors
                    if (response.message.includes('Priority')) {
                        $('#error-priority').text(response.message);
                    }
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat mengupdate data',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#dc3545',
                    customClass: {
                        popup: 'glass-swal-popup'
                    }
                });
            }
        });
    });
});
</script>
