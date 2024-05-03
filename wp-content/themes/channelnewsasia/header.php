<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package channelnewsasia
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>



<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'channelnewsasia' ); ?></a>

	<div class="whole-header">

		<header id="masthead" class="site-header">
			<div id="search-wrapper">
				<div class="container">
					<div class="search-section">
						<div class="search-section-left"><?php dynamic_sidebar('search-section-left'); ?></div>
						<div class="search-section-middle"><?php dynamic_sidebar('search-section-middle'); ?></div>
						<div class="search-section-right"><?php dynamic_sidebar('search-section-right'); ?></div>
					</div>
				</div>
			</div>
			<?php if(wp_is_mobile() && ! wp_is_ipad()){ ?>
				<div class="mobile-header-top">
					<div class="container">
						<div class="mobile-header-top-section"><?php dynamic_sidebar('mobile-header-top'); ?></div>
						<div class="mobile-header-bottom-section"><?php dynamic_sidebar('mobile-header-bottom'); ?></div>
					</div>
				</div>
				<div class="mobile-popout_navigation">
					<?php dynamic_sidebar('mobile-popout-navigation'); ?>
				</div>
			<?php }else{ ?>
				<div class="header-top">
					<div class="container">
						<div class="row">
							<div class="header-top-left col-sm-8"><?php dynamic_sidebar('header-top-left'); ?></div>
							<div class="header-top-right col-sm-4"><?php dynamic_sidebar('header-top-right'); ?></div>
						</div>
					</div>
				</div>
			<?php } ?>
			<div class="header-bottom" id="header-bottom-area">
				<div class="container">
					<?php dynamic_sidebar('header-bottom'); ?>
				</div>
			</div>
		</header><!-- #masthead -->
		<div class="header-bottom-leaderboard">
			<div class="container">
				<?php dynamic_sidebar('header-bottom-leaderboard'); ?>
			</div>
		</div>

	</div>
	
