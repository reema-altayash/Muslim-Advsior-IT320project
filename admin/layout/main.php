<?php

use HR\HotelReview\config\AppHelper;

$appUrl = AppHelper::app();
$isLoggedIn = AppHelper::isLoggedIn();
$user = (object)AppHelper::getLoggedInUserInfo();

$url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
if($url) {
    $url = rtrim("$url", "/");
    $url = ltrim("$url", "/");
    $url = str_replace("?r=", "", $url);
    $url = explode("/", filter_var($url, FILTER_SANITIZE_URL));

    if ($_SERVER["HTTP_HOST"] == 'localhost' || $_SERVER["HTTP_HOST"] == '127.0.0.1') {
        $method = isset($url[2]) ? strtolower($url[2]) : 'index';
    } else {
        $method = isset($url[1]) ? strtolower($url[1]) : 'index';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Muslim Advisor</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo $appUrl;?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?php echo $appUrl;?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo $appUrl;?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo $appUrl;?>/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $appUrl;?>/public/asset/admin/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo $appUrl;?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo $appUrl;?>/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo $appUrl;?>/plugins/summernote/summernote-bs4.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">



    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="<?php echo $appUrl;?>" class="brand-link">
            <img src="<?php echo $appUrl;?>/public/asset/admin/img/AdminLTELogo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Muslim Advisor</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?php echo $appUrl;?>/public/asset/admin/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?php echo $user->name;?></a>
                </div>
            </div>


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo \HR\HotelReview\config\AppHelper::get_url('hotel'); ?>" class="nav-link <?php if($method == 'index') echo 'active'; ?>">
                                    <i class="fa fa-home nav-icon"></i>
                                    <p>Hotels</p>
                                </a>
                            </li>
                            <?php if(AppHelper::isAdmin()):?>
                            <li class="nav-item">
                                <a href="<?php echo \HR\HotelReview\config\AppHelper::get_url('hotel/users'); ?>" class="nav-link <?php if($method == 'users') echo 'active'; ?>">
                                    <i class="fa fa-user-cog nav-icon"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo \HR\HotelReview\config\AppHelper::get_url('hotel/ratings'); ?>" class="nav-link <?php if($method == 'ratings') echo 'active'; ?>">
                                    <i class="fa fa-recycle nav-icon"></i>
                                    <p>Ratings</p>
                                </a>
                            </li>
                            <?php endif;?>
                        </ul>
                    </li>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

        <?php include_once "$______content";?>

        <?php include_once 'footer.php';?>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo $appUrl;?>/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo $appUrl;?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo $appUrl;?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo $appUrl;?>/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo $appUrl;?>/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo $appUrl;?>/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo $appUrl;?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo $appUrl;?>/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo $appUrl;?>/plugins/moment/moment.min.js"></script>
<script src="<?php echo $appUrl;?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo $appUrl;?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo $appUrl;?>/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo $appUrl;?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $appUrl;?>/public/asset/admin/js/adminlte.js"></script>
<!-- bootbox -->
<script src="<?php echo $appUrl;?>/plugins/bootbox/bootbox.js"></script>
<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.hotel-delete', function (e) {
            let id = $(this).data('id');
            let trId = 'tr_' + id;
            let url = '<?php echo \HR\HotelReview\config\AppHelper::get_url('hotel/delete-hotel/'); ?>';

            var values = {
                'id': id
            };
            bootbox.confirm({
                message: "Do you want to delete?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success pull-left'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger pull-right'
                    }
                },
                callback: function (result) {
                    if (result) {
                        $.ajax({
                            url: url + id,
                            type: 'POST',
                            data: values,
                            beforeSend: function () {

                            },
                            success: function (response) {
                                let data = JSON.parse(response)
                                if (data.status) {
                                    $('table#hotel_table tr#' + trId).remove();
                                    alertify.notify(data.message, 'success', 5, function () {
                                        console.log('dismissed');
                                    });
                                } else {
                                    alertify.notify(data.message, 'success', 5, function () {
                                        console.log('dismissed');
                                    });
                                }
                            },
                            error: function (xhr) {
                                let data = xhr.responseJSON;

                                alertify.notify(data.message, 'success', 5, function () {
                                    console.log('dismissed');
                                });
                            },
                            complete: function () {
                                setTimeout(function () {

                                }, 500);
                            }
                        });
                    }
                }
            });


        });

        $(document).on('click', '.rating-delete', function (e) {
            let id = $(this).data('id');
            let trId = 'tr_' + id;
            let url = '<?php echo \HR\HotelReview\config\AppHelper::get_url('hotel/delete-rating/'); ?>';

            var values = {
                'id': id
            };
            bootbox.confirm({
                message: "Do you want to delete?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success pull-left'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger pull-right'
                    }
                },
                callback: function (result) {
                    if (result) {
                        $.ajax({
                            url: url + id,
                            type: 'POST',
                            data: values,
                            beforeSend: function () {

                            },
                            success: function (response) {
                                let data = JSON.parse(response)
                                if (data.status) {
                                    $('table#review_table tr#' + trId).remove();
                                    alertify.notify(data.message, 'success', 5, function () {
                                        console.log('dismissed');
                                    });
                                } else {
                                    alertify.notify(data.message, 'danger', 5, function () {
                                        console.log('dismissed');
                                    });
                                }
                            },
                            error: function (xhr) {
                                let data = xhr.responseJSON;

                                alertify.notify(data.message, 'danger', 5, function () {
                                    console.log('dismissed');
                                });
                            },
                            complete: function () {
                                setTimeout(function () {

                                }, 500);
                            }
                        });
                    }
                }
            });


        });

        $(document).on('click', '.user-delete', function (e) {
            let id = $(this).data('id');
            let trId = 'tr_' + id;
            let url = '<?php echo \HR\HotelReview\config\AppHelper::get_url('hotel/delete-user/'); ?>';

            var values = {
                'id': id
            };
            bootbox.confirm({
                message: "Do you want to delete?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success pull-left'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger pull-right'
                    }
                },
                callback: function (result) {
                    if (result) {
                        $.ajax({
                            url: url + id,
                            type: 'POST',
                            data: values,
                            beforeSend: function () {

                            },
                            success: function (response) {
                                let data = JSON.parse(response)
                                if (data.status) {
                                    $('table#users_table tr#' + trId).remove();
                                    alertify.notify(data.message, 'success', 5, function () {
                                        console.log('dismissed');
                                    });
                                } else {
                                    alertify.notify(data.message, 'danger', 5, function () {
                                        console.log('dismissed');
                                    });
                                }
                            },
                            error: function (xhr) {
                                let data = xhr.responseJSON;

                                alertify.notify(data.message, 'danger', 5, function () {
                                    console.log('dismissed');
                                });
                            },
                            complete: function () {
                                setTimeout(function () {

                                }, 500);
                            }
                        });
                    }
                }
            });


        });
    });
</script>
</body>
</html>
