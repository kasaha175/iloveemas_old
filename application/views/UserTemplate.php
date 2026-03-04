<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?=$title?></title>
    <link rel="icon" type="image/x-icon" href="<?=base_url()?>favicon.ico">

    <!-- Core CSS -->
    <link href="<?=base_url()?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/keyboard.css" rel="stylesheet">
    <link href="<?=base_url()?>/assets/select2/css/select2.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/summernote/summernote.min.css" rel="stylesheet">

    <!-- Keyboard Plugin -->
    <link href="<?=base_url()?>assets/keyboard/docs/css/jquery-ui.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/keyboard/css/keyboard.css" rel="stylesheet">

    <!-- Optional Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

    <!-- Core JavaScript -->
    <script src="<?=base_url()?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/select2/js/select2.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables -->
    <script src="<?=base_url()?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- jqKeyboard Dependencies -->
    <script src="<?=base_url()?>assets/keyboard/docs/js/jquery-ui.min.js"></script>
    <script src="<?=base_url()?>assets/keyboard/js/jquery.keyboard.js"></script>
    <script src="<?=base_url()?>assets/keyboard/js/jquery.keyboard.extension-typing.js"></script>
    <script src="<?=base_url()?>assets/keyboard/js/jquery.keyboard.extension-autocomplete.js"></script>
    <script src="<?=base_url()?>assets/keyboard/js/jquery.keyboard.extension-caret.js"></script>

    <!-- Plugins -->
    <script src="<?= base_url()?>assets/offline/sweetalert2.all.js"></script>
    <script src="<?=base_url()?>assets/js/sb-admin-2.min.js"></script>
    <script src="<?=base_url()?>assets/summernote/summernote.min.js"></script>
    <script src="<?=base_url()?>assets/offline/dataTables.buttons.min.js"></script>
    <script src="<?=base_url()?>assets/offline/jszip.min.js"></script>
    <script src="<?=base_url()?>assets/offline/buttons.html5.min.js"></script>
    <script src="<?=base_url()?>assets/offline/buttons.print.min.js"></script>

    <!-- Glassmorphism CSS -->
    <link href="<?=base_url()?>assets/css/glassmorphism.css" rel="stylesheet">
    
    <!-- Chrome Performance Fix - Use light version on Chrome -->
    <script>
        // Detect Chrome and apply light CSS for smooth 60fps
        if (navigator.userAgent.indexOf("Chrome") !== -1) {
            document.write('<link href="<?=base_url()?>assets/css/glassmorphism-light.css" rel="stylesheet">');
        }
    </script>
    
    <!-- DataTables Custom CSS -->
    <link href="<?=base_url()?>assets/css/datatables.css" rel="stylesheet">
    
    <!-- Custom Modular CSS -->
    <link href="<?=base_url()?>assets/css/base.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/layout.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/components.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/datatables-custom.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/pages/master.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/pages/memo.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/pages/cabang.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/pages/customer.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/pages/transaction.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/transaction-readability-fix.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/transaction-cart-fix.css" rel="stylesheet">
    
    <!-- Navbar Info Items CSS -->
    <style>
    .navbar-info {
        display: flex;
        align-items: center;
        margin-left: 20px;
        gap: 15px;
    }
    
    .navbar-info .info-item {
        display: flex;
        align-items: center;
        --text-primary: #03045E;
        font-size: 0.85rem;
        white-space: nowrap;
    }
    
    .navbar-info .info-item i {
        margin-right: 5px;
        color: #00d2d3;
    }
    
    .navbar-info .info-item span {
        font-family: 'Poppins', sans-serif;
    }
    
    /* Responsive - Tablet */
    @media (max-width: 992px) {
        .navbar-info {
            gap: 10px;
            margin-left: 10px;
        }
        
        .navbar-info .info-item {
            font-size: 0.75rem;
        }
        
        .navbar-info .info-item i {
            font-size: 0.85rem;
        }
    }
    
    /* Responsive - Mobile */
    @media (max-width: 768px) {
        .navbar-info {
            display: none;
        }
    }
    </style>
    
    <!-- Glassmorphism JS -->
    <script src="<?=base_url()?>assets/js/glassmorphism.js"></script>
    
    <!-- Custom Modular JS -->
    <script src="<?=base_url()?>assets/js/app.js"></script>
    <script src="<?=base_url()?>assets/js/datatables-init.js"></script>
    <script src="<?=base_url()?>assets/js/master.js"></script>
    <script src="<?=base_url()?>assets/js/memo.js"></script>
    <script src="<?=base_url()?>assets/js/cabang.js"></script>
    <script src="<?=base_url()?>assets/js/transaction.js"></script>
</head>
<?php 
$uri = $this->uri->segment(1);
$body_class = 'page-dashboard';
if ($uri == 'archive') {
    $body_class = 'page-archive';
} elseif ($uri == 'master') {
    $body_class = 'page-master';
} elseif ($uri == 'report') {
    $body_class = 'page-report';
}
?>
<body class="<?=$body_class?>">
    <!-- App Wrapper - Flex Column Layout -->
    <div class="app-wrapper">
        
        <!-- Navbar - Fixed Position -->
        <nav class="navbar navbar-expand navbar-light topbar shadow glass-navbar">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars text-white"></i>
            </button>
            <a href="<?=base_url()?>">
                <img src="<?=base_url()?>assets/img/logo-new.webp" alt="ILoveEmas" class="navbar-logo">
            </a>
            
            <!-- Navbar Info Items - Date, Time, Version -->
            <div class="navbar-info">
                <div class="info-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span id="currentDate"></span>
                </div>
                <div class="info-item">
                    <i class="fas fa-clock"></i>
                    <span id="currentTime"></span>
                </div>
                <div class="info-item">
                    <i class="fas fa-gem"></i>
                    <span>ILoveEmas v3.0.0</span>
                </div>
            </div>
            
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline small">Administrator</span>
                        <img class="img-profile rounded-circle" src="<?=base_url()?>assets/img/user/logo.png">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in glass-dropdown" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- Main Content Area -->
        <main class="app-content">
            <div class="content-flex">
                <!-- Dynamic Content -->
                <div class="container-fluid">
                    <?=$content?>
                </div>
            </div>
        </main>

        <!-- Footer - Sticky Bottom -->
        <footer class="glass-footer">
            <div class="footer-content">
                <div class="footer-left">
                    <a href="<?=base_url()?>">
                        <img src="<?=base_url()?>assets/img/logo-new.webp" alt="ILoveEmas" class="navbar-logo">
                    </a>
                </div>
                <div class="footer-center">
                    <span>&copy; <?=date('Y')?> ILoveEmas. All rights reserved.</span>
                </div>
                <div class="footer-right">
                    <span>Made with <i class="fas fa-heart" style="color: #ef4444;"></i> for Indonesia</span>
                </div>
            </div>
        </footer>

    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
        aria-labelledby="logoutModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content border-0 shadow">

                <div class="modal-header bg-light border-0">
                    <h5 class="modal-title font-weight-bold text-dark"
                        id="logoutModalLabel">
                        Konfirmasi Logout
                    </h5>
                    <button class="close" type="button"
                            data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body text-center py-4">
                    <p class="mb-2 font-weight-semibold">
                        Anda yakin ingin keluar?
                    </p>

                    <small class="text-muted d-block">
                        Sesi transaksi yang belum disimpan akan tetap tersimpan di sistem.
                    </small>
                </div>

                <div class="modal-footer border-0 justify-content-center pb-4">
                    <button class="btn btn-outline-secondary px-4"
                            type="button"
                            data-dismiss="modal">
                        Batal
                    </button>

                    <a class="btn btn-danger px-4 font-weight-bold"
                    href="<?= base_url('logout-process/') ?>">
                        Logout
                    </a>
                </div>

            </div>
        </div>
    </div>
    
    <!-- Script Initialization -->
    <script>
        $(function () {
            // Initialize Keyboard
            if (typeof jqKeyboard !== 'undefined') {
                jqKeyboard.init();
            }

            // Initialize Summernote
            $('.summernote').summernote({
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['misc', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
</body>
</html>
