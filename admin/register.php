<?php
    $categories = \HR\HotelReview\config\AppHelper::getCategories();
    $data = (object) $data;
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
                        <li class="breadcrumb-item active">Register Hotel</li>
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
                                Register Hotel
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
                                <form  class="form" method="POST" autocomplete="off" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input class="form-control" name="name" id="name" pattern="[A-Za-z -]+" oninvalid="setCustomValidity('Please enter alphabets only. ')" <?php if(isset($data->name)):?> value="<?php echo $data->name;?>" <?php endif;?> required>
                                    </div>

                                    <div class="form-group">
                                        <label for="town">Town</label>
                                        <input class="form-control" name="town" id="town" pattern="[A-Za-z -]+" oninvalid="setCustomValidity('Please enter alphabets only. ')" <?php if(isset($data->town)):?> value="<?php echo $data->town;?>" <?php endif;?> required>
                                    </div>

                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input class="form-control" name="city" id="city" pattern="[A-Za-z -]+" oninvalid="setCustomValidity('Please enter alphabets only. ')" <?php if(isset($data->city)):?> value="<?php echo $data->city;?>" <?php endif;?> required>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input class="form-control" name="phone" id="phone" pattern="[+?096]+\s?\d{2}\s?\d{7}"
                                               title="Phone number must be a valid number" <?php if(isset($data->phone)):?> value="<?php echo $data->phone;?>" <?php endif;?> required>
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea class="form-control" name="address" id="address" required><?php if(isset($data->address)):?><?php echo $data->address;?> <?php endif;?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" id="description" required><?php if(isset($data->description)):?><?php echo $data->description;?> <?php endif;?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select class="form-control" id="category" name="category">
                                            <option>Select</option>
                                            <?php
                                            foreach ($categories as $key => $category ){
                                                echo "<option value='$category'>$category</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="photo">Add Thumbnail</label>
                                        <input type="file" class="" id="photo" name="photo" required>
                                    </div>

                                    <div class="form-group mt-3 text-center">
                                        <input type="submit" id="submit" value="Register" class="btn btn-success" />
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
