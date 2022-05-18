<?php

namespace HR\HotelReview\config;

use HR\HotelReview\model\Hotel;

class AppHelper extends Base {
    CONST USERS_TABLE = 'users';
    CONST HOTEL_TABLE = 'hotels';
    CONST REVIEW_TABLE = 'reviews';


    CONST ADMIN_NAME = 'System Admin';
    CONST ADMIN_EMAIL = 'test@admin.co';
    CONST ADMIN_PASSWORD = 'Test123';

    public static function app(){
        return getenv('APP_URL');
    }

    public static function get_url($url){
        return self::app().'?r='.$url;
    }

    public static function public_uri(){
        return self::app().'public/';
    }

    public static function resolve_path($url){
        return str_replace("-","_",$url);
    }

    public static function isLoggedIn(){
        return Auth::MayBeLoggedIn();
    }

    public static function getLoggedInUserInfo(){
        return Auth::getLoggedInUserInfo();
    }

    public static function isAdmin(){
        $user = (object)self::getLoggedInUserInfo();
        if($user->user_type == 'Admin')
            return true;

        return false;
    }

    public static function getLoggedInUserName(){
        $user =  Auth::getLoggedInUserInfo();
        return isset($user["name"]) ? $user["name"]: 'Demo User';
    }

    public static function getLoggedInUserId(){
        $user =  Auth::getLoggedInUserInfo();
        return isset($user["id"]) ? $user["id"]: '';
    }

    public static function getCategories(){
        return [
            'Hotel' => 'Hotel',
            'Resort' => 'Resort',
            'Motel' => 'Motel'
        ];
    }
}

