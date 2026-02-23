<div class="col-md-12 master-container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb glass-breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url()?>dashboard/"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active">Master</li>
        </ol>
    </nav>
    
    <!-- Page Title -->
    <h3 class="page-title">MASTER</h3>
    
    <!-- Master Menu Grid -->
    <div class="master-grid">
        <div class="row justify-content-center master-row">
            <div class="col-md-6 col-lg-4">
                <a href="<?=base_url()?>master/customer/" class="menu-box">
                    <i class="fas fa-users icon"></i>
                    <span>Customer</span>
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="<?=base_url()?>master/memo/" class="menu-box">
                    <i class="fas fa-file-alt icon"></i>
                    <span>Syarat & Ketentuan</span>
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="<?=base_url()?>master/cabang/" class="menu-box">
                    <i class="fas fa-store icon"></i>
                    <span>Daftar Cabang</span>
                </a>
            </div>
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
.master-container {
    padding: 90px 20px 40px;
    max-width: 1200px;
    margin: 0 auto;
}

.master-grid {
    max-width: 900px;
    margin: 0 auto;
}

.master-row {
    gap: 24px 0;
}

.master-row .menu-box {
    min-height: 120px;
}

@media (max-width: 768px) {
    .master-container {
        padding: 80px 15px 30px;
    }
    
    .master-row {
        gap: 16px 0;
    }
    
    .master-row .menu-box {
        min-height: 100px;
        padding: 24px 16px;
    }
    
    .master-row .menu-box .icon {
        font-size: 1.3rem;
    }
    
    .master-row .menu-box span {
        font-size: 0.9rem;
    }
}

@media (max-width: 576px) {
    .master-container {
        padding: 80px 12px 20px;
    }
    
    .master-row {
        gap: 12px 0;
    }
    
    .master-row .menu-box {
        min-height: 90px;
        padding: 20px 12px;
    }
    
    .master-row .menu-box .icon {
        font-size: 1.1rem;
    }
    
    .master-row .menu-box span {
        font-size: 0.85rem;
    }
}
</style>
