<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package channelnewsasia
 */

?>

	<footer id="colophon" class="site-footer sroll-close">
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="footer-top-left col-md-4"><?php dynamic_sidebar('footer-top-left'); ?></div>
					<div class="footer-top-middle col-md-4"><?php dynamic_sidebar('footer-top-middle'); ?></div>
					<div class="footer-top-right col-md-4"><?php dynamic_sidebar('footer-top-right'); ?></div>
				</div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="container">
				<?php dynamic_sidebar('footer-bottom'); ?>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
	<script 
	src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" 
	integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" 
	crossorigin="anonymous" 
	referrerpolicy="no-referrer" >
	</script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" 
	integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg==" 
	crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" 
	integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" 
	crossorigin="anonymous" referrerpolicy="no-referrer" />
</body>
</html>