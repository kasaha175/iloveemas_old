<div class="archive-container">
    <!-- Breadcrumb -->
    <div class="glass-breadcrumb mb-4">
        <a href="<?=base_url()?>dashboard/" class="breadcrumb-home">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <span class="breadcrumb-separator">/</span>
        <a href="<?=base_url()?>archive/" class="breadcrumb-link">Archive</a>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-current">Sell</span>
    </div>

    <!-- Page Title -->
    <h1 class="archive-title">ARCHIVE SELL</h1>
    <p class="archive-subtitle">Pilih kategori arsip penjualan emas</p>

    <!-- Menu Cards -->
    <div class="archive-grid archive-sell-grid">
        <a href="<?=base_url()?>archive/sell/?key=lm" class="menu-box archive-box">
            <!-- <div class="box-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            </div> -->
            <span class="box-text">LM</span>
            <!-- <span class="box-subtext">London Market</span> -->
        </a>

        <a href="<?=base_url()?>archive/sell/?key=material-au" class="menu-box archive-box">
            <!-- <div class="box-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            </div> -->
            <span class="box-text">MATERIAL AU</span>
            <!-- <span class="box-subtext">Emas Batangan</span> -->
        </a>

        <a href="<?=base_url()?>archive/sell/?key=material-ag" class="menu-box archive-box">
            <!-- <div class="box-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
            </div> -->
            <span class="box-text">MATERIAL AG</span>
            <!-- <span class="box-subtext">Perak Batangan</span> -->
        </a>

        <a href="<?=base_url()?>archive/sell/?key=material-ubs" class="menu-box archive-box">
            <!-- <div class="box-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
            </div> -->
            <span class="box-text">UBS</span>
            <!-- <span class="box-subtext">Unit UBS</span> -->
        </a>
    </div>

    <!-- Back Button -->
    <div class="archive-back">
        <a href="<?=base_url()?>archive/" class="btn btn-primary btn-lg">
            <i class="fas fa-arrow-left"></i>
            <span>Kembali ke Archive</span>
        </a>
    </div>
</div>

<style>
/* Archive Page Specific Styles */
.archive-container {
    padding: 110px 20px 40px;
    max-width: 1000px;
    margin: 0 auto;
}

.archive-title {
    text-align: center;
    color: #A8F1FF !important;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 8px;
    text-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
    animation: fadeInUp 0.6s ease-out;
}

.archive-subtitle {
    text-align: center;
    color: #A8F1FF !important;
    font-size: 1.1rem;
    margin-bottom: 40px;
    animation: fadeInUp 0.6s ease-out 0.1s both;
}

/* Breadcrumb */
.glass-breadcrumb {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    background: var(--glass-bg);
    backdrop-filter: var(--glass-blur);
    border: 1px solid var(--glass-border);
    border-radius: 14px;
    padding: 12px 20px;
    animation: fadeInUp 0.5s ease-out 0.2s both;
}

.breadcrumb-home, .breadcrumb-link {
    color: var(--turquoise-surf);
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.breadcrumb-home:hover, .breadcrumb-link:hover {
    color: var(--frosted-blue);
    transform: translateX(-3px);
}

.breadcrumb-separator {
    color: var(--text-muted);
}

.breadcrumb-current {
    color: var(--text-primary);
    font-weight: 500;
}

/* Archive Grid */
.archive-grid {
    display: grid;
    gap: 24px;
    margin-bottom: 40px;
}

.archive-sell-grid {
    grid-template-columns: repeat(4, 1fr);
}

.archive-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    min-height: 200px;
    position: relative;
    overflow: hidden;
}

.archive-box .box-icon {
    margin-bottom: 16px;
    color: var(--turquoise-surf);
    transition: all 0.4s ease;
}

.archive-box:hover .box-icon {
    color: var(--frosted-blue);
    transform: scale(1.1);
    filter: drop-shadow(0 0 15px rgba(144, 224, 239, 0.5));
}

.archive-box .box-text {
    font-size: 1.1rem;
    font-weight: 700;
    letter-spacing: 1px;
    margin-bottom: 6px;
    text-align: center;
}

.archive-box .box-subtext {
    font-size: 0.75rem;
    color: var(--text-muted);
    font-weight: 400;
    text-align: center;
}

/* Back Button */
.archive-back {
    text-align: center;
    animation: fadeInUp 0.6s ease-out 0.3s both;
}

.archive-back .btn {
    padding: 16px 36px;
    font-size: 1rem;
    gap: 12px;
}

.archive-back .btn i {
    font-size: 1.1rem;
}

/* Responsive */
@media (max-width: 992px) {
    .archive-sell-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .archive-container {
        padding: 90px 15px 30px;
    }

    .archive-title {
        font-size: 2rem;
    }

    .archive-subtitle {
        font-size: 1rem;
        margin-bottom: 30px;
    }

    .archive-sell-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .archive-box {
        min-height: 160px;
        padding: 30px 16px;
    }

    .archive-box .box-icon {
        margin-bottom: 12px;
    }

    .archive-box .box-text {
        font-size: 1rem;
    }

    .archive-back .btn {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .archive-title {
        font-size: 1.75rem;
    }

    .archive-sell-grid {
        grid-template-columns: 1fr;
    }

    .archive-box {
        min-height: 140px;
    }

    .archive-box .box-icon svg {
        width: 40px;
        height: 40px;
    }
}
</style>
