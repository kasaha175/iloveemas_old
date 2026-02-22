<?php 
function nominal($angka){
    $jd = number_format($angka, 2, ',', '.');
    return $jd;
}
?>
<div class="col-md-12 report-detail-container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb glass-breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url()?>dashboard/"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?=base_url()?>report/">Report</a></li>
            <li class="breadcrumb-item active">Buy Graph</li>
        </ol>
    </nav>
    
    <!-- Page Title -->
    <h3 class="page-title">REPORT</h3>
    <h3 class="page-subtitle">Transaction Buy Graph</h3>
    
    <!-- Filter Card -->
    <div class="col-md-12">
        <div class="card glass-card">
            <div class="card-header" data-toggle="collapse" data-target="#filterCard">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-filter"></i> Filter Data</h6>
            </div>
            <div class="collapse show" id="filterCard">
                <div class="card-body">
                    <form action="<?=base_url()?>report/buy-graph/">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Material</label>
                                    <select class="form-control glass-input select2" name="material">
                                        <option value="">ALL</option>
                                        <?php foreach($materialData as $y){ ?>
                                            <?php if($this->input->get('material')!=$y->m_name){ ?>
                                            <option><?=$y->m_name?></option>
                                            <?php }else{ ?>
                                              <option selected><?=$y->m_name?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Year</label>
                                    <select class="form-control glass-input select2" name="year">
                                        <option value="">ALL</option>
                                        <?php foreach($yearData as $y){ ?>
                                            <?php if($this->input->get('year')!=$y->y_name){ ?>
                                            <option><?=$y->y_name?></option>
                                            <?php }else{ ?>
                                              <option selected><?=$y->y_name?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-filter"></i> Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>    
                </div>
            </div>
        </div>
    </div>

    <!-- Transaction Graph Card -->
    <div class="col-md-12 mt-4">
        <div class="card glass-card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-chart-line"></i> Transaction Data <?= (!$this->input->get('year'))?date('Y') : $this->input->get('year') ?></h6>
            </div>
            <div class="card-body">
                <div class="data" style="height: 350px; width: 100%;"></div>
            </div>
        </div>
    </div>

    <!-- Customer Graph Card -->
    <div class="col-md-12 mt-4">
        <div class="card glass-card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-users"></i> Customer Data <?= (!$this->input->get('year'))?date('Y') : $this->input->get('year') ?></h6>
            </div>
            <div class="card-body">
                <div class="customer" style="height: 350px; width: 100%;"></div>
            </div>
        </div>
    </div>
    
    <!-- Back Button -->
    <div class="col-md-12 mt-4 text-center">
        <a href="<?=base_url()?>report/" class="btn btn-primary btn-lg">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Report</span>
        </a>
    </div>
</div>

<style>
.report-detail-container {
    padding: 100px 20px 40px;
    max-width: 1400px;
    margin: 0 auto;
}

.page-title {
    text-align: center;
    color: var(--text-primary);
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 10px;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.page-subtitle {
    text-align: center;
    color: var(--turquoise-surf);
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 30px;
}

.card.glass-card {
    margin-bottom: 20px;
}

.card-header {
    background: rgba(255, 255, 255, 0.05);
    border-bottom: 1px solid var(--glass-border);
    padding: 15px 20px;
    cursor: pointer;
}

.card-header h6 {
    color: var(--turquoise-surf);
    margin: 0;
}

.card-header:hover {
    background: rgba(255, 255, 255, 0.1);
}

.card-body {
    padding: 20px;
}

@media (max-width: 768px) {
    .report-detail-container {
        padding: 90px 15px 30px;
    }
    
    .page-title {
        font-size: 1.5rem;
    }
    
    .page-subtitle {
        font-size: 1.2rem;
    }
}
</style>

<script type="text/javascript">
$(document).ready(function() {
  $('#dataTable').DataTable();
});
</script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<script type="text/javascript">
$(function() {
    $(".data").CanvasJSChart({
        axisX: {
            interval: 1
        },
        animationEnabled: true,
        exportEnabled: true,
        indexLabelPlacement: "outside",  
        indexLabelOrientation: "horizontal",
        data: [
        {
            type: "line",
            indexLabel: "{label}, {y}",
            dataPoints: [
                <?php foreach($data as $d){ ?>
          { label: "<?=($d->m_name)?>",  y: <?=intval($d->priceTotal)?> },
        <?php } ?>
            ]
        }
        ]
    });
});
</script>
<script type="text/javascript">
$(function() {
    $(".customer").CanvasJSChart({
        axisX: {
            interval: 1
        },
        animationEnabled: true,
        exportEnabled: true,
        indexLabelPlacement: "outside",  
        indexLabelOrientation: "horizontal",
        data: [
        {
            type: "line",
            indexLabel: "{label}: {y} ",
            dataPoints: [
                <?php foreach($dataCustomer as $d){ ?>
          { label: "<?=($d['month'])?>",  y: <?=intval($d['countTransaction'])?> },
        <?php } ?>
            ]
        }
        ]
    });
});
</script>
