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
        <div class="row justify-content-center">
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
                    <span>Daftar Cabin</span>
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
