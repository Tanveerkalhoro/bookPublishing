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
							<div class="col-md-12 d-flex justify-content-between align-items-center">
								<h4 class="product-select">Select Category of Books</h4>
								<select class="selectpicker" multiple>
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
    		<div class="row" >
			<?php
			 
			 $page_number = 1;
			 if(isset($_GET['page_number'])) {
			  $page_number = $_GET['page_number'];
			 }   

			       $limit = 0 ;
				   $total_per_page = 6 ;
				   if($page_number > 1){
					$limit = ($page_number -1)*$total_per_page ;
				   }
				$sql = "SELECT a.*, b.category_name , c.author_name
						FROM book a 
						INNER JOIN category b ON a.category_id = b.category_id
						INNER JOIN author c ON a.author_id = c.author_id";
              $sql1 = $sql." LIMIT ".$limit.", ".$total_per_page." ";
				$result = mysqli_query($conn,$sql);
				$count = mysqli_num_rows($result);
				                                  		
				$result1 = mysqli_query($conn,$sql1);
				$count1 = mysqli_num_rows($result1);
				if($count1 > 0) {
					while  ($book = mysqli_fetch_assoc($result1)){ ?>
                <div class="col-md-6 col-lg-4 d-flex">
    				<div class="book-wrap d-lg-flex">
    					<div class="img d-flex justify-content-end" style="background-image: url(<?php echo $book['book_img']; ?>);">
    						<div class="in-text">
    							<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Add to cart">
    								<span class="flaticon-shopping-cart"></span>
    							</a>
    							<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Add to Wishlist">
    								<span class="flaticon-heart-1"></span>
    							</a>
    							<a href="book_review.php?book_id=<?php echo $book['book_id'];?>" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Quick View">
    								<span class="flaticon-search"></span>
    							</a>
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
			 }?>
    			
    		</div>
    		<div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
				<?php 
				if($count > 0 ) {
					$total_page = ceil($count /$total_per_page);
				} 
				?>
              <ul> 
			   <?php 
			  
			  for($i=1 ; $i <= $total_page ; $i++ ) {?>
                <li class="<?php 
                          if($i == $page_number){
                            echo 'active';
                          }?>">
						  <a href="book?page_number=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			    <?php
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

    
  </body>
</html>