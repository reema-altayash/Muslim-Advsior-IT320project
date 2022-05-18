<?php
    $hotels = isset($data["hotels"]) ? $data["hotels"]: [];
	$hotel_reviews = isset($data["hotel_review_data"]) ? $data["hotel_review_data"]: [];
	$hotel_ratings = isset($data["hotel_ratings"]) ? $data["hotel_ratings"]: [];
?>
<!-- Banner -->
	<div id="banner" class="banner-area">
		<div class="banner container">
			<div class="row">
				<div class="col-md-1 float-left"></div>
				<div class="col-md-10 float-left banner-form">
					
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
				<h2>Search result based on the selection</h2>
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
