<div class="col-md-12" style="margin-top:110px;">
    <div style="color:#fff;margin-top:-30px;">
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>dashboard/" class="fa fa-home"></a>
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>dashboard/">Dashboard</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href="<?=base_url()?>transaction/">Transaction</a> 
        > 
        <a style="color:#fff;text-decoration:none;" href="">Cabang</a> 
    </div>
    <!-- <h3 class="text-center" style="color:#fff">TRANSACTION</h3> -->
    <h3 class="text-center" style="color:#fff">Cabang</h3>
    <br>
    <div class="col-md-12" style="padding:0px 150px;">
        <div class="row">
            <div class="col-md-8 offset-md-2" style="padding:10px 10px">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Accordion -->
                            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                                aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-primary">Cabang</h6>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse show" id="collapseCardExample" style="">
                                <div class="card-body">
                                    <form action="<?=base_url('master/save-cabang')?>" method="post" id="myForm">
                                        <div class="form-group">
                                            <label>Nama Cabang</label>
                                            <input type="text" class="form-control" name="dt[nama_cabang]">
                                        </div>
                                        <div class="form-group">
                                            <label>Urutan</label>
                                            <input type="number" class="form-control" name="dt[urutan_cabang]">
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea class="form-control" name="dt[alamat_cabang]"></textarea>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                    <a href="#" onclick="document.getElementById('myForm').submit();" 
                                                        class="btn btn-primary btn-icon-split btn-lg btn-block">
                                                        <span class="text">Save</span>
                                                    </a>
                                                    </div>
                                                    <div class="col-md-4">
                                                    <a href="<?=base_url()?>master/cabang/"
                                                        class="btn btn-primary btn-icon-split btn-lg btn-block">
                                                       <span class="text">Back</span>
                                                    </a>
                                                    </div>
                                               </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#materialType").select2();
    $(".select2").select2();
</script>
<script>
    $('.select2').select2();
    jQuery(function ($) {
        renderTextArea();
        // QWERTY Text Input
        // The bottom of this file is where the autocomplete extension is added
        // ********************
        $('#tm_value').keyboard({
            layout: 'qwerty'
        });
        $('#tm_priority').keyboard({
            layout: 'qwerty'
        });
        $('.version').html('(v' + $('#u_name').getkeyboard().version + ')');
        // Contenteditable
        // ********************
        $.keyboard.keyaction.undo = function (base) {
            base.execCommand('undo');
            return false;
        };
        $.keyboard.keyaction.redo = function (base) {
            base.execCommand('redo');
            return false;
        };
        $('#contenteditable').keyboard({
            usePreview: false,
            useCombos: false,
            autoAccept: true,
            layout: 'custom',
            customLayout: {
                'normal': [
                    '` 1 2 3 4 5 6 7 8 9 0 - = {del} {b}',
                    '{tab} q w e r t y u i o p [ ] \\',
                    'a s d f g h j k l ; \' {enter}',
                    '{shift} z x c v b n m , . / {shift}',
                    '{accept} {space} {left} {right} {undo:Undo} {redo:Redo}'
                ],
                'shift': [
                    '~ ! @ # $ % ^ & * ( ) _ + {del} {b}',
                    '{tab} Q W E R T Y U I O P { } |',
                    'A S D F G H J K L : " {enter}',
                    '{shift} Z X C V B N M < > ? {shift}',
                    '{accept} {space} {left} {right} {undo:Undo} {redo:Redo}'
                ]
            },
            display: {
                del: '\u2326:Delete',
                redo: '↻',
                undo: '↺'
            }
        });
        prettyPrint();
    });
</script>