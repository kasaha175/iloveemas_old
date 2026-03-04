<div class="archive-container">
    <!-- Breadcrumb -->
    <div class="glass-breadcrumb mb-4">
        <a href="<?=base_url()?>dashboard/" class="breadcrumb-home">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-current">Archive</span>
    </div>

    <!-- Page Title -->
    <h1 class="archive-title">ARCHIVE</h1>
    <p class="archive-subtitle">Pilih jenis arsip yang ingin Anda akses</p>

    <!-- Menu Cards -->
    <div class="archive-grid">
        <a href="<?=base_url()?>archive/buy/" class="menu-box archive-box">
            <div class="box-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
            </div>
            <span class="box-text">BUY</span>
            <span class="box-subtext">Arsip Pembelian Emas</span>
        </a>

        <a href="<?=base_url()?>archive/sell/" class="menu-box archive-box">
            <div class="box-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            </div>
            <span class="box-text">SELL</span>
            <span class="box-subtext">Arsip Penjualan Emas</span>
        </a>
    </div>

    <!-- Back Button -->
    <div class="archive-back">
        <a href="<?=base_url()?>dashboard/" class="btn btn-primary btn-lg">
            <i class="fas fa-arrow-left"></i>
            <span>Kembali ke Dashboard</span>
        </a>
    </div>
</div>

<style>
/* Archive Page Specific Styles */
.archive-container {
    padding: 110px 20px 40px;
    max-width: 900px;
    margin: 0 auto;
}

.archive-title {
    text-align: center;
    color: #03045e;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 8px;
    text-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
    animation: fadeInUp 0.6s ease-out;
}

.archive-subtitle {
    text-align: center;
    color: #03045e;
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

.breadcrumb-home {
    color: var(--turquoise-surf);
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.breadcrumb-home:hover {
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
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
    margin-bottom: 40px;
}

.archive-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 50px 30px;
    min-height: 220px;
    position: relative;
    overflow: hidden;
}

.archive-box .box-icon {
    margin-bottom: 20px;
    color: var(--turquoise-surf);
    transition: all 0.4s ease;
}

.archive-box:hover .box-icon {
    color: var(--frosted-blue);
    transform: scale(1.1);
    filter: drop-shadow(0 0 15px rgba(144, 224, 239, 0.5));
}

.archive-box .box-text {
    font-size: 1.5rem;
    font-weight: 700;
    letter-spacing: 3px;
    margin-bottom: 8px;
}

.archive-box .box-subtext {
    font-size: 0.85rem;
    color: var(--text-muted);
    font-weight: 400;
    letter-spacing: 0.5px;
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

    .archive-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .archive-box {
        min-height: 180px;
        padding: 40px 24px;
    }

    .archive-box .box-icon {
        margin-bottom: 16px;
    }

    .archive-box .box-text {
        font-size: 1.25rem;
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

    .archive-grid {
        gap: 16px;
    }

    .archive-box {
        min-height: 160px;
        padding: 30px 20px;
    }

    .archive-box .box-icon svg {
        width: 40px;
        height: 40px;
    }

    .archive-box .box-text {
        font-size: 1.1rem;
    }
}
</style>
