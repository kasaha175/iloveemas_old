<div class="col-md-12 form-container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb glass-breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url()?>dashboard/"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?=base_url()?>master/">Master</a></li>
            <li class="breadcrumb-item active">Edit Cabang</li>
        </ol>
    </nav>
    
    <!-- Back Button -->
    <a href="<?=base_url()?>master/cabang/" class="btn btn-secondary btn-back-standard mb-3">
        <i class="fas fa-arrow-left"></i>
        <span>Back</span>
    </a>
    
    <!-- Page Title -->
    <h3 class="page-title">EDIT CABANG</h3>
    
    <!-- Form Card -->
    <div class="col-md-12">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card glass-card">
                    <div class="card-header" data-toggle="collapse" data-target="#formCard">
                        <h6 class="m-0 font-weight-bold"><i class="fas fa-edit"></i> Cabang Information</h6>
                    </div>
                    <div class="collapse show" id="formCard">
                        <div class="card-body">
                            <form action="<?=base_url('master/save-update-cabang')?>" method="post" id="myForm">
                                <input type="hidden" name="id" value="<?= $cabang->id ?>">
                                <div class="form-group">
                                    <label>Nama Cabang <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control glass-input" name="dt[nama_cabang]" value="<?= $cabang->nama_cabang ?>">
                                    <small class="text-danger" id="error-nama_cabang"></small>
                                </div>
                                <div class="form-group">
                                    <label>Urutan <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control glass-input" name="dt[urutan_cabang]" value="<?= $cabang->urutan_cabang ?>">
                                    <small class="text-danger" id="error-urutan_cabang"></small>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control glass-input" name="dt[alamat_cabang]"><?= $cabang->alamat_cabang ?></textarea>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6 mb-3">
                                        <button type="submit" class="btn btn-success btn-lg btn-block">
                                            <i class="fas fa-save"></i> Save
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="<?=base_url()?>master/cabang/" class="btn btn-secondary btn-lg btn-block">
                                            <i class="fas fa-arrow-left"></i> Back
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
