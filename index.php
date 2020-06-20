<?php include 'inc/header.php'; ?>

<section id="feature_news_section" class="feature_news_section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="feature_article_wrapper">
                    <div class="feature_article_img">
                        <?php 
                            $data = getlatestdata('video');
                        ?>
                        <iframe width="100%" height="500px" src="https://www.youtube.com/embed/<?php echo $data[0]['url']  ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        <h1><?php echo $data[0]['name']; ?></h1><hr>
                    </div>
                        <?php 
                            $latest_new = getlatestdata('news');
                        ?>
                        <h1><a href="single?id=<?php echo $latest_new[0]['id']; ?>" class="btn-link" ><?php echo $latest_new[0]['title']; ?></a></h1>
                        <p><?php echo $latest_new[0]['summary']; ?></p>
                        <a href="single?id=<?php echo $latest_new[0]['id']; ?>" class="btn-link" >Read more...</a>
                </div>
            </div>
            <div class="col-md-5">
                <h1>Gallery</h1>
            <?php 
                $gallery_info = getlatestdatas('gallery',2);
                foreach ($gallery_info as $key => $value) {
            ?>
                <div class="feature_static_wrapper">
                    <div class="feature_article_img">
                        <a href="gallery/gallery?id=<?php echo $value['id'] ?>"><img class="img-responsive img-thumbnail" src="<?php echo UPLOAD_URL.'gallery/'.$value['featured_image'] ?>" alt="feature-top">
                            <h5><?php echo $value['image_description'] ?></h5></a>
                    </div>
            <?php
                }
            ?>
                </div>
            </div>
        </div>
    </div>

<?php 
    $no_cat = true;
    $cat_info = getAllRows('categories','ASC');
    if ($cat_info) {
        $no_cat = false;
    }
?>





<section id="category_section" class="category_section">
<div class="container">
<div class="row">
<div class="col-md-12">
<?php 
    if(!$no_cat){
        foreach ($cat_info as $key => $cat) {
            $cat_news = getcatnews('news',5,$cat['id']);
            // debugger($cat_news,true);
?>
    <div class="category_section">
        <div class="article_title header_purple">
            <h2><a href="category?cat_id=<?php echo $cat['id']; ?>" target="_self"><?php echo $cat['name']; ?></a></h2>
        </div>
        <!----article_title------>
        <div class="category_article_wrapper">
            <div class="row">
                <?php 
                    $class = 'col-md-6';
                    $file_location = UPLOAD_URL."news/".$cat_news[0]['image'];
                    // echo $file_location;
                    // exit;
                    if (isset($cat_news[0]['image']) && !empty($cat_news[0]['image']) && file_exists(UPLOAD_DIR.'news/'.$cat_news[0]['image'])) {
                ?>
                    <div class="col-md-6">
                        <div class="top_article_img">
                            <a href="single?id=<?php echo $cat_news[0]['id']; ?>" target="_self">
                                <img class="img-responsive" src="<?php echo UPLOAD_URL."news/".$cat_news[0]['image']; ?>" alt="top">
                            </a>
                        </div>
                        <!----top_article_img------>
                    </div>
                <?php 
                    }else{
                        $class = 'col-md-12';
                    }
                ?>
                <div class="<?php echo $class; ?>">
                    <span class="tag purple"><?php echo $cat['name']; ?></span>

                    <div class="category_article_title">
                        <h2><a href="single?id=<?php echo $cat_news[0]['id']; ?>" target="_self"><?php echo $cat_news[0]['title']; ?></a></h2>
                    </div>
                    <!----category_article_title------>
                    <div class="category_article_date"><a href="#"><?php echo date('M d Y',strtotime($cat_news[0]['created_date'])); ?></a></div>
                    <!----category_article_date------>
                    <div class="category_article_content">
                        <?php 
                            echo html_entity_decode(substr($cat_news[0]['description'], 0,500));
                        ?>
                        <p><a href="single?id=<?php echo $cat_news[0]['id']; ?>" class="btn-link">Read more...</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="category_article_wrapper">
            <div class="row">
                <div class="col-md-6">
                    <?php 
                        if (isset($cat_news[1]) && !empty($cat_news[1])) {
                    ?>
                    <div class="media">
                        <?php 
                            $class = 'col-md-12';
                            if (isset($cat_news[1]['image']) && !empty($cat_news[1]['image']) && file_exists(UPLOAD_DIR.'news/'.$cat_news[1]['image'])) {
                                $class = 'col-md-6';
                        ?>
                                <div class="media-left">
                                    <a href="single?id=<?php echo $cat_news[1]['id'] ?>"><img class="media-object" width="122px" height="122px" src="<?php echo UPLOAD_URL.'news/'.$cat_news[1]['image'] ?>"
                                                     alt="Generic placeholder image"></a>
                                </div>
                        <?php        
                            }

                        ?>
                        <div class="media-body">
                            <span class="tag purple"><?php echo $cat['name']; ?></span>

                            <h3 class="media-heading"><a href="single?id=<?php echo $cat_news[1]['id'] ?>" target="_self"><?php echo $cat_news[1]['title']; ?></a></h3>
                            <span class="media-date"><?php echo date('M d Y',strtotime($cat_news[1]['created_date'])); ?></span>
                        </div>
                    </div>
                    <?php 
                        }
                    ?>
                    
                    <?php 
                        if (isset($cat_news[2]) && !empty($cat_news[2])) {
                    ?>
                    <div class="media">
                        <?php 
                            $class = 'col-md-12';
                            if (isset($cat_news[2]['image']) && !empty($cat_news[2]['image']) && file_exists(UPLOAD_DIR.'news/'.$cat_news[2]['image'])) {
                                $class = 'col-md-6';
                        ?>
                                <div class="media-left">
                                    <a href="single?id=<?php echo $cat_news[2]['id'] ?>"><img class="media-object" width="122px" height="122px" src="<?php echo UPLOAD_URL.'news/'.$cat_news[2]['image'] ?>"
                                                     alt="Generic placeholder image"></a>
                                </div>
                        <?php        
                            }

                        ?>
                        <div class="media-body">
                            <span class="tag purple"><?php echo $cat['name']; ?></span>

                            <h3 class="media-heading"><a href="single?id=<?php echo $cat_news[2]['id'] ?>" target="_self"><?php echo $cat_news[2]['title']; ?></a></h3>
                            <span class="media-date"><?php echo date('M d Y',strtotime($cat_news[2]['created_date'])); ?></span>
                        </div>
                    </div>
                    <?php 
                        }
                    ?>
                </div>
                <div class="col-md-6">
                    <?php 
                        if (isset($cat_news[3]) && !empty($cat_news[3])) {
                    ?>
                    <div class="media">
                        <?php 
                            $class = 'col-md-12';
                            if (isset($cat_news[3]['image']) && !empty($cat_news[3]['image']) && file_exists(UPLOAD_DIR.'news/'.$cat_news[3]['image'])) {
                                $class = 'col-md-6';
                        ?>
                                <div class="media-left">
                                    <a href="single?id=<?php echo $cat_news[3]['id'] ?>"><img class="media-object" width="122px" height="122px" src="<?php echo UPLOAD_URL.'news/'.$cat_news[3]['image'] ?>"
                                                     alt="Generic placeholder image"></a>
                                </div>
                        <?php        
                            }

                        ?>
                        <div class="media-body">
                            <span class="tag purple"><?php echo $cat['name']; ?></span>

                            <h3 class="media-heading"><a href="single?id=<?php echo $cat_news[3]['id'] ?>" target="_self"><?php echo $cat_news[3]['title']; ?></a></h3>
                            <span class="media-date"><?php echo date('M d Y',strtotime($cat_news[3]['created_date'])); ?></span>
                        </div>
                    </div>
                    <?php 
                        }
                    ?>
                    
                    <?php 
                        if (isset($cat_news[4]) && !empty($cat_news[4])) {
                    ?>
                    <div class="media">
                        <?php 
                            $class = 'col-md-12';
                            if (isset($cat_news[4]['image']) && !empty($cat_news[4]['image']) && file_exists(UPLOAD_DIR.'news/'.$cat_news[4]['image'])) {
                                $class = 'col-md-6';
                        ?>
                                <div class="media-left">
                                    <a href="single?id=<?php echo $cat_news[4]['id'] ?>"><img class="media-object" width="122px" height="122px" src="<?php echo UPLOAD_URL.'news/'.$cat_news[4]['image'] ?>"
                                                     alt="Generic placeholder image"></a>
                                </div>
                        <?php        
                            }

                        ?>
                        <div class="media-body">
                            <span class="tag purple"><?php echo $cat['name']; ?></span>

                            <h3 class="media-heading"><a href="single?id=<?php echo $cat_news[4]['id'] ?>" target="_self"><?php echo $cat_news[4]['title']; ?></a></h3>
                            <span class="media-date"><?php echo date('M d Y',strtotime($cat_news[4]['created_date'])); ?></span>
                        </div>
                    </div>
                    <?php 
                        }
                    ?>
                </div>
               
            </div>
        </div>
        <p class="divider"><a href="#">More News&nbsp;&raquo;</a></p>
    </div>
<?php  
        }
    }
?>

<?php include 'inc/footer.php'; ?>