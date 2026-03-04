<link rel="stylesheet" href="<?=base_url()?>assets/css/transaction.css">

<div class="col-md-12 page-container">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb glass-breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url()?>dashboard/"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?=base_url()?>transaction/">Transaction</a></li>
            <li class="breadcrumb-item active">Sell</li>
        </ol>
    </nav>

    <!-- Page Title -->
    <h3 class="page-title">SELL</h3>
    <h3 class="page-subtitle">Choose Material</h3>

    <!-- Back Button -->
    <div class="mb-3">
        <a href="<?=base_url()?>transaction/" class="btn btn-back">
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </a>
    </div>

    <!-- Material Grid -->
    <div class="material-grid">
        <div class="row g-3">
            <?php 
            $delay = 1;
            foreach($data as $d){ ?>
            <div class="col-4 col-md-3 col-lg-2">
                <a href="<?=base_url()?>transaction/sell/<?=$d->m_id?>/" class="material-card animate-fade-in-up" style="animation-delay: <?=$delay?>00ms">
                    <div class="material-icon">
                        <i class="fas fa-gem"></i>
                    </div>
                    <div class="material-image">
                        <img src="<?=base_url()?>assets/offline/<?=$d->m_img?>" alt="<?=$d->m_name?>">
                    </div>
                    <div class="material-name">
                        <span><?=$d->m_name?></span>
                    </div>
                </a>
            </div>
            <?php $delay++; } ?>
        </div>
    </div>
</div>

<style>
/* Compact Material Card Override */
.material-card {
    background-color: #0D1A63;
    min-height: 110px;
    padding: 14px 10px;
    border-radius: 12px;
}

.material-card::before {
    height: 35%;
}

.material-icon {
    font-size: 1.1rem;
    top: 8px;
    right: 8px;
}

.material-image {
    width: 55px;
    height: 55px;
    margin-bottom: 8px;
}

.material-name span {
    font-size: 0.9rem;
}

.material-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.35), 0 0 16px rgba(0, 180, 216, 0.15);
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(15px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.4s ease-out both;
}

@media (max-width: 576px) {
    .material-card {
        min-height: 90px;
        padding: 10px 8px;
        border-radius: 10px;
    }
    
    .material-image {
        width: 45px;
        height: 45px;
        margin-bottom: 6px;
    }
    
    .material-name span {
        font-size: 0.8rem;
    }
}
</style>
