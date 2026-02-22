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

<style>
.dashboard-container {
    margin-top: 110px;
    padding: 0 20px;
}

.dashboard-title {
    text-align: center;
    color: var(--text-primary);
    font-weight: 600;
    font-size: 2rem;
    margin-bottom: 2rem;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    animation: fadeInUp 0.6s ease-out;
}

.glass-breadcrumb {
    background: var(--glass-bg);
    backdrop-filter: var(--glass-blur);
    -webkit-backdrop-filter: var(--glass-blur);
    border: 1px solid var(--glass-border);
    border-radius: 12px;
    padding: 12px 20px;
    width: auto !important;
    position: static !important;
    margin-bottom: 1.5rem !important;
    list-style: none;
}

.glass-breadcrumb .breadcrumb-item {
    display: inline-flex;
    align-items: center;
}

.glass-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
    content: "/";
    padding: 0 12px;
    color: var(--text-muted);
}

.glass-breadcrumb .breadcrumb-item a {
    color: var(--text-secondary);
    text-decoration: none;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.glass-breadcrumb .breadcrumb-item a:hover {
    color: var(--text-primary);
}

.glass-breadcrumb .breadcrumb-item a i {
    color: var(--turquoise-surf);
}

@media (max-width: 768px) {
    .dashboard-container {
        margin-top: 90px;
        padding: 0 15px;
    }
    
    .dashboard-title {
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .menu-box {
        padding: 25px 15px;
        min-height: 90px;
        font-size: 0.9rem;
    }
    
    .menu-box .icon {
        font-size: 1.2rem;
        margin-right: 8px;
    }
}
</style>

<script>
function updateDateTime() {
    const now = new Date();
    
    // Format tanggal Indonesia
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const dateStr = now.toLocaleDateString('id-ID', options);
    document.getElementById('currentDate').textContent = dateStr;
    
    // Format waktu
    const timeStr = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    document.getElementById('currentTime').textContent = timeStr;
}

// Update setiap detik
setInterval(updateDateTime, 1000);
updateDateTime(); // Initial call
</script>
