
<?php
$appUrl = \HR\HotelReview\config\AppHelper::app();
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $appUrl;?>/public/asset/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $appUrl;?>/public/asset/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $appUrl;?>/public/asset/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $appUrl;?>/public/asset/css/responsive.css"/>
</head>

<body>
<button class="wow animated fadeInDown" data-wow-delay="0.3sec" onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-angle-double-up"></i></button>

<div class="container">
    <div class="preloader">
        <ul>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
</div>

<div class="error_area">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1>
                    Oops!</h1>
                <h2>
                    404 Not Found</h2>
                <div class="error-details">
                    Sorry, an error has occured, Requested page not found!
                </div>
                <div class="error-actions">
                    <a href="<?php echo $appUrl;?>" class="btn btn-warning"><span class="glyphicon glyphicon-home"></span>
                        Take Me Home </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript" src="<?php echo $appUrl;?>/public/asset/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $appUrl;?>/public/asset/js/bootstrap.min.js"></script>

<script>
    mybutton = document.getElementById("myBtn");
    window.onscroll = function() {scrollFunction()};

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

    $(window).on("load", function(){
        $(".preloader").fadeOut();
    });
</script>
</body>
</html>
