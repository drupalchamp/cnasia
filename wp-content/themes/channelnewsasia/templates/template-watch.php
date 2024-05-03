<?php

/* Template Name: Watch */

get_header();
 ?>

  <article class="watch-page sroll-close" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container">
        <div class="page-header">
            <h1 class="page-title"><?php the_title() ?></h1>
            <div class="description"><?php the_content() ?></div>
        </div>
        <div class="latest-watch-section">
            <div class="row">
                <div class="col-sm-8 with-video">
                    <?php
                        $query = array (
                            'paged' => 1,
                            'posts_per_page' => '1',
                            'offset' => 0,
                            'post_status' => 'publish',
                            'ignore_sticky_posts' => 0,
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'post_type' => 
                            array (
                                'video' => 'video',
                            ),
                        );
                        $post_ids = get_posts($query);
                        foreach ($post_ids as $post_id) {
                        $id = $post_id->ID;
                        $post_content = $post_id->post_content;
                        $title = get_the_title($id);
                        $slug = get_permalink( $id);
                        $duration = get_post_meta($id, 'duration', true);
                        $video_url = get_post_meta( $id, 'video_url', true );
                        $date = $post_id->post_date;
                        $date = date('d M Y', strtotime($date));
                        $post_time = get_the_time('h:i a', $id);
                        ?>
                        <div class="video-wrapper">
                            <div class="video-section"><iframe width="100%" height="502" src="<?php print $video_url; ?>" frameborder="0"></iframe></div>
                            <span class="indicator-flag">
                                <b class="on-air">ON AIR</b>
                            </span>
                            <h4 class="video-news-heading"><a href="<?php print $slug; ?>"><?php print $title; ?></a></h4>
                            <div class="post-date"><?php print $date; ?> <?php print $post_time; ?></div>
                            <p class="content"><?php print $post_content; ?></p>
                        </div>
                    <?php }?>
                </div>
                <div class="col-sm-4 without-video">
                    <h4 class="recommend-watch-title">Recommended for you</h4>
                    <?php
                        $query = array (
                            'paged' => 1,
                            'posts_per_page' => '5',
                            'offset' => 1,
                            'post_status' => 'publish',
                            'ignore_sticky_posts' => 0,
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'post_type' => 
                            array (
                                'video' => 'video',
                            ),
                        );
                        $post_ids = get_posts($query);
                        foreach ($post_ids as $post_id) {
                        $id = $post_id->ID;
                        $post_content = $post_id->post_content;
                        $title = get_the_title($id);
                        $slug = get_permalink( $id);
                        $featured_image = get_the_post_thumbnail($id ,'watch-list-thumb');
                        $duration = get_post_meta($id, 'duration', true);
                        $video_url = get_post_meta( $id, 'video_url', true );
                        $post_time = get_the_time('U' , $id);
                        $current_time = current_time('timestamp');
                        $time_difference = human_time_diff($post_time, $current_time);
                        ?>
                        <div class="recommend-watch-section d-flex">
                            <div class="featured-image"><a href="<?php print $slug; ?>"><?php print $featured_image; ?></a></div>
                            <div class="watch-video-detail">
                                <h4 class="recommend-news-heading"><a href="<?php print $slug; ?>"><?php print $title; ?></a></h4>
                                <div class="time-duration d-flex">
                                    <span class="timestamp"><?php print $time_difference.' ago'; ?></span>
                                    <span class="duration"><?php print $duration; ?></span>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
        <div class="recommended-section">
            <h2 class="section-heading">Recommended</h2>
            <!-- <div class="recommended-listing"> -->
            <?php
            $query = array (
                'paged' => 1,
                'posts_per_page' => '5',
                'offset' => 6,
                'post_status' => 'publish',
                'ignore_sticky_posts' => 0,
                'orderby' => 'date',
                'order' => 'DESC',
                'post_type' => 
                array (
                    'video' => 'video',
                ),
            );
            $post_ids = get_posts($query);
            $left_listing = array_slice($post_ids,0,1);
            $right_listing = array_slice($post_ids,1);
            ?>
            <div class="related-video-listing d-flex">
                <?php if($left_listing){
                    echo '<div class="related-video-listing-left">';
                        foreach ($left_listing as $post_id) {
                        $id = $post_id->ID;
                        $post_content = $post_id->post_content;
                        $title = get_the_title($id);
                        $slug = get_permalink( $id);
                        $featured_image = get_the_post_thumbnail($id);
                        $duration = get_post_meta($id, 'duration', true);
                        $video_url = get_post_meta( $id, 'video_url', true );
                        $post_time = get_the_time('U' , $id);
                        $current_time = current_time('timestamp');
                        $time_difference = human_time_diff($post_time, $current_time);

                        $categories = get_the_category($id);
                        $categories = array_shift(array_slice($categories,0,1));
                        $category_id =  $categories->term_id;
                        $category_name =  $categories->name;
                        $category_slug = get_category_link($categories);

                        $post_ids = get_posts($query);
                        ?>
                            <div class="related-video-structure-left">
                                <div class="featured-image"><a href="<?php print $slug; ?>"><?php print $featured_image; ?></a></div>
                                <div class="related-video-structure-data">
                                    <a href="<?php print $category_slug; ?>" class="term-name"><?php print $category_name; ?></a>
                                    <h4 class="video-news-heading"><a href="<?php print $slug; ?>"><?php print $title; ?></a></h4>
                                    <p class="content"><?php print $post_content; ?></p>
                                </div>
                            </div>
                        <?php }
                    echo '</div>';
                }?>
                <?php if($right_listing){
                    echo '<div class="related-video-listing-right">';
                        foreach ($right_listing as $post_id) {
                            $id = $post_id->ID;
                            $post_content = $post_id->post_content;
                            $title = get_the_title($id);
                            $slug = get_permalink( $id);
                            $featured_image = get_the_post_thumbnail($id);
                            $duration = get_post_meta($id, 'duration', true);
                            $video_url = get_post_meta( $id, 'video_url', true );
                            $post_time = get_the_time('U' , $id);
                            $current_time = current_time('timestamp');
                            $time_difference = human_time_diff($post_time, $current_time);

                            $categories = get_the_category($id);
                            $categories = array_shift(array_slice($categories,0,1));
                            $category_id =  $categories->term_id;
                            $category_name =  $categories->name;
                            $category_slug = get_category_link($categories);

                            $post_ids = get_posts($query);
                            ?>
                                <div class="related-video-structure-right">
                                    <div class="featured-image"><a href="<?php print $slug; ?>"><?php print $featured_image; ?></a></div>
                                    <div class="related-video-structure-data">
                                        <a href="<?php print $category_slug; ?>" class="term-name"><?php print $category_name; ?></a>
                                        <h5 class="related-video-listing-heading"><a href="<?php print $slug; ?>"><?php print $title; ?></a></h5>
                                    </div>
                                </div>
                        <?php }
                    echo '</div>'; 
                }?>
            </div>
            <!-- </div> -->
        </div>
        <div class="inside-asia-section">
            <h2 class="section-heading">Inside Asia</h2>
            <div class="inside-asia-listing">
                <?php
                    $idObj = get_category_by_slug('asia'); 
                    $Category_id = $idObj->term_id;
                    $query = array (
                        'paged' => 1,
                        'posts_per_page' => '5',
                        'offset' => 0,
                        'post_status' => 'publish',
                        'ignore_sticky_posts' => 0,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'post_type' => 
                        array (
                            'video' => 'video',
                        ),
                        'tax_query' =>
                        array (
                            'taxonomy_category' => 
                            array (
                                'taxonomy' => 'category',
                                'field' => 'id',
                                'terms' => $Category_id,
                                'operator' => 'IN',
                                'include_children' => false,
                            ),
                        ),
                    );
                    $post_ids = get_posts($query);
                    $left_listing = array_slice($post_ids,0,1);
                    $right_listing = array_slice($post_ids,1);    
                ?>
                <div class="row">
                    <div class="col-sm-9">
                        <div class="category-video-listing d-flex">
                            <?php if($left_listing){
                                echo '<div class="category-video-listing-left">';
                                    foreach ($left_listing as $post_id) {
                                        $id = $post_id->ID;
                                        $title = get_the_title($id);
                                        $slug = get_permalink( $id);
                                        $featured_image = get_the_post_thumbnail( $id );
                                        $duration = get_post_meta($id, 'duration', true);

                                        $post_time = get_the_time('U' , $id);
                                        $current_time = current_time('timestamp');
                                        $time_difference = human_time_diff($post_time, $current_time);
                                        ?>	
                                            <div class="category-video-structure-left">
                                                <div class="featured-image"><a href="<?php print $slug; ?>"><?php  print $featured_image; ?></a></div>
                                                <div class="category-video-structure-left-data">
                                                    <h4 class="category-video-listing-heading"><a href="<?php print $slug; ?>"><?php print $title; ?></a></h4>
                                                    <div class="time-duration d-flex">
                                                        <span class="timestamp"><?php print $time_difference.' ago'; ?></span>
                                                        <span class="duration"><?php print $duration; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    } 
                                echo '</div>';
                            }
                            if($right_listing){
                                echo '<div class="category-video-listing-right">';
                                    foreach ($right_listing as $post_id) {
                                        $id = $post_id->ID;
                                        $title = get_the_title($id);
                                        $slug = get_permalink( $id);
                                        $featured_image = get_the_post_thumbnail( $id );
                                        $duration = get_post_meta($id, 'duration', true);
                
                                        $post_time = get_the_time('U' , $id);
                                        $current_time = current_time('timestamp');
                                        $time_difference = human_time_diff($post_time, $current_time);
                                        ?>
                                            <div class="category-video-structure">
                                                <div class="category-video-structure-right">
                                                    <div class="featured-image"><a href="<?php print $slug; ?>"><?php  print $featured_image; ?></a></div>
                                                    <h4 class="category-video-listing-heading"><a href="<?php print $slug; ?>"><?php print $title; ?></a></h4>
                                                    <div class="time-duration d-flex">
                                                        <span class="timestamp"><?php print $time_difference.' ago'; ?></span>
                                                        <span class="duration"><?php print $duration; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php }
                                echo '</div>'; 
                            } ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <?php dynamic_sidebar('video-right-sidebar-area'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </article><!-- #post-<?php the_ID(); ?> -->

<?php get_footer(); ?>