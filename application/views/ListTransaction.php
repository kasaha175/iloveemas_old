<div class="col-md-12 page-container">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb glass-breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url()?>dashboard/"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active">Transaction</li>
        </ol>
    </nav>

    <!-- Page Title -->
    <h3 class="page-title">Transaction</h3>

    <!-- Main Card -->
    <div class="glass-card">
        <!-- Card Header -->
        <div class="card-header-glass">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold">Transaction Data</h6>
                </div>
                <div class="col-md-6 text-right">
                    <a href="<?= base_url('transaction') ?>" class="btn btn-sm btn-success">
                        <i class="fa fa-plus"></i> Add Transaction
                    </a>
                    <button class="btn btn-sm btn-warning" onclick="updateAllStatus()">
                        <i class="fa fa-trash"></i> Clear Data
                    </button>
                </div>
            </div>

        </div>
        <!-- Card Body -->
        <div class="card-body-glass">
            <?php if($this->session->userdata('status')=='success'): ?>
            <div class="alert alert-success alert-dismissible m-0 mb-3">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?=$this->session->userdata('message')?>
            </div>
            <?php 
            $data_session = array('status' => '', 'message' => "");
            $this->session->set_userdata($data_session); 
            endif; ?>

            <div class="table-responsive">
                <table class="table glass-table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Action</th>
                            <th>Transaction</th>
                            <th>No Order</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Qty</th>
                            <th>Price Total</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

        <!-- Back Button -->
        <div class="card-footer-glass">
            <a href="<?=base_url()?>dashboard/" class="btn btn-back">
                <i class="fas fa-arrow-left"></i>
                <span>Back</span>
            </a>
        </div>
    </div>
</div>

<style>
/* Page Container */
.page-container {
    padding: 110px 20px 40px;
    max-width: 1400px;
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
    color: var(--text-primary);
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 32px;
    text-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
    animation: fadeInUp 0.6s ease-out;
}

/* Glass Card */
.glass-card {
    background: var(--card-gradient);
    backdrop-filter: var(--glass-blur);
    border: 1px solid var(--glass-border);
    border-radius: 24px;
    overflow: hidden;
    animation: fadeInUp 0.6s ease-out 0.2s both;
    position: relative;
}

.glass-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 50%;
    background: linear-gradient(180deg, rgba(255,255,255,0.08) 0%, transparent 100%);
    pointer-events: none;
}

/* Card Header */
.card-header-glass {
    background: rgba(0, 180, 216, 0.1);
    border-bottom: 1px solid var(--glass-border);
    padding: 20px 24px;
}

.card-header-glass .m-0 {
    color: var(--turquoise-surf);
    font-weight: 600;
}

/* Card Body */
.card-body-glass {
    padding: 24px;
}

/* Glass Table */
.glass-table {
    width: 100%;
    border-collapse: collapse;
    color: var(--text-primary);
}

.glass-table thead {
    background: rgba(0, 180, 216, 0.15);
}

.glass-table th {
    padding: 14px 16px;
    text-align: left;
    color: var(--turquoise-surf);
    font-weight: 600;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 1px solid var(--glass-border);
}

.glass-table td {
    padding: 12px 16px;
    border-bottom: 1px solid var(--glass-border);
    font-size: 0.9rem;
}

.glass-table tbody tr {
    transition: all 0.3s ease;
}

.glass-table tbody tr:hover {
    background: var(--glass-bg-hover);
}

/* Card Footer */
.card-footer-glass {
    padding: 20px 24px;
    border-top: 1px solid var(--glass-border);
}

/* Back Button */
.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 24px;
    background: var(--glass-bg);
    backdrop-filter: var(--glass-blur);
    border: 1px solid var(--glass-border);
    border-radius: 12px;
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

/* Buttons */
.btn-sm {
    padding: 8px 16px;
    font-size: 0.85rem;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-success {
    background: #10b981;
    border-color: #10b981;
    color: #fff;
}

.btn-success:hover {
    background: #059669;
    border-color: #059669;
}

.btn-warning {
    background: #f59e0b;
    border-color: #f59e0b;
    color: #000;
}

.btn-warning:hover {
    background: #d97706;
    border-color: #d97706;
}

/* Alert */
.alert-success {
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.3);
    color: #10b981;
    border-radius: 12px;
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
@media (max-width: 992px) {
    .page-container {
        padding: 90px 15px 30px;
    }

    .page-title {
        font-size: 2rem;
    }

    .card-body-glass {
        padding: 18px;
    }
}

@media (max-width: 576px) {
    .page-title {
        font-size: 1.75rem;
    }

    .card-header-glass {
        padding: 16px;
    }

    .card-body-glass {
        padding: 14px;
    }

    .glass-table th, .glass-table td {
        padding: 10px 12px;
        font-size: 0.8rem;
    }

    .card-header-glass .row > div {
        margin-bottom: 10px;
    }

    .card-header-glass .text-right {
        text-align: left !important;
    }
}
</style>

<script>
function clearData() {
    Swal.fire({
        title: 'Are you sure?',
        text: 'All transaction data will be cleared and cannot be restored!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        'Yes, clear it!',
        confirmButtonText: cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= base_url('transaction/clearData') ?>";
        }
    });
}

function deleteData(no_order){
    Swal.fire({
        title: "Are you sure?",
        text: "The transaction will be deleted and cannot be restored!",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Cancel",
        denyButtonText: `Delete`,
    }).then((result) => {
        if (result.isDenied) {
            window.location.href = "<?= base_url('transaction/delete-transaction/') ?>" + no_order;
        } else {
            Swal.close();
        }
    });
}

$('#dataTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: "<?= base_url('transaction/getTransactions') ?>",
        type: "POST",
    },
    columns: [
        { data: 'no', orderable: false, searchable: false },
        { data: 'action', orderable: false, searchable: false },
        { data: 'transaction' },
        { data: 'no_order' },
        { data: 'status' },
        { data: 'date' },
        { data: 'customer' },
        { data: 'qty' },
        {
            data: 'price_total',
            render: function (data, type, row) {
                if (type === 'display' || type === 'filter') {
                    return 'IDR ' + new Intl.NumberFormat('id-ID').format(data || 0);
                }
                return data;
            }
        }
    ]
});

function updateAllStatus() {
    Swal.fire({
        title: 'Are you sure?',
        text: 'This will update the status of all transactions to SELESAI.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, update it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "<?= base_url('transaction/updateAllStatus') ?>",
                method: "POST",
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'All transactions have been updated to SELESAI.',
                            icon: 'success'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.message || 'An error occurred while updating data.',
                            icon: 'error'
                        });
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to process the request. Please try again.',
                        icon: 'error'
                    });
                }
            });
        }
    });
}
</script>
