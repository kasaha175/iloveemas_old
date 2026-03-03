<?php
/**
 * Print Buy PDF View - Enterprise POS Style
 * Optimized for TCPDF with clean, professional layout
 */

// Helper function
if (!function_exists('nominal')) {
    function nominal($angka) {
        return number_format($angka, 0, ',', '.');
    }
}

$transaction = $data[0] ?? null;
if (!$transaction) {
    echo 'Transaction data not found';
    return;
}

// Get cabang data
$this->db->order_by('urutan_cabang', 'ASC');
$this->db->where('status', 'ENABLE');
$cabang = $this->db->get('tb_cabang')->result();
$selected_cabang = isset($transaction_header->t_cabang_id) ? $transaction_header->t_cabang_id : 0;

// Get memo
$this->db->order_by('tm_priority', 'asc');
$memo = $this->db->get('tb_memo')->result();

// Payment method
$selected_payment = isset($transaction_header->t_payment_method) ? $transaction_header->t_payment_method : '';
?>

<!-- Invoice Header -->
<table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
    <!-- Company Name -->
    <tr>
        <td colspan="7" align="center" style="border-bottom: 1px solid #000000; padding: 10px 0;">
            <span style="font-size: 18px; font-weight: bold;">PT MUARA LOGAM INDONESIA</span><br/>
            <span style="font-size: 10px;">www.iloveemas.co.id</span>
        </td>
    </tr>
</table>

<!-- Branch Selection -->
<table cellpadding="3" cellspacing="0" border="0" style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 9px;">
    <tr>
        <?php 
        $col = 0;
        foreach ($cabang as $c): 
            if ($col > 0 && $col % 2 == 0) echo '</tr><tr>';
            $col++;
        ?>
            <td width="5%" align="center">
                <?= ($c->id == $selected_cabang) ? '☒' : '☐' ?>
            </td>
            <td width="45%">
                <?= $c->nama_cabang ?>: <?= $c->alamat_cabang ?>
            </td>
        <?php endforeach; ?>
    </tr>
</table>

<br/>

<!-- Customer & Invoice Info Table -->
<table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
    <tr>
        <!-- Customer Info -->
        <td width="48%" valign="top" style="border: 1px solid #000000; padding: 8px;">
            <strong>VENDOR</strong><br/>
            <span style="border-top: 1px solid #000000; display: block; margin: 5px 0;"></span>
            Name: <?= ucwords(strtolower($transaction->nameCustomer)) ?><br/>
            ID Number: <?= strtoupper($transaction->c_id_number) ?><br/>
            Address: <?= ucwords(strtolower($transaction->c_address)) ?><br/>
            Resident: <?= $transaction->c_resident_address ?><br/>
            Phone: <?= $transaction->c_phone ?>
        </td>
        
        <!-- Spacing -->
        <td width="4%">&nbsp;</td>
        
        <!-- Invoice Details -->
        <td width="48%" valign="top" style="border: 1px solid #000000; padding: 8px;">
            <div align="center"><strong>PURCHASE PAYMENT</strong></div>
            <span style="border-top: 1px solid #000000; display: block; margin: 5px 0;"></span>
            <table cellpadding="2" cellspacing="0" border="0" style="width: 100%;">
                <tr>
                    <td width="50%" align="center" style="border: 1px solid #000000;">
                        <strong>Payment Date</strong><br/>
                        <?= date('d-M-y', strtotime($transaction->t_date_created)) ?>
                    </td>
                    <td width="50%" align="center" style="border: 1px solid #000000;">
                        <strong>Invoice No</strong><br/>
                        <?= $transaction->t_no_order ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<br/>

<!-- Items Table -->
<table cellpadding="4" cellspacing="0" border="0" style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
    <!-- Table Header -->
    <tr>
        <td width="8%" align="center" style="border: 1px solid #000000; background-color: #CCCCCC; font-weight: bold;">No</td>
        <td width="20%" align="center" style="border: 1px solid #000000; background-color: #CCCCCC; font-weight: bold;">Material</td>
        <td width="18%" align="center" style="border: 1px solid #000000; background-color: #CCCCCC; font-weight: bold;">Type</td>
        <td width="12%" align="center" style="border: 1px solid #000000; background-color: #CCCCCC; font-weight: bold;">Carat</td>
        <td width="12%" align="center" style="border: 1px solid #000000; background-color: #CCCCCC; font-weight: bold;">Weight (gr)</td>
        <td width="15%" align="center" style="border: 1px solid #000000; background-color: #CCCCCC; font-weight: bold;">Price/gr</td>
        <td width="15%" align="center" style="border: 1px solid #000000; background-color: #CCCCCC; font-weight: bold;">Amount</td>
    </tr>
    
    <!-- Items Data -->
    <?php $no = 0; ?>
    <?php foreach ($detail as $d): ?>
        <?php $no++; ?>
        <tr>
            <td align="center" style="border: 1px solid #000000;"><?= $no ?></td>
            <td style="border: 1px solid #000000;"><?= ($d->ti_material == 'Cust. Profesion') ? 'Gold' : htmlspecialchars($d->ti_material) ?></td>
            <td style="border: 1px solid #000000;"><?= htmlspecialchars($d->ti_material_type) ?></td>
            <td align="center" style="border: 1px solid #000000;"><?= htmlspecialchars($d->ti_carat) ?></td>
            <td align="center" style="border: 1px solid #000000;"><?= $d->ti_weight ?></td>
            <td align="right" style="border: 1px solid #000000;"><?= ($d->ti_price != '-') ? nominal($d->ti_price) : $d->ti_price ?></td>
            <td align="right" style="border: 1px solid #000000;"><?= nominal($d->ti_price_total) ?></td>
        </tr>
    <?php endforeach; ?>
    
    <!-- Admin Fee Row -->
    <tr>
        <td align="center" style="border: 1px solid #000000;">#</td>
        <td style="border: 1px solid #000000;" colspan="5"><strong>ADMIN FEE</strong></td>
        <td align="right" style="border: 1px solid #000000;"><?= nominal($transaction->t_price_admin) ?></td>
    </tr>
    
    <!-- Total Row -->
    <tr>
        <td colspan="5" style="border: 1px solid #000000;">
            <strong>Payment:</strong>
            <?= ($selected_payment == 'cash') ? '[X]' : '[ ]' ?> Cash
            <?= ($selected_payment == 'credit') ? '[X]' : '[ ]' ?> Credit
            <?= ($selected_payment == 'debit') ? '[X]' : '[ ]' ?> Debit
            <?= ($selected_payment == 'transfer') ? '[X]' : '[ ]' ?> Transfer
        </td>
        <td align="center" style="border: 1px solid #000000; background-color: #CCCCCC; font-weight: bold;">TOTAL</td>
        <td align="right" style="border: 1px solid #000000; background-color: #CCCCCC; font-weight: bold;"><?= nominal($transaction->t_price_total + $transaction->t_price_admin) ?></td>
    </tr>
</table>

<br/>

<!-- Terms and Conditions -->
<table cellpadding="3" cellspacing="0" border="0" style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 9px;">
    <tr>
        <td style="border: 1px solid #000000;">
            <strong>Syarat & Ketentuan:</strong><br/>
            <?php foreach ($memo as $m): ?>
                - <?= htmlspecialchars($m->tm_value) ?><br/>
            <?php endforeach; ?>
        </td>
    </tr>
</table>

<br/><br/>

<!-- Signature Section -->
<table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
    <tr>
        <td width="33%" align="center">
            <strong>Received By</strong><br/><br/><br/><br/>
            <?= strtoupper(strtolower($transaction->nameCustomer)) ?><br/>
            _________________________
        </td>
        <td width="34%" align="center">
            <strong>Paid By</strong><br/><br/><br/><br/>
            I LOVE EMAS<br/>
            _________________________
        </td>
        <td width="33%" align="center">
            <strong>Approved By</strong><br/><br/><br/><br/>
            _________________________
        </td>
    </tr>
</table>

<!-- Footer -->
<table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 8px;">
    <tr>
        <td align="center" style="padding-top: 15px;">
            Document generated on <?= date('Y-m-d H:i:s') ?>
        </td>
    </tr>
</table>

