<?php
namespace HR\HotelReview\config;

use HR\HotelReview\model\User;

session_start();

trait Auth {
    function check_login($post){
        $email        = '';
        $password     = '';
        $arr = [];

        if($post['email'] == ''){
            array_push($arr, "Email address can not be blank");
        }elseif(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            array_push($arr, "Provided Email address is invalid");
        }else{
            $email = $post['email'];
        }

        if($post['password'] == ''){
            array_push($arr, "Password can not be blank");
        }else{
            $password = $post['password'];
        }

        if(sizeof($arr))
            return array(
                "status" => false,
                "error" => $arr
            );

        $hashPassword = md5($password);

        $this->tableName = 'users';
        $this->columns = array('id', 'name', 'email_address', 'user_type');
        $this->conditions = array('email_address' => $email, 'password' => $hashPassword);

        $row = $this->getOne();

        if($row['status']){
            $_SESSION['users'] = $row['data'];
            return array(
                "status" => true,
                "user" => $_SESSION['users']
            );
        }else{
            array_push($arr, "Provided credential is invalid");
            return array(
                "status" => false,
                "error" => $arr
            );
        }
    }

    function register($post){
        $name        = '';
        $email        = '';
        $phone        = '';
        $password     = '';
        $confirm_password = '';
        $user_type = 'User';
        $arr = [];

		if($post['name'] == ''){
            array_push($arr, "Name can not be blank");
        }else{
            $name = $post['name'];
        }
		
        if($post['email'] == ''){
            array_push($arr, "Email address can not be blank");
        }elseif(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            array_push($arr, "Provided Email address is invalid");
        }else{
            $email = $post['email'];
        }
		
		if($post['phone'] == ''){
            array_push($arr, "Phone can not be blank");
        }else{
            $phone = $post['phone'];
        }

        if($post['password'] == ''){
            array_push($arr, "Password can not be blank");
        }else{
            $password = $post['password'];
        }

        if($post['confirm_password'] == ''){
            array_push($arr, "Confirm password can not be blank");
        }else{
            $confirm_password = $post['confirm_password'];
			if($password != $confirm_password){
				array_push($arr, "Password and confirm password does not match");
			}
        }
		
        if(sizeof($arr))
            return array(
                "status" => false,
                "error" => $arr
            );

        $hashPassword = md5($password);

        $this->tableName = 'users';
        $this->columns = array('id', 'name', 'email_address', 'user_type');
        $this->conditions = array('email_address' => $email);

        $row = $this->getOne();

        if($row['status']){
            array_push($arr, "User already exist for given email address");
            return array(
                "status" => false,
                "error" => $arr
            );
        }else{
			$this->tableName = 'users';
            $this->columns = array('name', 'email_address', 'phone', 'password', 'user_type');
			$this->values = array("'$name'", "'$email'", "'$phone'", "'$hashPassword'", "'$user_type'");

			$id = $this->insert();

			if($id){
                $user = new User();
                $data =  $user->find($id);
                $_SESSION['users'] = $data;
				return array(
					"status" => true,
					"user" => $_SESSION['users']
				);
			}else{
				array_push($arr, "Something went wrong!! Please try again later");
				return array(
					"status" => false,
					"error" => $arr
				);
			}
        }
    }

    function sign_out(){
        unset($_SESSION['users']);
        session_unset();
        session_destroy();

        return true;
    }

    public static function MayBeLoggedIn(){
        if(isset($_SESSION['users']) && !empty($_SESSION['users']))
            return true;

        return false;
    }

    public static function getLoggedInUserInfo(){
        if(isset($_SESSION['users']) && !empty($_SESSION['users'])){
            return $_SESSION['users'];
        }else{
            return [];
        }
    }

    public static function getLoggedInUserType(){
        if(isset($_SESSION['users']) && !empty($_SESSION['users'])){
            return $_SESSION['users']['user_type'];
        }else{
            return false;
        }
    }

    public function getLoggedInUserName(){
        $userInfo = $this->getLoggedInUserInfo();
        if(!empty($userInfo)){
            if(isset($userInfo['name']) && $userInfo['name'])
                return  $userInfo['name'];
            else return  "";
        }else return "";
    }
}
