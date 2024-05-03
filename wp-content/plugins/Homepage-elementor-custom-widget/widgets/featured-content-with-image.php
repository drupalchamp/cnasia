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
class Featured_content_with_image extends \Elementor\Widget_Base {

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
		return 'featured_content_with_image';
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
		return esc_html__( 'Featured Content with image', 'featured_content_with_image' );
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
				'label' => esc_html__( 'Content', 'featured_content_with_image' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'Title', 'textdomain' ),
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
		?>  
		<div class="featured-content-image-section">
			<?php
			$query = array (
				'paged' => 1,
				'posts_per_page' => '10',
				'offset' => 0,
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
			$topposts = get_posts($query);
			$count = 0;?>
				<?php
				foreach ($topposts as $post_id) {
					$id = $post_id->ID;
					$title = get_the_title($id);
					$slug = get_permalink( $id);
					$featured_image = get_the_post_thumbnail($id);

					$post_time = get_the_time('U' , $id);
					$current_time = current_time('timestamp');
					$time_difference = human_time_diff($post_time, $current_time);

					$categories = get_the_category($id);
                    $categories = array_shift(array_slice($categories,0,1));
                    $category_id =  $categories->term_id;
                    $category_name =  $categories->name;
                    $category_slug = get_category_link($categories);

					if ($count == 0) {?>
						<div class="first-featured-content">
							<a href="<?php print $category_slug; ?>" class="term-name"><?php print $category_name; ?></a>
							<h1 class="featured-content-heading"><a href="<?php print $slug; ?>"><?php print $title; ?></a></h1>
							<span class="timestamp"><?php print $time_difference.' ago'; ?></span>
							<div class="featured-image"><a href="<?php print $slug; ?>"><?php print $featured_image; ?></a></div>
						</div>
					<?php } else { ?>
						<div class="remaining-featured-contents d-flex">
							<div class="featured-image"><a href="<?php print $slug; ?>"><?php print $featured_image; ?></a></div>
							<div class="featured-content-data">
								<a href="<?php print $category_slug; ?>" class="term-name"><?php print $category_name; ?></a>
								<h4 class="featured-content-heading"><a href="<?php print $slug; ?>"><?php print $title; ?></a></h4>
								<span class="timestamp"><?php print $time_difference.' ago'; ?></span>
							</div>
						</div>
					<?php }
				
					$count++; 

				} ?>	
		</div>	
		<?php
	}

}