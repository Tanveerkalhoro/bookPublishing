<?php
include("connection.php");
$page_no = 1;
if(isset($_GET['page_no'])){
  $page_no = $_GET['page_no'];
}?>

<!DOCTYPE html>
<html lang="en">
<?php include("header.php"); ?>

<body>

    <?php include("navbar.php"); ?>
    <!-- END nav -->

    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_5.jpg');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate mb-0 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.php">Home <i
                                    class="fa fa-chevron-right"></i></a></span> <span>Blog <i
                                class="fa fa-chevron-right"></i></span></p>
                    <h1 class="mb-0 bread">Blog</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section">
        <div class="container">
          <div class="row d-flex">
            <?php 
              $limit = 0; 
              $record_per_page = 6;
              if($page_no > 1){
                $limit = ($page_no-1)*$record_per_page;
              }
              $sql = " SELECT *,YEAR(post_date) AS YEAR, MONTHNAME(post_date) AS MONTH, DAY(post_date) AS DAY
                      FROM post a
                      LEFT JOIN post_category b ON a.`category_id` = b.`post_category_id` 
                      WHERE   1=1 "; 
              if(isset($_GET['post_category_id'])){
                $post_category_id = $_GET['post_category_id'];
                $sql .= " AND a.category_id ='$post_category_id' ";
              }
              $sql   .= " GROUP BY post_date ORDER BY post_date DESC ";
              $sql1   = $sql." LIMIT ".$limit.", ".$record_per_page." ";
              
              $result = mysqli_query($conn,$sql);
              $count  = mysqli_num_rows($result);

              $result1 = mysqli_query($conn,$sql1);
              $count1 = mysqli_num_rows($result1);

              if($count1 > 0) {
                while  ($row = mysqli_fetch_assoc($result1)){?>
                  <div class="col-md-4 d-flex ftco-animate">
                      <div class="blog-entry justify-content-end">
                          <div class="text text-center">
                              <a href="blog-single?post_id=<?php echo $row['post_id'];?>" class="block-20 img"
                                  style="background-image: url('<?php echo $row['post_img'];?>');">
                              </a>
                              <div class="meta text-center mb-2 d-flex align-items-center justify-content-center">
                                  <div>
                                      <span class="day"><?php echo $row ['DAY'] ; ?></span>
                                      <span class="mos"><?php echo $row ['MONTH'] ; ?></span>
                                      <span class="yr"><?php echo $row ['YEAR'] ; ?></span>
                                  </div>
                              </div>
                              <h3 class="heading mb-3"><a href="#"><?php echo $row['post_title'];?></a></h3>
                              <p><?php echo strlen($row['post_description']) > 130 ? substr($row['post_description'], 0, 130) . '...' : $row['post_description'];?>
                              </p>
                              <a href="blog-single?post_id=<?php echo $row['post_id'];?>" class="btn btn-primary">Read
                                  More</a>

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
                        if($count > 0) {
                          // $total_record = mysqli_fetch_assoc($result)['total'];            
                          $total_pages = ceil($count / $record_per_page);
                        }
                     ?>
                      <ul>
                         <?php
                          if( $page_no > 1){
                            echo'<li><a href="blog.php?page_no='.($page_no -1).' ">Prev</a></li>';
                          }
                        for ($i = 1; $i <= $total_pages; $i++) { ?>
                          <li class="<?php 
                          if($i == $page_no){
                            echo 'active';
                          }?>">
                            <a href="blog?page_no=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                          <?php }
                          if($total_pages > $page_no){
                            echo'<li><a href="blog.php?page_no='.($page_no +1).' ">Next</a></li>';
                          } ?>
                      </ul>
                  </div>
              </div>

          </div>
        </div>
    </section>

    <?php include("footer.php"); ?>




    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg></div>


    <?php include("js.php"); ?>

</body>

</html>