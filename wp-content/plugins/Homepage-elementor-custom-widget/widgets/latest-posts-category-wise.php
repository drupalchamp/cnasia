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
class latest_posts_category_wise extends \Elementor\Widget_Base {

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
		return 'latest_posts_category_wise';
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
		return esc_html__( 'Category Wise Latest Posts', 'latest_posts_category_wise' );
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
		return [ 'custom', 'widget', 'latest', 'posts', 'category' ];
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
				'label' => esc_html__( 'Content', 'latest_posts_category_wise' ),
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

		$this->add_control(
			'ad_code',
			[
				'label' => esc_html__( 'Ad Code', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'placeholder' => esc_html__( 'Put ad code here', 'textdomain' ),
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
		// $cta_link = $settings['cta_link'];
		// $cta_title = $settings['cta_title'];
		$ad_code = $settings['ad_code'];
		
		$Category_id = $Categories;
		$term_obj = get_term_by('id', $Category_id, 'category');
		$term_name = $term_obj->name;
		$term_slug = get_category_link($Category_id);

		?>  
		
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
					'video' => 'video',
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
		?>
		<div class= "latest-post-section category-wise">
			<div class="latest-post">
				<?php
					if($ad_code != ''){
						?>
							<div class="row">
								<div class="col-sm-9">
									<div class="title-and-view-more">
										<h2 class="section-heading">Latest From <?php print $term_name; ?></h2>
										<div class="view-more">
											<a href="<?php print $term_slug; ?>">View More</a>
										</div>
									</div>
									<div class="row">
									<?php
										foreach ($allposts as $post_id) {
											$id = $post_id->ID;
											$title = get_the_title($id);
											$slug = get_permalink( $id);
					
											$post_time = get_the_time('U' , $id);
											$current_time = current_time('timestamp');
											$time_difference = human_time_diff($post_time, $current_time);
											$featured_image = get_the_post_thumbnail($id);
					
											$categories = get_the_category($id);
											$categories = array_shift(array_slice($categories,0,1));
											$category_id =  $categories->term_id;
											$category_name =  $categories->name;
											$category_slug = get_category_link($categories);
					
									?>
										<div class="col-sm-6">
											<div class="latest-posts">
												<div class="row">
													<div class="col-sm-5">
														<div class="featured-image"><a href="<?php print $slug; ?>"><?php print $featured_image; ?></a></div>
													</div>
													<div class="col-sm-7">
														<a href="<?php print $category_slug; ?>" class="term-name"><?php print $category_name; ?></a>
														<h4 class="featured-content-heading"><a href="<?php print $slug; ?>"><?php print $title; ?></a></h4>
														<span class="timestamp"><?php print $time_difference.' ago'; ?></span>
													</div>
												</div>		
											</div>				
										</div>
									<?php
										}
									?>
									</div>
								</div>
								<div class="col-sm-3">
									<?php echo $ad_code; ?>
								</div>
							</div>
						<?php
					}else{
						?>
							<div class="title-and-view-more">
								<h2 class="section-heading">Latest From <?php print $term_name; ?></h2>
								<div class="view-more">
									<a href="<?php print $term_slug; ?>">View More</a>
								</div>
							</div>
							<div class="row">
								<?php
									foreach ($allposts as $post_id) {
										$id = $post_id->ID;
										$title = get_the_title($id);
										$slug = get_permalink( $id);
				
										$post_time = get_the_time('U' , $id);
										$current_time = current_time('timestamp');
										$time_difference = human_time_diff($post_time, $current_time);
										$featured_image = get_the_post_thumbnail($id);
				
										$categories = get_the_category($id);
										$categories = array_shift(array_slice($categories,0,1));
										$category_id =  $categories->term_id;
										$category_name =  $categories->name;
										$category_slug = get_category_link($categories);
				
								?>
									<div class="col-sm-6">
										<div class="latest-posts">
											<div class="row">
												<div class="col-sm-4">
													<div class="featured-image"><a href="<?php print $slug; ?>"><?php print $featured_image; ?></a></div>
												</div>
												<div class="col-sm-8">
													<a href="<?php print $category_slug; ?>" class="term-name"><?php print $category_name; ?></a>
													<h4 class="featured-content-heading"><a href="<?php print $slug; ?>"><?php print $title; ?></a></h4>
													<span class="timestamp"><?php print $time_difference.' ago'; ?></span>
												</div>
											</div>						
										</div>						
									</div>
								<?php
									}
								?>
							</div>
						<?php
					}
				?>
			</div>
		</div>
		<?php
	}

}