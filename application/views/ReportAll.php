<?php 
function nominal($angka){
    $jd = number_format($angka, 0, ',', '.');
    return $jd;
}

// Get filter parameters
$currentType = $this->input->get('type') ?? 'all';
$currentStatus = $this->input->get('status') ?? '';
$dateStart = $this->input->get('dateStart') ?? date('Y-m-01');
$dateEnd = $this->input->get('dateEnd') ?? date('Y-m-t');
?>
<div class="col-md-12 report-detail-container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb glass-breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url()?>dashboard/"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active">Report</li>
        </ol>
    </nav>
    
    <!-- Page Title -->
    <h3 class="page-title">LAPORAN TRANSAKSI</h3>
    
    <!-- Tab Navigation -->
    <div class="tab-navigation">
        <div class="tab-buttons">
            <a href="<?=base_url()?>report/all/?type=all&dateStart=<?=$dateStart?>&dateEnd=<?=$dateEnd?>&status=<?=$currentStatus?>" 
               class="tab-btn <?=($currentType == 'all') ? 'active' : ''?>">
                <i class="fas fa-list"></i> ALL
            </a>
            <a href="<?=base_url()?>report/all/?type=buy&dateStart=<?=$dateStart?>&dateEnd=<?=$dateEnd?>&status=<?=$currentStatus?>" 
               class="tab-btn <?=($currentType == 'buy') ? 'active' : ''?>">
                <i class="fas fa-shopping-cart"></i> BUY
            </a>
            <a href="<?=base_url()?>report/all/?type=sell&dateStart=<?=$dateStart?>&dateEnd=<?=$dateEnd?>&status=<?=$currentStatus?>" 
               class="tab-btn <?=($currentType == 'sell') ? 'active' : ''?>">
                <i class="fas fa-arrow-up"></i> SELL
            </a>
        </div>
    </div>
    
    <!-- Quick Date Filters -->
    <?php
    // Helper to check if current dates match quick filter
    $isToday = ($dateStart == date('Y-m-d') && $dateEnd == date('Y-m-d'));
    $isThisWeek = ($dateStart == date('Y-m-d', strtotime('monday this week')) && $dateEnd == date('Y-m-d', strtotime('sunday this week')));
    $isThisMonth = ($dateStart == date('Y-m-01') && $dateEnd == date('Y-m-t'));
    $isThisYear = ($dateStart == date('Y-01-01') && $dateEnd == date('Y-12-31'));
    ?>
    <div class="quick-filters">
        <span class="quick-label"><i class="fas fa-bolt"></i> Quick:</span>
        <a href="<?=base_url()?>report/all/?type=<?=$currentType?>&dateStart=<?=date('Y-m-d')?>&dateEnd=<?=date('Y-m-d')?>&status=<?=$currentStatus?>" 
           class="quick-btn <?=$isToday ? 'active' : ''?>">
            Today
        </a>
        <a href="<?=base_url()?>report/all/?type=<?=$currentType?>&dateStart=<?=date('Y-m-d', strtotime('monday this week'))?>&dateEnd=<?=date('Y-m-d', strtotime('sunday this week'))?>&status=<?=$currentStatus?>" 
           class="quick-btn <?=$isThisWeek ? 'active' : ''?>">
            This Week
        </a>
        <a href="<?=base_url()?>report/all/?type=<?=$currentType?>&dateStart=<?=date('Y-m-01')?>&dateEnd=<?=date('Y-m-t')?>&status=<?=$currentStatus?>" 
           class="quick-btn <?=$isThisMonth ? 'active' : ''?>">
            This Month
        </a>
        <a href="<?=base_url()?>report/all/?type=<?=$currentType?>&dateStart=<?=date('Y-01-01')?>&dateEnd=<?=date('Y-12-31')?>&status=<?=$currentStatus?>" 
           class="quick-btn <?=$isThisYear ? 'active' : ''?>">
            This Year
        </a>
    </div>
    
    <!-- Filter Card -->
    <div class="col-md-12">
        <div class="card glass-card">
            <div class="card-header" data-toggle="collapse" data-target="#filterCard">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-filter"></i> Filter Data</h6>
            </div>
            <div class="collapse show" id="filterCard">
                <div class="card-body">
                    <form action="<?=base_url()?>report/all/">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Type</label>
                                    <select name="type" class="form-control glass-input">
                                        <option value="all" <?=($currentType == 'all') ? 'selected' : ''?>>ALL</option>
                                        <option value="buy" <?=($currentType == 'buy') ? 'selected' : ''?>>BUY</option>
                                        <option value="sell" <?=($currentType == 'sell') ? 'selected' : ''?>>SELL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Start Date</label>
                                    <input name="dateStart" required type="date" value="<?=$dateStart?>" class="form-control glass-input">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">End Date</label>
                                    <input name="dateEnd" required type="date" value="<?=$dateEnd?>" class="form-control glass-input">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control glass-input">
                                        <option value="">All Status</option>
                                        <option value="SELESAI" <?=($currentStatus == 'SELESAI') ? 'selected' : ''?>>SELESAI</option>
                                        <option value="PROSES" <?=($currentStatus == 'PROSES') ? 'selected' : ''?>>PROSES</option>
                                        <option value="CHECKOUT" <?=($currentStatus == 'CHECKOUT') ? 'selected' : ''?>>CHECKOUT</option>
                                        <option value="VOID" <?=($currentStatus == 'VOID') ? 'selected' : ''?>>VOID</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">&nbsp;</label>
                                    <div class="btn-group-filter">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-filter"></i> Filter
                                        </button>
                                        <button type="button" class="btn btn-secondary" onclick="resetFilter()">
                                            <i class="fas fa-redo"></i> Reset
                                        </button>
                                        <button type="button" class="btn btn-success" onclick="exportData()">
                                            <i class="fas fa-file-export"></i> Export
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row summary-cards">
        <div class="col-md-3">
            <div class="summary-card">
                <div class="summary-icon" style="background: linear-gradient(135deg, #10b981, #059669);">
                    <i class="fas fa-receipt"></i>
                </div>
                <div class="summary-content">
                    <span class="summary-label">Total Transaksi</span>
                    <span class="summary-value"><?=nominal($totalTransactions)?></span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="summary-card">
                <div class="summary-icon" style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="summary-content">
                    <span class="summary-label">Total Nilai</span>
                    <span class="summary-value">IDR <?=nominal($totalNilai)?></span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="summary-card">
                <div class="summary-icon" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);">
                    <i class="fas fa-calculator"></i>
                </div>
                <div class="summary-content">
                    <span class="summary-label">Rata-rata Transaksi</span>
                    <span class="summary-value">IDR <?=nominal($avgTransaction)?></span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="summary-card">
                <div class="summary-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                    <i class="fas fa-percentage"></i>
                </div>
                <div class="summary-content">
                    <span class="summary-label">Total Admin Fee</span>
                    <span class="summary-value">IDR <?=nominal($totalAdminFee)?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row charts-row">
        <!-- Transaction Trend Chart -->
        <div class="col-md-8">
            <div class="card glass-card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-chart-line"></i> Tren Transaksi</h6>
                </div>
                <div class="card-body chart-container">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Transaction Type Pie Chart -->
        <div class="col-md-4">
            <div class="card glass-card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-chart-pie"></i> Perbandingan</h6>
                </div>
                <div class="card-body chart-container">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Secondary Charts Row -->
    <div class="row charts-row-secondary">
        <!-- Monthly Comparison -->
        <div class="col-md-6">
            <div class="card glass-card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-chart-bar"></i> Perbandingan Bulanan</h6>
                </div>
                <div class="card-body chart-container-sm">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Summary Stats -->
        <div class="col-md-6">
            <div class="card glass-card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-analytics"></i> Statistik Ringkas</h6>
                </div>
                <div class="card-body">
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-label">Total Buy</span>
                            <span class="stat-value text-buy"><?=nominal($pieData['buy'])?> Transaksi</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Total Sell</span>
                            <span class="stat-value text-sell"><?=nominal($pieData['sell'])?> Transaksi</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Nilai Buy</span>
                            <span class="stat-value text-buy">IDR <?=nominal($pieData['buyTotal'] ?? 0)?></span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Nilai Sell</span>
                            <span class="stat-value text-sell">IDR <?=nominal($pieData['sellTotal'] ?? 0)?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="col-md-12">
        <div class="card glass-card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-list"></i> Data Transaksi</h6>
                <span class="badge badge-info ml-2"><?=strtoupper($currentType)?></span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Type</th>
                                <th>No Order</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Created By</th>
                                <th>Customer</th>
                                <th>Qtt</th>
                                <th>Price Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no=0; foreach($data as $a){ $no++; ?>
                            <tr>
                                <td><?=$no?></td>
                                <td>
                                    <?php if($a->t_type == 'BUY'): ?>
                                        <span class="badge badge-buy">BUY</span>
                                    <?php else: ?>
                                        <span class="badge badge-sell">SELL</span>
                                    <?php endif; ?>
                                </td>
                                <td><?=$a->t_no_order?></td>
                                <td><span class="badge badge-<?=strtolower($a->t_status)?>"><?=$a->t_status?></span></td>
                                <td><?=date('d/m/Y H:i', strtotime($a->t_date_created))?></td>
                                <td><?=$a->nameCreator?></td>
                                <td><?=$a->nameCustomer?></td>
                                <td><?=$a->t_qtt?></td>
                                <td>IDR <?=nominal(floatval($a->t_price_total) + floatval($a->t_price_admin ?? 0))?></td>
                                <td class="action-buttons">
                                    <a href="#" class="btn btn-info btn-circle btn-sm" title="Detail" onclick="openDetailModal(<?= $a->t_id ?>, '<?=strtolower($a->t_type)?>')">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Back Button -->
    <div class="col-md-12 mt-4 text-center">
        <a href="<?=base_url()?>dashboard/" class="btn btn-primary btn-lg">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Dashboard</span>
        </a>
    </div>
</div>

<!-- Detail Transaction Modal -->
<div class="modal fade" id="transactionDetailModal" tabindex="-1" role="dialog" aria-labelledby="transactionDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content glass-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="transactionDetailModalLabel">
                    <i class="fas fa-receipt"></i> Transaction Detail
                    <span id="modalTransactionType" class="badge badge-info ml-2">-</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #fff;">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalDetailBody">
                <!-- Loading State -->
                <div id="modalLoading" class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <p class="mt-3 text-muted">Loading transaction data...</p>
                </div>
                
                <!-- Content (will be populated by JS) -->
                <div id="modalContent" style="display: none;">
                    <!-- Transaction Info Card -->
                    <div class="card glass-card mb-3">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold"><i class="fas fa-info-circle"></i> Transaction Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <span class="info-label">No Order:</span>
                                        <span class="info-value" id="detailNoOrder">-</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <span class="info-label">Date:</span>
                                        <span class="info-value" id="detailDate">-</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <span class="info-label">Status:</span>
                                        <span class="info-value" id="detailStatus">-</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <span class="info-label">Cabang:</span>
                                        <span class="info-value" id="detailCabang">-</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Customer & Kasir Info -->
                    <div class="row">
                        <!-- Customer Info -->
                        <div class="col-md-6">
                            <div class="card glass-card mb-3">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold"><i class="fas fa-user"></i> Customer Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="info-item">
                                        <span class="info-label">Name:</span>
                                        <span class="info-value" id="detailCustomer">-</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Kasir Info -->
                        <div class="col-md-6">
                            <div class="card glass-card mb-3">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold"><i class="fas fa-user-tie"></i> Kasir Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="info-item">
                                        <span class="info-label">Created By:</span>
                                        <span class="info-value" id="detailCreatedBy">-</span>
                                    </div>
                                    <div class="info-item mt-2">
                                        <span class="info-label">Received By:</span>
                                        <span class="info-value" id="detailReceiveBy">-</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Transaction Items -->
                    <div class="card glass-card mb-3">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold"><i class="fas fa-box"></i> Transaction Items</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="detailItemsTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Material</th>
                                            <th>Type</th>
                                            <th>Carat</th>
                                            <th>Weight</th>
                                            <th>Price/Gr</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detailItemsBody">
                                        <!-- Items will be populated here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Summary & PDF -->
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card glass-card">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold"><i class="fas fa-calculator"></i> Summary</h6>
                                </div>
                                <div class="card-body">
                                    <div class="summary-row">
                                        <span class="summary-label">Total Quantity:</span>
                                        <span class="summary-value" id="detailTotalQty">-</span>
                                    </div>
                                    <div class="summary-row">
                                        <span class="summary-label">Sub Total:</span>
                                        <span class="summary-value" id="detailSubTotal">-</span>
                                    </div>
                                    <div class="summary-row">
                                        <span class="summary-label">Admin Fee:</span>
                                        <span class="summary-value" id="detailAdminFee">-</span>
                                    </div>
                                    <div class="summary-row">
                                        <span class="summary-label">Payment Method:</span>
                                        <span class="summary-value" id="detailPaymentMethod">-</span>
                                    </div>
                                    <div class="summary-row total">
                                        <span class="summary-label">Grand Total:</span>
                                        <span class="summary-value" id="detailTotalPrice">-</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card glass-card h-100">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold"><i class="fas fa-file-pdf"></i> Invoice</h6>
                                </div>
                                <div class="card-body d-flex align-items-center justify-content-center">
                                    <a id="detailPdfLink" href="#" target="_blank" class="btn btn-primary btn-block">
                                        <i class="fas fa-file-pdf"></i> View PDF
                                    </a>
                                    <span id="detailNoPdf" class="text-muted" style="display: none;">No PDF available</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
.report-detail-container {
    padding: 100px 20px 40px;
    max-width: 1600px;
    margin: 0 auto;
}

.page-title {
    text-align: center;
    color: var(--text-primary);
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 20px;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

/* Tab Navigation */
.tab-navigation {
    margin-bottom: 20px;
}

.tab-buttons {
    display: flex;
    justify-content: center;
    gap: 10px;
    flex-wrap: wrap;
}

.tab-btn {
    padding: 12px 30px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid var(--glass-border);
    border-radius: 30px;
    color: var(--text-secondary);
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
}

.tab-btn:hover {
    background: rgba(255, 255, 255, 0.1);
    color: var(--text-primary);
    transform: translateY(-2px);
}

.tab-btn.active {
    background: linear-gradient(135deg, var(--turquoise-surf), #059669);
    border-color: var(--turquoise-surf);
    color: white;
    box-shadow: 0 4px 15px rgba(6, 182, 140, 0.4);
}

/* Quick Filters */
.quick-filters {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.quick-label {
    color: var(--text-secondary);
    font-weight: 500;
}

.quick-btn {
    padding: 6px 15px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid var(--glass-border);
    border-radius: 20px;
    color: var(--text-secondary);
    text-decoration: none;
    font-size: 0.85rem;
    transition: all 0.3s ease;
}

.quick-btn:hover {
    background: rgba(255, 255, 255, 0.1);
    color: var(--text-primary);
}

.quick-btn.active {
    background: var(--turquoise-surf);
    border-color: var(--turquoise-surf);
    color: white;
}

/* Summary Cards */
.summary-cards {
    margin-bottom: 20px;
}

.summary-card {
    background: var(--card-gradient);
    border: 1px solid var(--glass-border);
    border-radius: 16px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    transition: all 0.3s ease;
}

.summary-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.summary-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    flex-shrink: 0;
}

.summary-content {
    display: flex;
    flex-direction: column;
}

.summary-label {
    color: var(--text-secondary);
    font-size: 0.85rem;
    margin-bottom: 5px;
}

.summary-value {
    color: var(--text-primary);
    font-size: 1.3rem;
    font-weight: 700;
}

/* Charts Row */
.charts-row {
    margin-bottom: 20px;
}

.charts-row .card-body {
    padding: 15px;
}

.chart-container {
    height: 200px !important;
    position: relative;
}

.chart-container-sm {
    height: 180px !important;
    position: relative;
}

.charts-row-secondary {
    margin-bottom: 20px;
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

.stat-item {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid var(--glass-border);
    border-radius: 10px;
    padding: 15px;
    text-align: center;
}

.stat-label {
    display: block;
    color: var(--text-secondary);
    font-size: 0.8rem;
    margin-bottom: 5px;
}

.stat-value {
    display: block;
    font-size: 1rem;
    font-weight: 700;
}

.text-buy {
    color: #10b981;
}

.text-sell {
    color: #3b82f6;
}

/* Card Styles */
.card.glass-card {
    margin-bottom: 20px;
}

.card-header {
    background: rgba(255, 255, 255, 0.05);
    border-bottom: 1px solid var(--glass-border);
    padding: 15px 20px;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-header h6 {
    color: var(--turquoise-surf);
    margin: 0;
}

.card-header:hover {
    background: rgba(255, 255, 255, 0.1);
}

.card-body {
    padding: 20px;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 5px;
    justify-content: center;
}

/* Badges */
.badge-buy {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.75rem;
}

.badge-sell {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.75rem;
}

.badge-selesai, .badge-completed {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.75rem;
}

.badge-proses, .badge-process {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.75rem;
}

.badge-checkout {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
    color: white;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.75rem;
}

.badge-void {
    background: linear-gradient(135deg, #6b7280, #4b5563);
    color: white;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.75rem;
}

/* Modal Styles */
.glass-modal {
    background: var(--card-gradient) !important;
    backdrop-filter: var(--glass-blur) !important;
    border: 1px solid var(--glass-border) !important;
    border-radius: 16px !important;
}

.glass-modal .modal-header {
    background: linear-gradient(180deg, rgba(255,255,255,0.1) 0%, transparent 100%) !important;
    border-bottom: 1px solid var(--glass-border) !important;
    border-radius: 16px 16px 0 0 !important;
    padding: 16px 20px !important;
}

.glass-modal .modal-header .modal-title {
    color: var(--text-primary) !important;
    font-weight: 600 !important;
}

.glass-modal .modal-body {
    padding: 20px !important;
    color: var(--text-light) !important;
}

.glass-modal .modal-footer {
    background: linear-gradient(0deg, rgba(255,255,255,0.05) 0%, transparent 100%) !important;
    border-top: 1px solid var(--glass-border) !important;
    border-radius: 0 0 16px 16px !important;
    padding: 14px 20px !important;
}

.glass-modal .close {
    color: var(--text-muted) !important;
    font-size: 1.5rem !important;
    font-weight: 300 !important;
    opacity: 0.7 !important;
}

.glass-modal .close:hover {
    color: #fff !important;
    opacity: 1 !important;
}

/* Info Item Styles */
.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.info-item:last-child {
    border-bottom: none;
}

.info-label {
    color: var(--text-secondary);
    font-size: 0.9rem;
    font-weight: 500;
}

.info-value {
    color: var(--text-primary);
    font-size: 0.9rem;
    font-weight: 600;
    text-align: right;
}

/* Summary Styles */
.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.summary-row:last-child {
    border-bottom: none;
}

.summary-row.total {
    border-top: 2px solid var(--turquoise-surf);
    border-bottom: none;
    padding-top: 15px;
    margin-top: 10px;
}

.summary-label {
    color: var(--text-secondary);
    font-size: 1rem;
    font-weight: 500;
}

.summary-value {
    color: var(--text-primary);
    font-size: 1.1rem;
    font-weight: 700;
}

.summary-row.total .summary-value {
    color: var(--turquoise-surf);
    font-size: 1.3rem;
}

/* Loading spinner */
.spinner-border {
    width: 3rem;
    height: 3rem;
    border-width: 0.3em;
}

/* Responsive */
@media (max-width: 768px) {
    .report-detail-container {
        padding: 90px 15px 30px;
    }
    
    .page-title {
        font-size: 1.5rem;
    }
    
    .tab-btn {
        padding: 10px 20px;
        font-size: 0.9rem;
    }
    
    .summary-card {
        padding: 15px;
    }
    
    .summary-icon {
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
    }
    
    .summary-value {
        font-size: 1.1rem;
    }
    
    .action-buttons {
        flex-wrap: wrap;
    }
    
    .btn-group-filter {
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
    }
    
    .btn-group-filter .btn {
        flex: 1;
        min-width: 80px;
        font-size: 0.8rem;
        padding: 8px 5px;
    }
}

/* Button Group Filter */
.btn-group-filter {
    display: flex;
    gap: 8px;
}

.btn-group-filter .btn {
    flex: 1;
}
</style>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Chart Data from PHP
const chartData = <?=json_encode($chartData)?>;
const pieData = <?=json_encode($pieData)?>;

// Initialize Charts
document.addEventListener('DOMContentLoaded', function() {
    initTrendChart();
    initPieChart();
    initBarChart();
});

// Trend Chart (Line Chart)
function initTrendChart() {
    const ctx = document.getElementById('trendChart');
    if (!ctx) return;
    
    new Chart(ctx.getContext('2d'), {
        type: 'line',
        data: {
            labels: chartData.labels,
            datasets: [
                {
                    label: 'Buy',
                    data: chartData.buy,
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 3,
                    pointHoverRadius: 5
                },
                {
                    label: 'Sell',
                    data: chartData.sell,
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 3,
                    pointHoverRadius: 5
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        color: '#aaa',
                        boxWidth: 12,
                        padding: 10,
                        font: { size: 11 }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    },
                    ticks: {
                        color: '#aaa',
                        font: { size: 10 },
                        callback: function(value) {
                            if (value >= 1000000) return 'IDR ' + (value/1000000).toFixed(1) + 'M';
                            if (value >= 1000) return 'IDR ' + (value/1000).toFixed(0) + 'K';
                            return 'IDR ' + value;
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#aaa',
                        font: { size: 10 },
                        maxRotation: 45
                    }
                }
            }
        }
    });
}

// Pie Chart
function initPieChart() {
    const ctx = document.getElementById('pieChart');
    if (!ctx) return;
    
    new Chart(ctx.getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Buy', 'Sell'],
            datasets: [{
                data: [pieData.buy || 0, pieData.sell || 0],
                backgroundColor: [
                    '#10b981',
                    '#3b82f6'
                ],
                borderColor: 'rgba(255, 255, 255, 0.2)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '60%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#aaa',
                        padding: 10,
                        font: { size: 11 },
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                }
            }
        }
    });
}

// Bar Chart
function initBarChart() {
    const ctx = document.getElementById('barChart');
    if (!ctx) return;
    
    new Chart(ctx.getContext('2d'), {
        type: 'bar',
        data: {
            labels: chartData.labels,
            datasets: [
                {
                    label: 'Buy',
                    data: chartData.buy,
                    backgroundColor: 'rgba(16, 185, 129, 0.7)',
                    borderColor: '#10b981',
                    borderWidth: 1,
                    borderRadius: 4
                },
                {
                    label: 'Sell',
                    data: chartData.sell,
                    backgroundColor: 'rgba(59, 130, 246, 0.7)',
                    borderColor: '#3b82f6',
                    borderWidth: 1,
                    borderRadius: 4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        color: '#aaa',
                        boxWidth: 12,
                        padding: 10,
                        font: { size: 11 }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    },
                    ticks: {
                        color: '#aaa',
                        font: { size: 10 },
                        callback: function(value) {
                            if (value >= 1000000) return (value/1000000).toFixed(1) + 'M';
                            if (value >= 1000) return (value/1000).toFixed(0) + 'K';
                            return value;
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#aaa',
                        font: { size: 10 },
                        maxRotation: 45
                    }
                }
            }
        }
    });
}

// Reset Filter
function resetFilter() {
    window.location.href = '<?=base_url()?>report/all/';
}

// Export Data
function exportData() {
    const currentType = '<?=$currentType?>';
    const dateStart = '<?=$dateStart?>';
    const dateEnd = '<?=$dateEnd?>';
    const status = '<?=$currentStatus?>';
    
    // Show loading
    Swal.fire({
        title: 'Mohon Tunggu',
        html: '<i class="fa fa-spin fa-refresh"></i> Menyiapkan data...',
        showConfirmButton: false,
    });
    
    // Redirect to export URL
    window.location.href = '<?=base_url()?>report/all/export?type=' + currentType + '&dateStart=' + dateStart + '&dateEnd=' + dateEnd + '&status=' + status;
}

// Function to open detail modal
function openDetailModal(transactionId, type) {
    // Show modal
    $('#transactionDetailModal').modal('show');
    
    // Reset modal content
    $('#modalLoading').show();
    $('#modalContent').hide();
    
    // Set transaction type badge
    $('#modalTransactionType').text(type.toUpperCase());
    
    // Determine which API endpoint to call based on type
    const apiUrl = type === 'sell' 
        ? "<?= base_url('report/getSellTransactionDetail') ?>" 
        : "<?= base_url('report/getBuyTransactionDetail') ?>";
    
    // Fetch data from API
    $.ajax({
        url: apiUrl,
        type: 'GET',
        data: { id: transactionId },
        dataType: 'json',
        success: function(response) {
            $('#modalLoading').hide();
            
            if (response.status === 'success') {
                $('#modalContent').show();
                
                const data = response.data;
                const transaction = data.transaction;
                const items = data.items;
                
                // Populate transaction info
                $('#detailNoOrder').text(transaction.no_order || '-');
                $('#detailDate').text(transaction.date_created ? formatDate(transaction.date_created) : '-');
                $('#detailStatus').html(getStatusBadge(transaction.status));
                $('#detailCabang').text(transaction.cabang || '-');
                
                // Populate customer info
                $('#detailCustomer').text(transaction.customer_name || '-');
                
                // Populate kasir info
                $('#detailCreatedBy').text(transaction.created_by || '-');
                $('#detailReceiveBy').text(transaction.receive_by || '-');
                
                // Populate items table
                populateItemsTable(items);
                
                // Populate summary
                $('#detailTotalQty').text(transaction.qtt || '0');
                $('#detailSubTotal').text('IDR ' + nominal(transaction.price_total));
                $('#detailAdminFee').text('IDR ' + nominal(transaction.admin_fee));
                $('#detailPaymentMethod').text(transaction.payment_method || '-');
                $('#detailTotalPrice').text('IDR ' + nominal(transaction.grand_total));
                
                // Handle PDF link
                if (transaction.pdf_path && transaction.pdf_filename) {
                    $('#detailPdfLink').show();
                    $('#detailNoPdf').hide();
                    $('#detailPdfLink').attr('href', '<?= base_url() ?>' + transaction.pdf_path);
                } else {
                    $('#detailPdfLink').hide();
                    $('#detailNoPdf').show();
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message || 'Failed to load transaction data'
                });
            }
        },
        error: function() {
            $('#modalLoading').hide();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to connect to server'
            });
        }
    });
}

// Populate items table
function populateItemsTable(items) {
    const tbody = $('#detailItemsBody');
    tbody.empty();
    
    if (items && items.length > 0) {
        let no = 1;
        items.forEach(function(item) {
            const row = `
                <tr>
                    <td>${no}</td>
                    <td>${item.ti_material || '-'}</td>
                    <td>${item.ti_material_type || '-'}</td>
                    <td>${item.ti_carat || '-'}</td>
                    <td>${item.ti_weight || '0'}</td>
                    <td>${item.ti_price !== '-' ? 'IDR ' + nominal(item.ti_price) : '-'}</td>
                    <td>IDR ${nominal(item.ti_price_total)}</td>
                </tr>
            `;
            tbody.append(row);
            no++;
        });
    } else {
        tbody.html('<tr><td colspan="7" class="text-center">No items found</td></tr>');
    }
}

// Format date
function formatDate(dateString) {
    if (!dateString) return '-';
    const date = new Date(dateString);
    const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
    return date.toLocaleDateString('id-ID', options);
}

// Get status badge HTML
function getStatusBadge(status) {
    const statusLower = (status || '').toLowerCase();
    let badgeClass = 'badge-secondary';
    
    if (statusLower === 'completed' || statusLower === 'selesai') {
        badgeClass = 'badge-selesai';
    } else if (statusLower === 'proses' || statusLower === 'process') {
        badgeClass = 'badge-proses';
    } else if (statusLower === 'checkout') {
        badgeClass = 'badge-checkout';
    } else if (statusLower === 'void') {
        badgeClass = 'badge-void';
    }
    
    return `<span class="badge ${badgeClass}">${status || '-'}</span>`;
}

// Format number to Indonesian Rupiah
function nominal(angka) {
    if (!angka || isNaN(angka)) return '0';
    return new Intl.NumberFormat('id-ID').format(angka);
}

// DataTable Initialization
$(document).ready(function () {
    $('#dataTable').DataTable({
        dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, 100, -1 ],
            [ '10 rows', '25 rows', '50 rows', '100 rows', 'Show all' ]
        ],
        buttons: [
            {
                extend: 'copyHtml5',
                text: '<i class="fa fa-clipboard"></i> Copy',
                className: 'btn btn-primary',
            },
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'A4',
                text: '<i class="fa fa-file-pdf-o"></i> PDF',
                className: 'btn btn-primary',
            },
            {
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel-o"></i> Excel',
                className: 'btn btn-primary',
            },
            {
                extend: 'csvHtml5',
                text: '<i class="fa fa-file-text-o"></i> CSV',
                className: 'btn btn-primary',
            },
            {
                extend: 'pageLength',
                text: '<i class="fa fa-list"></i> Show',
                className: 'btn btn-primary',
            }
        ],
    });
});
</script>

