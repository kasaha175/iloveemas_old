<?php
$total = 0;
foreach ($this->cart->contents() as $a) {
    $total = $total + $a['priceTotal'];
}

function nominal($angka) {
    $jd = number_format($angka, 0, ',', '.');
    return $jd;
}
?>

<div class="col-md-12 page-container">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb glass-breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url()?>dashboard/"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?=base_url()?>transaction/">Transaction</a></li>
            <li class="breadcrumb-item"><a href="<?=base_url()?>transaction/sell">Sell</a></li>
            <li class="breadcrumb-item active">Cart</li>
        </ol>
    </nav>

    <!-- Page Title -->
    <h3 class="page-title">SELL</h3>
    <h3 class="page-subtitle">Checkout Session</h3>

    <!-- Back Button -->
    <div class="mb-4">
        <a href="<?=base_url()?>transaction/sell/" class="btn btn-back">
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </a>
    </div>

    <!-- Content Grid -->
    <div class="row g-4">
        <!-- Left Column - Material Detail -->
        <div class="col-lg-4">
            <div class="glass-card">
                <div class="card-header-glass">
                    <h6 class="m-0 font-weight-bold">
                        MATERIAL DETAIL (<?= $materianName ?>)
                    </h6>
                </div>
                <div class="card-body-glass">
                    <form action="<?=base_url()?>transaction/sell-add-to-cart/" method="post">
                        <input type="hidden" name="idMaterial" value="<?=$this->uri->segment(3)?>">
                        
                        <?php if (in_array($this->uri->segment(3), array("13"))): ?>
                        <div class="form-group">
                            <label>POTONGAN</label>
                            <select required class="form-control select2-glass" name="tahun_potongan">
                                <option value="">Pilih Potongan</option>
                                <?php
                                $tahun_mulai = 2018;
                                while ($tahun_mulai <= date('Y') + 1): ?>
                                    <option value="<?=$tahun_mulai?>">LM Certi <?=$tahun_mulai?></option>
                                    <?php $tahun_mulai++;
                                endwhile; ?>
                            </select>
                        </div>
                        <?php endif; ?>

                        <?php if (in_array($this->uri->segment(3), array("18"))): ?>
                        <div class="form-group">
                            <label>WEIGHT</label>
                            <select required class="form-control select2-glass" name="idConfig" id="idConfig">
                                <option value="">Pilih Berat</option>
                                <?php foreach ($configMaterial as $key => $value): ?>
                                    <option value="<?=$value->id?>"><?=$value->size?> Gr</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php else: ?>
                        <div class="form-group">
                            <label>WEIGHT</label>
                            <input type="number" step="any" name="weight" id="weight" required class="form-control input-glass">
                        </div>
                        <?php endif; ?>

                        <div class="form-group mb-0">
                            <input type="submit" class="btn btn-primary btn-block btn-lg" value="Add To Cart">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Column - Cart -->
        <div class="col-lg-8">
            <div class="glass-card">
                <div class="card-header-glass">
                    <h6 class="m-0 font-weight-bold">
                        SELL CART
                    </h6>
                </div>
                <div class="card-body-glass">
                    <div class="table-responsive">
                        <table class="table glass-table" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Material</th>
                                    <th>Type</th>
                                    <th>Carat</th>
                                    <th>Weight</th>
                                    <th>Price/Gr</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;
                                foreach ($this->cart->contents() as $a):
                                    $no++; ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $a['materialName'] ?></td>
                                        <td><?= $a['materialType'] ?></td>
                                        <td><?= $a['carat'] ?></td>
                                        <td><?= $a['weight'] ?></td>
                                        <td><?= ($a['materialName'] != 'DIAMOND') ? nominal($a['prices']) : $a['prices'] ?></td>
                                        <td><?= nominal($a['priceTotal']) ?></td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger btn-circle" onclick="confirmDelete('<?=base_url()?>transaction/sell-add-to-cart-reset/?idMaterial=<?=$this->uri->segment(3)?>&idRow=<?=$a['rowid']?>')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <form id="checkoutForm" action="<?=base_url()?>transaction/sell-checkout/" method="POST">
                        <div class="row g-3 mt-3">
                            <div class="col-md-3">
                                <p class="mb-2" style="color: var(--turquoise-surf); font-weight: 600;">PLUS/MINUS</p>
                                <select name="operator" id="operator" class="form-control select2-glass" onchange="updateTotal()">
                                    <option value="+">+</option>
                                    <option value="-">-</option>
                                </select>
                            </div>
                            <div class="col-md-9">
                                <p class="mb-2" style="color: var(--turquoise-surf); font-weight: 600;">BIAYA ADMIN</p>
                                <input type="number" step="any" class="form-control input-glass biayaAdmin" name="biayaAdmin" id="biayaAdmin" placeholder="Masukkan biaya admin" oninput="updateTotal()">
                            </div>
                        </div>
                        
                        <!-- Hidden inputs for checkout data -->
                        <input type="hidden" name="cabang_id" id="cabang_id" value="">
                        <input type="hidden" name="payment_method" id="payment_method" value="">
                        
                        <!-- Total Summary -->
                        <div class="mt-4 p-3" style="background: var(--glass-bg); border-radius: 12px; border: 1px solid var(--glass-border);">
                            <div class="d-flex justify-content-between align-items-center">
                                <span style="color: var(--text-secondary); font-weight: 500;">Subtotal</span>
                                <span id="subtotalDisplay" style="color: var(--text-primary); font-weight: 600; font-size: 1.1rem;">RP <?= nominal($total) ?></span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <span style="color: var(--text-secondary); font-weight: 500;">Admin Fee</span>
                                <span id="adminFeeDisplay" style="color: var(--text-primary); font-weight: 600; font-size: 1.1rem;">RP 0</span>
                            </div>
                            <hr style="border-color: var(--glass-border); margin: 12px 0;">
                            <div class="d-flex justify-content-between align-items-center">
                                <span style="color: var(--text-primary); font-weight: 600; font-size: 1.2rem;">TOTAL</span>
                                <span id="totalDisplay" style="color: var(--text-primary); font-weight: 700; font-size: 1.4rem;">RP <?= nominal($total) ?></span>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-footer-glass">
                    <a href="#" data-toggle="modal" data-target="#resetModal" class="btn btn-danger">
                        <i class="fas fa-times"></i>
                        <span>Reset</span>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#checkoutModal" class="btn btn-success" onclick="prepareCheckout()">
                        <i class="fas fa-check"></i>
                        <span>Checkout</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Checkout Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content glass-modal">
            <div class="modal-header">
                <h5 class="modal-title">Checkout Summary</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Customer Information -->
                <div class="mb-4 p-3" style="background: var(--glass-bg); border-radius: 12px; border: 1px solid var(--glass-border);">
                    <h6 style="color: var(--turquoise-surf); font-weight: 600; margin-bottom: 15px;">Informasi Customer</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <span style="color: var(--text-secondary); font-size: 0.85rem;">Nama Customer</span>
                                <p style="color: var(--text-primary); font-weight: 600; margin: 0;"><?= $nameCustomer ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <span style="color: var(--text-secondary); font-size: 0.85rem;">Tanggal Transaksi</span>
                                <p style="color: var(--text-primary); font-weight: 600; margin: 0;"><?= date('d/m/Y H:i') ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <span style="color: var(--text-secondary); font-size: 0.85rem;">Jumlah Item</span>
                                <p style="color: var(--text-primary); font-weight: 600; margin: 0;"><?= count($this->cart->contents()) ?> Item</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Payment Summary -->
                <div class="mb-4 p-3" style="background: var(--glass-bg); border-radius: 12px; border: 1px solid var(--glass-border);">
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="color: var(--text-secondary);">Subtotal</span>
                        <span id="modalSubtotal" style="color: var(--text-primary); font-weight: 600;">RP <?= nominal($total) ?></span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <span style="color: var(--text-secondary);">Admin Fee</span>
                        <span id="modalAdminFee" style="color: var(--text-primary); font-weight: 600;">RP 0</span>
                    </div>
                    <hr style="border-color: var(--glass-border); margin: 12px 0;">
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="color: var(--text-primary); font-weight: 600; font-size: 1.1rem;">TOTAL</span>
                        <span id="modalTotal" style="color: var(--text-primary); font-weight: 700; font-size: 1.3rem;">RP <?= nominal($total) ?></span>
                    </div>
                </div>

                <!-- Pilih Cabang -->
                <div>
                    <h6 style="color: var(--turquoise-surf); font-weight: 600; margin-bottom: 15px;">
                        cabang
                    </h6>

                    <div class="form-group">                        
                        <select name="cabang_id" id="modalCabang" 
                                class="form-control select2-glass" 
                                style="margin-top: 5px;">

                            <option value="">Pilih cabang</option>

                            <?php if (!empty($cabang)): ?>
                                <?php foreach ($cabang as $c): ?>
                                    <option value="<?= $c->id ?>"
                                        <?= ($c->id == $this->session->userdata('cabang_id')) ? 'selected' : '' ?>>
                                        <?= $c->nama_cabang ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </select>
                    </div>
                </div>
                
                <!-- Payment Method -->
                <div>
                    <h6 style="color: var(--turquoise-surf); font-weight: 600; margin-bottom: 15px;">Metode Pembayaran</h6>
                    <div class="form-group">
                        <div class="payment-method-options" style="display: flex; flex-wrap: wrap; gap: 15px;">
                            <div class="payment-option" style="display: flex; align-items: center; gap: 5px;">
                                <input type="checkbox" name="paymentMethod[]" id="paymentMethod_cash" value="cash" class="payment-checkbox" style="width: 18px; height: 18px;">
                                <label for="paymentMethod_cash" style="margin: 0; cursor: pointer; color: var(--text-primary);">Cash</label>
                            </div>
                            <div class="payment-option" style="display: flex; align-items: center; gap: 5px;">
                                <input type="checkbox" name="paymentMethod[]" id="paymentMethod_transfer" value="transfer" class="payment-checkbox" style="width: 18px; height: 18px;">
                                <label for="paymentMethod_transfer" style="margin: 0; cursor: pointer; color: var(--text-primary);">Transfer Bank</label>
                            </div>
                            <div class="payment-option" style="display: flex; align-items: center; gap: 5px;">
                                <input type="checkbox" name="paymentMethod[]" id="paymentMethod_credit" value="credit" class="payment-checkbox" style="width: 18px; height: 18px;">
                                <label for="paymentMethod_credit" style="margin: 0; cursor: pointer; color: var(--text-primary);">Kartu Kredit</label>
                            </div>
                            <div class="payment-option" style="display: flex; align-items: center; gap: 5px;">
                                <input type="checkbox" name="paymentMethod[]" id="paymentMethod_debit" value="debit" class="payment-checkbox" style="width: 18px; height: 18px;">
                                <label for="paymentMethod_debit" style="margin: 0; cursor: pointer; color: var(--text-primary);">Kartu Debit</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info" type="button" onclick="openPdfPreview('sell')">
                    <i class="fas fa-file-pdf"></i>
                    <span>Preview PDF</span>
                </button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="confirmCheckout()">Konfirmasi Checkout</button>
            </div>
        </div>
    </div>
</div>

<!-- PDF Preview Modal -->
<div class="modal fade" id="pdfPreviewModal" tabindex="-1" role="dialog" aria-labelledby="pdfPreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document" style="max-width: 95%;">
        <div class="modal-content glass-modal" style="height: 90vh;">
            <div class="modal-header">
                <h5 class="modal-title">Invoice Preview</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 0; height: calc(100% - 60px);">
                <iframe id="pdfPreviewFrame" src="" style="width: 100%; height: 100%; border: none;"></iframe>
            </div>
        </div>
    </div>
</div>

<!-- Reset Modal -->
<div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content glass-modal">
            <div class="modal-header">
                <h5 class="modal-title">Reset Transaksi?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body"><p style="color: #03045E !important;">Semua item di keranjang akan dihapus.</p></div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-danger" href="<?=base_url()?>transaction/sell-add-to-cart-reset/?idMaterial=<?=$this->uri->segment(3)?>">Ya, Reset</a>
            </div>
        </div>
    </div>
</div>

<style>
/* Page Container */
.page-container {
    padding: 110px 20px 40px;
    max-width: 1600px;
    margin: 0 auto;
}

/* Breadcrumb */
.breadcrumb.glass-breadcrumb {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    background: var(--glass-bg);
    backdrop-filter: var(--glass-blur);
    border: 1px solid var(--glass-border);
    border-radius: 14px;
    padding: 14px 20px;
    list-style: none;
    margin-bottom: 24px;
}

.breadcrumb.glass-breadcrumb .breadcrumb-item {
    display: flex;
    align-items: center;
    gap: 8px;
}

.breadcrumb.glass-breadcrumb .breadcrumb-item a {
    color: var(--turquoise-surf);
    text-decoration: none;
    font-weight: 500;
}

.breadcrumb.glass-breadcrumb .breadcrumb-item.active {
    color: var(--text-primary);
    font-weight: 500;
}

.breadcrumb.glass-breadcrumb .breadcrumb-item:not(:last-child)::after {
    content: '/';
    color: var(--text-muted);
    margin-left: 8px;
}

/* Page Title */
.page-title {
    text-align: center;
    color: #A8F1FF;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 8px;
    text-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
}

.page-subtitle {
    text-align: center;
    color: #A8F1FF;
    font-size: 1.25rem;
    font-weight: 500;
    margin-bottom: 32px;
}

/* Back Button */
.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 24px;
    background: var(--glass-bg);
    backdrop-filter: var(--glass-blur);
    border: 1px solid var(--glass-border);
    border-radius: 12px;
    color: var(--text-primary);
    font-weight: 500;
    text-decoration: none;
}

.btn-back:hover {
    background: var(--turquoise-surf);
    color: #000;
}

/* Glass Card */
.glass-card {
    background: var(--card-gradient);
    backdrop-filter: var(--glass-blur);
    border: 1px solid var(--glass-border);
    border-radius: 24px;
    overflow: hidden;
    position: relative;
    height: 100%;
}

.glass-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 50%;
    background: linear-gradient(180deg, rgba(255,255,255,0.08) 0%, transparent 100%);
    pointer-events: none;
}

/* Card Header */
.card-header-glass {
    background: rgba(0, 180, 216, 0.1);
    border-bottom: 1px solid var(--glass-border);
    padding: 16px 20px;
}

.card-header-glass .m-0 {
    color: var(--turquoise-surf);
    font-weight: 600;
}

/* Card Body */
.card-body-glass {
    padding: 20px;
}

/* Card Footer */
.card-footer-glass {
    padding: 16px 20px;
    border-top: 1px solid var(--glass-border);
    display: flex;
    gap: 12px;
    justify-content: flex-end;
}

/* Form Group */
.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    color: var(--turquoise-surf);
    font-weight: 600;
    font-size: 0.85rem;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Glass Input */
.input-glass, .select2-glass {
    width: 100%;
    padding: 12px 16px;
    background: var(--glass-bg);
    backdrop-filter: var(--glass-blur);
    border: 1px solid var(--glass-border);
    border-radius: 12px;
    color: var(--text-primary);
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.input-glass:focus, .select2-glass:focus {
    outline: none;
    border-color: var(--turquoise-surf);
    box-shadow: 0 0 0 4px rgba(0, 180, 216, 0.15);
}

/* Glass Table */
.glass-table {
    width: 100%;
    border-collapse: collapse;
    color: var(--text-primary);
    font-size: 0.9rem;
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
    padding: 12px 14px;
    border-bottom: 1px solid var(--glass-border);
}

.glass-table tbody tr:hover {
    background: var(--glass-bg-hover);
}

/* Buttons */
.btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 12px;
    font-weight: 500;
    font-size: 0.9rem;
    text-decoration: none;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    color: #fff;
}

.btn-success {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: #fff;
}

.btn-danger {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: #fff;
}

.btn-secondary {
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    color: var(--text-primary);
}

.btn-secondary:hover {
    background: var(--glass-bg-hover);
}

.btn-circle {
    width: 32px;
    height: 32px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

.btn-lg {
    padding: 14px 28px;
    font-size: 1rem;
}

.btn-block {
    width: 100%;
    justify-content: center;
}

/* Modal */
.glass-modal {
    background: var(--card-gradient);
    backdrop-filter: var(--glass-blur);
    border: 1px solid var(--glass-border);
    border-radius: 20px;
}

.glass-modal .modal-header {
    border-bottom: 1px solid var(--glass-border);
    padding: 20px 24px;
}

.glass-modal .modal-title {
    color: var(--text-primary);
    font-weight: 600;
}

.glass-modal .modal-body {
    padding: 24px;
    color: var(--text-primary);
}

.glass-modal .modal-footer {
    border-top: 1px solid var(--glass-border);
    padding: 16px 24px;
}

/* Responsive */
@media (max-width: 992px) {
    .page-container {
        padding: 90px 15px 30px;
    }

    .page-title {
        font-size: 2rem;
    }

    .glass-card {
        margin-bottom: 24px;
    }
}

@media (max-width: 576px) {
    .page-title {
        font-size: 1.75rem;
    }

    .page-subtitle {
        font-size: 1rem;
    }

    .card-body-glass {
        padding: 16px;
    }

    .glass-table {
        font-size: 0.8rem;
    }

    .glass-table th, .glass-table td {
        padding: 8px 10px;
    }

    .card-footer-glass {
        flex-direction: column;
    }

    .card-footer-glass .btn {
        width: 100%;
        justify-content: center;
    }
}
</style>

<script type="text/javascript">
$("#materialType").select2();
$(".select2").select2();
</script>

<script>
var subtotal = <?= $total ?>;

function formatRupiah(angka) {
    return 'RP ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function updateTotal() {
    var operator = document.getElementById('operator').value;
    var biayaAdmin = parseFloat(document.getElementById('biayaAdmin').value) || 0;
    
    var adminFee = operator === '+' ? biayaAdmin : -biayaAdmin;
    var total = subtotal + adminFee;
    
    document.getElementById('adminFeeDisplay').textContent = formatRupiah(Math.abs(adminFee));
    document.getElementById('totalDisplay').textContent = formatRupiah(total);
    
    // Also update modal
    document.getElementById('modalAdminFee').textContent = formatRupiah(Math.abs(adminFee));
    document.getElementById('modalTotal').textContent = formatRupiah(total);
}

function prepareCheckout() {
    updateTotal();
}

function confirmCheckout() {
    var paymentMethodCheckboxes = document.querySelectorAll('input[name="paymentMethod[]"]:checked');
    var cabangId = document.getElementById('modalCabang').value;
    
    // Validate payment method - at least one must be selected
    if (paymentMethodCheckboxes.length === 0) {
        alert('Silakan pilih setidaknya satu metode pembayaran');
        return;
    }
    
    // Validate cabang
    if (!cabangId) {
        alert('Silakan pilih cabang');
        return;
    }
    
    // Collect all selected payment methods as comma-separated string
    var paymentMethods = [];
    paymentMethodCheckboxes.forEach(function(checkbox) {
        paymentMethods.push(checkbox.value);
    });
    var paymentMethodString = paymentMethods.join(',');
    
    // Set hidden field values
    document.getElementById('payment_method').value = paymentMethodString;
    document.getElementById('cabang_id').value = cabangId;
    
    // Submit the form
    document.getElementById('checkoutForm').submit();
}

function confirmDelete(url) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Item ini akan dihapus dari keranjang!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        customClass: {
            popup: 'glass-swal-popup'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}

jQuery(function ($) {
    // Initialize keyboard for biayaAdmin with real-time update
    $('#biayaAdmin').keyboard({
        layout: 'num',
        restrictInput: true,
        preventPaste: true,
        autoAccept: true
    }).on('keyboardChange keyup', function(e, keyboard, el) {
        // Real-time update when keyboard is used
        updateTotal();
    });
    
    // Also listen to standard input event for non-keyboard input
    $('#biayaAdmin').on('input', function() {
        updateTotal();
    });
    
$('#weight').keyboard({
        layout: 'num',
        restrictInput: true,
        preventPaste: true,
        autoAccept: true
    });
    
    // Note: #idConfig is a select element, so no keyboard needed
    // $('#idConfig').keyboard({
    //     layout: 'num',
    //     restrictInput: true,
    //     preventPaste: true,
    //     autoAccept: true
    // });
    
    prettyPrint();
});

function openPdfPreview(type) {
    var idTransaction = '<?= $this->session->userdata("idTransaction") ?>';
    
    if (!idTransaction) {
        alert('Silakan tambah item ke cart terlebih dahulu');
        return;
    }
    
    // Get values from the form
    var cabangId = $('#modalCabang').val();
    
    // Get all checked payment methods
    var paymentMethodCheckboxes = document.querySelectorAll('input[name="paymentMethod[]"]:checked');
    var paymentMethods = [];
    paymentMethodCheckboxes.forEach(function(checkbox) {
        paymentMethods.push(checkbox.value);
    });
    var paymentMethod = paymentMethods.join(',');
    
    var biayaAdmin = $('#biayaAdmin').val();
    var operator = $('#operator').val();
    
    // Validate at least one payment method selected
    if (paymentMethods.length === 0) {
        alert('Silakan pilih setidaknya satu metode pembayaran');
        return;
    }
    
    // Store in session via AJAX before opening preview
    $.ajax({
        url: '<?= base_url() ?>transaction/store-preview-data',
        type: 'POST',
        data: {
            cabang_id: cabangId,
            payment_method: paymentMethod,
            biaya_admin: biayaAdmin,
            operator: operator
        },
        success: function() {
            var previewUrl = '<?= base_url() ?>report/' + type + '-print-preview/' + idTransaction;
            
            $('#pdfPreviewFrame').attr('src', previewUrl);
            $('#pdfPreviewModal').modal('show');
        }
    });
}
</script>
