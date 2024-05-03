<?php

/**
 * Template part for displaying page content in single-post.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package channelnewsasia
 */
get_header();

$ids = [];
$id = $post->ID;
$ids[] = $id;

$title = get_the_title($id); 
$date = $post->post_date;
$date = date('d M Y', strtotime($date));
$post_time = get_the_time('h:i a', $id);
$video_url = get_post_meta( $id, 'video_url', true );

$categories = get_the_terms( $id, 'category' );
if($categories){
    $categories = array_shift(array_slice($categories,0,1));
    $category_id =  $categories->term_id;
}
?>

<div class="video-detail-page text-white sroll-close">
    <div class="container">

        <div class="video-title">
            <h1 class="section-heading"><?php print $title; ?></h1>
        </div>

        <div class="video-content">
            <!-- Start row -->
                <div class="row">
                    <!-- Start col-sm-9 -->
                    <div class="col-sm-9">
                        <div class="content-wrapper">
                            <div class="video-section"><iframe width="100%" height="502" src="<?php print $video_url; ?>" frameborder="0"></iframe></div>
                            <div class="post-date"><?php print $date; ?> <?php print $post_time; ?></div>
                            <div class="video-detail"><?php the_content(); ?></div>
                        </div>

                    </div>
                        <!-- End col-sm-9 -->
                    <!-- Start col-sm-3 -->
                    <div class="col-sm-3 desktop-show">
                        <?php dynamic_sidebar('video-right-sidebar-area'); ?>
                    </div>
                    <!-- End col-sm-3 -->

                </div>
            <!-- End row -->
        </div>

        <div class="related-content">
            <?php
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
                'post__not_in' => 
                    array (
                        0 => $id,
                    ),
                'tax_query' => 
                array (
                    'taxonomy_category' => 
                    array (
                    'taxonomy' => 'category',
                    'field' => 'id',
                    'terms' => $category_id,
                    'operator' => 'IN',
                    'include_children' => false,
                    ),
                ),
            );
            $post_ids = get_posts($query);
            $left_listing = array_slice($post_ids,0,1);
            $right_listing = array_slice($post_ids,1); 
            if($post_ids){ ?>
                <h2 class="section-heading">You May Also Like</h2>
            <?php } ?>

            <div class="related-video-listing d-flex">
                <?php if($left_listing){
                    echo '<div class="related-video-listing-left">';
                        foreach ($left_listing as $post_id) {
                            $id = $post_id->ID;
                            $title = get_the_title($id);
                            $slug = get_permalink( $id);
                            $featured_image = get_the_post_thumbnail( $id );
                            $duration = get_post_meta($id, 'duration', true);

                            $post_time = get_the_time('U' , $id);
                            $current_time = current_time('timestamp');
                            $time_difference = human_time_diff($post_time, $current_time);

                            $categories = get_the_category($id);
                            $categories = array_shift(array_slice($categories,0,1));
                            $category_id =  $categories->term_id;
                            $category_name =  $categories->name;
                            $category_slug = get_category_link($categories);
                            ?>	
                                <div class="related-video-structure">
                                    <div class="featured-image"><a href="<?php print $slug; ?>"><?php  print $featured_image; ?></a></div>
                                    <div class="related-video-structure-data">
                                        <a href="<?php print $category_slug; ?>" class="term-name"><?php print $category_name; ?></a>
                                        <h3 class="related-video-listing-heading"><a href="<?php print $slug; ?>"><?php print $title; ?></a></h3>
                                        <div class="time-duration d-flex">
                                            <span class="timestamp"><?php print $time_difference.' ago'; ?></span>
                                            <span class="duration"><?php print $duration; ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        } 
                    echo '</div>';
                }?>
                <?php if($right_listing){
                    echo '<div class="related-video-listing-right">';
                        foreach ($right_listing as $post_id) {
                            $id = $post_id->ID;
                            $title = get_the_title($id);
                            $slug = get_permalink( $id);
                            $featured_image = get_the_post_thumbnail( $id );
                            $duration = get_post_meta($id, 'duration', true);

                            $post_time = get_the_time('U' , $id);
                            $current_time = current_time('timestamp');
                            $time_difference = human_time_diff($post_time, $current_time);

                            $categories = get_the_category($id);
                            $categories = array_shift(array_slice($categories,0,1));
                            $category_id =  $categories->term_id;
                            $category_name =  $categories->name;
                            $category_slug = get_category_link($categories);
                            ?>
                                <div class="related-video-structure">
                                    <div class="featured-image"><a href="<?php print $slug; ?>"><?php  print $featured_image; ?></a></div>
                                    <div class="related-video-structure-data">
                                        <a href="<?php print $category_slug; ?>" class="term-name"><?php print $category_name; ?></a>
                                        <h5 class="related-video-listing-heading"><a href="<?php print $slug; ?>"><?php print $title; ?></a></h5>
                                        <div class="time-duration d-flex">
                                            <span class="timestamp"><?php print $time_difference.' ago'; ?></span>
                                            <span class="duration"><?php print $duration; ?></span>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                    echo '</div>'; 
                }?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>