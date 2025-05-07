<?php 
include("connection.php");

extract($_POST);
if(isset($is_submit)) {

    if($user_name == ""){
        echo $error ;
    } elseif ($email == "") {
        echo $error ;
    } elseif ($comment_text == "") {
        echo $error ;
    }

    $add_date = date('y-m-d , H:i:s');
    if(isset($_GET['post_id'])){
        $post_id =$_GET['post_id'];
    }

    if(empty($error)) {
        $sql8 = "INSERT INTO post_comment(user_name,email,comment_text,post_id,comment_date)
                 values('$user_name','$email','$comment_text','$post_id','$add_date') ";
        $result8 = mysqli_query($conn,$sql8);
        if($result8) {
            echo $msg ;
        }         


    }



}




?>

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
                                    class="fa fa-chevron-right"></i></a></span> <span class="mr-2"><a
                                href="blog.php">Blog <i class="fa fa-chevron-right"></i></a></span> <span>Blog Single <i
                                class="fa fa-chevron-right"></i></span></p>
                    <h1 class="mb-0 bread">Blog Single</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ftco-animate">
                    <div>
                        <?php
                $sql = "SELECT a.*, b.post_category_name , c.author_name
                        FROM post a 
                        LEFT JOIN post_category b ON a.category_id = b.post_category_id
                        LEFT JOIN post_author c ON a.author_id = c.author_id
                        WHERE 1=1 ";
              if(isset($_GET['post_id'])){
                    $post_id = $_GET['post_id'];
                $sql .= " AND a.post_id='$post_id' ";
              } 

              // echo $sql;
              $result = mysqli_query($conn,$sql);
              $count = mysqli_num_rows($result);
              if($count > 0) {
                while  ($row = mysqli_fetch_assoc($result)){ ?>
                        <p>
                            <img src="<?php echo $row['post_img'];?>" alt="" class="img-fluid">
                        </p>
                        <h2 class="mb-3"><?php echo $row['post_title'];?></h2>
                        <p><?php echo $row['post_description'];?></p>
                        <?php 
                }
              }?>
                    </div>
                    <div class="tag-widget post-tag-container mb-5 mt-5">
                        <div class="tagcloud">
                            <?php
									$sql = "SELECT * FROM `category` ";
									$result = mysqli_query($conn,$sql);
									$count = mysqli_num_rows($result);
				                  if($count > 0) {
				                	while($data = mysqli_fetch_assoc($result)){ ?>
                            <a href="#" class="tag-cloud-link"><?php echo $data['category_name'];?></a>
                            <?php }
			                	}?>
                        </div>
                    </div>

                    <div class="about-author d-flex p-4 bg-light">
                        <div class="bio mr-5">
                        <?php
                            $sql = "SELECT a.*, b.post_category_name , c.author_name ,c.post_author_img
                                    FROM post a 
                                    LEFT JOIN post_category b ON a.category_id = b.post_category_id
                                    LEFT JOIN post_author c ON a.author_id = c.author_id
                                    WHERE 1=1 ";
                                if(isset($_GET['post_id'])){
                                        $post_id = $_GET['post_id'];
                                    $sql .= " AND a.post_id='$post_id' ";
                                } 

                                $result = mysqli_query($conn,$sql);
                                $count = mysqli_num_rows($result);
                                if($count > 0) {
                                    while  ($at = mysqli_fetch_assoc($result)){ ?>
                            <img src="<?php echo $at['post_author_img'];?>" alt="Image placeholder" class="img-fluid mb-4">
                        </div>
                        <div class="desc">
                            <h3><?php echo $at['author_name'];?></h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem
                                necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa
                                sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
                        </div>
                    </div>
                    <?php }
			                	}?>


                    <div class="pt-5 mt-5">
                        <h3 class="mb-5">6 Comments</h3>
                        <ul class="comment-list">
                            <?php
                            $sql5 = "SELECT a.* , b.`post_id`
                                    FROM post_comment a
                                    LEFT JOIN post b ON a.`post_id` = b.`post_id`
                                    WHERE 1=1 "; 
                            if(isset($_GET['post_id'])){
                                $post_id =$_GET['post_id'];
                            $sql5 .= " AND a.post_id= '$post_id' ";     
                            } 
                            $result5 = mysqli_query($conn,$sql5);
                            $count5 = mysqli_num_rows($result5);
                            if($count5 > 0) {
                                while ( $data5 = mysqli_fetch_assoc($result5)){ ?>
                            <li class="comment">
                                <div class="vcard bio">
                                    <img src="<?php echo $data5['user_imag']; ?>" alt="Image placeholder">
                                </div>
                                <div class="comment-body">
                                    <h3><?php echo $data5['user_name']; ?></h3>
                                    <div class="meta"><?php echo $data5['comment_date']; ?></div>
                                    <p><?php echo $data5['comment_text']; ?></p>
                                </div>
                            </li>
                            <?php 
                              }
                            } else {
                                echo "<p>non has comment on this post</p>";
                            } 
                            ?>
                        </ul>
                        <!-- END comment-list -->

                        <div class="comment-form-wrap pt-5">
                            <h3 class="mb-5">Leave a comment</h3>
                            <?php
                            if(isset($msg)){
                                echo $msg="You have comment successfully";
                            }
                            if(isset($error)){
                                echo $error="You have comment successfully";
                            }
                            ?>
                            <form  class="p-5 bg-light" method="post">
                                <input type="hidden" name="is_submit" value="Y">
                                <div class="form-group">
                                    <label for="user_name">Name *</label>
                                    <input type="text" name="user_name" class="form-control" id="user_name" value="<?php if(isset($user_name)) { echo $user_name; } ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" name="email" class="form-control" id="email" value="<?php if(isset($email)) { echo $email; } ?>">
                                </div>

                                <div class="form-group">
                                    <label for="comment_text">Message</label>
                                    <input type="text" name="comment_text" id="comment_text" cols="30" rows="10" class="form-control" value="<?php if(isset($comment_text)) { echo $comment_text; } ?>">
                                </div>
                                <div class="form-group">
                                    <input type="submit"  placeholder="Post Comment" class="btn py-3 px-4 btn-primary">
                                </div>

                            </form>
                        </div>
                    </div>

               <?php include("blog_sidebar.php"); ?>
    </section> <!-- .section -->

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