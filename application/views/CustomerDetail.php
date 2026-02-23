<?php foreach($detail as $d){}?>
<div class="col-md-12" style="margin-top:110px;">
    <div style="color:#fff;margin-top:-30px;">
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>dashboard/" class="fa fa-home"></a>
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>dashboard/">Dashboard</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>master/">Master</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href="">Detail Customer</a> 
    </div>
    <h3 class="text-center" style="color:#fff">CUSTOMER</h3>
    <h3 class="text-center" style="color:#fff">Detail Customer</h3>
    <br>
    <div class="col-md-12" style="padding:0px 150px;">
        <div class="row">
            <div class="col-md-6 offset-md-3" style="padding:10px 10px">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Accordion -->
                            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                                aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-primary">DETAIL CUSTOMER</h6>
                            </a>
                            
                            <?php if($this->session->userdata('status')=='success'){ ?>
                            <div class="col-md-12 mt-3">
                            <div class="alert alert-success alert-dismissible m-0">
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
                            <!-- Card Content - Collapse -->
                            <div class="collapse show" id="collapseCardExample" style="">
                                <div class="card-body">
                                    <form action="<?=base_url()?>master/save-customer-edit-validation/" method="post" id="myForm">
                                        <input type="hidden" name="idCustomer" value="<?=$d->c_id?>">
                                        <div class="form-group">
                                            <label>NAME <span class="text-danger">*</span></label>
                                            <input type="text" id="u_name" class="form-control" name="name" value="<?=$d->c_name?>">
                                            <small class="text-danger" id="error-name"></small>
                                        </div>
                                        <div class="form-group">
                                            <label>ID NUMBER (KTP) <span class="text-danger">*</span></label>
                                            <input type="text" id="c_id_number" class="form-control" name="idNumber" value="<?=$d->c_id_number?>">
                                            <small class="text-danger" id="error-idNumber"></small>
                                        </div>
                                        <div class="form-group">
                                            <label>NO ORDER</label>
                                            <input type="text" id="u_no_order" class="form-control" name="noOrder" value="<?=$d->c_no_order?>">
                                        </div>
                                        <div class="form-group">
                                            <label>ADDRESS <span class="text-danger">*</span></label>
                                            <textarea id="u_address" class="form-control" name="address"><?=$d->c_address?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>RESIDENT ADDRESS <span class="text-danger">*</span></label>
                                            <textarea id="u_resident_address" class="form-control" name="resident_address"><?=$d->c_resident_address?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>PHONE <span class="text-danger">*</span></label>
                                            <input type="text" id="u_phone" class="form-control" name="phone" value="<?=$d->c_phone?>">
                                            <small class="text-danger" id="error-phone"></small>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <button type="submit" class="btn btn-success btn-lg btn-block">
                                                            <i class="fas fa-save"></i> Save
                                                        </button>
                                                    </div>
                                                    
                                                    <div class="col-md-12">
                                                        <a href="<?=base_url()?>master/customer/"
                                                            class="btn btn-secondary btn-lg btn-block">
                                                            <i class="fas fa-arrow-left"></i> Back
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>
<script type="text/javascript">
    $("#materialType").select2();
    $(".select2").select2();
</script>

<script>
    jQuery(function ($) {

        // QWERTY Text Input
        // The bottom of this file is where the autocomplete extension is added
        // ********************
        $('#u_name').keyboard({
            layout: 'qwerty'
        });
        $('#u_address').keyboard({
            layout: 'qwerty'
        });
        $('#u_resident_address').keyboard({
            layout: 'qwerty'
        });
        $('#u_id_number').keyboard({
            layout: 'qwerty'
        });
        $('#u_phone').keyboard({
            layout: 'qwerty'
        });
        $('#u_no_order').keyboard({
            layout: 'qwerty'
        });
        $('#c_id_number').keyboard({
            layout: 'qwerty'
        });

        $('.version').html('(v' + $('#u_name').getkeyboard().version + ')');

        // Contenteditable
        // ********************
        $.keyboard.keyaction.undo = function (base) {
            base.execCommand('undo');
            return false;
        };
        $.keyboard.keyaction.redo = function (base) {
            base.execCommand('redo');
            return false;
        };

        $('#contenteditable').keyboard({
            usePreview: false,
            useCombos: false,
            autoAccept: true,
            layout: 'custom',
            customLayout: {
                'normal': [
                    '` 1 2 3 4 5 6 7 8 9 0 - = {del} {b}',
                    '{tab} q w e r t y u i o p [ ] \\',
                    'a s d f g h j k l ; \' {enter}',
                    '{shift} z x c v b n m , . / {shift}',
                    '{accept} {space} {left} {right} {undo:Undo} {redo:Redo}'
                ],
                'shift': [
                    '~ ! @ # $ % ^ & * ( ) _ + {del} {b}',
                    '{tab} Q W E R T Y U I O P { } |',
                    'A S D F G H J K L : " {enter}',
                    '{shift} Z X C V B N M < > ? {shift}',
                    '{accept} {space} {left} {right} {undo:Undo} {redo:Redo}'
                ]
            },
            display: {
                del: '\u2326:Delete',
                redo: '↻',
                undo: '↺'
            }
        });
        prettyPrint();

    });

    // Form submission with validation and SWAL
    $('#myForm').on('submit', function(e) {
        e.preventDefault();
        
        // Clear previous errors
        $('#error-name').text('');
        $('#error-idNumber').text('');
        $('#error-phone').text('');
        
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
                    
                    // Show field-specific errors
                    if (response.message.includes('Nama')) {
                        $('#error-name').text(response.message);
                    } else if (response.message.includes('KTP')) {
                        $('#error-idNumber').text(response.message);
                    } else if (response.message.includes('HP')) {
                        $('#error-phone').text(response.message);
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
</script>
