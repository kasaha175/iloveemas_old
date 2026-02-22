<div class="archive-container">
    <!-- Breadcrumb -->
    <div class="glass-breadcrumb mb-4">
        <a href="<?=base_url()?>dashboard/" class="breadcrumb-home">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <span class="breadcrumb-separator">/</span>
        <a href="<?=base_url()?>archive/" class="breadcrumb-link">Archive</a>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-current">Buy</span>
    </div>

    <!-- Page Title -->
    <h1 class="archive-title">ARCHIVE BUY</h1>
    <p class="archive-subtitle">Pilih kategori arsip pembelian emas</p>

    <!-- Menu Cards -->
    <div class="archive-grid archive-buy-grid">
        <a href="<?=base_url()?>archive/buy/?key=rti-au" class="menu-box archive-box">
            <div class="box-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            </div>
            <span class="box-text">RTI AU</span>
            <span class="box-subtext">Emas 24K / Au</span>
        </a>

        <a href="<?=base_url()?>archive/buy/?key=rti-pt" class="menu-box archive-box">
            <div class="box-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <span class="box-text">RTI PT</span>
            <span class="box-subtext">Platinum</span>
        </a>

        <a href="<?=base_url()?>archive/buy/?key=rti-ag" class="menu-box archive-box">
            <div class="box-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
            </div>
            <span class="box-text">RTI AG</span>
            <span class="box-subtext">Perak / Silver</span>
        </a>

        <a href="<?=base_url()?>archive/buy/?key=rti-ru" class="menu-box archive-box">
            <div class="box-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            </div>
            <span class="box-text">RTI RU</span>
            <span class="box-subtext">Ruble / Rusia</span>
        </a>

        <a href="<?=base_url()?>archive/buy/?key=rti-ta" class="menu-box archive-box">
            <div class="box-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <span class="box-text">RTI TA</span>
            <span class="box-subtext">Tahunan</span>
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
    color: var(--text-primary);
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 8px;
    text-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
    animation: fadeInUp 0.6s ease-out;
}

.archive-subtitle {
    text-align: center;
    color: var(--text-secondary);
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

.archive-buy-grid {
    grid-template-columns: repeat(3, 1fr);
}

.archive-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 40px 24px;
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
    font-size: 1.25rem;
    font-weight: 700;
    letter-spacing: 2px;
    margin-bottom: 6px;
}

.archive-box .box-subtext {
    font-size: 0.8rem;
    color: var(--text-muted);
    font-weight: 400;
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
    .archive-buy-grid {
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

    .archive-buy-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .archive-box {
        min-height: 160px;
        padding: 30px 20px;
    }

    .archive-box .box-icon {
        margin-bottom: 12px;
    }

    .archive-box .box-text {
        font-size: 1.1rem;
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

    .archive-buy-grid {
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
