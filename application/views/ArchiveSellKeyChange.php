<style>
    .bordering {
        width: 50%;
        border: 1px solid #fff;
        text-align: left;
        padding-left: 5px;
        color: #fff;
    }

    .input-box {
        height: 35px;
        padding: 10px;
        background: #EEE;
        margin: 0px;
        padding: 0px;
        border: none;
        margin-bottom: 0px;
        width: 100%;
    }
</style>
<?php
$d = $data[0];
?>
<div class="col-md-12" style="margin-top:110px;">
    <h3 class="text-center" style="color:#fff">ARCHIVE BUY /
        <?php
        if ($this->input->get("key") == "lm")
        {
            echo "LM";
        }
        else if ($this->input->get("key") == "material-au")
        {
            echo "MATERIAL AU";
        }
        else if ($this->input->get("key") == "material-ag")
        {
            echo "MATERIAL AG";
        }
        else if ($this->input->get("key") == "material-ubs")
        {
            echo "UBS";
        }
        ?> / GANTI POTONGAN
    </h3>
    <br>
    <form action="<?= base_url() ?>archive/sell/save/" id="myForm">
        <div class="row">


            <div class="<?= ($this->input->get("key") == "lm") ? 'col-md-6' : 'col-md-12' ?>" style="">
                <div class="row">
                    <div class="col-md-12" <?= ($this->input->get("key") == "lm") ? '' : 'style="padding:0px 350px;"' ?>>


                        <input type="hidden" name="key" required class="form-control" value="<?= $this->input->get("key") ?>">
                        <input type="hidden" name="type" required class="form-control" value="change">
                        <div class="form-group text-center">
                            <label style="color:#fff;">
                                <?php
                                if ($this->input->get("key") == "lm")
                                {
                                    echo "LM";
                                }
                                else if ($this->input->get("key") == "material-au")
                                {
                                    echo "MATERIAL AU";
                                }
                                else if ($this->input->get("key") == "material-ag")
                                {
                                    echo "MATERIAL AG";
                                }
                                else if ($this->input->get("key") == "material-ubs")
                                {
                                    echo "UBS";
                                }
                                ?>
                            </label>
                            <table style="width:100%;border: 1px solid black;" cellspacing="3" cellpadding="3">
                                <thead>
                                    <tr>
                                        <th class="bordering">Name</th>
                                        <th class="bordering">Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($this->input->get("key") == "lm")
                                    { ?>

                                        <tr>
                                            <td class="bordering">LM Retro</td>
                                            <td class="bordering"><input class="input-box" type="number" step="any" name="a"
                                                    required value="<?= $d->a ?>"></td>
                                        </tr>
                                        <tr style="display: none">
                                            <td class="bordering">LM Baru</td>
                                            <td class="bordering"><input class="input-box" type="number" step="any" name="b"
                                                    required value="<?= $d->b ?>"></td>
                                        </tr>
                                    <?php }
                                    else if ($this->input->get("key") == "material-au")
                                    { ?>
                                            <tr>
                                                <td class="bordering">Potongan Material AU</td>
                                                <td class="bordering"><input class="input-box" type="number" step="any" name="a"
                                                        required value="<?= $d->a ?>"></td>
                                            </tr>
                                    <?php }
                                    else if ($this->input->get("key") == "material-ag")
                                    { ?>
                                                <tr>
                                                    <td class="bordering">Potongan Material AG</td>
                                                    <td class="bordering"><input class="input-box" type="number" step="any" name="a"
                                                            required value="<?= $d->a ?>"></td>
                                                </tr>
                                    <?php }
                                    else if ($this->input->get("key") == "material-ubs")
                                    {

                                        ?>


                                        <?php foreach ($configMaterial as $value): ?>
                                                        <tr>
                                                            <td class="bordering">
                                                    <?= $value->size ?> Gr
                                                            </td>
                                                            <td class="bordering">
                                                                <input class="input-box" type="number" step="any"
                                                                    name="configMaterial[<?= $value->id ?>]" required
                                                                    value="<?= $value->potongan ?>">
                                                            </td>
                                                        </tr>
                                        <?php endforeach; ?>




                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
            <?php if ($this->input->get("key") == "lm")
            { ?>
                <div class="col-md-6">
                    <div class="text-center">

                        <label style="color:#fff; text-align: center; ">Potongan LM Certi</label>
                    </div>
                    <table style="width:100%;border: 1px solid black;" cellspacing="3" cellpadding="3">
                        <thead>

                            <tr>
                                <th style="text-align:center;" colspan="2" class="bordering">Material</th>
                            </tr>
                            <tr>
                                <th class="bordering">Name</th>
                                <th class="bordering">Value</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $potongan_lm = json_decode($d->potongan_lm, true);

                            $tahun_mulai = 2018;
                            // $d=mktime(11, 14, 54, 8, 12, 2023);
                            while ($tahun_mulai <= date('Y') + 1)
                            { ?>
                                <tr>
                                    <td class="bordering">LM Certi
                                        <?= $tahun_mulai; ?>
                                    </td>
                                    <td class="bordering"><input class="input-box" type="number" step="any"
                                            name="potongan_lm[<?= $tahun_mulai; ?>]" required
                                            value="<?= $potongan_lm[$tahun_mulai] ?>"></td>
                                </tr>

                                <?php $tahun_mulai++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
            <div class="col-md-12 mt-3 text-center">
                <a href="<?= base_url() ?>archive/sell/?key=<?= $this->input->get('key') ?>"
                    class="btn btn-primary btn-icon-split btn-lg mr-3">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Back</span>
                </a>
                <a href="#" onclick="document.getElementById('myForm').submit();"
                    class="btn btn-success btn-icon-split btn-lg mr-3">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Save</span>
                </a>
            </div>
        </div>
    </form>
</div>
<script>
    jQuery(function ($) {
        // Num Pad Input
        // ********************
        $('.input-box').keyboard({
            layout: 'num',
            restrictInput: true, // Prevent keys not in the displayed keyboard from being typed in
            preventPaste: true,  // prevent ctrl-v and right click
            autoAccept: true
        });
        prettyPrint();
    });
</script>