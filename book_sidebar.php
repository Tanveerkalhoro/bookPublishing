<div class="col-lg-3 sidebar pl-lg-3 ftco-animate">
            <div class="sidebar-box">
              <form action="#" class="search-form">
                <div class="form-group">
                  <span class="fa fa-search"></span>
                  <input type="text" class="form-control" placeholder="Type a keyword and hit enter">
                </div>
              </form>
            </div>
            <div class="sidebar-box ftco-animate">
              <div class="categories">
                <h3>Genres</h3>
                <ul> <?php
					$sql = "SELECT * FROM `category` ";
					$result = mysqli_query($conn,$sql);
					$count = mysqli_num_rows($result);
					if($count > 0) {
					while($data = mysqli_fetch_assoc($result)){ ?>
	                <li><a href="top-seller.php?category_id=<?php echo $data['category_id'];?>"><?php echo $data['category_name'];?> <span class="fa fa-chevron-right"></span></a></li>
					 <?php }
			            }?>
	              </ul>
              </div>
            </div>

            <div class="sidebar-box ftco-animate">
              <h3>Top Authors</h3>
              <ul class="top"> 
				<?php
			  $sql = "SELECT * FROM `author` ";
					$result = mysqli_query($conn,$sql);
					$count = mysqli_num_rows($result);
					if($count > 0) {
					while($data = mysqli_fetch_assoc($result)){ ?>
              	<li><a href="top-seller?author_id=<?php echo $data['author_id'];?>"><?php echo $data['author_name'];?> </a></li>
              	<?php }
			            }?>
              </ul>
            </div>
          </div>