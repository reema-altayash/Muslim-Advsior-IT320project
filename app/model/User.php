<?php

namespace HR\HotelReview\model;

use HR\HotelReview\config\AppHelper;
use HR\HotelReview\config\DB;

class User extends DB {
    protected $table = AppHelper::USERS_TABLE;

    public function __construct()
    {
        parent::__construct(_ROOT);
        $this->tableName = $this->table;
    }

    function all($select = [], $condition = []){
        if($select)
            $this->columns = $select;
        else
            $this->columns = array('id', 'name', 'email_address', 'phone', 'user_type');
        if($condition)
            $this>$this->conditions = $condition;

        $data = $this->getAll();
        if($data["status"])
            return $data["data"];

        return [];
    }

    public function find($id){
        $this->columns = array('id', 'name', 'email_address', 'phone', 'user_type', 'password');
        $this->conditions = array('id' => $id);

        $data = $this->getById();

        if($data["status"])
            return $data["data"];

        return [];
    }
	
	public function inserData($post){
		$name        = '';
        $email        = '';
        $phone        = '';
        $password     = '';
        $user_type = '';

		if($post['name'] == ''){
            return array(
				'status' => false,
				'message' => "Name can not be blank"
			);
        }else{
            $name = $post['name'];
        }
		
        if($post['email'] == ''){
            return array(
				'status' => false,
				'message' => "Email can not be blank"
			);
        }elseif(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            return array(
				'status' => false,
				'message' => "Provided Email address is invalid"
			);
        }else{
            $email = $post['email'];
        }
		
		if($post['phone'] == ''){
            return array(
				'status' => false,
				'message' => "Phone can not be blank"
			);
        }else{
            $phone = $post['phone'];
        }

        if($post['password'] == ''){
            return array(
				'status' => false,
				'message' => "Password can not be blank"
			);
        }else{
            $password = $post['password'];
        }
		
		if($post['user_type'] == ''){
            return array(
				'status' => false,
				'message' => "User type can not be blank"
			);
        }else{
            $user_type = $post['user_type'];
        }

        $hashPassword = md5($password);

        $this->columns = array('id', 'name', 'email_address', 'user_type');
        $this->conditions = array('email_address' => $email);

        $row = $this->getOne();

        if($row['status']){
            return array(
				'status' => false,
				'message' => "User already exist for given email address"
			);
        }else{
            $this->columns = array('name', 'email_address', 'phone', 'password', 'user_type');
			$this>$this->values = array("'$name'", "'$email'", "'$phone'", "'$hashPassword'", "'$user_type'");

			$id = $this->insert();

			if($id){
                $data = $this->find($id);
                return array(
					"status" => true,
					"message" => "User created successfully"
				);
			}else{
				return array(
					"status" => false,
					"message" => "Something went wrong!! Please try again later"
				);
			}
        }
    }
	
	public function updateData($values, $conditions){
		$this->columns = $values;
        $this->conditions = $conditions;

        $data = $this->update();

        if($data){
            return array(
                'status' => true,
                'data' => $data
            );
		}else{
			return array(
                'status' => false,
                'message' => 'Something went wrong! Please try again later!'
            );
		}
    }

	public function deleteData($conditions){
        $this->conditions = $conditions;

        $data = $this->delete();

        if($data){
            return array(
                'status' => true,
                'message' => 'User deleted successfully'
            );
		}else{
			return array(
                'status' => true,
                'message' => 'Something went wrong! Please try again later'
            );
		}
    }
}
