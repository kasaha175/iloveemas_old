<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?=$title?></title>

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
    
    <!-- Glassmorphism JS -->
    <script src="<?=base_url()?>assets/js/glassmorphism.js"></script>
    
    <style>
        /* ===== LAYOUT STRUCTURE ===== */
        .app-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            min-height: 100dvh;
        }

        .app-content {
            flex: 1 1 auto;
            display: flex;
            flex-direction: column;
            padding-top: 80px;
            padding-bottom: 0;
        }

        .content-flex {
            flex: 1 1 auto;
            display: flex;
            flex-direction: column;
        }

        /* ===== NAVBAR FIXES ===== */
        .glass-navbar {
            position: fixed !important;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            height: 70px;
        }

        /* ===== FOOTER STICKY ===== */
        .glass-footer {
            flex-shrink: 0;
            margin-top: auto;
        }

        /* ===== SELECT2 STYLING ===== */
        .select2 { width: 100%!important; }
        .select2-container--default .select2-selection--single {
            background: var(--glass-bg);
            backdrop-filter: var(--glass-blur);
            border: 1px solid var(--glass-border);
            border-radius: 14px;
            padding: 10px;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered { color: var(--text-primary); }
        .select2-dropdown {
            background: rgba(3, 4, 94, 0.95);
            backdrop-filter: var(--glass-blur-strong);
            border: 1px solid var(--glass-border);
            border-radius: 14px;
        }
        .select2-results__option { color: var(--text-primary); }
        .select2-container--default .select2-results__option--highlighted[aria-selected] { background: var(--glass-bg-hover); }

        /* ===== DATATABLES STYLING ===== */
        .dataTables_wrapper { color: var(--text-primary); }
        table.dataTable {
            background: var(--card-gradient);
            border-radius: 16px;
        }
        table.dataTable thead th, table.dataTable thead td {
            background: var(--glass-bg-hover);
            color: var(--text-primary);
            border-bottom: 1px solid var(--glass-border);
        }
        table.dataTable tbody tr { color: var(--text-primary); }
        table.dataTable tbody tr:hover { background: var(--glass-bg-hover); }

        /* ===== CARD STYLING ===== */
        .card {
            background: var(--card-gradient);
            backdrop-filter: var(--glass-blur);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            position: relative;
            overflow: hidden;
        }
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 50%;
            background: linear-gradient(180deg, rgba(255,255,255,0.1) 0%, transparent 100%);
            border-radius: 24px 24px 0 0;
            pointer-events: none;
        }

        /* ===== MODAL STYLING ===== */
        .modal-content {
            background: rgba(3, 4, 94, 0.9);
            backdrop-filter: var(--glass-blur-strong);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            color: var(--text-primary);
        }

        /* ===== FORM STYLING ===== */
        .form-control {
            background: var(--glass-bg);
            backdrop-filter: var(--glass-blur);
            border: 1px solid var(--glass-border);
            color: var(--text-primary);
            border-radius: 14px;
            padding: 14px 18px;
        }
        .form-control:focus {
            background: var(--glass-bg-hover);
            border-color: var(--turquoise-surf);
            box-shadow: 0 0 0 4px rgba(0, 180, 216, 0.2);
            color: var(--text-primary);
        }

        /* ===== RESPONSIVE PADDING ===== */
        @media (max-width: 768px) {
            .app-content {
                padding-top: 70px;
            }
        }
    </style>
</head>
<body>
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
                    <span class="footer-brand"><i class="fas fa-gem"></i> ILoveEmas</span>
                    <span class="footer-version">v3.0.0</span>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="<?=base_url()?>logout-process/">Logout</a>
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
