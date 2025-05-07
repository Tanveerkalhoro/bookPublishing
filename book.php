<?php
include("connection.php");


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Vidhya-Publisher</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <?php include("navbar.php"); ?>
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_5.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate mb-0 text-center">
          	<p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.php">Home <i class="fa fa-chevron-right"></i></a></span> <span>Book Store <i class="fa fa-chevron-right"></i></span></p>
            <h1 class="mb-0 bread">Book Store</h1>
          </div>
        </div>
      </div>
    </section>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center mb-4">
				<div class="col-md-10">
					<div class="row mb-4">
					  <h4 class="product-select">Select Category of Books</h4>
						<div class="col-md-12 d-flex justify-content-between align-items-center">
							<select class="selectpicker"  multiple>
							<?php
								$sql = "SELECT * FROM `category` ";
								$result = mysqli_query($conn,$sql);
								$count = mysqli_num_rows($result);
								if($count > 0) {
								while($data = mysqli_fetch_assoc($result)){ ?>
							<option value="<?php echo $data['category_id']; ?>"  <?php if(isset($category_id) && $category_id= $data['category_id']) { echo "selected"; } ?> ><?php echo $data['category_name'];?></option>		
								<?php }
							}?>				          
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
    	<div class="container-fluid px-md-5">
    		<div class="row"  >
			    <?php
					$page_number = 1;
					if(isset($_GET['page_number'])) {
					$page_number = $_GET['page_number'];}   
					$limit = 0 ;
					$total_per_page = 6 ;
					if($page_number > 1){
					$limit = ($page_number -1)*$total_per_page ;}
				$sql = "SELECT a.*, b.category_name , c.author_name
						FROM book a 
						INNER JOIN category b ON a.category_id = b.category_id
						INNER JOIN author c ON a.author_id = c.author_id";
                $sql1 = $sql." LIMIT ".$limit.", ".$total_per_page." ";
				if(isset($_GET['category_id'])){
					$category_id = $_GET['category_id'];
					$sql .= " AND WHERE  a.category_id ='$category_id' ";
					//echo $sql ; die;
				}
				$result = mysqli_query($conn,$sql);
				$count = mysqli_num_rows($result);
				$result1 = mysqli_query($conn,$sql1);
				$count1 = mysqli_num_rows($result1);
				if($count1 > 0) {
				while  ($book = mysqli_fetch_assoc($result1)){ ?>
                <div class="col-md-6 col-lg-4 d-flex">
    				<div class="book-wrap d-lg-flex">
    					<div class="img d-flex justify-content-end" style="background-image: url(<?php echo $book['book_img']; ?>);">
    						<div class="in-text" name="book_id" id="book_id">
    							
    							<a href="book_review.php?book_id=<?php echo $book['book_id'];?>" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Compare">
    								<span class="flaticon-visibility"></span>
    							</a>
    						</div>
    					</div>
    					<div class="text p-4">
    						<p class="mb-2"><span class="price">RS:&nbsp<?php echo $book['price_id']; ?></span></p>
    						<h2><a href="#"><?php echo $book['book_name']; ?></a></h2>
    						<span class="position"><?php echo $book['author_name']; ?></span>
    					</div>
    				</div>
    			</div>			
				<?php }
				} else {
					echo "<p> Their is no book in this catagory </p>";
				}?>
    	    </div>
    		<div class="row mt-5">
				<div class="col text-center">
					<div class="block-27">
							<?php 
							if($count > 0 ) {
							$total_page = ceil($count /$total_per_page);} ?>
						<ul> 
						<?php 
							if( $page_number > 1){
								echo'<li><a href="book.php?page_number='.($page_number -1).' ">Prev</a></li>';
							}
							for($i=1 ; $i <= $total_page ; $i++ ) {?>
							<li class="<?php 
								if($i == $page_number){
								echo 'active';}?>">
								<a href="book?page_number=<?php echo $i; ?>"><?php echo $i; ?></a>
							</li>
							<?php   }
							if($total_page > $page_number){
								echo'<li><a href="book.php?page_number='.($page_number +1).' ">Next</a></li>';
							} ?>
						</ul>
					</div>
				</div>
            </div>
    	</div>
    </section>
	<?php include("footer.php"); ?>
  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
 <?php include("js.php"); ?>
 <script>
		$(document).ready(function(){
			$('#state_id').on('change', function() {
				data = [];
				data[0] = category_id; // source field name
				data[1] = 'book_id'; // target field
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