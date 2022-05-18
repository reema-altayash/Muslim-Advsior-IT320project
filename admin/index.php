<?php
    $hotels = $data['hotels'];
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
                                Hotels
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="hotel_table">
                                <thead class="text-center">
                                <tr>
                                    <th scope="col">Thumbnail</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Town</th>
                                    <th scope="col">City</th>
                                    <th scope="col">Hotel Type</th>
                                    <th scope="col">
                                        <a href="<?php echo \HR\HotelReview\config\AppHelper::get_url('hotel/register'); ?>" class="btn btn-sm btn-info">Add</a>
                                    </th>
                                </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        foreach ($hotels as $hotel):
                                            $hotel = (object)$hotel;
                                    ?>
                                <tr id="tr_<?php echo $hotel->id;?>">

                                    <td width="200px">
                                        <?php if($hotel->thumbnail_url):?>
                                        <img src="<?php echo \HR\HotelReview\config\AppHelper::public_uri();?>asset/img/<?php echo $hotel->thumbnail_url;?>" class="img-thumbnail">
                                        <?php endif;?>
                                    </td>
                                    <td><?php echo $hotel->name;?></td>
                                    <td><?php echo $hotel->town;?></td>
                                    <td><?php echo $hotel->city;?></td>
                                    <td><?php echo $hotel->category;?></td>
                                    <td class="text-center" width="10%">
                                        <a href="<?php echo \HR\HotelReview\config\AppHelper::get_url('hotel/update-hotel/'.$hotel->id); ?>" class="btn btn-warning btn-sm edit" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
                                        <button class="btn btn-danger btn-sm hotel-delete" data-id = "<?php echo $hotel->id;?>" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
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
