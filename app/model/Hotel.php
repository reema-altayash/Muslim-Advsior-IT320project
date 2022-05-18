<?php


namespace HR\HotelReview\model;

use HR\HotelReview\config\AppHelper;
use HR\HotelReview\config\DB;


class Hotel extends DB {
    protected $table = AppHelper::HOTEL_TABLE;

    public function __construct()
    {
        parent::__construct(_ROOT);
        $this->tableName = $this->table;
    }

    function all($select = [], $condition = [], $limit = ''){
        if($select)
            $this->columns = $select;
        else
            $this->columns = array('id', 'name', 'town', 'city', 'phone', 'description', 'category', 'address', 'thumbnail_url');
        if($condition)
            $this->conditions = $condition;

        if($limit)
            $this->limit = $limit;

        $data = $this->getAll();
        if($data["status"])
            return $data["data"];

        return [];
    }

    public function find($id){
        $this->columns = array('id', 'name', 'town', 'city', 'phone', 'description', 'category', 'address', 'thumbnail_url');
        $this>$this->conditions = array('id' => $id);

        $data = $this->getById();

        if($data["status"])
            return $data["data"];

        return [];
    }
	
	public function findWhere($conditions){
        $this->columns = array('id', 'name', 'town', 'city', 'phone', 'description', 'category', 'address', 'hours_of_operation', 'parking_details', 'owner_id', 'thumbnail_url');
        $this->conditions = $conditions;

        $data = $this->getOne();

        if($data["status"])
            return $data["data"];

        return [];
    }
	
	public function insertData($post){
		$this->columns = array('name', 'town', 'city', 'phone', 'description', 'category', 'address', 'thumbnail_url');
        
		$this>$this->values = array("'$post[name]'", "'$post[town]'", "'$post[city]'", "'$post[phone]'", "'$post[description]'", "'$post[category]'", "'$post[address]'", "'$post[thumbnail_url]'");

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
                'message' => 'Hotel deleted successfully'
            );
		}else{
			return array(
                'status' => true,
                'message' => 'Something went wrong! Please try again later'
            );
		}
    }
}
