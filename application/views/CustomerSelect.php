<div class="col-md-12 page-container">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb glass-breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url()?>dashboard/"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active">Transaction</li>
        </ol>
    </nav>

    <!-- Page Title -->
    <h3 class="page-title">TRANSACTION</h3>
    <h3 class="page-subtitle">Select Customer</h3>

    <!-- Form Card -->
    <div class="form-card">
        <div class="card-inner">
            <form action="<?=base_url()?>transaction/buy-add-to-cart/" method="post">
                <input type="hidden" name="idMaterial" value="<?=$this->uri->segment(3)?>">
                
                <div class="form-group">
                    <label>CUSTOMER</label>
                    <a href="<?=base_url()?>transaction/new-customer/" class="link-add">
                        <i class="fas fa-user-plus"></i> Add Customer
                    </a>
                    <select id="u_name" name="u_name" class="form-control select2-glass">
                        <option value="" disabled selected>Please select customer...</option>
                        <?php foreach($customer as $c): ?>
                            <option value="<?=$c->c_id?>"><?=$c->c_id?> - <?=$c->c_name?> - <?=$c->c_id_number?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <a id="sell" href="#!" class="btn btn-action btn-sell">
                            <i class="fas fa-tag"></i>
                            <span>Sell</span>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a id="buy" href="#!" class="btn btn-action btn-buy">
                            <i class="fas fa-shopping-bag"></i>
                            <span>Buy</span>
                        </a>
                    </div>
                </div>

                <div class="form-group mb-0">
                    <a href="<?=base_url()?>dashboard/" class="btn btn-back btn-block">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Page Container */
.page-container {
    padding: 110px 20px 40px;
    max-width: 600px;
    margin: 0 auto;
}

/* Breadcrumb */
.breadcrumb.glass-breadcrumb {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    background: var(--glass-bg);
    backdrop-filter: var(--glass-blur);
    border: 1px solid var(--glass-border);
    border-radius: 14px;
    padding: 14px 20px;
    list-style: none;
    margin-bottom: 24px;
    animation: fadeInUp 0.5s ease-out;
}

.breadcrumb.glass-breadcrumb .breadcrumb-item {
    display: flex;
    align-items: center;
    gap: 8px;
}

.breadcrumb.glass-breadcrumb .breadcrumb-item a {
    color: var(--turquoise-surf);
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.breadcrumb.glass-breadcrumb .breadcrumb-item a:hover {
    color: var(--frosted-blue);
    transform: translateX(-3px);
}

.breadcrumb.glass-breadcrumb .breadcrumb-item.active {
    color: var(--text-primary);
    font-weight: 500;
}

.breadcrumb.glass-breadcrumb .breadcrumb-item:not(:last-child)::after {
    content: '/';
    color: var(--text-muted);
    margin-left: 8px;
}

/* Page Title */
.page-title {
    text-align: center;
    color: #A8F1FF !important;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 8px;
    text-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
    animation: fadeInUp 0.6s ease-out;
}

.page-subtitle {
    text-align: center;
    color: #A8F1FF !important;
    font-size: 1.25rem;
    font-weight: 500;
    margin-bottom: 32px;
    animation: fadeInUp 0.6s ease-out 0.1s both;
}

/* Form Card */
.form-card {
    background: var(--card-gradient);
    backdrop-filter: var(--glass-blur);
    border: 1px solid var(--glass-border);
    border-radius: 24px;
    overflow: hidden;
    animation: fadeInUp 0.6s ease-out 0.2s both;
    position: relative;
}

.form-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 50%;
    background: linear-gradient(180deg, rgba(255,255,255,0.08) 0%, transparent 100%);
    pointer-events: none;
}

.card-inner {
    padding: 32px;
}

/* Form Group */
.form-group {
    margin-bottom: 24px;
}

.form-group label {
    display: block;
    color: var(--turquoise-surf);
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.link-add {
    float: right;
    color: var(--turquoise-surf);
    font-size: 0.85rem;
    font-weight: 500;
    transition: all 0.3s ease;
    text-decoration: none;
}

.link-add:hover {
    color: var(--frosted-blue);
    transform: translateX(3px);
}

/* Select2 Glass Style */
.select2-glass {
    width: 100%;
    padding: 14px 16px;
    background: var(--glass-bg);
    backdrop-filter: var(--glass-blur);
    border: 1px solid var(--glass-border);
    border-radius: 14px;
    color: var(--text-primary);
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.select2-glass:focus {
    outline: none;
    border-color: var(--turquoise-surf);
    box-shadow: 0 0 0 4px rgba(0, 180, 216, 0.15);
}

/* Form Row */
.form-row {
    display: flex;
    gap: 16px;
    margin-bottom: 16px;
}

.form-row > div {
    flex: 1;
}

/* Buttons */
.btn-action {
    width: 100%;
    padding: 16px 20px;
    border-radius: 14px;
    border: none;
    font-size: 1rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-sell {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: #000;
}

.btn-sell:hover {
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(245, 158, 11, 0.3);
}

.btn-buy {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: #fff;
}

.btn-buy:hover {
    background: linear-gradient(135deg, #34d399 0%, #10b981 100%);
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);
}

.btn-back {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 14px 20px;
    background: var(--glass-bg);
    backdrop-filter: var(--glass-blur);
    border: 1px solid var(--glass-border);
    border-radius: 14px;
    color: var(--text-primary);
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-back:hover {
    background: var(--turquoise-surf);
    color: #000;
    transform: translateX(-5px);
}

/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 576px) {
    .page-container {
        padding: 90px 15px 30px;
    }

    .page-title {
        font-size: 2rem;
    }

    .page-subtitle {
        font-size: 1rem;
    }

    .card-inner {
        padding: 24px 20px;
    }

    .form-row {
        flex-direction: column;
        gap: 12px;
    }

    .form-row > div {
        width: 100%;
    }
}
</style>

<script type="text/javascript">
$(document).ready(function () {
    // Inisialisasi Select2 dengan mode AJAX
    $('#u_name').select2({
        placeholder: "Please select customer...",
        allowClear: true,
        minimumInputLength: 2,
        ajax: {
            url: "<?=base_url()?>index.php/TransactionController/getCustomers",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    search: params.term,
                    page: params.page || 1
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                return {
                    results: data.results.map(function (item) {
                        return {
                            id: item.c_id,
                            text: `${item.c_id} - ${item.c_name} - ${item.c_id_number}`
                        };
                    }),
                    pagination: {
                        more: data.pagination.more
                    }
                };
            },
            cache: true
        }
    });

    // Mengirim data pelanggan saat dipilih
    $('#u_name').on('select2:select', function (e) {
        var customerId = e.params.data.id;
        if (customerId) {
            $.ajax({
                url: "<?=base_url()?>index.php/TransactionController/updateLive/",
                method: "POST",
                data: { id: customerId },
                success: function (response) {
                    // Success
                },
                error: function (xhr, status, error) {
                    // Error
                }
            });
        }
    });

    // Tombol Sell
    $("#sell").click(function () {
        var customer = $("#u_name").val();
        if (!customer) {
            alert("Please select customer!");
        } else {
            window.location.href = "<?=base_url()?>transaction/sell/";
        }
    });

    // Tombol Buy
    $("#buy").click(function () {
        var customer = $("#u_name").val();
        if (!customer) {
            alert("Please select customer!");
        } else {
            window.location.href = "<?=base_url()?>transaction/buy/";
        }
    });
});
</script>
