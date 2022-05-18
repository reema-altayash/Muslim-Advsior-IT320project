<?php


namespace HR\HotelReview\model;

use HR\HotelReview\config\AppHelper;
use HR\HotelReview\config\DB;


class Review extends DB {
    protected $table = AppHelper::REVIEW_TABLE;

    public function __construct()
    {
        parent::__construct(_ROOT);
        $this->tableName = $this->table;
    }
    function all($select = [], $condition = []){
        if($select)
            $this->columns = $select;
        else
            $this->columns = array('id', 'hotel_id', 'title', 'rating', 'review', 'profile', 'created_at');
        if($condition)
            $this>$this->conditions = $condition;

        $data = $this->getAll();
        if($data["status"])
            return $data["data"];

        return [];
    }

    public function find($id){
        $this->columns = array('id', 'hotel_id', 'title', 'rating', 'review', 'profile', 'created_at');
        $this>$this->conditions = array('id' => $id);

        $data = $this->getById();

        if($data["status"])
            return $data["data"];

        return [];
    }
	
	public function findWhere($conditions){
        $this->columns = array('id', 'hotel_id', 'title', 'rating', 'review', 'profile', 'created_at');
        $this->conditions = $conditions;

        $data = $this->getOne();

        if($data["status"])
            return $data["data"];

        return [];
    }
	
	public function insertData($post){
		$current_date = date('Y-m-d H:i:s');
		$this->columns = array('hotel_id', 'title', 'rating', 'review', 'profile', 'created_at');
        
		$this>$this->values = array("'$post[hotel_id]'", "'$post[title]'", "'$post[rating]'", "'$post[review]'", "'$post[profile]'", "'$current_date'", "'$current_date'");

        $data = $this->insert();

        if($data){
            return array(
                'status' => true,
                'id' => $data
            );
		}else{
			return array(
                'status' => false,
                'message' => 'Not Updated'
            );
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
                'message' => 'Not Updated'
            );
		}
    }
	
	public function deleteData($conditions){
        $this->conditions = $conditions;

        $data = $this->delete();

        if($data){
            return array(
                'status' => true,
                'message' => 'Review removed successfully'
            );
		}else{
            return array(
                'status' => true,
                'message' => 'Something went wrong! Please try again later'
            );
		}
    }
}
