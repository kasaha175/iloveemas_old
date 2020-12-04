<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>
    <?=$title?>
  </title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

  <script src="https://cdn.jsdelivr.net/gh/hawkgs/jqKeyboard/development/build/jqkeyboard.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/hawkgs/jqKeyboard/layouts/jqk.layout.en.js"></script>
  <link href="<?=base_url()?>assets/css/keyboard.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/css/login.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
  <style>
  .bg-image {
    background-image: url('assets/img/back.jpg');
    background-size: cover;
    background-position: center;
  }
  body{
  font-family: 'Poppins', 'sans-serif';
  }
  </style>
</head>
	<!-- jQuery (required) & jQuery UI + theme (optional) -->
  <link href="<?=base_url()?>assets/keyboard/docs/css/jquery-ui.min.css" rel="stylesheet">
<!-- still using jQuery v2.2.4 because Bootstrap doesn't support v3+ -->
<script src="<?=base_url()?>assets/keyboard/docs/js/jquery-latest.min.js"></script>
<script src="<?=base_url()?>assets/keyboard/docs/js/jquery-ui.min.js"></script>
<!-- <script src="<?=base_url()?>assets/keyboard/docs/js/jquery-migrate-3.0.0.min.js"></script> -->

<!-- keyboard widget css & script (required) -->
<link href="<?=base_url()?>assets/keyboard/css/keyboard.css" rel="stylesheet">
<script src="<?=base_url()?>assets/keyboard/js/jquery.keyboard.js"></script>

<!-- keyboard extensions (optional) -->
<script src="<?=base_url()?>assets/keyboard/js/jquery.mousewheel.js"></script>
<script src="<?=base_url()?>assets/keyboard/js/jquery.keyboard.extension-typing.js"></script>
<script src="<?=base_url()?>assets/keyboard/js/jquery.keyboard.extension-autocomplete.js"></script>
<script src="<?=base_url()?>assets/keyboard/js/jquery.keyboard.extension-caret.js"></script>

<!-- demo only -->
<link rel="stylesheet" href="<?=base_url()?>assets/keyboard/docs/css/font-awesome.min.css">

<link href="<?=base_url()?>assets/keyboard/docs/css/tipsy.css" rel="stylesheet">
<link href="<?=base_url()?>assets/keyboard/docs/css/prettify.css" rel="stylesheet">
<script src="<?=base_url()?>assets/keyboard/docs/js/jquery.tipsy.min.js"></script>
<script src="<?=base_url()?>assets/keyboard/docs/js/prettify.js"></script> <!-- syntax highlighting -->
<body>
  <div class="container-fluid">
    <div class="row no-gutter">
      <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
      <div class="col-md-8 col-lg-6">
        <div class="login d-flex align-items-center py-5">
          <div class="container">
            <div class="row">
              <div class="col-md-9 col-lg-8 mx-auto">
                <h3 class="login-heading mb-4">
                  <img src="<?=base_url()?>assets/img/logo.png" alt="" class="img-responsive">
                </h3>
                <form action="<?php echo base_url() ?>login-process/" method="post">
                  <div class="form-label-group">
                    <input name="username" type="text" id="inputEmail" class="form-control" placeholder="Username" required
                      autofocus>
                    <label for="inputEmail">Username</label>
                  </div>
                  <div class="form-label-group">
                    <input  name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                    <label for="inputPassword">Password</label>
                  </div>
                  <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">Sign
                    in</button>
                </form>
                <hr>
                <div style="color:red;" class="text-center">
                  <?php if($this->session->userdata("failedLogin")==true){ ?>
                  <p>Username atau password salah!</p>
                  <?php 
                  $data_session = array(
                    'failedLogin' => false
                  );
                  $this->session->set_userdata($data_session);
                  }else{ ?>
                  <!-- <p>Username atau password tidak boleh kosong!</p> -->
                  <?php } ?>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script type="text/javascript">
  $(function () {
    jqKeyboard.init();
  });
</script>

</html>
   
<script>
    jQuery(function ($) {

        // QWERTY Text Input
        // The bottom of this file is where the autocomplete extension is added
        // ********************
        $('.form-control').keyboard({
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