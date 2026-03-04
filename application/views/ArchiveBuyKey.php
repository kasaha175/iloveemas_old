<div class="form-page-container">
    <!-- Breadcrumb -->
    <div class="glass-breadcrumb mb-4">
        <a href="<?=base_url()?>dashboard/" class="breadcrumb-home">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <span class="breadcrumb-separator">/</span>
        <a href="<?=base_url()?>archive/" class="breadcrumb-link">Archive</a>
        <span class="breadcrumb-separator">/</span>
        <a href="<?=base_url()?>archive/buy/" class="breadcrumb-link">Buy</a>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-current"><?=ucwords(str_replace('-',' ',$this->input->get("key")))?></span>
    </div>

    <!-- Page Title -->
    <h1 class="page-title">
        ARCHIVE BUY
        <span class="page-subtitle">
            <?php 
            if($this->input->get("key")=="rti-au"){
                echo "RTI AU";
            }else if($this->input->get("key")=="rti-pt"){
                echo "RTI PT";
            }else if($this->input->get("key")=="rti-ag"){
                echo "RTI AG";
            }else if($this->input->get("key")=="rti-lm"){
                echo "RTI LM";
            }else if($this->input->get("key")=="rti-ru"){
                echo "RTI RU";
            }else if($this->input->get("key")=="rti-ta"){
                echo "RTI TA";
            }
            ?>
        </span>
    </h1>

    <!-- Form Card -->
    <div class="form-card">
        <form action="<?=base_url()?>archive/buy/save/" id="myForm" class="archive-form">
            <input type="hidden" name="key" required class="form-control" value="<?=$this->input->get("key")?>">
            
            <div class="form-group">
                <label>
                    <?php 
                    if($this->input->get("key")=="rti-au"){
                        echo "RTI AU - Harga Emas 24K";
                    }else if($this->input->get("key")=="rti-pt"){
                        echo "RTI PT - Platinum";
                    }else if($this->input->get("key")=="rti-ag"){
                        echo "RTI AG - Perak";
                    }else if($this->input->get("key")=="rti-lm"){
                        echo "RTI LM - London Market";
                    }else if($this->input->get("key")=="rti-ru"){
                        echo "RTI RU - Ruble";
                    }else if($this->input->get("key")=="rti-ta"){
                        echo "RTI TA - Tahunan";
                    }
                    ?>
                </label>
                <input type="number" step="any" name="value" required class="form-control input-box" value="<?=$value?>">
            </div>

            <!-- Action Buttons -->
            <div class="form-actions">
                <a href="<?=base_url()?>archive/buy/" class="btn btn-secondary btn-lg">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>
                
                <button type="submit" form="myForm" class="btn btn-success btn-lg btn-save">
                    <i class="fas fa-save"></i>
                    <span>Simpan</span>
                </button>
                
                <?php if($this->input->get("key")!="rti-ta"){ ?>
                <a href="<?=base_url()?>archive/buy/?key=<?=$this->input->get("key")?>&type=change" class="btn btn-warning btn-lg">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Ganti Potongan</span>
                </a>
                <?php } ?>
            </div>
        </form>
    </div>
</div>

<style>
/* Form Page Container */
.form-page-container {
    padding: 110px 20px 40px;
    max-width: 700px;
    margin: 0 auto;
}

/* Breadcrumb */
.glass-breadcrumb {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    background: var(--glass-bg);
    backdrop-filter: var(--glass-blur);
    border: 1px solid var(--glass-border);
    border-radius: 14px;
    padding: 12px 20px;
    animation: fadeInUp 0.5s ease-out;
}

.breadcrumb-home, .breadcrumb-link {
    color: var(--turquoise-surf);
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.breadcrumb-home:hover, .breadcrumb-link:hover {
    color: var(--frosted-blue);
    transform: translateX(-3px);
}

.breadcrumb-separator {
    color: var(--text-muted);
}

.breadcrumb-current {
    color: var(--text-primary);
    font-weight: 500;
}

/* Page Title */
.page-title {
    text-align: center;
    color: #03045e !important;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 8px;
    text-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
    animation: fadeInUp 0.6s ease-out;
}

.page-subtitle {
    display: block;
    font-size: 1rem;
    /* color: var(--turquoise-surf); */
    color: #03045e !important;
    font-weight: 500;
    margin-top: 8px;
}

/* Form Card */
.form-card {
    background: var(--card-gradient);
    backdrop-filter: var(--glass-blur);
    border: 1px solid var(--glass-border);
    border-radius: 24px;
    padding: 40px;
    margin-top: 30px;
    animation: fadeInUp 0.6s ease-out 0.2s both;
    position: relative;
    overflow: hidden;
}

.form-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 50%;
    background: linear-gradient(180deg, rgba(255,255,255,0.08) 0%, transparent 100%);
    pointer-events: none;
}

/* Form */
.archive-form .form-group {
    margin-bottom: 30px;
}

.archive-form label {
    display: block;
    color: var(--turquoise-surf);
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.archive-form .input-box {
    width: 100%;
    padding: 18px 24px;
    background: var(--glass-bg);
    backdrop-filter: var(--glass-blur);
    border: 1px solid var(--glass-border);
    border-radius: 16px;
    color: var(--text-primary);
    font-size: 1.5rem;
    font-weight: 600;
    text-align: center;
    transition: all 0.3s ease;
}

.archive-form .input-box:focus {
    outline: none;
    border-color: var(--turquoise-surf);
    box-shadow: 0 0 0 4px rgba(0, 180, 216, 0.2), 0 8px 32px rgba(0, 0, 0, 0.3);
    background: var(--glass-bg-hover);
}

/* Form Actions */
.form-actions {
    display: flex;
    gap: 16px;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 20px;
}

.form-actions .btn {
    padding: 14px 28px;
    font-size: 0.95rem;
    gap: 10px;
    min-width: 160px;
    justify-content: center;
}

.form-actions .btn i {
    font-size: 1rem;
}

/* Responsive */
@media (max-width: 768px) {
    .form-page-container {
        padding: 90px 15px 30px;
    }

    .form-card {
        padding: 30px 24px;
    }

    .page-title {
        font-size: 1.75rem;
    }

    .archive-form .input-box {
        font-size: 1.25rem;
        padding: 16px 20px;
    }

    .form-actions {
        flex-direction: column;
    }

    .form-actions .btn {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .form-card {
        padding: 24px 18px;
        border-radius: 20px;
    }

    .archive-form label {
        font-size: 0.9rem;
    }

    .archive-form .input-box {
        font-size: 1.1rem;
        padding: 14px 16px;
        border-radius: 14px;
    }
}
</style>

<script>
jQuery(function ($) {
    // Num Pad Input
    $('.input-box').keyboard({
        layout: 'num',
        restrictInput : true,
        preventPaste : true,
        autoAccept : true
    });
    
    // Remove any existing submit handlers and bind new one to prevent duplicate submissions
    $('#myForm').off('submit').on('submit', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        
        // Disable submit button to prevent double click
        $('.btn-save').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');
        
        // Show loading SweetAlert
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
        
        // Submit form via AJAX
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                console.log('Form submitted successfully:', response);
                // Show success message
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data berhasil disimpan',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#00b4d8',
                    customClass: {
                        popup: 'glass-swal-popup'
                    }
                }).then((result) => {
                    // Redirect after success
                    window.location.href = '<?=base_url()?>archive/buy/?key=<?=$this->input->get("key")?>';
                });
            },
            error: function(xhr, status, error) {
                console.error('Form submission error:', error);
                // Re-enable submit button on error
                $('.btn-save').prop('disabled', false).html('<i class="fas fa-save"></i> <span>Simpan</span>');
                
                // Show error message
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat menyimpan data',
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
