<?php
    
?>

<div class="sign-up-area text-white bg-black">
	<div class="sign-up container-fluid">
		<div class="row">
			<div class="col-md-4 sign-up-left float-left">
				<div class="app-logo">
					<a href="<?php echo $appUrl;?>">
						<img src="<?php echo $appUrl;?>/public/asset/img/logo.png" alt="" />
					</a>
				</div>
				
				<div class="sign-up-form mx-auto d-block">
					<h3>Sign Up</h3>
					
					<?php
						$name      	= isset($data["name"]) ? $data["name"] : '';
						$email      = isset($data["email"]) ? $data["email"] : '';
						$phone      = isset($data["phone"]) ? $data["phone"] : '';
						$password   = isset($data["password"]) ? $data["password"] : '';
						$confirm_password   = isset($data["confirm_password"]) ? $data["confirm_password"] : '';

						if(isset($error) && !empty($error)):
					?>
					
					<div class="alert alert-danger">
						<ol>
							<?php foreach ($error as $err):?>
							<li><?php echo $err;?></li>
							<?php endforeach;?>
						</ol>
					</div>
					<?php endif; ?>
					
					<form name="register" action="<?php echo \HR\HotelReview\config\AppHelper::get_url('auth/sign-up'); ?>" method="POST">
						<div class="form-row">
							
							<div class="col-md-12 form-group">
								<input type="text" name="name" pattern="[A-Za-z -]+" oninvalid="setCustomValidity('Please enter alphabets only. ')" class="form-control" placeholder="Enter your name" id="fullname" value="<?php echo $name;?>" required>
							</div>
							
							<div class="col-md-12 form-group">
								<input type="email" pattern="[a-zA-Z0-9._-]{3,}@[a-zA-Z0-9.-]{3,}\.[a-zA-Z]{2,4}" class="form-control" id="email" name="email" placeholder="Enter Email" value="<?php echo $email;?>" required>
							</div>
							
							<div class="col-md-12 form-group">
								<input type="text" name="phone" pattern="[+?096]+\s?\d{2}\s?\d{7}"
                                       title="Phone number must be a valid number" class="form-control" placeholder="Enter your phone number" id="phone" value="<?php echo $phone;?>" required>
							</div>
							
							<div class="col-md-12 form-group">
								<input type="password" onkeyup='check_pass();' class="form-control" id="password" name="password" placeholder="Create Password" value="<?php echo $password;?>" required>
							</div>
							
							<div class="col-md-12 form-group">
								<input type="password" onkeyup='check_pass();' class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" value="<?php echo $confirm_password;?>" required="required">
                                <small id="passwordHelp" class="text-danger" style="display: none;">
                                    Password and confirm password does not match
                                </small>
                            </div>
							
							<div class="col-md-12 mt-3 text-center">
								<input type="submit" id="submit" value="Sign Up" class="btn btn-block btn-warning" />
							</div>
							
							<div class="s-12 col-md-12 text-center mt-2 float-left">
								<p>Already have an account? <a href="<?php echo \HR\HotelReview\config\AppHelper::get_url('auth/login'); ?>">Sign In Now!</a></p>
							</div>
							
							<div class="col-md-12 text-center mt-4 float-left">
								<p class="text-muted">All rights reserved &copy; KSU College of CIS 2022</p>
							</div>
							
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
			</div>
			
			<div class="col-md-8 sign-up-right float-left">
			</div>
		</div>
	</div>
</div>
