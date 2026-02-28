<div class="col-md-12 dashboard-container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb glass-breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url()?>dashboard/"><i class="fas fa-home fa-fw"></i> Dashboard</a></li>
        </ol>
    </nav>
    
    <!-- Welcome Section -->
    <div class="welcome-card glass-card">
        <div class="welcome-content">
            <div class="row">
                <!-- Left Grid: Welcome Text -->
                <div class="col-md-8 welcome-text-section">
                    <h1 class="welcome-title">Selamat Datang, Administrator! 👋</h1>
                    <p class="welcome-subtitle">Kelola bisnis emas Anda dengan mudah dan efisien</p>
                </div>
                
                <!-- Right Grid: Info Items -->
                <div class="col-md-4 welcome-info-section">
                    <div class="welcome-info">
                        <div class="info-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span id="currentDate"></span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-clock"></i>
                            <span id="currentTime"></span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-gem"></i>
                            <span>ILoveEmas v3.0.0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <h3 class="dashboard-title">MENU UTAMA</h3>
    
    <div class="container">
        <div class="row g-4 dashboard-grid">
            <div class="col-12 col-md-6 col-lg-3">
                <a href="<?=base_url()?>transaction-list/" class="menu-box">
                    <i class="fas fa-exchange-alt icon"></i>
                    <span>TRANSACTION</span>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <a href="<?=base_url()?>archive/" class="menu-box">
                    <i class="fas fa-archive icon"></i>
                    <span>ARCHIVE</span>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <a href="<?=base_url()?>master/" class="menu-box">
                    <i class="fas fa-database icon"></i>
                    <span>MASTER DATA</span>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <a href="<?=base_url()?>report/" class="menu-box">
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
}

.dashboard-grid .menu-box {
    min-height: 140px;
}

.welcome-content .row {
    align-items: center;
}

.welcome-text-section {
    padding-right: 20px;
}

.welcome-info-section {
    display: flex;
    justify-content: flex-end;
}

.welcome-info {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    justify-content: flex-end;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--text-secondary);
    font-size: 0.9rem;
    padding: 8px 12px;
    background: rgba(255, 255, 255, 0.08);
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.15);
    white-space: nowrap;
}

.info-item i {
    color: #00b4d8;
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
    
    .welcome-text-section {
        padding-right: 0;
        margin-bottom: 16px;
    }
    
    .welcome-info-section {
        justify-content: flex-start;
    }
    
    .welcome-info {
        justify-content: flex-start;
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
    
    .welcome-info {
        gap: 8px;
    }
    
    .info-item {
        font-size: 0.8rem;
        padding: 6px 10px;
    }
}
</style>
