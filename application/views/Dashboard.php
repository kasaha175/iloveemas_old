<div class="col-md-12 dashboard-container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb glass-breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url()?>dashboard/"><i class="fas fa-home fa-fw"></i> Dashboard</a></li>
        </ol>
    </nav>
    <!-- Welcome Section -->
    <div class="welcome-card glass-card">
        <div class="welcome-content">
            <div class="welcome-text">
                <h1 class="welcome-title">Selamat Datang, Administrator! 👋</h1>
                <p class="welcome-subtitle">Kelola bisnis emas Anda dengan mudah dan efisien</p>
            </div>
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
    
    <h3 class="dashboard-title">MENU UTAMA</h3>
    
    <div class="container">
        <div class="row g-4">
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
