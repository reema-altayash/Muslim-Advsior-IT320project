<?php
    $ratings = $data['ratings'];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo \HR\HotelReview\config\AppHelper::get_url('home'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                My Review
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">

                            <!-- Small boxes (Stat box) -->
                            <div class="row">
                                <?php
                                if(!empty($ratings)):
                                    foreach ($ratings as $rating):
                                        $rating = (object)$rating;
                                        ?>
                                        <div class="col-lg-3 col-6">
                                            <!-- small box -->
                                            <div class="small-box bg-gradient-indigo">
                                                <div class="inner">
                                                    <img width="100%" src="<?php echo \HR\HotelReview\config\AppHelper::public_uri();?>asset/img/<?php echo $rating->thumbnail_url;?>" alt="" />
                                                </div>
                                                <div class="icon">
                                                    <h4 class="text-white"><?php echo $rating->hotel_name;?></h4>
                                                </div>
                                                <a href="<?php echo \HR\HotelReview\config\AppHelper::get_url("main/hotel-details/$rating->hotel_id"); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                    <?php
                                    endforeach;
                                endif;
                                ?>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </section>
                <!-- /.Left col -->
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
