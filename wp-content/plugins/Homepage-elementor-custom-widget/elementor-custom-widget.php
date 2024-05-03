<?php
/**
 * Plugin Name: Homepage Elementor Custom Widget
 * Description: Auto embed any embbedable content from external URLs into Elementor.
 * Plugin URI:  https://elementor.com/
 * Version:     1.0.0
 * Author:      Asentech
 * Author URI:  https://www.asentechllc.com/
 *
 * Elementor tested up to: 3.7.0
 * Elementor Pro tested up to: 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register oEmbed Widget.
 *
 * Include widget file and register widget class.
 *
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */


// for homepage.
function register_homepage_widgtes( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/latest-news-without-fetured-content.php' );
	$widgets_manager->register( new \Latest_news_without_featured_content() );


	require_once( __DIR__ . '/widgets/featured-content-with-image.php' );
	$widgets_manager->register( new \Featured_content_with_image() );


	require_once( __DIR__ . '/widgets/featured-content-without-image.php' );
	$widgets_manager->register( new \Featured_content_without_image() );


	require_once( __DIR__ . '/widgets/homepage-latest-video.php' );
	$widgets_manager->register( new \Homepage_latest_video() );
}
add_action( 'elementor/widgets/register', 'register_homepage_widgtes' );


// for Category wise grid post listing coming on homepage
function register_category_wise_listing( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/category-wise-listing.php' );
	$widgets_manager->register( new \Category_wise_listing() );

	// Latest posts widget
	require_once( __DIR__ . '/widgets/latest-posts.php' );
	$widgets_manager->register( new \latest_posts() );

	// Category wise latest posts
	require_once( __DIR__ . '/widgets/latest-posts-category-wise.php' );
	$widgets_manager->register( new \latest_posts_category_wise() );

	// trending posts
	require_once( __DIR__ . '/widgets/trending-posts.php' );
	$widgets_manager->register( new \trending_posts() );

	// Editors picks posts widget
	require_once( __DIR__ . '/widgets/editor-picks.php' );
	$widgets_manager->register( new \editor_picks() );

	// Recommended picks posts widget
	require_once( __DIR__ . '/widgets/recommennded-posts.php' );
	$widgets_manager->register( new \recommended_post() );

	// Ad with Image widget
	require_once( __DIR__ . '/widgets/ad-with-img.php' );
	$widgets_manager->register( new \ad_with_img() );
}
add_action( 'elementor/widgets/register', 'register_category_wise_listing' );