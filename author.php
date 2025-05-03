<?php
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<?php include("header.php"); ?>
  <body> 
  <?php include("navbar.php"); ?> 
    <!-- END nav -->
    
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_5.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate mb-0 text-center">
          	<p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Authors <i class="fa fa-chevron-right"></i></span></p>
            <h1 class="mb-0 bread">Authors</h1>
          </div>
        </div>
      </div>
    </section>
		
		<section class="ftco-section">
			<div class="container">
				<div class="row"> 
				<?php
				$sql = "SELECT * FROM `author` ";
				$result = mysqli_query($conn,$sql);
				$count = mysqli_num_rows($result);
				if($count > 0) {
					while  ($row = mysqli_fetch_assoc($result)){ ?>
						<div class="col-md-6 col-lg-3 ftco-animate">
							<div class="staff">
								<div class="img-wrap d-flex align-items-stretch">
									<div class="img align-self-stretch" style="background-image: url(<?php echo $row ['author_img'] ; ?>);"></div>
								</div>
								<div class="text pt-3 px-3 pb-4 text-center">
									<h3><?php echo $row['author_name'] ; ?></h3>
									<div class="faded">
										<p><?php echo $row['author_intro'] ; ?></p>
										<a href="top-seller?author_id=<?php echo $row['author_id'];?>" class="btn btn-primary">View All Books</a>
										<ul class="ftco-social text-center">
											<li class="ftco-animate"><a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a></li>
											<li class="ftco-animate"><a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a></li>
											<li class="ftco-animate"><a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-google"></span></a></li>
											<li class="ftco-animate"><a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"></span></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					<?php }
				}?>
				</div>
			</div>
		</section>

		<section class="ftco-section ftco-no-pt">
			<div class="container">
				<div class="row justify-content-center pb-5 mb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <h2>Browse All Authors</h2>
          </div>
        </div>
				<div class="row">
					<div class="col-md-2 ftco-animate">
						<ul class="top">
            	<li><a href="#">John Nathan Muller</a></li>
            	<li><a href="#">Sandra Park</a></li>
            	<li><a href="#">Laura Preston</a></li>
            	<li><a href="#">John Doe</a></li>
            	<li><a href="#">Mc Gregor Douglas</a></li>
            	<li><a href="#">Atom Night</a></li>
            	<li><a href="#">Danny Green</a></li>
            	<li><a href="#">Sonya Lopez</a></li>
            	<li><a href="#">Archie Bochs</a></li>
            	<li><a href="#">Jelian Coward</a></li>
            	<li><a href="#">Mark Hatton</a></li>
            	<li><a href="#">Madison Mc Collen</a></li>
            </ul>
					</div>
					<div class="col-md-2 ftco-animate">
						<ul class="top">
            	<li><a href="#">John Nathan Muller</a></li>
            	<li><a href="#">Sandra Park</a></li>
            	<li><a href="#">Laura Preston</a></li>
            	<li><a href="#">John Doe</a></li>
            	<li><a href="#">Mc Gregor Douglas</a></li>
            	<li><a href="#">Atom Night</a></li>
            	<li><a href="#">Danny Green</a></li>
            	<li><a href="#">Sonya Lopez</a></li>
            	<li><a href="#">Archie Bochs</a></li>
            	<li><a href="#">Jelian Coward</a></li>
            	<li><a href="#">Mark Hatton</a></li>
            	<li><a href="#">Madison Mc Collen</a></li>
            </ul>
					</div>
					<div class="col-md-2 ftco-animate">
						<ul class="top">
            	<li><a href="#">John Nathan Muller</a></li>
            	<li><a href="#">Sandra Park</a></li>
            	<li><a href="#">Laura Preston</a></li>
            	<li><a href="#">John Doe</a></li>
            	<li><a href="#">Mc Gregor Douglas</a></li>
            	<li><a href="#">Atom Night</a></li>
            	<li><a href="#">Danny Green</a></li>
            	<li><a href="#">Sonya Lopez</a></li>
            	<li><a href="#">Archie Bochs</a></li>
            	<li><a href="#">Jelian Coward</a></li>
            	<li><a href="#">Mark Hatton</a></li>
            	<li><a href="#">Madison Mc Collen</a></li>
            </ul>
					</div>
					<div class="col-md-2 ftco-animate">
						<ul class="top">
            	<li><a href="#">John Nathan Muller</a></li>
            	<li><a href="#">Sandra Park</a></li>
            	<li><a href="#">Laura Preston</a></li>
            	<li><a href="#">John Doe</a></li>
            	<li><a href="#">Mc Gregor Douglas</a></li>
            	<li><a href="#">Atom Night</a></li>
            	<li><a href="#">Danny Green</a></li>
            	<li><a href="#">Sonya Lopez</a></li>
            	<li><a href="#">Archie Bochs</a></li>
            	<li><a href="#">Jelian Coward</a></li>
            	<li><a href="#">Mark Hatton</a></li>
            	<li><a href="#">Madison Mc Collen</a></li>
            </ul>
					</div>
					<div class="col-md-2 ftco-animate">
						<ul class="top">
            	<li><a href="#">John Nathan Muller</a></li>
            	<li><a href="#">Sandra Park</a></li>
            	<li><a href="#">Laura Preston</a></li>
            	<li><a href="#">John Doe</a></li>
            	<li><a href="#">Mc Gregor Douglas</a></li>
            	<li><a href="#">Atom Night</a></li>
            	<li><a href="#">Danny Green</a></li>
            	<li><a href="#">Sonya Lopez</a></li>
            	<li><a href="#">Archie Bochs</a></li>
            	<li><a href="#">Jelian Coward</a></li>
            	<li><a href="#">Mark Hatton</a></li>
            	<li><a href="#">Madison Mc Collen</a></li>
            </ul>
					</div>
					<div class="col-md-2 ftco-animate">
						<ul class="top">
            	<li><a href="#">John Nathan Muller</a></li>
            	<li><a href="#">Sandra Park</a></li>
            	<li><a href="#">Laura Preston</a></li>
            	<li><a href="#">John Doe</a></li>
            	<li><a href="#">Mc Gregor Douglas</a></li>
            	<li><a href="#">Atom Night</a></li>
            	<li><a href="#">Danny Green</a></li>
            	<li><a href="#">Sonya Lopez</a></li>
            	<li><a href="#">Archie Bochs</a></li>
            	<li><a href="#">Jelian Coward</a></li>
            	<li><a href="#">Mark Hatton</a></li>
            	<li><a href="#">Madison Mc Collen</a></li>
            </ul>
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