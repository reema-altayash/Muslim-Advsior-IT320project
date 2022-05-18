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
<!-- Footer -->
<div class="footer-area text-white">
	<div class="container footer">
		<div class="row">
			<div class="col-md-12 text-center float-left">
				<p>All rights reserved &copy; KSU College of CIS <?php echo date('Y');?></p>
			</div>
		</div>
	</div>
</div>
<?php
	}
?>