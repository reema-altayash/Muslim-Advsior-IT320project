<?php

namespace HR\HotelReview\controller;

use HR\HotelReview\config\AppHelper;
use HR\HotelReview\config\DB;
use HR\HotelReview\model\Hotel;
use HR\HotelReview\model\Review;
use HR\HotelReview\model\User;

class HotelController extends DB
{
    public function index(){
        if (AppHelper::isLoggedIn()){
            $hotel = new Hotel();
            if(AppHelper::isAdmin()){
                $hotels = $hotel->all('', '');

                $this->load_admin('index',compact('hotels'), '', '');
            }else{
                $userId  = AppHelper::getLoggedInUserId();
                $query = "SELECT reviews.*, hotels.name as hotel_name, hotels.thumbnail_url as thumbnail_url FROM reviews LEFT JOIN hotels ON reviews.hotel_id=hotels.id WHERE reviews.user_id = $userId ORDER BY reviews.id DESC;";
                $ratings = [];
                $results = $this->con->query($query);

                if($results->num_rows > 0) {
                    while ($row = $results->fetch_assoc()) {
                        $ratings[] = (object)$row;
                    }
                }

                $this->load_admin('reviews',compact('ratings'), '', '');
            }
        }else{
            $appUrl = AppHelper::get_url('home');
            header("Location: $appUrl");
        }
    }

    public function register(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $name           = '';
            $town           = '';
            $city           = '';
            $phone          = '';
            $address        = '';
            $description    = '';
            $category       = '';
            $arr            = [];

            if($_POST['name'] == ''){
                array_push($arr, "Name can not be blank");
            }else{
                $name = $_POST['name'];
            }

            if($_POST['town'] == ''){
                array_push($arr, "Town can not be blank");
            }else{
                $town = $_POST['town'];
            }

            if($_POST['city'] == ''){
                array_push($arr, "City can not be blank");
            }else{
                $city = $_POST['city'];
            }

            if($_POST['phone'] == ''){
                array_push($arr, "Phone can not be blank");
            }else{
                $phone = $_POST['phone'];
            }

            if($_POST['address'] == ''){
                array_push($arr, "Address can not be blank");
            }else{
                $address = $_POST['address'];
            }

            if($_POST['description'] == ''){
                array_push($arr, "Description can not be blank");
            }else{
                $description = $_POST['description'];
            }

            if($_POST['category'] == ''){
                array_push($arr, "Category can not be blank");
            }else{
                $category = $_POST['category'];
            }

            if(sizeof($arr)){
                $this->load_admin('register', $_POST, '', $arr);
            }else{
                $photo = 'restaurant.jpg';
                if(isset($_FILES['photo']) && !empty($_FILES['photo'])){
                    $target_dir = "public/asset/img/";
                    $target_file = $target_dir . basename($_FILES["photo"]["name"]);

                    if(getimagesize($_FILES["photo"]["tmp_name"])){
                        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                            $photo  = basename($_FILES["photo"]["name"]);
                        }
                    }
                }

                $this->tableName = 'hotels';
                $this->columns = array('name', 'town', 'city', 'phone', 'address', 'description', 'category', 'thumbnail_url');
                $this->values = array("'$name'", "'$town'", "'$city'", "'$phone'", "'$address'", "'$description'" , "'$category'" , "'$photo'" );

                $id = $this->insert();

                if($id){
                    $this->load_admin('register', '', 'New hotel registered successfully');
                }else{
                    $this->load_admin('register', $_POST, '', array('Something went wrong! Try again later'));
                }
            }

        }else{
            $this->load_admin('register');
        }
    }

    public function update_hotel($id){
        $hotel = new Hotel();
        $hotelInfo = $hotel->find($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $name           = '';
            $town           = '';
            $city           = '';
            $phone          = '';
            $address        = '';
            $description    = '';
            $category       = '';
            $arr            = [];

            if($_POST['name'] == ''){
                array_push($arr, "Name can not be blank");
            }else{
                $name = $_POST['name'];
            }

            if($_POST['town'] == ''){
                array_push($arr, "Town can not be blank");
            }else{
                $town = $_POST['town'];
            }

            if($_POST['city'] == ''){
                array_push($arr, "City can not be blank");
            }else{
                $city = $_POST['city'];
            }

            if($_POST['phone'] == ''){
                array_push($arr, "Phone can not be blank");
            }else{
                $phone = $_POST['phone'];
            }

            if($_POST['address'] == ''){
                array_push($arr, "Address can not be blank");
            }else{
                $address = $_POST['address'];
            }

            if($_POST['description'] == ''){
                array_push($arr, "Description can not be blank");
            }else{
                $description = $_POST['description'];
            }

            if($_POST['category'] == ''){
                array_push($arr, "Category can not be blank");
            }else{
                $category = $_POST['category'];
            }
            $hotelInfo = $_POST;

            if(sizeof($arr)){
                $this->load_admin('update', compact('hotelInfo'), '', $arr);
            }else{
                $photo = '';

                if(isset($_FILES['photo']) && !empty($_FILES['photo'])){
                    $target_dir = "public/asset/img/";
                    $target_file = $target_dir . basename($_FILES["photo"]["name"]);

                    if(getimagesize($_FILES["photo"]["tmp_name"])){
                        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                            $photo  = basename($_FILES["photo"]["name"]);
                        }
                    }
                }
                $values = array(
                    'name' 				=> '"'.$name.'"',
                    'town' 				=> '"'.$town.'"',
                    'city' 				=> '"'.$city.'"',
                    'phone' 			=> '"'.$phone.'"',
                    'address' 		    => '"'.$address.'"',
                    'description' 		=> '"'.$description.'"',
                    'category' 	        => '"'.$category.'"'
                );

                if($photo)
                    $values['thumbnail_url'] = '"'.$photo.'"';

                $conditions = array('id' => $id);
                $updated = $hotel->updateData($values, $conditions);


                if($updated["status"]){
                    $this->load_admin('update', compact('hotelInfo'), 'Hotel information updated successfully');
                }else{
                    $this->load_admin('update', compact('hotelInfo'), '', array('Something went wrong! Try again later'));
                }
            }
        }else{
            if (!empty($hotelInfo))
                $this->load_admin('update', compact('hotelInfo'), '', '');
            else {
                $appUrl = AppHelper::get_url('hotel');
                header("Location: $appUrl");
            }
        }
    }

    public function delete_hotel(){
        $id = $_POST["id"];

        $hotel = new Hotel();

        $deleted = $hotel->deleteData(array('id' => $id));

        echo json_encode($deleted);exit;
    }

    public function review(){
        $hotel_id   = '';
        $title      = '';
        $review     = '';
        $rating     = '';
        $userid = AppHelper::getLoggedInUserId();
        $arr = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!isset($_POST["hotel_id"]) || empty($_POST["hotel_id"])){
                array_push($arr, "Hotel can not be blank");
            }else{
                $hotel_id   = $_POST["hotel_id"];
            }

            if(!isset($_POST["rating"]) || empty($_POST["rating"])){
                array_push($arr, "Rating must be given");
            }else{
                $rating     = $_POST["rating"];
            }

            if(!isset($_POST["title"]) || empty($_POST["title"])){
                array_push($arr, "Review title can not be blank");
            }else{
                $title    = $_POST["title"];
            }

            if(!isset($_POST["review"]) || empty($_POST["review"])){
                array_push($arr, "Must have a review description");
            }else{
                $review     = $_POST["review"];
            }

            if(sizeof($arr)) {
                echo json_encode(array(
                    "status" => false,
                    "error" => $arr
                ));
                exit;
            }

            $photo = 'avatar.png';
            if(isset($_FILES['photo']) && !empty($_FILES['photo'])){
                $target_dir = "public/asset/img/";
                $target_file = $target_dir . basename($_FILES["photo"]["name"]);

                if(getimagesize($_FILES["photo"]["tmp_name"])){
                    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                        $photo  = basename($_FILES["photo"]["name"]);
                    }
                }
            }

            $this->tableName = 'reviews';
            $this->columns = array('hotel_id','user_id', 'title', 'rating', 'review', 'profile');
            $this>$this->values = array($hotel_id, $userid, "'$title'", $rating, "'$review'", "'$photo'");

            $id = $this->insert();

            if($id){
                echo json_encode( array(
                    "status" => true,
                    "message" => 'Review submitted successfully'
                ));
                exit;
            }else{
                echo json_encode( array(
                    "status" => false,
                    "message" => 'Something went wrong!! Please try again'
                ));
                exit;
            }
        }else{
            echo json_encode( array(
                "status" => false,
                "message" => 'Invalid request submitted'
            ));
            exit;
        }
    }

    public function ratings(){
        if (AppHelper::isLoggedIn()){
            if(AppHelper::isAdmin()){
                $query = "SELECT reviews.*, users.name as user_name, hotels.name as hotel_name FROM reviews LEFT JOIN users ON reviews.user_id=users.id LEFT JOIN hotels ON reviews.hotel_id=hotels.id ORDER BY reviews.id DESC;";
                $ratings = [];
                $results = $this->con->query($query);

                if($results->num_rows > 0) {
                    while ($row = $results->fetch_assoc()) {
                        $ratings[] = (object)$row;
                    }
                }

                $this->load_admin('ratings', compact('ratings'), '', '');
            }else{
                echo "not an admin";
            }
        }else{
            $appUrl = AppHelper::get_url('home');
            header("Location: $appUrl");
        }
    }

    public function delete_rating(){
        $id = $_POST["id"];

        $review = new Review();

        $deleted = $review->deleteData(array('id' => $id));

        echo json_encode($deleted);exit;
    }

    public function users(){
        if (AppHelper::isLoggedIn()){
            $userModel = new User();
            if(AppHelper::isAdmin()){
                $users = $userModel->all('', '');

                $this->load_admin('user', compact('users'), '', '');
            }else{
                $appUrl = AppHelper::get_url('home');
                header("Location: $appUrl");
            }
        }else{
            $appUrl = AppHelper::get_url('home');
            header("Location: $appUrl");
        }
    }

    public function create_user(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $name           = '';
            $email          = '';
            $phone          = '';
            $password       = '';
            $user_type      = '';
            $arr            = [];

            if($_POST['name'] == ''){
                array_push($arr, "Name can not be blank");
            }else{
                $name = $_POST['name'];
            }

            if($_POST['email'] == ''){
                array_push($arr, "Email can not be blank");
            }else{
                $email = $_POST['email'];
            }

            if($_POST['phone'] == ''){
                array_push($arr, "Phone can not be blank");
            }else{
                $phone = $_POST['phone'];
            }

            if($_POST['password'] == ''){
                array_push($arr, "Password can not be blank");
            }else{
                $password = md5($_POST['password']);
            }

            if($_POST['user_type'] == ''){
                array_push($arr, "User Type can not be blank");
            }else{
                $user_type = $_POST['user_type'];
            }

            if(sizeof($arr)){
                $this->load_admin('create_user', $_POST, '', $arr);
            }else{

                $this->tableName = 'users';
                $this->columns = array('name', 'email_address', 'phone', 'password', 'user_type');
                $this->values = array("'$name'", "'$email'", "'$phone'", "'$password'", "'$user_type'" );

                $id = $this->insert();

                if($id){
                    $this->load_admin('create_user', '', 'New User Created successfully');
                }else{
                    $this->load_admin('create_user', $_POST, '', array('Something went wrong! Try again later'));
                }
            }

        }else{
            $this->load_admin('create_user');
        }
    }

    public function delete_user(){
        $id = $_POST["id"];

        $user = new User();

        $deleted = $user->deleteData(array('id' => $id));

        echo json_encode($deleted);exit;
    }
}
