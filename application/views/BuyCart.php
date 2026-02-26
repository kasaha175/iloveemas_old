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
    <h5 class="page-subtitle">Checkout Session</h5>

    <!-- Back Button -->
    <div class="mb-3">
        <a href="<?=base_url()?>transaction/buy/" class="btn-back">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="row">

        <!-- LEFT COLUMN -->
        <div class="col-lg-4 mb-4">
            <div class="glass-card">
                <div class="card-header-glass">
                    <h6 class="m-0">
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
                                   name="carat" required
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
                                   name="percentage" required
                                   class="form-control input-glass"
                                   autocomplete="off">
                        </div>
                        <?php endif; ?>

                        <?php if (in_array($this->uri->segment(3), array("1"))): ?>
                        <div class="form-group">
                            <label>PRICE</label>
                            <input type="number" step="any" inputmode="decimal"
                                   name="price" required
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
                                   name="weight" required
                                   class="form-control input-glass"
                                   autocomplete="off">
                        </div>
                        <?php endif; ?>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary btn-block">
                                Add To Cart
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN -->
        <div class="col-lg-8">
            <div class="glass-card">
                <div class="card-header-glass">
                    <h6 class="m-0">
                        BUY CART (<?= $nameCustomer ?>)
                        → RP <?= nominal($total) ?>
                    </h6>
                </div>

                <div class="card-body-glass">

                    <div class="table-responsive">
                        <table class="table glass-table cart-table">
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

                    <form action="<?=base_url()?>transaction/buy-checkout/">
                        <div class="form-row mt-3">
                            <div>
                                <label>PLUS / MINUS BIAYA ADMIN</label>
                                <select name="operator" class="form-control select2-glass">
                                    <option value="+">Plus (+)</option>
                                    <option value="-">Minus (-)</option>
                                </select>
                            </div>
                            <div>
                                <label>&nbsp;</label>
                                <input type="number"
                                       name="biayaAdmin"
                                       step="any"
                                       inputmode="decimal"
                                       autocomplete="off"
                                       class="form-control input-glass"
                                       placeholder="Masukkan biaya admin">
                            </div>
                        </div>
                    </form>

                </div>

                <div class="card-footer-glass">
                    <a href="#" data-toggle="modal" data-target="#resetModal"
                       class="btn btn-danger">
                        Reset
                    </a>
                    <a href="#" data-toggle="modal" data-target="#checkoutModal"
                       class="btn btn-success">
                        Checkout
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>