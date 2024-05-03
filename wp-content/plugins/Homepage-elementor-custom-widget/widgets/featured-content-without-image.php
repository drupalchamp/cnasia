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
class Featured_content_without_image extends \Elementor\Widget_Base {

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
		return 'featured_content_without_image';
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
		return esc_html__( 'Featured Content without image', 'featured_content_without_image' );
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
		return [ 'custom', 'widget' ];
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

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'featured_content_without_image' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'300x250_ad',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( '300*250 Ad code', 'textdomain' ),
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
        $ad = $settings['300x250_ad'];
		?>  
		<div class="featured-content-without-image-section">
			<?php
			$query = array (
				'paged' => 1,
				'posts_per_page' => '9',
				'offset' => 10,
				'post_status' => 'publish',
				'ignore_sticky_posts' => 0,
				'orderby' => 'date',
				'order' => 'DESC',
				'post_type' => 
				array (
				'post' => 'post',
				),
				'meta_query' => 
				array (
					0 => 
					array (
					'key' => 'is_it_featured',
					'value' => 'yes',
					'compare' => '=',
					'type' => 'CHAR',
					),
				),
			);
			$topposts = get_posts($query);?>
			<div class="ad-section"><?php print $ad; ?></div>
			<div class="listing-without-image">
				<?php
				foreach ($topposts as $post_id) {
					$id = $post_id->ID;
					$title = get_the_title($id);
					$slug = get_permalink( $id);

					$post_time = get_the_time('U' , $id);
					$current_time = current_time('timestamp');
					$time_difference = human_time_diff($post_time, $current_time);

					$categories = get_the_category($id);
                    $categories = array_shift(array_slice($categories,0,1));
                    $category_id =  $categories->term_id;
                    $category_name =  $categories->name;
                    $category_slug = get_category_link($categories);
					?>
					<div class="featured-content-listing">
						<a href="<?php print $category_slug; ?>" class="term-name"><?php print $category_name; ?></a>
						<h4 class="featured-content-heading"><a href="<?php print $slug; ?>"><?php print $title; ?></a></h4>
						<span class="timestamp"><?php print $time_difference.' ago'; ?></span>
					</div>

				<?php } ?>	
			</div>
		</div>	
		<?php
	}

}