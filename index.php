<?php
    DEFINE('_ROOT', __DIR__);

    require_once 'vendor/autoload.php';

    use HR\HotelReview\controller\MainController;
    use HR\HotelReview\config\AppHelper;

    $url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
    if($url){
        $url = rtrim("$url","/");
        $url = ltrim("$url","/");
        $url = str_replace("?r=","", $url);
        $url = explode("/",filter_var($url,FILTER_SANITIZE_URL));

		if ($_SERVER["HTTP_HOST"] == 'localhost' || $_SERVER["HTTP_HOST"] == '127.0.0.1' ){
            $controller = (isset($url[1]) && strtolower($url[1]) != 'home') ? ucfirst($url[1]).'Controller' : 'MainController';
            $method = isset($url[2]) ? strtolower($url[2]) : 'index';
            $params =  implode(',',(array_splice($url, 3)));
        }else{
            $controller = (isset($url[0]) && strtolower($url[0]) != 'home') ? ucfirst($url[0]).'Controller' : 'MainController';
            $method = isset($url[1]) ? strtolower($url[1]) : 'index';
            $params =  implode(',',(array_splice($url, 2)));
        }

        $file = __DIR__."/app/controller/$controller.php";
        if(!file_exists($file)){
            $controller = 'MainController';
        }

        $controller = 'HR\HotelReview\controller\\'.$controller;
        $controller = new $controller(__DIR__);
        $method = AppHelper::resolve_path($method);

        if(!$controller->isValid($method)){
            $method = 'not_found';
        }

        $controller->$method($params);
    }else{
        unset($url);
        $base = new MainController(__DIR__);

        $base->index();
    }
