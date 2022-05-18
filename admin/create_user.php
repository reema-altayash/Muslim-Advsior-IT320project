<?php
    $name      	= isset($data["name"]) ? $data["name"] : '';
    $email      = isset($data["email"]) ? $data["email"] : '';
    $phone      = isset($data["phone"]) ? $data["phone"] : '';
    $password   = isset($data["password"]) ? $data["password"] : '';
    $confirm_password   = isset($data["confirm_password"]) ? $data["confirm_password"] : '';
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
                        <li class="breadcrumb-item"><a href="<?php echo \HR\HotelReview\config\AppHelper::get_url('hotel/users'); ?>">Users</a></li>
                        <li class="breadcrumb-item active">Create User</li>
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
                                Create New User
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
                                <form  class="form" method="POST" autocomplete="off">
                                    <div class="col-md-12 form-group">
                                        <label for="name">Full Name</label>
                                        <input type="text" name="name" pattern="[A-Za-z -]+" oninvalid="setCustomValidity('Please enter alphabets only. ')" class="form-control" placeholder="Enter your name" id="fullname" value="<?php echo $name;?>" required>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="email">Email Address</label>
                                        <input type="email" pattern="[a-zA-Z0-9._-]{3,}@[a-zA-Z0-9.-]{3,}\.[a-zA-Z]{2,4}" class="form-control" id="email" name="email" placeholder="Enter Email" value="<?php echo $email;?>" required>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" pattern="[+?096]+\s?\d{2}\s?\d{7}"
                                               title="Phone number must be a valid number" class="form-control" placeholder="Enter your phone number" id="phone" value="<?php echo $phone;?>" required>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="password">Password</label>
                                        <input type="password" onkeyup='check_pass();' class="form-control" id="password" name="password" placeholder="Create Password" value="<?php echo $password;?>" required>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="confirm_password">Confirm Password</label>
                                        <input type="password" onkeyup='check_pass();' class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" value="<?php echo $confirm_password;?>" required="required">
                                        <small id="passwordHelp" class="text-danger" style="display: none;">
                                            Password and confirm password does not match
                                        </small>
                                    </div>

                                    <div class="form-group">
                                        <label for="user_type">User Type</label>
                                        <select class="form-control" id="user_type" name="user_type">
                                            <option>Select</option>
                                            <option value="Admin">Admin</option>
                                            <option value="User">User</option>
                                        </select>
                                    </div>

                                    <div class="form-group mt-3 text-center">
                                        <input type="submit" id="submit" value="Create" class="btn btn-success" />
                                    </div>
                                </form>
                                <script>
                                    function check_pass() {
                                        if (document.getElementById('confirm_password').value !== '' && document.getElementById('password').value == document.getElementById('confirm_password').value) {
                                            document.getElementById('passwordHelp').style.display = 'none';
                                            document.getElementById('submit').disabled = false;
                                        } else {
                                            document.getElementById('passwordHelp').style.display = '';
                                            document.getElementById('submit').disabled = true;
                                        }
                                    }
                                </script>
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
