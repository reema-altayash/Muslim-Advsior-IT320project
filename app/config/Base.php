<?php

namespace HR\HotelReview\config;

class Base {
    use DotEnv;

    protected $path;
    protected $root;
    public $isInstalled;

    public function __construct($path) {
        $this->root = $path;
        $this->path = $path.'/.env';
        $this->loadEnv();
        $this->isInstalled();
    }


    /**
     * checking the installation of the application
     * @return void
     */
    public function isInstalled() {
        if(getenv('INSTALLATION') === 'DONE')
            $this->isInstalled = true;
        else $this->isInstalled = false;
    }

    public function complete_installation(){
        $this->setEnv('INSTALLATION', 'DONE');
    }

    /**
     * Return the APP_URL
     * @return string
     */
    public function base_url(){
        return getenv('APP_URL');
    }

    public function load($page, $_data = [], $_success = '', $_error = []){
        $data       = $_data;
        $success    = $_success;
        $error      = $_error;
        $public_uri = AppHelper::public_uri();

        $______content =  "$this->root/view/$page.php";
        require_once "$this->root/view/layout/main.php";
    }

    public function load_admin($page, $_data = [], $_success = '', $_error = []){
        $data       = $_data;
        $success    = $_success;
        $error      = $_error;
        $public_uri = AppHelper::public_uri();
        $______content =  "$this->root/admin/$page.php";
        require_once "$this->root/admin/layout/main.php";
    }

    public function isValid($method){
        if(method_exists($this, "$method")){
            return true;
        }else{
            return false;
        }
    }

    public function not_found(){
        require_once "$this->root/view/404.php";
    }
}
