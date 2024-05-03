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
class editor_picks extends \Elementor\Widget_Base {

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
		return 'editor_picks';
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
		return esc_html__( 'Editor Picks Posts', 'editor_picks' );
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
		return [ 'custom', 'widget', 'latest', 'posts' ];
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
			"7" => "7",
			"8" => "8",
			"9" => "9",
			"10" => "10",
			"20" => "20",
		);

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'editor_picks' ),
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
				'label' => esc_html__( 'Post To Display', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'multiple' => true,
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
			'posts_per_page' => $post_display,
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
					'key' => 'editors_pick_option',
					'value' => 'yes',
					'compare' => '=',
				),
			),
		);
		$allposts = get_posts($query);
	?>
		<div class= "editors-pick-section">
			<h2 class="text-center section-heading"><?php print $heading; ?></h2>
			<div class="editor-pick">
				<div class="editor-pick-slider">
					<?php
						foreach ($allposts as $post_id) {
							$id = $post_id->ID;
							$title = get_the_title($id);
							$slug = get_permalink( $id);
							$featured_image = get_the_post_thumbnail($id);

							?>
							<div class="content-box">
								<div class="featured-image"><a href="<?php print $slug; ?>"><?php print $featured_image; ?></a></div>
								<h4 class="featured-content-heading"><a href="<?php print $slug; ?>"><?php print $title; ?></a></h4>
							</div>
							<?php
						}
					?>
				</div>
			</div>
		</div>
		<?php
	}

}