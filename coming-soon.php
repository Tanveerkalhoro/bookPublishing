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
          	<p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Coming Soon <i class="fa fa-chevron-right"></i></span></p>
            <h1 class="mb-0 bread">Coming Soon</h1>
          </div>
        </div>
      </div>
    </section>
		
		<section class="ftco-section">
			<div class="container">
				<div class="row mb-5">
					<div class="col-lg-4">
						<div class="date-post w-100 text-lg-right mb-4">
							<h3>September, 2020</h3>
						</div>	
					</div>
					<div class="col-lg-8">
						<div class="row">
							<div class="col-md-12">
							<?php
							$page_no = 1;
							if(isset($_GET['page_no'])){
							 $page_no = $_GET['page_no'];
							}
							$limit = 0 ;
							$record_per_page = 3 ;
							if($page_no > 1) {
								$limit = ($page_no-1)*$record_per_page;
							}
								$sql = "SELECT a.*, b.category_name , c.author_name
											FROM book a 
											INNER JOIN category b ON a.category_id = b.category_id
											INNER JOIN author c ON a.author_id = c.author_id
											WHERE 1=1 ";
								if(isset($_GET['author_id'])){
							        $author_id = $_GET['author_id'];
									$sql .= " AND a.author_id='$author_id' ";
								} if(isset($_GET['category_id'])){
							        $category_id = $_GET['category_id'];
									$sql .= " AND a.category_id ='$category_id' ";
								}
								$sql1   = $sql." LIMIT ".$limit.", ".$record_per_page." ";
								$result1 = mysqli_query($conn,$sql1);
								$count1 = mysqli_num_rows($result1);
								if($count1 > 0) {
									while  ($book = mysqli_fetch_assoc($result1)){ ?>
		    				<div class="book-wrap book-wrap-2 d-md-flex">
		    					<div class="img img-2 d-flex justify-content-end" style="background-image: url(<?php echo $book['book_img']; ?>);">
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
		    						<p><?php echo $book['book_intro']; ?></p>
		    					</div>
		    				</div>
							<?php }
			                   }?>
		    			</div>
					</div>
					<div class="col">
				<div class="block-27">
					<?php 
					if($count > 0) {
						$total_page = ceil($count / $record_per_page);
					} ?>
					<ul> <?php 
					 if( $page_no > 1){
						echo'<li><a href="coming-soon?page_no='.($page_no -1).' ">Prev</a></li>';
					}
						for($i=1 ; $i <= $total_page ; $i++){ ?>
					<li class="<?php if($i == $page_no) { echo 'active';} ?>"><a href="coming-soon?page_no=<?php echo $i; ?>"><?php echo $i; ?></a></li>
					<?php }
					if($total_page > $page_no){
						echo'<li><a href="coming-soon?page_no='.($page_no +1).' ">Next</a></li>';
					} ?>
					</ul>
				</div>
			</div>
	</section>
		<?php include("footer.php"); ?>

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
  <?php include("js.php"); ?>
  </body>
</html>