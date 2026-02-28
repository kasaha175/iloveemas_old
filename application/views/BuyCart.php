<?php
error_reporting(0);
$total = 0;
foreach ($this->cart->contents() as $a) {
    $total += $a['priceTotal'];
}

function nominal($angka) {
    return number_format(floor($angka), 0, ',', '.');
}
?>

<div class="col-md-12 page-container">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb glass-breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?=base_url()?>dashboard/">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?=base_url()?>transaction/">Transaction</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?=base_url()?>transaction/buy">Buy</a>
            </li>
            <li class="breadcrumb-item active">Cart</li>
        </ol>
    </nav>

    <!-- Page Title -->
    <h3 class="page-title">BUY</h3>
    <h3 class="page-subtitle">Checkout Session</h3>

    <!-- Back Button -->
    <div class="mb-4">
        <a href="<?=base_url()?>transaction/buy/" class="btn btn-back">
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </a>
    </div>

    <div class="row g-4">

        <!-- LEFT COLUMN -->
        <div class="col-lg-4 mb-4">
            <div class="glass-card">
                <div class="card-header-glass">
                    <h6 class="m-0 font-weight-bold">
                        MATERIAL DETAIL (<?= $materianName ?>)
                        <?php if (!empty($_GET['t'])): ?>
                            <br><small><?= ucwords($_GET['t']) ?> Material</small>
                        <?php endif; ?>
                    </h6>
                </div>

                <div class="card-body-glass">
                    <form action="<?=base_url()?>transaction/buy-add-to-cart/" method="post">

                        <input type="hidden" name="idMaterial" value="<?=$this->uri->segment(3)?>">
                        <input type="hidden" name="types" value="<?=$_GET['t']?>">

                        <?php if (in_array($this->uri->segment(3), array("2","5","6","7","8","9","10"))): ?>
                        <div class="form-group">
                            <label>TYPE</label>
                            <select name="materialType" required class="form-control select2-glass">
                                <?php foreach ($materialType as $m): ?>
                                    <option><?=$m->mt_name?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php endif; ?>

                        <?php if (in_array($this->uri->segment(3), array("5"))): ?>
                        <div class="form-group">
                            <label>PRESENTASI</label>
                            <input type="number" step="any" inputmode="decimal"
                                   name="carat" id="carat" required
                                   class="form-control input-glass"
                                   autocomplete="off">
                        </div>
                        <?php endif; ?>

                        <?php if (in_array($this->uri->segment(3), array("2","23"))): ?>
                        <div class="form-group">
                            <label>CARAT</label>
                            <select name="carat" required class="form-control select2-glass">
                                <?php foreach ($carat as $c): ?>
                                    <option><?=$c->c_name?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php endif; ?>

                        <?php if (in_array($this->uri->segment(3), array("6","7","8","9","10","19","21"))): ?>
                        <div class="form-group">
                            <label>PERCENTAGE</label>
                            <input type="number" step="any" inputmode="decimal"
                                   name="percentage" id="percentage" required
                                   class="form-control input-glass"
                                   autocomplete="off">
                        </div>
                        <?php endif; ?>

                        <?php if (in_array($this->uri->segment(3), array("1"))): ?>
                        <div class="form-group">
                            <label>PRICE</label>
                            <input type="number" step="any" inputmode="decimal"
                                   name="price" id="price" required
                                   class="form-control input-glass"
                                   autocomplete="off">
                        </div>
                        <?php endif; ?>

                        <?php if (in_array($this->uri->segment(3), array("3"))): ?>
                        <div class="form-group">
                            <label>POTONGAN</label>
                            <select name="tahun_potongan" required class="form-control select2-glass">
                                <option value="">Pilih Potongan</option>
                                <?php
                                $tahun_mulai = 2018;
                                while ($tahun_mulai <= date('Y') + 1): ?>
                                    <option value="<?=$tahun_mulai?>">
                                        LM Certi <?=$tahun_mulai?>
                                    </option>
                                <?php $tahun_mulai++; endwhile; ?>
                            </select>
                        </div>
                        <?php endif; ?>

                        <?php if (in_array($this->uri->segment(3), array("2","3","4","5","6","7","8","9","10","17","18","19","23","21"))): ?>
                        <div class="form-group">
                            <label>WEIGHT</label>
                            <input type="number" step="any" inputmode="decimal"
                                   name="weight" id="weight" required
                                   class="form-control input-glass"
                                   autocomplete="off">
                        </div>
                        <?php endif; ?>

                        <div class="form-group mb-0">
                            <input type="submit" class="btn btn-primary btn-block btn-lg" value="Add To Cart">
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN -->
        <div class="col-lg-8">
            <div class="glass-card">
                <div class="card-header-glass">
                    <h6 class="m-0 font-weight-bold">
                        BUY CART
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
                                    <th>Type Material</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($this->cart->contents() as $a): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $a['materialName'] ?></td>
                                    <td><?= $a['materialType'] ?></td>
                                    <td><?= $a['carat'] ?></td>
                                    <td><?= $a['weight'] ?></td>
                                    <td>
                                        <?= ($a['materialName'] != 'DIAMOND')
                                            ? nominal($a['prices'])
                                            : $a['prices'] ?>
                                    </td>
                                    <td><?= nominal($a['priceTotal']) ?></td>
                                    <td><?= $a['types'] ?></td>
                                    <td>
                                        <a href="<?=base_url()?>transaction/buy-add-to-cart-reset/?idMaterial=<?=$this->uri->segment(3)?>&idRow=<?=$a['rowid']?>&t=<?=$_GET['t'];?>"
                                           class="btn btn-sm btn-danger btn-circle">
                                           <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <form id="checkoutForm" action="<?=base_url()?>transaction/buy-checkout/">
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
                                <input type="number"
                                       name="biayaAdmin"
                                       id="biayaAdmin"
                                       step="any"
                                       inputmode="decimal"
                                       autocomplete="off"
                                       class="form-control input-glass biayaAdmin"
                                       placeholder="Masukkan biaya admin"
                                       oninput="updateTotal()">
                            </div>
                        </div>
                        
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
                        <div class="col-md-6">
                            <div class="mb-2">
                                <span style="color: var(--text-secondary); font-size: 0.85rem;">Material</span>
                                <p style="color: var(--text-primary); font-weight: 600; margin: 0;"><?= $materianName ?></p>
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
                
                <!-- Payment Method -->
                <div>
                    <h6 style="color: var(--turquoise-surf); font-weight: 600; margin-bottom: 15px;">Metode Pembayaran</h6>
                    <div class="form-group">
                        <select name="paymentMethod" id="paymentMethod" class="form-control select2-glass" required>
                            <option value="">Pilih Metode Pembayaran</option>
                            <option value="cash">Cash</option>
                            <option value="transfer">Transfer Bank</option>
                            <option value="credit">Kartu Kredit</option>
                            <option value="debit">Kartu Debit</option>
                            <option value="payment_gateway" disabled>Payment Gateway (Coming Soon)</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="confirmCheckout()">Konfirmasi Checkout</button>
            </div>
        </div>
    </div>
</div>

<!-- Reset Modal -->
<div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content glass-modal">
            <div class="modal-header">
                <h5 class="modal-title">Ready to Reset?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Reset" below if you are ready to end your cart session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" href="<?=base_url()?>transaction/buy-add-to-cart-reset/?idMaterial=<?=$this->uri->segment(3)?>">Reset</a>
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
    color: var(--text-primary);
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 8px;
    text-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
}

.page-subtitle {
    text-align: center;
    color: var(--turquoise-surf);
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
    color: var(--text-light);
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
    var biayaAdminInput = document.getElementById('biayaAdmin');
    var biayaAdmin = parseFloat(biayaAdminInput.value) || 0;
    
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
    var paymentMethod = document.getElementById('paymentMethod').value;
    if (!paymentMethod) {
        alert('Silakan pilih metode pembayaran');
        return;
    }
    
    // Submit the form
    document.getElementById('checkoutForm').submit();
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
    $('#price').keyboard({
        layout: 'num',
        restrictInput: true,
        preventPaste: true,
        autoAccept: true
    });
    $('#carat').keyboard({
        layout: 'num',
        restrictInput: true,
        preventPaste: true,
        autoAccept: true
    });
    $('#percentage').keyboard({
        layout: 'num',
        restrictInput: true,
        preventPaste: true,
        autoAccept: true
    });
    prettyPrint();
});
</script>
