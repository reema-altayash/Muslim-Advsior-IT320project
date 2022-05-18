<!-- Banner -->
<?php
    $categories = \HR\HotelReview\config\AppHelper::getCategories();
    $hotels = isset($data["hotels"]) ? $data["hotels"]: [];
	$reviews = isset($data["reviews"]) ? $data["reviews"]: [];
	$hotel_reviews = isset($data["hotel_review_data"]) ? $data["hotel_review_data"]: [];
	$hotel_ratings = isset($data["hotel_ratings"]) ? $data["hotel_ratings"]: [];
?>
<!-- Banner -->
	<div id="banner" class="banner-area">
		<div class="banner container">
			<div class="row">
				<div class="col-md-1 float-left"></div>
				<div class="col-md-10 float-left banner-form">
				
					<h1>Every Review is an Experience!</h1>
					<h6>Check Ratings of Hotels, Read Reviews & Book</h6>
					
					<form action="<?php echo \HR\HotelReview\config\AppHelper::get_url('main/searchHotel'); ?>" method="POST" class="form">
						<div class="form-row">
							<div class="form-group col-md-6 float-left">
								<input type="text" class="form-control" id="" name="name" placeholder="What are you looking for..." />
							</div>
							<div class="form-group col-md-4 float-left">
								<select class="form-control" id="category" name="category">
									<option value="" selected style="color:black;font-weight: 600;font-style: italic;">All Categories</option>
									<?php
									foreach ($categories as $key => $category ){
										echo "<option value='$category'>$category</option>";
									}
									?>
								</select>
							</div>
							<div class="form-group col-md-2 float-left">
								<button type="submit" class="btn btn-block btn-warning-dark">Find</button>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-1 float-left"></div>
			</div>
		</div>
	</div>
<!-- Banner End -->

<!-- Hotel List -->
	<div class="restaurant-list-area">
		<div class="restaurant-list container">
			<div class="common-header mb-5">
				<h2>Popular Hotels</h2>
			</div>
			
			<div class="row all-restaurants">
				<?php
                if(!empty($hotels)):
                    foreach ($hotels as $hotel):
                        $hotel = (object)$hotel;
				?>
				<div class="col-md-3 col-sm-4 float-left">
					<a href="<?php echo \HR\HotelReview\config\AppHelper::get_url("main/hotel-details/$hotel->id"); ?>">
						<div class="single-restaurant">
							<div class="single-restaurant-img">
								<img src="<?php echo \HR\HotelReview\config\AppHelper::public_uri();?>asset/img/<?php echo $hotel->thumbnail_url;?>" alt="" />
							</div>
							<div class="single-restaurant-desc">
								<h4><?php echo $hotel->name;?></h4>
								<div class="row">
									<div class="col-md-6 float-left">
										<?php
										$rating = round($hotel_ratings[$hotel->id]);
										for ($rating; $rating>0; $rating--):
										?>
										<i class="fas fa-star"></i>
										<?php
										endfor;
										?>
									</div>
									<div class="col-md-6 float-left text-right">
										<p><?php echo $hotel_reviews[$hotel->id];?> reviews</p>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
				<?php
					endforeach;
					endif;
				?>
			</div>
		</div>
	</div>
<!-- Hotel List End -->

<!-- Reviews Section Start -->
	<div class="review-area">
		<div class="review container">
			<div class="common-header mb-5">
				<h2>Latest Reviews</h2>
			</div>
			
			<div class="row">
				<?php
				if(!empty($reviews)):
				?>
				<div class="col-md-12 reviews owl-carousel float-left">
					<?php
					foreach ($reviews as $review):
						$review = (object)$review;
					?>
					<div class="single-review">
						<div class="row">
							<div class="col-md-3 float-left">
								<img src="<?php echo \HR\HotelReview\config\AppHelper::public_uri();?>asset/img/<?php echo $review->profile;?>" class="review-profile rounded-circle" alt="avatar">
							</div>
							<div class="col-md-8 float-left review-heading">
								<?php
								$rating = round($review->rating);
								for ($rating; $rating>0; $rating--):
								?>
								<i class="fas fa-star"></i>
								<?php
								endfor;
								?>
								
								<h6><?php echo $review->title;?></h6>
							</div>
							<div class="col-md-12 float-left review-desc">
								<p><?php echo $review->review;?></p>
							</div>
							<div class="col-md-12 float-left review-published">
								<p class="text-muted">Published: <?php echo date('d M Y', strtotime($review->created_at));?></p>
							</div>
						</div>
					</div>
					<?php
						endforeach;
					?>
				</div>
				<?php
					endif;
				?>
			</div>
		</div>
	</div>
<!-- Reviews End -->
