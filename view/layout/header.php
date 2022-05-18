<?php
	$url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
    if($url){
        $url = rtrim("$url","/");
        $url = ltrim("$url","/");
        $url = str_replace("?r=","", $url);
        $url = explode("/",filter_var($url,FILTER_SANITIZE_URL));
        $method = isset($url[2]) ? strtolower($url[2]) : 'index';
    }
	
	if($method != "sign-up" && $method != "login"){
?>
<div class="header-area">
	<div class="container">
		<div class="header">
			<div class="row">
				<div class="menu-left col-md-2 float-left">
					<div class="logo">
						<a href="<?php echo $appUrl;?>">
							<img src="<?php echo $appUrl;?>/public/asset/img/logo.png" alt="" />
						</a>
					</div>
				</div>
				<div class="menu-right col-md-10 float-right">
					<div class="nav d-flex justify-content-center" id="nav">
                        <?php if (\HR\HotelReview\config\AppHelper::isLoggedIn()):?>
                            <div class="dropdown">
                              <button class="btn btn-outline-warning dropdown-toggle dropdown-toggle menu-dropdown" type="button" data-toggle="dropdown">
                                  <?php echo \HR\HotelReview\config\AppHelper::getLoggedInUserName()?>
                              <span class="caret"></span></button>
                              <ul class="dropdown-menu nav-dropdown-menu">
                                <li><a href="<?php echo \HR\HotelReview\config\AppHelper::get_url('hotel'); ?>">Dashboard</a></li>
                                <li><a href="<?php echo \HR\HotelReview\config\AppHelper::get_url('auth/logout'); ?>">Log Out</a></li>
                              </ul>
                            </div>

                        <?php else:?>
                            <ul id="nav-menu">
                                <li>
                                    <a href="<?php echo \HR\HotelReview\config\AppHelper::get_url('auth/sign-up'); ?>" class="btn btn-warning mr-1">Sign Up</a>
                                </li>
                                <li>
                                    <a href="<?php echo \HR\HotelReview\config\AppHelper::get_url('auth/login'); ?>" class="btn btn-warning-dark">Sign In</a>
                                </li>

                            </ul>
                        <?php endif;?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	}
?>
