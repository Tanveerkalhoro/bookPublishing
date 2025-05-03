<?php
include("connection.php");

$add_date = date('y-m-d : H:i:s');
extract($_POST);
if(isset($is_submit)){

	if($full_name =="") {
		echo $error="Please inser full name";
	} elseif($email == ""){
		echo $error="please insert email" ;
	} elseif ($subject_text == ""){
		echo $error="please insert subject" ;
	} elseif ($comment_msg == ""){
		echo $error="please insert your msg  ";
	}

	if(empty($error)) {

		$sql0 = "INSERT INTO contact(full_name,email,subject_text,comment_msg,comment_date) 
		         VALUES('$full_name','$email','$subject_text','$comment_msg','$add_date')";
		$result0 = mysqli_query($conn,$sql0);
		if($result0) {
				echo $msg="You have send us msg successfully";
		}

	}		  



} 
?>

<!DOCTYPE html>
<html lang="en">
<?php include("header.php"); ?>
  <body>

    	<?php include("navbar.php"); ?>

    
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_5.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate mb-0 text-center">
          	<p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Contact Us <i class="fa fa-chevron-right"></i></span></p>
            <h1 class="mb-0 bread">Contact Us</h1>
          </div>
        </div>
      </div>
    </section>
		
		<section class="ftco-section bg-light">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="wrapper px-md-4">
							<div class="row mb-5">
								<div class="col-md-3">
									<div class="dbox w-100 text-center">
				        		<div class="icon d-flex align-items-center justify-content-center">
				        			<span class="fa fa-map-marker"></span>
				        		</div>
				        		<div class="text">
					            <p><span>Address:</span> 198 West 21th Street, Suite 721 Karachi NY 10016</p>
					          </div>
				          </div>
								</div>
								<div class="col-md-3">
									<div class="dbox w-100 text-center">
				        		<div class="icon d-flex align-items-center justify-content-center">
				        			<span class="fa fa-phone"></span>
				        		</div>
				        		<div class="text">
					            <p><span>Phone:</span> <a href="tel://03238019024">+92 3238 0190 24</a></p>
					          </div>
				          </div>
								</div>
								<div class="col-md-3">
									<div class="dbox w-100 text-center">
				        		<div class="icon d-flex align-items-center justify-content-center">
				        			<span class="fa fa-paper-plane"></span>
				        		</div>
				        		<div class="text">
					            <p><span>Email:</span> <a href="mailto:tanveerkalhoro25@gmail.com">tanveerkalhoro25@gmail.com</a></p>
					          </div>
				          </div>
								</div>
								<div class="col-md-3">
									<div class="dbox w-100 text-center">
				        		<div class="icon d-flex align-items-center justify-content-center">
				        			<span class="fa fa-globe"></span>
				        		</div>
				        		<div class="text">
					            <p><span>Website</span> <a href="#">yoursite.com</a></p>
					          </div>
				          </div>
								</div>
							</div>
							<div class="row no-gutters">
								<div class="col-md-7">
									<div class="contact-wrap w-100 p-md-5 p-4">
										<?php
										 if(isset($msg)){
											echo $msg;
										 }
										 if(isset($error)){
											echo $error;
										 }
										
										?>
										<h3 class="mb-4">Contact Us</h3>
										<form method="POST" id="contactForm" name="contactForm" class="contactForm">
											<input type="hidden"; name="is_submit" value="Y">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="label" for="full_name">Full Name</label>
														<input type="text" class="form-control" name="full_name" id="full_name" placeholder="Name" values="<?php if(isset($full_name)) { echo $full_name;} ?>">
													</div>
												</div>
												<div class="col-md-6"> 
													<div class="form-group">
														<label class="label" for="email">Email Address</label>
														<input type="email" class="form-control" name="email" id="email" placeholder="Email" values="<?php if(isset($email)) { echo $email;} ?>">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label class="label" for="subject_text">Subject</label>
														<input type="text" class="form-control" name="subject_text" id="subject_text" placeholder="Subject" values="<?php if(isset($subject_text)) { echo $subject_text;} ?>">
													</div>
												</div> 
												<div class="col-md-12">
													<div class="form-group">
														<div class="custom-select" style="width:200px;">
															<select name="state_id" id="state_id">
																<option value="">Select State:</option>
																<?php 
																$sql11 = "SELECT * FROM `state`	";
																$result11 = mysqli_query($conn,$sql11);
																$count11 = mysqli_num_rows($result11);
																if($count11 > 0){
																	while($data11 = mysqli_fetch_assoc($result11)){ ?>
																		<option value="<?php echo $data11['state_id']?>" <?php if(isset($state_id) && $state_id == $data11['state_id']){ echo " selected "; }?> ><?php echo $data11['state_name']; ?></option>
															      <?php
																	}
																}	
															 ?>
															</select>
														</div>
														<div class="custom-select" style="width:200px;">
															<select name="city_id" id="city_id">
																<option value="0">Select City:</option>
																<?php 
																	if(isset($state_id)) { 
																		$sql12 = "SELECT * FROM city WHERE state_id='$state_id' ";
																		$result12 = mysqli_query($conn,$sql12);
																		$count12 = mysqli_num_rows($result12);
																		if($count12 > 0) {
																			while( $data12 = mysqli_fetch_assoc($result12)){?>
																				<option value="<?php echo $data12['state_id']; ?>"><?php echo $data12['city_name']; ?></option>																
																				<?php
																			}																 
																		} 
																	}?>
															</select>
														</div>
														
													</div>
													
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<div class="custom-select" style="width:200px;">
															<select name="state_id2" id="state_id2">
																<option value="">Select State:</option>
																<?php 
																$sql11 = "SELECT * FROM `state`	";
																$result11 = mysqli_query($conn,$sql11);
																$count11 = mysqli_num_rows($result11);
																if($count11 > 0){
																	while($data11 = mysqli_fetch_assoc($result11)){ ?>
																		<option value="<?php echo $data11['state_id']?>" <?php if(isset($state_id) && $state_id == $data11['state_id']){ echo " selected "; }?> ><?php echo $data11['state_name']; ?></option>
															      <?php
																	}
																}	
															 ?>
															</select>
														</div>
														<div class="custom-select" style="width:200px;">
															<select name="city_id2" id="city_id2">
																<option value="0">Select City:</option>
																<?php 
																	if(isset($state_id)) { 
																		$sql12 = "SELECT * FROM city WHERE state_id='$state_id' ";
																		$result12 = mysqli_query($conn,$sql12);
																		$count12 = mysqli_num_rows($result12);
																		if($count12 > 0) {
																			while( $data12 = mysqli_fetch_assoc($result12)){?>
																				<option value="<?php echo $data12['state_id']; ?>"><?php echo $data12['city_name']; ?></option>																
																				<?php
																			}																 
																		} 
																	}?>
															</select>
														</div>
														
													</div>
													
												</div>
												
												<div class="col-md-12">
													<div class="form-group">
														<label class="label" for="comment_msg">Message</label>
														<input type="text" name="comment_msg" class="form-control" id="comment_msg" cols="30" rows="4" placeholder="Message" values="<?php if(isset($comment_msg)) { echo $comment_msg;} ?>">
													</div>
								   				</div>
												<div class="col-md-12">
													<div class="form-group">
														<input type="submit"  placeholder="Send Message" class="btn btn-primary">
														<div class="submitting"></div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
								<div class="col-md-5 order-md-first d-flex align-items-stretch">
									<div id="map" class="map"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php include("footer.php"); ?>

    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
  	<script src="js/main.js"></script>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			$('#state_id').on('change', function() {
				data = [];
				data[0] = state_id; // source field name
				data[1] = 'city_id'; // target field
				data[2] = null;
				data[3] = null;
				data[4] = null;
				generate_combo_new(data);
			});
		});

		$(document).ready(function(){
			$('#state_id2').on('change', function() {
				data = [];
				data[0] = state_id2; // source field name
				data[1] = 'city_id2'; // target field
				data[2] = null;
				data[3] = null;
				data[4] = null;
				generate_combo_new(data);
			});
		});


		function generate_combo_new(data) {
			source_field = data[0];
			target_field = data[1];
			other_option = data[2];
			default_value = data[3];
			other_value = data[4];

			var dataString = '';
			dataString = dataString + "source_field=" + $(source_field).attr('name') + "&" + $(source_field).attr('name') + "=" + $(source_field).val() + "";
			dataString = dataString + "&target_field=" + target_field;
			if (other_option != null) {
				dataString = dataString + "&other_option=1";
			}
			if (other_value != null) {
				dataString = dataString + "&other_value=" + other_value;
			}

			//alert(dataString);
			// extra variables for query
			if (data[4] != null) {
				for (i = 4; i < data.length; i++) {
					dataString = dataString + "&" + data[i] + "=" + $('#' + data[i] + '').val() + "";
				}
			}
			//alert(source_field);
			$.ajax({
				url: 'generate_combo.php',
				type: 'POST',
				dataType: 'json',
				data: dataString,

				success: function(result) {

					$('#' + target_field).html(""); //clear old options
					result = eval(result);
					for (i = 0; i < result.length; i++) {
						for (key in result[i]) {
							$('#' + target_field).get(0).add(new Option(result[i][key], [key]), document.all ? i : null);
						}
					}
					if (default_value != null) {
						$('#' + target_field).val(default_value); //select default value
					} else {
						$("option:first", target_field).attr("selected", "selected"); //select first option
					}

					$('#' + target_field).css("display", "inline");

				}
			});
		}

	</script>
    
</body>
</html>