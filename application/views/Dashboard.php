<div class="col-md-12 dashboard-container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb glass-breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url()?>dashboard/"><i class="fas fa-home fa-fw"></i> Dashboard</a></li>
        </ol>
    </nav>
    <!-- Welcome Section -->
    <div class="welcome-card">
        <div class="welcome-content">
            <div class="welcome-text">
                <h1 class="welcome-title">Selamat Datang, Administrator! 👋</h1>
                <p class="welcome-subtitle">Kelola bisnis emas Anda dengan mudah dan efisien</p>
            </div>
        </div>
    </div>
    
    <h3 class="dashboard-title">MENU UTAMA</h3>
    <p class="dashboard-subtitle">Kelola dan pantau seluruh operasional Anda dari sini.</p>
    
    <div class="container">
        <div class="row g-4 dashboard-grid">
            <div class="col-12 col-md-6 col-lg-3">
                <a href="<?=base_url()?>transaction-list/" class="menu-box animate-fade-in-up stagger-1">
                    <i class="fas fa-exchange-alt icon"></i>
                    <span>TRANSACTION</span>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <a href="<?=base_url()?>archive/" class="menu-box animate-fade-in-up stagger-2">
                    <i class="fas fa-archive icon"></i>
                    <span>ARCHIVE</span>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <a href="<?=base_url()?>master/" class="menu-box animate-fade-in-up stagger-3">
                    <i class="fas fa-database icon"></i>
                    <span>MASTER DATA</span>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <a href="<?=base_url()?>report/" class="menu-box animate-fade-in-up stagger-4">
                    <i class="fas fa-chart-bar icon"></i>
                    <span>REPORT</span>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.dashboard-container {
    margin-top: 80px;
    padding: 0 20px;
}

.dashboard-grid {
    gap: 24px 0;
    padding-bottom:15px;
}

.dashboard-grid .menu-box {
    min-height: 140px;
}

@media (max-width: 768px) {
    .dashboard-container {
        margin-top: 70px;
        padding: 0 16px;
    }
    
    .dashboard-grid {
        gap: 16px 0;
    }
    
    .dashboard-grid .menu-box {
        min-height: 100px;
        padding: 24px 16px;
    }
    
    .dashboard-grid .menu-box .icon {
        font-size: 1.3rem;
        margin-right: 10px;
    }
    
    .dashboard-grid .menu-box span {
        font-size: 0.85rem;
    }
}

@media (max-width: 576px) {
    .dashboard-container {
        margin-top: 70px;
        padding: 0 12px;
    }
    
    .dashboard-grid {
        gap: 12px 0;
    }
    
    .dashboard-grid .menu-box {
        min-height: 90px;
        padding: 20px 12px;
    }
    
    .dashboard-grid .menu-box .icon {
        font-size: 1.1rem;
        margin-right: 8px;
    }
    
    .dashboard-grid .menu-box span {
        font-size: 0.75rem;
    }
}
</style>
