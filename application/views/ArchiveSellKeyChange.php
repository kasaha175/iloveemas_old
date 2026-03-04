<?php
$d = $data[0];
?>

<div class="form-page-container">
    <!-- Breadcrumb -->
    <div class="glass-breadcrumb mb-4">
        <a href="<?= base_url() ?>dashboard/" class="breadcrumb-home">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <span class="breadcrumb-separator">/</span>
        <a href="<?= base_url() ?>archive/" class="breadcrumb-link">Archive</a>
        <span class="breadcrumb-separator">/</span>
        <a href="<?= base_url() ?>archive/sell/" class="breadcrumb-link">Sell</a>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-current">Ganti Potongan</span>
    </div>

    <!-- Page Title -->
    <h1 class="page-title">
        ARCHIVE / SELL /
        <span class="page-subtitle">
            <?php
            if ($this->input->get("key") == "lm")
            {
                echo "LM";
            }
            else if ($this->input->get("key") == "material-au")
            {
                echo "MATERIAL AU";
            }
            else if ($this->input->get("key") == "material-ag")
            {
                echo "MATERIAL AG";
            }
            else if ($this->input->get("key") == "material-ubs")
            {
                echo "UBS";
            }
            ?> / GANTI POTONGAN
        </span>
    </h1>

    <!-- Form Card -->
    <div class="form-card">
        <form action="<?= base_url() ?>archive/sell/save/" id="myForm">
            <input type="hidden" name="key" required value="<?= $this->input->get("key") ?>">
            <input type="hidden" name="type" required value="change">

            <div class="change-tables">
                <?php if ($this->input->get("key") == "lm"): ?>
                    <!-- Main Table -->
                    <div class="glass-table-section">
                        <h3 class="table-title">Potongan Utama</h3>
                        <div class="lm-table-wrapper">
                            <table class="glass-table">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>LM Retro</td>
                                        <td><input class="input-box" type="number" step="any" name="a" required
                                                value="<?= $d->a ?>"></td>
                                    </tr>
                                    <tr style="display:none">
                                        <td>LM Baru</td>
                                        <td><input class="input-box" type="number" step="any" name="b" required
                                                value="<?= $d->b ?>"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- LM Certi Table -->
                    <div class="glass-table-section">
                        <h3 class="table-title">Potongan LM Certi</h3>
                        <div class="lm-table-wrapper">
                            <table class="glass-table">
                                <thead>
                                    <tr>
                                        <th>Tahun</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $potongan_lm = json_decode($d->potongan_lm, true);
                                    $tahun_mulai = 2018;
                                    while ($tahun_mulai <= date('Y') + 1):
                                        ?>
                                        <tr>
                                            <td>LM Certi <?= $tahun_mulai; ?></td>
                                            <td><input class="input-box" type="number" step="any"
                                                    name="potongan_lm[<?= $tahun_mulai; ?>]"
                                                    value="<?= $potongan_lm[$tahun_mulai] ?>"></td>
                                        </tr>
                                        <?php $tahun_mulai++; endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                <?php elseif ($this->input->get("key") == "material-au"): ?>
                    <div class="glass-table-section">
                        <h3 class="table-title">Potongan Material AU</h3>
                        <div class="lm-table-wrapper">
                            <table class="glass-table">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Potongan Material AU</td>
                                        <td><input class="input-box" type="number" step="any" name="a" required
                                                value="<?= $d->a ?>"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                <?php elseif ($this->input->get("key") == "material-ag"): ?>
                    <div class="glass-table-section">
                        <h3 class="table-title">Potongan Material AG</h3>
                        <div class="lm-table-wrapper">
                            <table class="glass-table">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Potongan Material AG</td>
                                        <td><input class="input-box" type="number" step="any" name="a" required
                                                value="<?= $d->a ?>"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                <?php elseif ($this->input->get("key") == "material-ubs"): ?>
                    <div class="glass-table-section full-width">
                        <h3 class="table-title">Potongan UBS</h3>
                        <div class="lm-table-wrapper">
                            <table class="glass-table">
                                <thead>
                                    <tr>
                                        <th>Size</th>
                                        <th>Potongan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($configMaterial as $value): ?>
                                        <tr>
                                            <td><?= $value->size ?> Gr</td>
                                            <td><input class="input-box" type="number" step="any"
                                                    name="configMaterial[<?= $value->id ?>]" required
                                                    value="<?= $value->potongan ?>"></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Action Buttons -->
            <div class="form-actions">
                <a href="<?= base_url() ?>archive/sell/?key=<?= $this->input->get('key') ?>"
                    class="btn btn-secondary btn-lg">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>

                <button type="submit" form="myForm" class="btn btn-success btn-lg btn-save">
                    <i class="fas fa-save"></i>
                    <span>Simpan</span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    /* Form Page Container */
    .form-page-container {
        padding: 110px 20px 40px;
        max-width: 1200px;
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

    .breadcrumb-home,
    .breadcrumb-link {
        color: var(--turquoise-surf);
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .breadcrumb-home:hover,
    .breadcrumb-link:hover {
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
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 8px;
        text-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
        animation: fadeInUp 0.6s ease-out;
    }

    .page-subtitle {
        display: block;
        font-size: 0.9rem;
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
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.08) 0%, transparent 100%);
        pointer-events: none;
    }

    /* Change Tables */
    .change-tables {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
    }

    .glass-table-section.full-width {
        grid-column: 1 / -1;
    }

    .glass-table-section {
        background: var(--glass-bg);
        border-radius: 16px;
        padding: 20px;
        border: 1px solid var(--glass-border);
    }

    .table-title {
        color: var(--turquoise-surf);
        font-size: 0.95rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 16px;
        text-align: center;
    }

    /* Glass Table */
    .lm-table-wrapper {
        overflow-x: auto;
        border-radius: 12px;
    }

    .glass-table {
        width: 100%;
        border-collapse: collapse;
    }

    .glass-table thead {
        background: rgba(0, 180, 216, 0.15);
    }

    .glass-table th {
        padding: 12px 14px;
        text-align: left;
        color: var(--turquoise-surf);
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid var(--glass-border);
    }

    .glass-table td {
        padding: 10px 14px;
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
        padding: 10px 12px;
        background: var(--bg-card);
        border: 1px solid var(--glass-border);
        border-radius: 8px;
        color: var(--text-primary);
        font-size: 0.9rem;
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
        margin-top: 30px;
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
    @media (max-width: 992px) {
        .change-tables {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .form-page-container {
            padding: 90px 15px 30px;
        }

        .form-card {
            padding: 24px 18px;
        }

        .page-title {
            font-size: 1.5rem;
        }

        .glass-table th,
        .glass-table td {
            padding: 8px 10px;
            font-size: 0.85rem;
        }

        .glass-table .input-box {
            padding: 8px 10px;
            font-size: 0.85rem;
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
            border-radius: 20px;
        }

        .glass-table-section {
            padding: 16px;
        }
    }
</style>

<script>
    jQuery(function ($) {
        $('.input-box').keyboard({
            layout: 'num',
            restrictInput: true,
            preventPaste: true,
            autoAccept: true
        });

        // Form submission with AJAX and SweetAlert loading
        jQuery(function ($) {

            $('.input-box').keyboard({
                layout: 'num',
                restrictInput: true,
                preventPaste: true,
                autoAccept: true
            });

            $('#myForm').off('submit').on('submit', function (e) {
                e.preventDefault();
                e.stopImmediatePropagation(); // tambahan pengaman

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
                    data: $(this).serialize(),
                    success: function (response) {
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
                            window.location.href = '<?= base_url() ?>archive/sell/?key=<?= $this->input->get("key") ?>&type=change';
                        });
                    },
                    error: function () {
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
    });
</script>