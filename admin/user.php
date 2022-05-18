<?php
    $users = $data['users'];
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
                        <li class="breadcrumb-item active">Users</li>
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
                                Manage Users
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="users_table">
                                <thead class="text-center">
                                <tr>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email Address</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">User Type</th>
                                    <th scope="col">
                                        <a href="<?php echo \HR\HotelReview\config\AppHelper::get_url('hotel/create-user'); ?>" class="btn btn-sm btn-info">Add</a>
                                    </th>
                                </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        foreach ($users as $user):
                                            $user = (object)$user;
                                    ?>
                                <tr id="tr_<?php echo $user->id;?>">
                                    <td><?php echo $user->name;?></td>
                                    <td><?php echo $user->email_address;?></td>
                                    <td><?php echo $user->phone;?></td>
                                    <td><?php echo $user->user_type;?></td>
                                    <td class="text-center" width="10%">
                                        <button class="btn btn-danger btn-sm user-delete" data-id = "<?php echo $user->id;?>" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-alt"></i></button>
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
