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
					<h3>Sign In</h3>
					
					<?php
						$email      = isset($data["email"]) ? $data["email"] : '';
						$password   = isset($data["password"]) ? $data["password"] : '';

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
					
					<form action="<?php echo \HR\HotelReview\config\AppHelper::get_url('auth/login'); ?>" method="POST">
						<div class="form-row">
							<div class="col-md-12 form-group">
								<input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="<?php echo $email;?>" required>
							</div>
							
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" value="<?php echo $password;?>" required>
							</div>
							
							<div class="col-md-12 mt-3 text-center">
								<input type="submit" value="Sign In" class="btn btn-block btn-warning" />
							</div>
							
							<div class="s-12 col-md-12 text-center mt-2 float-left">
								<p>Don't have an account? <a href="<?php echo \HR\HotelReview\config\AppHelper::get_url('auth/sign-up'); ?>">Sign Up</a></p>
							</div>
							
							<div class="col-md-12 text-center mt-4 float-left">
								<p class="text-muted">All rights reserved &copy; KSU College of CIS 2022</p>
							</div>
							
						</div>
					</form>
				</div>
			</div>
			
			<div class="col-md-8 sign-up-right float-left">
			</div>
		</div>
	</div>
</div>
