<div class="form-page-container">
    <!-- Breadcrumb -->
    <div class="glass-breadcrumb mb-4">
        <a href="<?=base_url()?>dashboard/" class="breadcrumb-home">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <span class="breadcrumb-separator">/</span>
        <a href="<?=base_url()?>archive/" class="breadcrumb-link">Archive</a>
        <span class="breadcrumb-separator">/</span>
        <a href="<?=base_url()?>archive/sell/" class="breadcrumb-link">Sell</a>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-current"><?=ucwords(str_replace('-',' ',$this->input->get("key")))?></span>
    </div>

    <!-- Page Title -->
    <h1 class="page-title">
        ARCHIVE / SELL /
        <span class="page-subtitle">
            <?php 
            if($this->input->get("key")=="lm"){
                echo "LM";
            }else if($this->input->get("key")=="material-au"){
                echo "MATERIAL AU";
            }else if($this->input->get("key")=="material-ag"){
                echo "MATERIAL AG";
            }else if($this->input->get("key")=="material-ubs"){
                echo "UBS";
            }
            ?>
        </span>
    </h1>

    <!-- Form Card -->
    <div class="form-card">
        <form action="<?=base_url()?>archive/sell/save/" id="myForm" class="archive-form">
            <input type="hidden" name="key" required class="form-control" value="<?=$this->input->get("key")?>">
            
            <div class="form-group">
                <label>
                    <?php 
                    if($this->input->get("key")=="lm"){
                        echo "LM - Harga Jual per Gram";
                    }else if($this->input->get("key")=="material-au"){
                        echo "MATERIAL AU - Emas Batangan";
                    }else if($this->input->get("key")=="material-ag"){
                        echo "MATERIAL AG - Perak Batangan";
                    }else if($this->input->get("key")=="material-ubs"){
                        echo "UBS - Unit UBS";
                    }
                    ?>
                </label>
                
                <?php 
                switch($this->input->get("key")){
                    case "lm": ?>
                        <div class="lm-table-wrapper">
                            <table class="glass-table">
                                <thead>
                                    <tr>
                                        <th>Berat</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>0.5 Gr</td>
                                        <td><input class="input-box" type="number" step="any" name="f_nol5" required value="<?php echo $f_nol5; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>1 Gr</td>
                                        <td><input class="input-box" type="number" step="any" name="f_1" required value="<?php echo $f_1; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>2 Gr</td>
                                        <td><input class="input-box" type="number" step="any" name="f_2" required value="<?php echo $f_2; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>2.5 Gr</td>
                                        <td><input class="input-box" type="number" step="any" name="f_2_coma_5" required value="<?php echo $f_2_coma_5; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>3 Gr</td>
                                        <td><input class="input-box" type="number" step="any" name="f_3" required value="<?php echo $f_3; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>5 Gr</td>
                                        <td><input class="input-box" type="number" step="any" name="f_5" required value="<?php echo $f_5; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>10 Gr</td>
                                        <td><input class="input-box" type="number" step="any" name="f_10" required value="<?php echo $f_10; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>25 Gr</td>
                                        <td><input class="input-box" type="number" step="any" name="f_25" required value="<?php echo $f_25; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>50 Gr</td>
                                        <td><input class="input-box" type="number" step="any" name="f_50" required value="<?php echo $f_50; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>100 Gr</td>
                                        <td><input class="input-box" type="number" step="any" name="f_100" required value="<?php echo $f_100; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>250 Gr</td>
                                        <td><input class="input-box" type="number" step="any" name="f_250" required value="<?php echo $f_250; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>500 Gr</td>
                                        <td><input class="input-box" type="number" step="any" name="f_500" required value="<?php echo $f_500; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>1000 Gr</td>
                                        <td><input class="input-box" type="number" step="any" name="f_1000" required value="<?php echo $f_1000; ?>"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php break;
                    case "material-au": ?>
                        <input type="number" step="any" name="value" required class="form-control input-single" value="<?php echo $value; ?>">
                        <?php break;
                    case "material-ag": ?>
                        <input type="number" step="any" name="value" required class="form-control input-single" value="<?php echo $value; ?>">
                        <?php break;
                    case "material-ubs": ?>
                        <div class="lm-table-wrapper">
                            <table class="glass-table">
                                <thead>
                                    <tr>
                                        <th>Size</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($configMaterial as $key => $val){ ?>
                                        <tr>
                                            <td><?=$val->size?> Gr</td>
                                            <td><input class="input-box" type="number" step="any" name="configMaterial[<?=$val->id?>]" required value="<?php echo $val->harga; ?>"></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <?php break;
                } ?>
            </div>

            <!-- Action Buttons -->
            <div class="form-actions">
                <a href="<?=base_url()?>archive/sell/" class="btn btn-secondary btn-lg">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>
                
                <button type="submit" form="myForm" class="btn btn-success btn-lg btn-save">
                    <i class="fas fa-save"></i>
                    <span>Simpan</span>
                </button>
                
                <a href="<?=base_url()?>archive/sell/?key=<?=$this->input->get("key")?>&type=change" class="btn btn-warning btn-lg">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Ganti Potongan</span>
                </a>
            </div>
        </form>
    </div>
</div>

<style>
/* Form Page Container */
.form-page-container {
    padding: 110px 20px 40px;
    max-width: 800px;
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
    margin-bottom: 16px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.archive-form .input-single {
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

.archive-form .input-single:focus {
    outline: none;
    border-color: var(--turquoise-surf);
    box-shadow: 0 0 0 4px rgba(0, 180, 216, 0.2), 0 8px 32px rgba(0, 0, 0, 0.3);
    background: var(--glass-bg-hover);
}

/* Glass Table */
.lm-table-wrapper {
    overflow-x: auto;
    border-radius: 16px;
    border: 1px solid var(--glass-border);
}

.glass-table {
    width: 100%;
    border-collapse: collapse;
    background: var(--glass-bg);
}

.glass-table thead {
    background: rgba(0, 180, 216, 0.15);
}

.glass-table th {
    padding: 14px 16px;
    text-align: left;
    color: var(--turquoise-surf);
    font-weight: 600;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 1px solid var(--glass-border);
}

.glass-table td {
    padding: 12px 16px;
    color: var(--text-primary);
    border-bottom: 1px solid var(--glass-border);
}

.glass-table tbody tr:hover {
    background: var(--glass-bg-hover);
}

.glass-table tbody tr:last-child td {
    border-bottom: none;
}

.glass-table .input-box {
    width: 100%;
    padding: 12px 14px;
    background: var(--bg-card);
    border: 1px solid var(--glass-border);
    border-radius: 10px;
    color: var(--text-primary);
    font-size: 1rem;
    font-weight: 500;
    text-align: right;
    transition: all 0.3s ease;
}

.glass-table .input-box:focus {
    outline: none;
    border-color: var(--turquoise-surf);
    box-shadow: 0 0 0 3px rgba(0, 180, 216, 0.15);
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

    .glass-table th, .glass-table td {
        padding: 10px 12px;
        font-size: 0.9rem;
    }

    .glass-table .input-box {
        padding: 10px 12px;
        font-size: 0.9rem;
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

    .archive-form .input-single {
        font-size: 1.25rem;
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
    
    // Form submission with AJAX and SweetAlert loading
    $('#myForm').on('submit', function(e) {
        e.preventDefault();
        
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
                    window.location.href = '<?=base_url()?>archive/sell/?key=<?=$this->input->get("key")?>';
                });
            },
            error: function(xhr, status, error) {
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
