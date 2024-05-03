<?php
/**
 * channelnewsasia functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package channelnewsasia
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function channelnewsasia_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on channelnewsasia, use a find and replace
		* to change 'channelnewsasia' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'channelnewsasia', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'channelnewsasia' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'channelnewsasia_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'channelnewsasia_setup' );
add_image_size( 'watch-list-thumb', 122, 68, true);

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function channelnewsasia_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'channelnewsasia_content_width', 640 );
}
add_action( 'after_setup_theme', 'channelnewsasia_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function channelnewsasia_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Header Top Left', 'channelnewsasia' ),
			'id'            => 'header-top-left',
			'description'   => esc_html__( 'Add widgets here.', 'channelnewsasia' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Header Top Right', 'channelnewsasia' ),
			'id'            => 'header-top-right',
			'description'   => esc_html__( 'Add widgets here.', 'channelnewsasia' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Header Bottom', 'channelnewsasia' ),
			'id'            => 'header-bottom',
			'description'   => esc_html__( 'Add widgets here.', 'channelnewsasia' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Header Bottom Leaderboard', 'channelnewsasia' ),
			'id'            => 'header-bottom-leaderboard',
			'description'   => esc_html__( 'Add widgets here.', 'channelnewsasia' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Search Section Left', 'channelnewsasia' ),
			'id'            => 'search-section-left',
			'description'   => esc_html__( 'Add widgets here.', 'channelnewsasia' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Search Section Middle', 'channelnewsasia' ),
			'id'            => 'search-section-middle',
			'description'   => esc_html__( 'Add widgets here.', 'channelnewsasia' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Search Section Right', 'channelnewsasia' ),
			'id'            => 'search-section-right',
			'description'   => esc_html__( 'Add widgets here.', 'channelnewsasia' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Mobile Header Top', 'channelnewsasia' ),
			'id'            => 'mobile-header-top',
			'description'   => esc_html__( 'Add widgets here.', 'channelnewsasia' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Mobile Header Bottom', 'channelnewsasia' ),
			'id'            => 'mobile-header-bottom',
			'description'   => esc_html__( 'Add widgets here.', 'channelnewsasia' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Mobile Pop-out navigation', 'channelnewsasia' ),
			'id'            => 'mobile-popout-navigation',
			'description'   => esc_html__( 'Add widgets here.', 'channelnewsasia' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	// Footer-section starts
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer top Left', 'channelnewsasia' ),
			'id'            => 'footer-top-left',
			'description'   => esc_html__( 'Add widgets here.', 'channelnewsasia' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer top Middle', 'channelnewsasia' ),
			'id'            => 'footer-top-middle',
			'description'   => esc_html__( 'Add widgets here.', 'channelnewsasia' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer top Right', 'channelnewsasia' ),
			'id'            => 'footer-top-right',
			'description'   => esc_html__( 'Add widgets here.', 'channelnewsasia' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Bottom', 'channelnewsasia' ),
			'id'            => 'footer-bottom',
			'description'   => esc_html__( 'Add widgets here.', 'channelnewsasia' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Video Right Sidebar Area', 'channelnewsasia' ),
			'id'            => 'video-right-sidebar-area',
			'description'   => esc_html__( 'Add widgets here.', 'channelnewsasia' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'channelnewsasia_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function channelnewsasia_scripts() {
	wp_enqueue_style( 'channelnewsasia-cdn', get_template_directory_uri() . '/css/bootstrap.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'channelnewsasia-layout', get_template_directory_uri() . '/css/layout.css', array(), _S_VERSION );
	wp_enqueue_style( 'channelnewsasia-header', get_template_directory_uri() . '/css/header.css', array(), _S_VERSION );
	wp_enqueue_style( 'channelnewsasia-footer', get_template_directory_uri() . '/css/footer.css', array(), _S_VERSION );
	wp_enqueue_style( 'channelnewsasia-mobile', get_template_directory_uri() . '/css/mobile.css', array(), _S_VERSION );
	wp_enqueue_style( 'channelnewsasia-ipad', get_template_directory_uri() . '/css/ipad.css', array(), _S_VERSION );
	wp_enqueue_style( 'channelnewsasia-jQuery', get_template_directory_uri() . '/css/jquery-ui.css', array(), _S_VERSION );
	wp_enqueue_style( 'channelnewsasia-font', get_template_directory_uri() . '/font/stylesheet.css', array(), _S_VERSION );
	
	$current_time = date('h.i.s.m.d.Y');
	wp_enqueue_script( 'channelnewsasia-navigation', get_template_directory_uri() . '/js/navigation.js', array(), $current_time, true );
	wp_enqueue_script( 'channelnewsasia-jquery-min', get_template_directory_uri() . '/js/jquery.min.js', array(), $current_time);
	wp_enqueue_script( 'channelnewsasia-bootstrap-bundle', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array(), $current_time );
	wp_enqueue_script( 'channelnewsasia-simple', get_template_directory_uri() . '/js/simple.js', array(), $current_time);
    wp_enqueue_script( 'channelnewsasia-jquery-ui', get_template_directory_uri() . '/js/jquery-ui.js', array(), $current_time);

}
add_action( 'wp_enqueue_scripts', 'channelnewsasia_scripts' );

function wp_enqueue_emoji_styles() {
    wp_enqueue_style('wp-emoji');
}

function wp_print_font_faces() {
    // Your font face styles go here
    echo '<style>';
    echo '/* Add your font face CSS rules here */';
    echo '</style>';
}

// Hook the function to an appropriate action
add_action('wp_head', 'wp_print_font_faces');
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
function wp_is_ipad() {
	$ipad = strpos($_SERVER['HTTP_USER_AGENT'],'iPad');
	if ($ipad === false) {
		return false;
	} else {
		return true;
	}
  }
