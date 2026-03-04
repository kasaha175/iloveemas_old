<div class="col-md-12 report-container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb glass-breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url()?>dashboard/"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active">Report</li>
        </ol>
    </nav>
    
    <!-- Page Title -->
    <h3 class="page-title">REPORT</h3>
    
    <!-- Report Menu Grid -->
    <div class="report-grid">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <a href="<?=base_url()?>report/all/?dateStart=<?= date('Y-m-01'); ?>&dateEnd=<?= date('Y-m-t'); ?>" class="menu-box">
                    <i class="fas fa-list icon"></i>
                    <span>ALL TRANSACTIONS</span>
                    <small class="menu-desc">Combined Buy & Sell</small>
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="<?=base_url()?>report/buy/?dateStart=<?= date('Y-m-01'); ?>&dateEnd=<?= date('Y-m-t'); ?>" class="menu-box">
                    <i class="fas fa-shopping-cart icon"></i>
                    <span>BUY</span>
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="<?=base_url()?>report/sell/?dateStart=<?= date('Y-m-01'); ?>&dateEnd=<?= date('Y-m-t'); ?>" class="menu-box">
                    <i class="fas fa-arrow-up icon"></i>
                    <span>SELL</span>
                </a>
            </div>
            <!-- <div class="col-md-6 col-lg-4">
                <a href="<?=base_url()?>report/buy-graph/" class="menu-box">
                    <i class="fas fa-chart-line icon"></i>
                    <span>BUY GRAPH</span>
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="<?=base_url()?>report/sell-graph/" class="menu-box">
                    <i class="fas fa-chart-bar icon"></i>
                    <span>SELL GRAPH</span>
                </a>
            </div> -->
        </div>
        
        <!-- Back Button -->
        <div class="mt-4 text-center">
            <a href="<?=base_url()?>dashboard/" class="btn btn-primary btn-lg">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Dashboard</span>
            </a>
        </div>
    </div>
</div>

<style>
.report-container {
    padding: 100px 20px 40px;
    max-width: 1200px;
    margin: 0 auto;
}

.page-title {
    text-align: center;
    color: var(--text-primary);
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 40px;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.report-grid {
    max-width: 900px;
    margin: 0 auto;
}

.report-grid .row {
    gap: 20px 0;
}

.report-grid .menu-box {
    min-height: 120px;
}

.menu-desc {
    display: block;
    font-size: 0.75rem;
    color: var(--text-secondary);
    margin-top: 5px;
    font-weight: normal;
}

@media (max-width: 768px) {
    .report-container {
        padding: 90px 15px 30px;
    }
    
    .page-title {
        font-size: 1.5rem;
        margin-bottom: 30px;
    }
    
    .report-grid .menu-box {
        min-height: 100px;
        font-size: 0.9rem;
    }
}
</style>
