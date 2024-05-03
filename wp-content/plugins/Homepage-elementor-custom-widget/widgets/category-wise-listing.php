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
class Category_wise_listing extends \Elementor\Widget_Base {

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
		return 'category_wise_listing';
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
		return esc_html__( 'Category wise listing', 'category_wise_listing' );
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

		$display_option = array(
			"7" => "7",
			"8" => "8",
			"9" => "9",
			"10" => "10",
		);

		$option = [];
		$terms = get_terms([
			'taxonomy' => 'category',
			'hide_empty' => false,
		]);
		foreach ($terms as $term) {
			$option[$term->term_id] = $term->name;
			
		}
		

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'category_wise_listing' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Select Category', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'multiple' => true,
				'options' => $option,
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
        $Categories = $settings['list'];
		
		$Category_id = $Categories;
		$term_obj = get_term_by('id', $Category_id, 'category');
		$term_name = $term_obj->name;
		$term_slug = get_category_link($Category_id);

		?>  
		<div class="latest-category-section">
			<?php
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
			$allposts = get_posts($query);
			$left_listing = array_slice($allposts,0,2);
			$middle_listing = array_slice($allposts,2,2);
			$right_listing = array_slice($allposts,4);
			?>
			<h2 class="section-heading"><?php print $term_name; ?></h2>
			<div class="category-listing d-flex">
				<?php
					if($left_listing){
						echo '<div class="category-listing-left">';
							foreach ($left_listing as $post_id) {
								$id = $post_id->ID;
								$title = get_the_title($id);
								$external_url = get_post_meta( $id, 'external_url', true );
								$slug = get_permalink( $id);
								if($external_url != ""){
									$slug = $external_url;
								}else{
									$slug = $slug;
								}
								$featured_image = get_the_post_thumbnail( $id );

								$post_time = get_the_time('U' , $id);
								$current_time = current_time('timestamp');
								$time_difference = human_time_diff($post_time, $current_time);
								?>	
									<div class="category-structure">
										<div class="featured-image"><a href="<?php print $slug; ?>"><?php  print $featured_image; ?></a></div>
										<div class="content-information">
											<h4 class="category-listing-heading"><a href="<?php print $slug; ?>"><?php print $title; ?></a></h4>
											<span class="timestamp"><?php print $time_difference.' ago'; ?></span>
										</div>
									</div>
								<?php
							} 
						echo '</div>';
					}
					if($middle_listing){
						echo '<div class="category-listing-middle">';
						$count = 0;
							foreach ($middle_listing as $post_id) {
								$id = $post_id->ID;
								$title = get_the_title($id);
								$slug = get_permalink( $id);
								$featured_image = get_the_post_thumbnail( $id );

								$post_time = get_the_time('U' , $id);
								$current_time = current_time('timestamp');
								$time_difference = human_time_diff($post_time, $current_time);

								if ($count == 0) {?>
									<div class="category-structure-top">
										<div class="featured-image"><a href="<?php print $slug; ?>"><?php print $featured_image; ?></a></div>
										<div class="content-information">
											<h4 class="category-listing-heading"><a href="<?php print $slug; ?>"><?php print $title; ?></a></h4>
											<span class="timestamp"><?php print $time_difference.' ago'; ?></span>
										</div>
									</div>
								<?php } else { ?>
									<div class="category-structure-bottom d-flex">
										<div class="featured-image"><a href="<?php print $slug; ?>"><?php print $featured_image; ?></a></div>
										<div class="content-information">
											<h4 class="category-listing-heading"><a href="<?php print $slug; ?>"><?php print $title; ?></a></h4>
											<span class="timestamp"><?php print $time_difference.' ago'; ?></span>
										</div>
									</div>
								<?php }	
								$count++;
							}
						echo '</div>';
					}
					if($right_listing){
						echo '<div class="category-listing-right">';
						$count = 0;
							foreach ($right_listing as $post_id) {
								$id = $post_id->ID;
								$title = get_the_title($id);
								$slug = get_permalink( $id);
								$featured_image = get_the_post_thumbnail( $id );
		
								$post_time = get_the_time('U' , $id);
								$current_time = current_time('timestamp');
								$time_difference = human_time_diff($post_time, $current_time);
									
								if ($count == 0) {?>
									<div class="category-structure">
										<div class="featured-image"><a href="<?php print $slug; ?>"><?php print $featured_image; ?></a></div>
										<div class="content-information">
											<h4 class="category-listing-heading"><a href="<?php print $slug; ?>"><?php print $title; ?></a></h4>
											<span class="timestamp"><?php print $time_difference.' ago'; ?></span>
										</div>
									</div>
								<?php } else { ?>
									<div class="category-structure-without-image">
										<h4 class="category-listing-heading"><a href="<?php print $slug; ?>"><?php print $title; ?></a></h4>
										<span class="timestamp"><?php print $time_difference.' ago'; ?></span>
									</div>
								<?php }	
								$count++;
							}
						echo '</div>'; 
					} 
				?>																
			</div> 
		</div>	
		<?php
	}

}