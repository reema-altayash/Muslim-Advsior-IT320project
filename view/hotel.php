<?php
	$message = '';
	if(!empty($_SESSION['message'])) {
	   $message = $_SESSION['message'];
	   $_SESSION['message'] = '';
	}
	
	$hotelInfo = $data['hotelInfo'];
	$ownerInfo = $data['ownerInfo'];
	$reviews = isset($data["reviews"]) ? $data["reviews"]: [];
	$review_number = isset($data["hotel_review_number"]) ? $data["hotel_review_number"]: 0;
	$ratings = isset($data["hotel_ratings"]) ? $data["hotel_ratings"]: 0;
?>

<!-- Banner -->
	<div class="restaurant-banner-area">
		<div class="restaurant-banner">
			<img src="<?php echo \HR\HotelReview\config\AppHelper::public_uri();?>asset/img/<?php echo $hotelInfo->thumbnail_url;?>" class="" alt="thumbnail">
		</div>
		
		<div class="bookmark">
			<button class="btn"><i class="far fa-bookmark"></i>Save This Hotel</button>
		</div>
	</div>

<!-- Description -->
	<div class="restaurant-description-area">
		<div class="container restaurant-description">
			<div class="row">
				<div class="col-md-12">
					<div class="restaurant-description-left">
						<div class="row">
							
							<div class="col-md-12 restaurant-description-header">
								<div class="row mt-2">
									<div class="col-md-8">
										<h1><?php echo $hotelInfo->name; ?></h1>
									</div>
									<div class="col-md-4">
										<div class="stars">
											<?php
											$rating = round($ratings);
											for ($rating; $rating>0; $rating--):
											?>
											<i class="fas fa-star"></i>
											<?php
											endfor;
											?>
											<span class="badge badge-warning p-2 ml-2"><?php echo round($ratings); ?> out of 5</span>
										</div>
									</div>
								</div>
							</div>
							
							<div class="col-md-12 restaurant-description-desc">
								<h6>About <?php echo ucfirst($hotelInfo->category); ?></h6>
								
								<div class="row">
									<div class="col-md-6">
										<ul>
											<li><b>Name</b>: <?php echo $hotelInfo->name; ?></li>
											<li><b>Contact Number</b>: <?php echo $hotelInfo->phone; ?></li>
											<li><b>Category</b>: <?php echo $hotelInfo->category; ?></li>
										</ul>
									</div>
									<div class="col-md-6">
										<ul>
											<li><b>Town</b>: <?php echo $hotelInfo->town;?></li>
											<li><b>City</b>: <?php echo $hotelInfo->city; ?></li>
                                            <li><b>Address</b>: <?php echo $hotelInfo->address; ?></li>
										</ul>
									</div>
								</div>
							</div>
							
							<div class="col-md-12 restaurant-description-desc">
								<h6>Description</h6>
								<p><?php echo $hotelInfo->description; ?></p>
							</div>
							
							<div class="col-md-12 restaurant-description-review">
                                <?php if($review_number > 0):?>
								<h3 class="sub-header">What <?php echo $review_number; ?> people are saying</h3>
								
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
													<p class="text-muted">Published: <?php echo date('d M Y', strtotime($review->created_at));?></</p>
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
                                <?php else:?>
                                <h3 class="sub-header">No one review yet</h3>
                                <?php endif;?>
							</div>
							
						</div>
						
					</div>
				</div>
				
				<div class="col-md-12">
					<div class="review-form">
						<h4>Write a review</h4>
						
						<form action="<?php echo \HR\HotelReview\config\AppHelper::get_url('hotel/review'); ?>" method="POST" id="review_form" enctype="multipart/form-data">
                            <input type="hidden" name="hotel_id" value="<?php echo $hotelInfo->id;?>">
							<div class="form-group">
								<label class="d-block">Overall rating</label>
								<span class="star-rating star-5">
									<input type="radio" name="rating" value="1"><i></i>
									<input type="radio" name="rating" value="2"><i></i>
									<input type="radio" name="rating" value="3"><i></i>
									<input type="radio" name="rating" value="4"><i></i>
									<input type="radio" name="rating" value="5" checked><i></i>
								</span>
							</div>
							
							<div class="form-group">
								<label for="title">Title of your review</label>
								<input type="text" class="form-control" id="title" name="title" placeholder="If you could say it in one sentence, what would you say?" required>
							</div>
							
							<div class="form-group">
								<label for="review">Your review</label>
								<textarea class="form-control" id="review" name="review" rows="3" placeholder="Write your review to help others learn about this online business"></textarea>
							</div>
							
							<div class="form-group">
								<label class="d-block" for="photo">Add your photo (optional)</label>
								<input type="file" class="" id="photo" name="photo">
							</div>

                            <input type="submit" name="submit_review" id="submit_review_form" style="display: none;">
                            <button class="btn btn-primary" type="button" id="submit_review">Submit Review</button>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
