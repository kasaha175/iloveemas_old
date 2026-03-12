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
