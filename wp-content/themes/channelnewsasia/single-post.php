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

$categories = get_the_terms( $id, 'category' );
if($categories){
    $categories = array_shift(array_slice($categories,0,1));
    $category_id =  $categories->term_id;
    $category_name =  $categories->name;
    $category_slug =  get_category_link($categories);
}

$title = get_the_title($id); 
$date = $post->post_date;
$date = date('d M Y', strtotime($date));
$post_time = get_the_time('h:i a', $id);
$subtitle = get_post_meta( $id, 'sub_heading', true );
$source = get_post_meta( $id, 'source', true );
$author = get_post_meta( $id, 'select_author', true );
$display_name = get_the_author_meta('display_name', $author);
$author_link = get_author_posts_url($author);
$author_attahment_id = get_the_author_meta( 'bio_pic',$author );
if($author_attahment_id) $profile_photo = wp_get_attachment_image(get_the_author_meta( 'bio_pic',$author ));
else $profile_photo = get_avatar(get_the_author_meta('user_email',$author), apply_filters('MFW_author_bio_avatar_size', 60));
$twitter_username = get_the_author_meta( 'twitter_username',$author ); 
$twitter_url = get_the_author_meta( 'twitter_url',$author ); 
$featured_image = get_the_post_thumbnail($id);
$image = get_post_thumbnail_id( $id );
$image_caption = wp_get_attachment_caption( $image );

$date = $post->post_date;
$date = date('d M Y', strtotime($date));
$post_time = get_the_time('h:i a', $id);
$modified_time = get_the_modified_time('d M Y h:i a', $id);

?>

<div class="article-detail-page container sroll-close">

    <div class="article-header-wrapper text-center">
        <a href="<?php print $category_slug; ?>" class="term-name"><?php print $category_name; ?></a>
        <h1 class="section-heading"><?php print $title; ?></h1>
        <h4 class="sub-title"><?php print $subtitle; ?></h4>
    </div>

    <div class="article-main-wrapper">
        <!-- Start row -->
            <div class="row">
                <!-- Start col-sm-9 -->
                    <div class="col-sm-9 detail-media">
                        <div class="featured-image"><?php print $featured_image; ?></div>
                        <div class="image-caption"><?php print $image_caption; ?></div>
                    </div>
                <!-- End col-sm-9 -->
                <!-- Start col-sm-3 -->
                    <div class="col-sm-3 desktop-show">
                        <?php if($author){ ?>
                            <div class="author-description d-flex">
                                <div class="author-image ">
                                    <?php print $profile_photo; ?> 
                                </div>
                                <div class="author-details">
                                    <h6 class="author-name"><a href="<?php print $author_link; ?>"><?php print $display_name; ?></a></h6>
                                    <?php if($twitter_username){ ?>
                                        <p class="twitter-username"><a href="<?php print $twitter_url; ?>"><?php print $twitter_username; ?></a></p>
                                    <?php }?>
                                </div>

                            </div>
                        <?php } ?>
                        <div class="post-date-time">
                            <div class="post-date"><?php print $date; ?> <?php print $post_time; ?></div>
                            <div class="post-date-with-update">(<?php print 'Updated: '.$modified_time; ?>)</div>
                        </div>
                    </div>
                <!-- End col-sm-3 -->

            </div>
        <!-- End row -->
    </div>

    <div class="article-body-wrapper">
        <div class="row">
            <div class="col-sm-9">
                <div class="article-detail"><?php the_content(); ?></div>
            </div>
            <div class="col-sm-3">
                <?php dynamic_sidebar('video-right-sidebar-area'); ?>
            </div>
        </div>
    </div>
    <div class="source-block">
      <div class="source source-with-label"><?php print "Source: ".$source; ?></div>
    </div>

</div>


<?php get_footer(); ?>