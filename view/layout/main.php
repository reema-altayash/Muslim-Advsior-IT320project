<?php
    $appUrl = \HR\HotelReview\config\AppHelper::app();
    $isLoggedIn = \HR\HotelReview\config\AppHelper::isLoggedIn();
?>
<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <title>Muslim Advisor</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo $appUrl;?>/public/asset/css/owl.carousel.css">
        <link rel="stylesheet" href="<?php echo $appUrl;?>/public/asset/css/all.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $appUrl;?>/public/asset/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $appUrl;?>/public/asset/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $appUrl;?>/public/asset/css/responsive.css"/>
        <!-- CSS -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <!-- Default theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    </head>

    <body>
        <button class="wow animated fadeInDown" data-wow-delay="0.3sec" onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-angle-double-up"></i></button>

        <?php include_once 'header.php';?>

        <?php include_once "$______content";?>

        <?php include_once 'footer.php';?>

        <script type="text/javascript" src="<?php echo $appUrl;?>/public/asset/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $appUrl;?>/public/asset/js/popper.js"></script>
        <script type="text/javascript" src="<?php echo $appUrl;?>/public/asset/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo $appUrl;?>/public/asset/js/owl.carousel.js"></script>
        <!-- JavaScript -->
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

        <script>
			mybutton = document.getElementById("myBtn");
			window.onscroll = function() {scrollFunction()};
			var isLoggedIn = '<?php echo $isLoggedIn;?>';

			function scrollFunction() {
			  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
				mybutton.style.display = "block";
				$(".header-area").addClass("header-area2");
			  } else {
				mybutton.style.display = "none";
				$(".header-area").removeClass("header-area2");
			  }
			}

			function topFunction() {
				window.scroll({
				  top: 0,
				  left: 0,
				  behavior: 'smooth'
				});
			}
		</script>
		
		<script>
			$(document).ready(function(){
				$(".menu-dropdown").click(function(){
					$(".dropdown-menu").toggle(500);
				});
			});
		</script>
		
		<script>
			$(document).ready(function(){
				$('.reviews').owlCarousel({
					loop:true,
					dotsEach:true,
					margin:15,
					responsiveClass:true,
					responsive:{
						0:{
							items:1,
							autoplay:true
						},
						600:{
							items:2,
							margin:10,
							autoplay:true
						},
						768:{
							items:3,
							autoplay:true
						},
						1000:{
							items:3,
							autoplay:true
						}
					}
				})


                $(document).on('click', '#submit_review', function (e) {
                    if(isLoggedIn){
                        if(!$('#review_form')[0].checkValidity()) {
                            $('#review_form').addClass('was-validated');
                            $('#submit_review_form').click();
                        }else{
                            let fd = new FormData(document.getElementById('review_form'));
                            let url = $('#review_form').attr('action');

                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: fd,
                                cache: false,
                                dataType: 'json',
                                processData: false,
                                contentType: false,
                                beforeSend: function () {

                                },
                                success: function (data) {console.log(typeof data.status);
                                    if(data.status){
                                        alertify.notify(data.message, 'success', 5, function(){  console.log('dismissed'); });
                                        setTimeout(function() {location.reload()}, 5000);
                                    }else{
                                        alertify.notify(data.message, 'error', 5, function(){  console.log('dismissed'); });
                                    }
                                },
                                error: function(xhr){
                                    let data = xhr.responseJSON;

                                    alertify.notify(data.message, 'error', 5, function(){  console.log('dismissed'); });
                                },
                                complete: function () {

                                }
                            });
                        }
                    }else{
                        alertify.notify("Please login first to submit your review", 'error', 5, function(){  console.log('dismissed'); });
                    }
                });
			});
		</script>
    </body>
</html>
