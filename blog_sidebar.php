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
                                    <h3>Raltive Post</h3>
                                    <?php
                                            $sql = "SELECT * FROM `post_category` ";
                                            $result = mysqli_query($conn,$sql);
                                            $count = mysqli_num_rows($result);
                                        if($count > 0) {
                                            while($data = mysqli_fetch_assoc($result)){ ?>
                                    <li><a href="blog?post_category_id=<?php echo $data['post_category_id'];?>"><?php echo $data['post_category_name'];?><span
                                                class="fa fa-chevron-right"></span></a></li>
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
                                        <h3 class="heading"><a href="blog-single?post_id=<?php echo $row['post_id'];?>">Even the
                                                all-powerful Pointing has no control about the blind texts</a></h3>
                                        <div class="meta">
                                            <div><a href="#"><span
                                                        class="fa fa-calendar"></span><?php echo date('Y-M-d', strtotime($row['post_date'])); ?></a>
                                            </div>
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
                                <h3>Paragraph</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem
                                    necessitatibus voluptate quod mollitia delectus aut.</p>
                            </div>
                        </div>

                    </div>
                </div>