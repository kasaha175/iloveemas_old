<?php 
function nominal($angka){
    $jd = number_format($angka, 2, ',', '.');
    return $jd;
}
?>
<div class="col-md-12 transaction-customer-container">
    <!-- Breadcrumb - Consistent Format with / -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb glass-breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url()?>dashboard/"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?=base_url()?>transaction/">Transaction</a></li>
            <li class="breadcrumb-item active">New Customer</li>
        </ol>
    </nav>
    
    <!-- Page Header Container -->
    <div class="page-header-container">
        <div class="page-header-row">
            <!-- Page Title Group -->
            <div class="page-title-group">
                <h1 class="page-title-main">New Transaction Customer</h1>
                <div class="page-title-sub">
                    <span class="context-badge context-badge-transaction">
                        <i class="fas fa-exchange-alt"></i> Transaction Module
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Info Banner - Transaction Context -->
    <div class="info-banner">
        <i class="fas fa-info-circle info-banner-icon"></i>
        <span class="info-banner-text">
            Customer baru akan otomatis tersimpan ke <strong>Master Data</strong>. 
            Anda dapat mengelola data customer di menu <em>Master > Customer</em>.
        </span>
    </div>
    
    <!-- Form Card -->
    <div class="col-md-12">
        <div class="enterprise-card">
            <div class="enterprise-card-header">
                <h3 class="enterprise-card-title">
                    <i class="fas fa-user-plus"></i> New Customer Form
                </h3>
            </div>
            <div class="enterprise-card-body">
                <form action="<?=base_url()?>master/save-customer-validation/" method="post" id="myForm">
                    <input type="hidden" class="enterprise-input" name="key" value="<?=$this->input->get('key')?>">
                    
                    <!-- Form Fields - 20px spacing -->
                    <div class="form-field-row">
                        <label class="enterprise-form-label">
                            NAME <span class="required-mark">*</span>
                        </label>
                        <input id="u_name" type="text" class="enterprise-input" name="name" placeholder="Enter customer name">
                        <small class="error-message" id="error-name"></small>
                    </div>
                    
                    <div class="form-field-row">
                        <label class="enterprise-form-label">
                            ID NUMBER (KTP) <span class="required-mark">*</span>
                        </label>
                        <input type="text" id="u_id_number" class="enterprise-input" name="idNumber" placeholder="Enter ID number">
                        <small class="error-message" id="error-idNumber"></small>
                    </div>
                    
                    <div class="form-field-row">
                        <label class="enterprise-form-label">
                            ADDRESS <span class="required-mark">*</span>
                        </label>
                        <textarea id="u_address" class="enterprise-input enterprise-textarea" name="address" placeholder="Enter address"></textarea>
                    </div>
                    
                    <div class="form-field-row">
                        <label class="enterprise-form-label">
                            RESIDENT ADDRESS <span class="required-mark">*</span>
                        </label>
                        <textarea id="u_resident_address" class="enterprise-input enterprise-textarea" name="resident_address" placeholder="Enter resident address"></textarea>
                    </div>
                    
                    <div class="form-field-row">
                        <label class="enterprise-form-label">
                            PHONE <span class="required-mark">*</span>
                        </label>
                        <input id="u_phone" type="text" class="enterprise-input" name="phone" placeholder="Enter phone number">
                        <small class="error-message" id="error-phone"></small>
                    </div>
                    
                    <!-- Button Group -->
                    <div class="form-field-row" style="margin-top: 32px;">
                        <div class="row">
                            <div class="col-md-6 mb-16">
                                <button type="submit" class="btn-primary-enterprise btn-lg-enterprise btn-block" id="btnSave">
                                    <i class="fas fa-save"></i> Save Customer
                                </button>
                            </div>
                            <div class="col-md-6">
                                <a href="<?=base_url()?>master/customer/" class="btn-secondary-enterprise btn-lg-enterprise btn-block">
                                    <i class="fas fa-arrow-left"></i> Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.transaction-customer-container {
    padding: 90px 20px 40px;
    max-width: 800px;
    margin: 0 auto;
}

.form-field-row .row {
    margin: 0 -8px;
}

.form-field-row .col-md-6 {
    padding: 0 8px;
}

.mb-16 {
    margin-bottom: 16px;
}

@media (max-width: 768px) {
    .transaction-customer-container {
        padding: 80px 15px 30px;
    }
    
    .form-field-row .row {
        flex-direction: column;
    }
    
    .form-field-row .col-md-6 {
        margin-bottom: 12px;
    }
    
    .form-field-row .col-md-6:last-child {
        margin-bottom: 0;
    }
}
</style>

<script type="text/javascript">
    $("#materialType").select2();
    $(".select2").select2();
</script>

<script>
    jQuery(function ($) {

        // QWERTY Text Input
        $('#u_name').keyboard({
            layout: 'qwerty'
        });
        $('#u_address').keyboard({
            layout: 'qwerty'
        });
        $('#u_resident_address').keyboard({
            layout: 'qwerty'
        });
        $('#u_phone').keyboard({
            layout: 'qwerty'
        });
        $('#u_id_number').keyboard({
            layout: 'qwerty'
        });

        $('.version').html('(v' + $('#u_name').getkeyboard().version + ')');

        // Contenteditable
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
        
        // Add loading state
        $('#btnSave').addClass('loading').prop('disabled', true);
        
        // Clear previous errors
        $('#error-name').text('');
        $('#error-idNumber').text('');
        $('#error-phone').text('');
        
        Swal.fire({
            title: 'Menyimpan Data...',
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
                // Remove loading state
                $('#btnSave').removeClass('loading').prop('disabled', false);
                
                if (response.status === 'success') {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#10b981',
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
                        confirmButtonColor: '#ef4444',
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
                // Remove loading state
                $('#btnSave').removeClass('loading').prop('disabled', false);
                
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat menyimpan data',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#ef4444',
                    customClass: {
                        popup: 'glass-swal-popup'
                    }
                });
            }
        });
    });
</script>
