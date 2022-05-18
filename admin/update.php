<?php
    $categories = \HR\HotelReview\config\AppHelper::getCategories();

    $hotelInfo = (object)$data['hotelInfo'];
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
                        <li class="breadcrumb-item"><a href="<?php echo \HR\HotelReview\config\AppHelper::get_url('hotel'); ?>">Hotels</a></li>
                        <li class="breadcrumb-item active">Update Hotel</li>
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
                                Update Hotel
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <?php if(isset($error) && !empty($error)): ?>
                                <div class="alert alert-danger">
                                    <ol>
                                        <?php foreach ($error as $err):?>
                                            <li><?php echo $err;?></li>
                                        <?php endforeach;?>
                                    </ol>
                                </div>
                            <?php endif; ?>

                            <?php if(isset($success) && !empty($success)): ?>
                                <div class="alert alert-success">
                                    <p class="text-center"><?php echo $success;?></p>
                                </div>
                            <?php endif; ?>
                            <div class="col-md-6 offset-3">
                                <form action="<?php echo \HR\HotelReview\config\AppHelper::get_url('hotel/update-hotel/'.$hotelInfo->id); ?>" class="form" method="POST" autocomplete="off">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input class="form-control" value="<?php echo $hotelInfo->name;?>" name="name" id="name" pattern="[A-Za-z -]+" oninvalid="setCustomValidity('Please enter alphabets only. ')" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="town">Town</label>
                                        <input class="form-control" value="<?php echo $hotelInfo->town;?>" name="town" id="town" pattern="[A-Za-z -]+" oninvalid="setCustomValidity('Please enter alphabets only. ')" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input class="form-control" value="<?php echo $hotelInfo->city;?>" name="city" id="city" pattern="[A-Za-z -]+" oninvalid="setCustomValidity('Please enter alphabets only. ')" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input class="form-control" value="<?php echo $hotelInfo->phone;?>" name="phone" id="phone"  pattern="[7-9]{1}[0-9]{9}"
                                               title="Phone number with 7-9 and remaining 9 digit with 0-9" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea class="form-control" name="address" id="address" required><?php echo $hotelInfo->address;?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" id="description" required><?php echo $hotelInfo->description;?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select class="form-control" id="category" name="category">
                                            <option>Select</option>
                                            <?php
                                            foreach ($categories as $key => $category ):?>
                                                <option value="<?php echo $category;?>"
                                                <?php if($category == $hotelInfo->description); echo 'selected'?>>
                                                    <?php echo $category;?></option>

                                            <?php endforeach;?>
                                        </select>
                                    </div>

                                    <div class="form-group mt-3 text-center">
                                        <input type="submit" id="submit" value="Update" class="btn btn-success" />
                                    </div>
                                </form>
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
