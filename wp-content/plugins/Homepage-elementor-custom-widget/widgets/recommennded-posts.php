<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Custom Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class recommended_post extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Custom widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'recommended_post';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Custom widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Recommended Posts', 'recommended_post' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Custom widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-code';
	}

	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url() {
		return 'https://developers.elementor.com/docs/widgets/';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Custom widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the Custom widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'custom', 'widget', 'recommended', 'posts' ];
	}

	/**
	 * Register Custom widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$display_option = array(
			"left" => "Left",
			"right" => "Right",
		);

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'recommended_post' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'heading',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'Heading of the section', 'textdomain' ),
			]
		);

		$this->add_control(
			'post_to_display',
			[
				'label' => esc_html__( 'Position To Display Big Banner Post', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'multiple' => true,
				'default' => 'left',
				'options' => $display_option,
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render Custom widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		$post_display = $settings['post_to_display'];
		$heading = $settings['heading'];

		$query = array (
			'paged' => 1,
			'posts_per_page' => 13,
			'offset' => 0,
			'post_status' => 'publish',
			'ignore_sticky_posts' => 0,
			'orderby' => 'date',
			'order' => 'DESC',
			'post_type' => 
			array (
				'post' => 'post',
				'video' => 'video',
			),
			'meta_query' => array(
				array(
					'key' => 'is_it_trending_article',
					'value' => 'yes',
					'compare' => '=',
				),
			),
		);
		$allposts = get_posts($query);
		$big_content = array_slice($allposts,0,1);
		$small_content = array_slice($allposts,1,4);
		$sliders = array_slice($allposts,5,8);
		// print "<pre>"; print_r($sliders); print "</pre>";
	?>
		<div class= "recommended-post-section">
			<h2 class="text-center section-heading"><?php print $heading; ?></h2>
			<div class="top-box d-flex">
				<?php
					if($post_display == "left"){
						?>
							<div class="recommended-post-section-left">
								<?php
									// print "<pre>"; print_r($big_content); print "</pre>";
									$B_id = $big_content[0]->ID;
									$title = get_the_title($B_id);
									$featured_image = get_the_post_thumbnail($B_id);
									$B_slug = get_permalink( $B_id);
									?>
									<div class="featured-image"><a href="<?php print $B_slug; ?>"><?php  print $featured_image; ?></a></div>
									<h3 class="category-listing-heading"><a href="<?php print $B_slug; ?>"><?php print $title; ?></a></h3>
							</div>
							<div class="recommended-post-section-right">
								<?php
									foreach($small_content as $s_ids){
										$s_id = $s_ids->ID;
										$s_title = get_the_title($s_id);
										$s_featured_image = get_the_post_thumbnail($s_id);
										$s_slug = get_permalink( $s_id);
										?>
											<div class="content-box">
												<div class="featured-image"><a href="<?php print $s_slug; ?>"><?php  print $s_featured_image; ?></a></div>
												<h4 class="category-listing-heading"><a href="<?php print $s_slug; ?>"><?php print $s_title; ?></a></h4>
											</div>
										<?php
									}
								?>
							</div>
						<?php
					}else{
						?>
							<div class="recommended-post-section-right">
								<?php
									foreach($small_content as $s_ids){
										$s_id = $s_ids->ID;
										$s_title = get_the_title($s_id);
										$s_featured_image = get_the_post_thumbnail($s_id);
										$s_slug = get_permalink( $s_id);
										?>
											<div class="content-box">
												<div class="featured-image"><a href="<?php print $s_slug; ?>"><?php  print $s_featured_image; ?></a></div>
												<h4 class="category-listing-heading"><a href="<?php print $s_slug; ?>"><?php print $s_title; ?></a></h4>
											</div>
										<?php
									}
								?>
							</div>
							<div class="recommended-post-section-left">
								<?php
									// print "<pre>"; print_r($big_content); print "</pre>";
									$B_id = $big_content[0]->ID;
									$title = get_the_title($B_id);
									$featured_image = get_the_post_thumbnail($B_id);
									$B_slug = get_permalink( $B_id);
									?>
									<div class="featured-image"><a href="<?php print $B_slug; ?>"><?php  print $featured_image; ?></a></div>
									<h3 class="category-listing-heading"><a href="<?php print $B_slug; ?>"><?php print $title; ?></a></h3>
							</div>
						<?php
					}
				?>
			</div>
			<div class="bottom-box slider row">
				<?php
					foreach($sliders as $sl_ids){
						$sl_id = $sl_ids->ID;
						$sl_title = get_the_title($sl_id);
						$sl_featured_image = get_the_post_thumbnail($sl_id);
						$sl_slug = get_permalink( $sl_id);
						?>
							<div class="slider-box">
								<div class="without-image">
									<!-- <div class="featured-image"><a href="<?php print $sl_slug; ?>"><?php  print $sl_featured_image; ?></a></div> -->
									<h4 class="category-heading"><a href="<?php print $sl_slug; ?>"><?php print $sl_title; ?></a></h4>
								</div>
							</div>
						<?php
					}
				?>
			</div>
		</div>
		<?php
	}

}