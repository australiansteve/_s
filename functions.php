<?php
/**
 * Hamburger_Cat functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Hamburger_Cat
 */

if ( ! defined( 'HAMBURGER_CAT_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'HAMBURGER_CAT_VERSION', '1.0.0' );
}

if ( ! function_exists( 'hamburger_cat_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function hamburger_cat_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Hamburger_Cat, use a find and replace
		 * to change 'hamburger-cat' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'hamburger-cat', get_template_directory() . '/languages' );

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
				'primary-menu' => esc_html__( 'Primary', 'hamburger-cat' ),
				'social-menu' => esc_html__( 'Social Media', 'hamburger-cat' ),
				'language-menu' => esc_html__( 'Language Switcher', 'hamburger-cat' ),
				'footer-menu' => esc_html__( 'Footer', 'hamburger-cat' ),
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
				'hamburger_cat_custom_background_args',
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

		add_image_size( 'header-logo', 405, 130, true );
		add_image_size( 'footer-logo', 275, 145, true );
		add_image_size( 'archive-square', 600, 600, true );
	}
endif;
add_action( 'after_setup_theme', 'hamburger_cat_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hamburger_cat_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'hamburger_cat_content_width', 640 );
}
add_action( 'after_setup_theme', 'hamburger_cat_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function hamburger_cat_scripts() {

	wp_enqueue_script('lodash-js',
		'https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js'
	);

	wp_enqueue_script( 'font-awesome', 'https://kit.fontawesome.com/30900d1525.js', array() );

	wp_enqueue_style( 'hamburger-cat-style', get_stylesheet_uri(), array(), HAMBURGER_CAT_VERSION );
	wp_style_add_data( 'hamburger-cat-style', 'rtl', 'replace' );

	wp_enqueue_script( 'hamburger-cat-js', get_template_directory_uri() . '/dist/main.js', array( ), HAMBURGER_CAT_VERSION, true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'hamburger_cat_scripts' );

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
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Load ACF Theme files
 */
if ( class_exists('ACF') ) {
	require get_template_directory() . '/inc/theme-settings.php';
}

/* Scoial media menu item icons */
add_filter('wp_nav_menu_objects', function( $items, $args ) {
	// loop
	foreach( $items as &$item ) {
		// vars
		$icon = get_field('icon', $item);
		// replace title with icon
		if( $icon ) {
			$title = $item->title;
			$item->title = '<i class="fab fa-'.$icon.'" title="'.$title.'"></i>';	
		}
	}

	// return
	return $items;
}, 10, 2);

add_filter('nav_menu_css_class', function( $classes, $item, $args ) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}, 1, 3);


function austeve_courses_pagesize( $query ) {
    if ( ! is_admin() && (is_post_type_archive( 'austeve-courses' ) || (is_array($query->get('post_type')) && in_array('austeve-courses', $query->get('post_type'))))) {
        // Display 50 posts for 'austeve-courses'
        $query->set( 'posts_per_page', 50 );

        error_log("Course Query : ".print_r($query, true));
		
		$queries = null;
		parse_str($_SERVER['QUERY_STRING'], $queries);

		error_log("Course Filter : ".print_r($queries, true));

		if(array_key_exists('search', $queries)) {
			$query->set('s', $queries['search']);
		}

		if (array_key_exists('category', $queries)) {

		 	$query->set('tax_query', array(
				array(
					'taxonomy'         => 'course-category',
					'terms'            => $queries['category'],
					'field'            => 'slug',
					'operator'         => 'IN',
				)
			));
		}

        return;
    }
}
add_action( 'pre_get_posts', 'austeve_courses_pagesize', 1, 1 );

function austeve_get_courses() {

	$nonce = $_REQUEST['security'];
	if (wp_verify_nonce( $nonce, 'get-courses')) {
		error_log("AJAX SEARCH");
		$category = isset($_REQUEST['category']) ? $_REQUEST['category'] : null;
		$search = isset($_REQUEST['s']) ? $_REQUEST['s']: null;

		$args = array(
			'post_type' => array('austeve-courses'),
			'post_status' => array('publish'),
			'order' => 'ASC',
			'orderby' => 'menu_order',
		);

		if ($category) {
			$args['tax_query'] = array(
				array(
					'taxonomy'         => 'course-category',
					'terms'            => $category,
					'field'            => 'slug',
					'operator'         => 'IN',
				)
			);
		}

		if ($search) {
			$args['s'] = $search;
		}

		error_log("AJAX args: ".print_r($args, true));
		$ajaxposts = new WP_Query( $args );

		if ( $ajaxposts->have_posts()) {
			while ( $ajaxposts->have_posts() ) {
				$ajaxposts->the_post();
				include( locate_template('template-parts/archive-austeve-courses.php', false, false ));
			}
		}

		wp_reset_query();
	}

	exit;
}

add_action('wp_ajax_austeve_get_courses', 'austeve_get_courses');
add_action('wp_ajax_nopriv_austeve_get_courses', 'austeve_get_courses');
