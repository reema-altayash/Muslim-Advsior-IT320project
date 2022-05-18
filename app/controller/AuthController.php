<?php

namespace HR\HotelReview\controller;

use HR\HotelReview\config\AppHelper;
use HR\HotelReview\config\Auth;
use HR\HotelReview\config\DB;

class AuthController extends DB {
    use Auth;

    public function __construct($path) {
        parent::__construct($path);
    }

    public function index(){
        $this->login();
    }

    public function login(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = $this->check_login($_POST);

            if($auth["status"]){
                $appUrl = AppHelper::get_url('user');
                header("Location: $appUrl");
            }else{
                $error = $auth["error"];
                $this->load('auth/login', $_POST, '', $error);
            }
        }else{
            if(self::MayBeLoggedIn()){
                $appUrl = AppHelper::get_url('user');
                header("Location: $appUrl");
            }
            $this->load('auth/login');
        }

    }

    public function sign_up($user_type = ''){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = $this->register($_POST);

            if($auth["status"]){
                $appUrl = AppHelper::get_url('user');
                header("Location: $appUrl");
            }else{
                $error 	= $auth["error"];
				$name 	= $_POST["name"];
				$email 	= $_POST["email"];
				$phone 	= $_POST["phone"];
				$password = $_POST["password"];
				$confirm_password = $_POST["confirm_password"];
                
				$this->load('auth/register', compact('user_type', 'error', 'name', 'email', 'phone', 'password', 'confirm_password'));
            }
        }else{
            $this->load('auth/register', compact('user_type'));
        }
    }

    public function logout(){
        $this->sign_out();
        $appUrl = AppHelper::get_url('home');
        header("Location: $appUrl");
    }

}
