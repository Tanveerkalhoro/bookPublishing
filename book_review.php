<?php
include("connection.php");
 extract($_POST);
if(isset($is_submit)) {
    if($user_name == "") {
        echo $error;
    }
    elseif($email == ""){
        echo $error;
    }
    elseif($comment_text == ""){
        echo $error;
    } 
    $add_date = date('Y-m-d H:i:s');
    $book_id = $_GET['book_id'];

    if(empty($error)){
        $sql7 = "INSERT INTO book_comment(user_name,email,comment_text,comment_date,book_id) 
        VALUES('$user_name','$email','$comment_text','$add_date','$book_id')";
        $result7 = mysqli_query($conn,$sql7);
        if($result7) {
            echo $msg;
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
                                href="book.php">Book <i class="fa fa-chevron-right"></i></a></span> <span>Single Book <i
                                class="fa fa-chevron-right"></i></span></p>
                    <h1 class="mb-0 bread">Book Review</h1>
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
                        if(isset($_GET['book_id'])){
                                $book_id = $_GET['book_id'];} 
                        $sql3 = " SELECT *  FROM book  WHERE book_id='$book_id' ";
                        //echo $sql3; die ;
                        $result3 = mysqli_query($conn,$sql3);
                        $count = mysqli_num_rows($result3);
                        if($count > 0) {
                            while($row = mysqli_fetch_assoc($result3)){ ?>
                            <p>
                                <img src="<?php echo $row['book_img'];?>" alt="" class="img-fluid">
                            </p>
                            <h2 class="mb-3"><?php echo $row['book_name'];?></h2>
                            <p><?php echo $row['review'];?></p>
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
                            $sql4 = "SELECT a.* ,  b.`author_name` , b.`author_intro` , b.`author_img` 
                                    FROM book a
                                    INNER JOIN author b ON a.`book_id` = b.`author_id` WHERE 1 = 1 " ;
                                    if(isset($_GET['book_id'])){
                                        $book_id = $_GET['book_id'];
                            $sql4 .= " AND a.book_id = '$book_id' "; }
                            $result4 = mysqli_query($conn,$sql4);
                            $count4 = mysqli_num_rows($result4);
                            if($count4 > 0 ) {
                                while ( $data4 = mysqli_fetch_assoc($result4)) { ?>
                            <img src="<?php echo $data4['author_img'] ;?>" alt="Image placeholder" class="img-fluid mb-4">
                        </div>
                        <div class="desc">
                            <h3><?php echo $data4['author_name']; ?></h3>
                            <p><?php echo $data4['author_intro']; ?></p>
                        </div>
                        <?php }
                            }        
                            ?>
                    </div>
                    <div class="pt-5 mt-5">
                        <h3 class="mb-5">Comments About Book</h3>
                        <ul class="comment-list">
                            <?php
                            $sql6 = "SELECT a.*, b.`book_id`
                                    FROM `book_comment` a
                                    LEFT JOIN book b ON a.`book_id` = b.`book_id` WHERE 1=1 "; 
                            if(isset($_GET['book_id'])){
                                $book_id =$_GET['book_id'];
                                $sql6 .= " AND a.book_id= '$book_id' ";} 
                            // echo $sql6;
                            $result6 = mysqli_query($conn,$sql6);
                            $count6 = mysqli_num_rows($result6);
                            if($count6 > 0) {
                                while ( $data6 = mysqli_fetch_assoc($result6)){ ?>
                            <li class="comment">
                                <div class="vcard bio">
                                    <img src="<?php echo $data6['user_imag']; ?>" alt="Image placeholder">
                                </div>
                                <div class="comment-body">
                                    <h3><?php echo $data6['user_name']; ?></h3>
                                    <div class="meta"><?php echo $data6['comment_date']; ?></div>
                                    <p><?php echo $data6['comment_text']; ?></p>
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
                            <form class="p-5 bg-light" method="post">
                                <?php if(isset($msg)){ 
                                    echo $msg="Your have comment successfully!";
                                } 
                                if(isset($error)) {
                                    echo $error="their is something error in comment !";
                                }
                                ?>
                                <input type="hidden" name="is_submit" value="Y">
                                <div class="form-group">
                                    <label for="user_name">Name *</label>
                                    <input type="text" name="user_name" class="form-control" id="user_name"
                                        value="<?php if(isset($user_name)){ echo $user_name ;} ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        value="<?php if(isset($email)){ echo $email ;} ?>">
                                </div>
                                <div class="form-group">
                                    <label for="comment_text">Message *</label>
                                    <input type="text" name="comment_text" id="comment_text" cols="30" rows="10"
                                        class="form-control"
                                        value="<?php if(isset($comment_text)){ echo $comment_text ;} ?>">
                                </div>
                                <div class="form-group">
                                    <input type="submit" placeholder="Post Comment" class="btn py-3 px-4 btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- .col-md-8 -->
                <div class="col-lg-4 sidebar pl-lg-5 ftco-animate">
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
                            <h3>Relative Books</h3>
                            <?php
                            $sql = "SELECT * FROM `category` ";
                            $result = mysqli_query($conn,$sql);
                            $count = mysqli_num_rows($result);
                            if($count > 0) {
                            while($data = mysqli_fetch_assoc($result)){ ?>
                            <li><a href="blog?post_category_id=<?php echo $data['category_id'];?>"><?php echo $data['category_name'];?><span class="fa fa-chevron-right"></span></a></li>
                            <?php }
			                	}?>
                        </div>
                    </div>
                    <div class="sidebar-box ftco-animate">
                        <h3>Recent Blog</h3>
                           <?php 
                            $sql = "SELECT *,YEAR(post_date) AS YEAR, MONTHNAME(post_date) AS MONTH, DAY(post_date) AS DAY
                            FROM post GROUP BY post_date ORDER BY post_date DESC LIMIT 3;";
                            $result = mysqli_query($conn,$sql);
                            $count = mysqli_num_rows($result);
                            if($count > 0) {
                            while  ($row = mysqli_fetch_assoc($result)){ ?>
                            <div class="block-21 mb-4 d-flex">
                                <a class="blog-img mr-4"
                                    style="background-image: url(<?php echo $row ['post_img'] ; ?>);"></a>
                                <div class="text">
                                    <h3 class="heading"><a href="blog-single?post_id=<?php echo $row['post_id'];?>">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                                    <div class="meta">
                                        <div><a href="#"><span class="fa fa-calendar"></span><?php echo date('Y-M-d', strtotime($row['post_date'])); ?></a></div>
                                        <div><a href="#"><span class="fa fa-user"></span> Admin</a></div>
                                        <div><a href="#"><span class="fa fa-comment"></span> 19</a></div>
                                    </div>
                                </div>
                             </div>
                        <?php }
                           }?>
                    </div>
                    <div class="sidebar-box ftco-animate">
                        <h3>Tag Cloud</h3>
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
                    <div class="sidebar-box ftco-animate">
                        <h3>Quotation of The Day !</h3>
                        <p>What you do today can improve all your tomorrows. Never give up. Today is hard,
                            tomorrow will be worse, but the day after tomorrow will be sunshine.
                            Someone is sitting in the shade today because someone planted a tree a long time ago..</p>
                    </div>
                </div>

            </div>
        </div>
    </section> <!-- .section -->
    <?php include("footer.php"); ?>
    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg>
    </div>
    <?php include("js.php"); ?>
</body>

</html>