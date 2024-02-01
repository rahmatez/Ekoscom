<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=settings('company_profile','company_name');?> | <?=settings('company_profile','tagline');?></title>
    <meta name="keywords" content="<?=settings('general','meta_keywords');?>" />
    <meta name="description" content="<?=settings('general','meta_description');?>" />
    <link rel="icon" href="<?=base_url('uploads/'. settings('general','favicon'));?>">
    <!-- Favicons -->
    <link href="<?= base_url(); ?>assets/front-end/img/<?= settings('general','favicon'); ?>" rel="icon">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>bower_components/Ionicons/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet"
        href="<?= base_url('assets/'); ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>bower_components/select2/dist/css/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
	folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/skins/_all-skins.min.css">
    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- jQuery 3 -->
    <script src="<?= base_url('assets/'); ?>bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?= base_url('assets/'); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?= base_url('assets/'); ?>bower_components/fastclick/lib/fastclick.js"></script>
    <!-- DataTables -->
    <script src="<?= base_url('assets/'); ?>bower_components/datatables.net/js/jquery.dataTables.min.js">
    </script>
    <script src="<?= base_url('assets/'); ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
    </script>
    <!-- CK Editor -->
    <script src="<?= base_url('assets/'); ?>bower_components/ckeditor/ckeditor.js"></script>
    <!-- Select2 -->
    <script src="<?= base_url('assets/'); ?>bower_components/select2/dist/js/select2.full.min.js"></script>
    <!-- Mask Money -->
    <script src="<?= base_url('assets/'); ?>plugins/jquery-mask.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/'); ?>dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url('assets/'); ?>dist/js/demo.js"></script>
    <script>
    $(function() {
        // Datatables
        $('#example1').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': false,
            'info': true,
            'autoWidth': true
        });
        $(function() {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor1', {
                toolbar: [{
                        name: 'document',
                        items: ['Source', '-', 'NewPage', 'Preview', '-', 'Templates']
                    },
                    ['Undo', 'Redo', '-', 'Cut', 'Copy', 'Paste', 'PasteText',
                        'PasteFromWord'
                    ],
                    {
                        name: 'links',
                        items: ['Link', 'Unlink']
                    },
                    {
                        name: 'insert',
                        items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar']
                    },
                    {
                        name: 'tools',
                        items: ['Maximize']
                    },
                    '/',
                    {
                        name: 'basicstyles',
                        items: ['Bold', 'Italic', 'Underline', 'Strike', '-',
                            'RemoveFormat'
                        ]
                    },
                    {
                        name: 'paragraph',
                        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent',
                            '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft',
                            'JustifyCenter', 'JustifyRight'
                        ]
                    },
                    {
                        name: 'styles',
                        items: ['Styles', 'Format']
                    }
                ]
            });
        });
        // Select2
        $('.select2').select2();
        // View modal add category
        $('#add_category').on('click', function() {
            $('#modal_add_category').modal('show', {
                backdrop: 'static'
            });
        });
        // View modal add tag
        $('#add_tag').on('click', function() {
            $('#modal_add_tag').modal('show', {
                backdrop: 'static'
            });
        });
    })
    // Fungsi check all
    $(function() {
        $('#check_all').on('click', function() {
            if (this.checked) {
                $('.check').each(function() {
                    this.checked = true;
                });
            } else {
                $('.check').each(function() {
                    this.checked = false;
                });
            }
        });

        $('.check').on('click', function() {
            if ($('.check:checked').length == $('.check').length) {
                $('#check_all').prop('checked', true);
            } else {
                $('#check_all').prop('checked', false);
            }
        });
    });
    $(document).ready(function() {
        $('.harga').mask('000.000.000.000.000', {
            reverse: true
        });
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    </script>
</head>

<body class="hold-transition skin-blue fixed sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="dashboard" class="logo">
                <span class="logo-mini"><b><i class="fa fa-cogs"></i></b></span>
                <span class="logo-lg"><b>CONTROL </b>PANEL</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Control Sidebar Toggle Button -->
                        <li <?=isset($user_profile) ? 'class="active"':'';?>>
                            <a href="<?=base_url('user/user_profile');?>"><i class="fa fa-edit"></i> UPDATE PROFILE</a>
                        </li>
                        <li <?=isset($change_password) ? 'class="active"':'';?>>
                            <a href="<?=base_url('user/change_password');?>"><i class="fa fa-key"></i> CHANGE
                                PASSWORD</a>
                        </li>
                        <li class="" style="background-color:red;">
                            <a href="<?=base_url('auth/logout');?>"><i class="fa fa-power-off"></i> LOGOUT</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="main-sidebar">
            <?php $this->load->view('backend/sidebar');?>
        </aside>
        <div class="content-wrapper">
            <?php $this->load->view($content);?>
        </div>
        <!-- Control Sidebar Right -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Create the tabs -->
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!-- Home tab content -->
                <div class="tab-pane" id="control-sidebar-home-tab">
                </div>
            </div>
        </aside>
        <div class="control-sidebar-bg"></div>
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version 1.1.0</b>

            </div>
            <strong>Copyright &copy; <?=date('Y');?></strong> All rights reserved
			
        </footer>
        </d iv>
</body>


</html>
