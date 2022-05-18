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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Ratings</li>
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
                                Reviews
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="review_table">
                                <thead class="text-center">
                                <tr>
                                    <th scope="col">Hotel Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Review Title</th>
                                    <th scope="col">Ratings</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        foreach ($ratings as $rating):
                                    ?>
                                <tr id="tr_<?php echo $rating->id;?>">
                                    <td><?php echo $rating->hotel_name;?></td>
                                    <td><?php echo $rating->user_name;?></td>
                                    <td><?php echo $rating->title;?></td>
                                    <td><?php echo $rating->rating;?></td>
                                    <td><?php echo $rating->review;?></td>
                                    <td><?php echo date('d M Y', strtotime($rating->created_at));?></td>
                                    <td class="text-center" width="10%">
                                        <button class="btn btn-danger btn-sm rating-delete" data-id = "<?php echo $rating->id;?>" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-alt"></i></button>
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
