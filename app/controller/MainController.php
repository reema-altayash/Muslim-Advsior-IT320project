<?php

namespace HR\HotelReview\controller;
use HR\HotelReview\config\DB;
use HR\HotelReview\model\User;
use HR\HotelReview\model\Hotel;
use HR\HotelReview\model\Review;

class MainController extends DB {

    public function __construct($path) {
        parent::__construct($path);
    }

    /*
     * Showing main page/landing page
     */

    public function index(){
		$hotel = new Hotel();
		
		$hotels = $hotel->all('','', 4);
		
		$review = new Review();
		$reviews = $review->all();
		
		$hotel_review_data = [];
		$hotel_ratings = [];
		foreach ($hotels as $key => $hotel){
            $hotel_reviews = $review->all('', array('hotel_id' => $hotel["id"]));
			$hotel_review_data[$hotel["id"]] = count($hotel_reviews);
			$total = 0;
			foreach ($hotel_reviews as $key => $hotel_review){
				$total += $hotel_review["rating"];
			}
			if($hotel_review_data[$hotel["id"]] > 0){
				$hotel_ratings[$hotel["id"]] = $total/$hotel_review_data[$hotel["id"]];
			}else{
				$hotel_ratings[$hotel["id"]] = 0;
			}
        }
		
        $this->load('index', compact('hotels', 'reviews', 'hotel_review_data', 'hotel_ratings'));
    }

    /*
     * Showing details page
     */
    public function hotel_details($id){
		$hotel = new Hotel();
        $hotelInfo = $hotel->find($id);
		
		$review = new Review();
		$reviews = $review->all('', array('hotel_id' => $id));
		
		$hotel_review_number = count($reviews);
		$total = 0;
		foreach ($reviews as $key => $hotel_review){
			$total += $hotel_review["rating"];
		}
		if($hotel_review_number > 0){
			$hotel_ratings = $total/$hotel_review_number;
		}else{
			$hotel_ratings = 0;
		}
		
		$hotelInfo = (object)$hotelInfo;
		
        $this->load('hotel', compact('hotelInfo', 'reviews', 'hotel_review_number', 'hotel_ratings'));
    }

    /*
     * Showing search page
     */
    public function searchHotel(){
        $hotel = new Hotel();
        $review = new Review();
        $condition = array();

        if(isset($_POST['name']) && !empty($_POST['name'])){
            $condition['name'] =  $_POST['name'];
        }

        if(isset($_POST['category']) && !empty($_POST['category'])){
            $condition['category'] =  $_POST['category'];
        }

		$hotels = $hotel->all('', $condition);
		
        $hotel_review_data = [];
		$hotel_ratings = [];
		foreach ($hotels as $key => $hotel){
            $hotel_reviews = $review->all('', array('hotel_id' => $hotel["id"]));
			$hotel_review_data[$hotel["id"]] = count($hotel_reviews);
			$total = 0;
			foreach ($hotel_reviews as $key => $hotel_review){
				$total += $hotel_review["rating"];
			}
			if($hotel_review_data[$hotel["id"]] > 0){
				$hotel_ratings[$hotel["id"]] = $total/$hotel_review_data[$hotel["id"]];
			}else{
				$hotel_ratings[$hotel["id"]] = 0;
			}
        }

        $this->load('search', compact('hotels', 'hotel_review_data', 'hotel_ratings'));
    }
}
