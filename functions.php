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
				'language-menu-small' => esc_html__( 'Mobile Language Switcher', 'hamburger-cat' ),
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
				'height'      => 95,
				'width'       => 195,
				'flex-width'  => true,
				'flex-height' => true,
				'header-text' => array( 'site-title', 'site-description' ),
			)
		);

		add_image_size( 'full-page-background', 1920, 1080, true);
		add_image_size( 'hero-image', 1920, 775, true);
		add_image_size( 'archive-image', 800, 640, true);
		add_image_size( 'header-logo', 390, 190, false);
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

	// Google Fonts
	wp_enqueue_style(
		'google_fonts',
		'https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap'
	);

	wp_enqueue_style( 'hamburger-cat-style', get_stylesheet_uri(), array( 'google_fonts' ), HAMBURGER_CAT_VERSION );
	wp_style_add_data( 'hamburger-cat-style', 'rtl', 'replace' );

	wp_enqueue_script( 'hamburger-cat-js', get_template_directory_uri() . '/dist/main.js', array( 'jquery'), HAMBURGER_CAT_VERSION, true );


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
			$item->title = '<i class="fab '.$icon.'" title="'.$title.'"></i>';	
		}
	}

	// return
	return $items;
}, 10, 2);

add_filter ( 'pre_get_posts', function($query) {
	if (! is_admin() && $query->is_main_query() && is_post_type_archive('austeve-projects') && !is_tax('project-category')) {
		//Restrict the Projects archive page to be one default category
		$defaultCategory = get_field('projects_default_category', 'options');

		if ($defaultCategory) {
			$tax_query = $query->get( 'tax_query' ) ?: array();
			$tax_query[] = array(
					'taxonomy'         => 'project-category',
					'terms'            => array($defaultCategory),
					'field'            => 'term_id',
					'operator'         => 'IN'
			);		
	        $query->set( 'tax_query', $tax_query );
	    }

		return $query;        
	}
}, 10, 1);

add_filter( 'get_the_archive_title', function ($title) {
	if ( is_post_type_archive() ) {
		$title = "<span>" . post_type_archive_title( '', false ) . "</span>";
	} elseif ( is_tax('project-category') ) {
		/* Start with tax term name */
		$title = single_term_title( '', false );

		/* Prepend parent term names */
		$parentTermId = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) )->parent;
		$parentTerm = get_term_by('id', $parentTermId, 'project-category');
		while($parentTerm) {
			$title = "<a href='".get_term_link($parentTerm->term_id)."'>".$parentTerm->name."</a> : ".$title;
			$parentTerm = get_term_by('id', $parentTerm->parent, 'project-category');
		}

		/* Prepend post type archive */
		global $post;
		$post_type_string = get_post_type($post);
		$post_type = get_post_type_object( $post_type_string ); 
		$title = "<span><a href='".get_post_type_archive_link($post_type_string)."'>".get_post_type_labels($post_type)->name."</a> : " .$title. "</span>";

	} elseif ( is_category() ) {
		$title = "<span>" . single_cat_title( '', false ) . "</span>";
	} elseif ( is_tag() ) {
		$title = "<span>" . single_tag_title( '', false ) . "</span>";
	} elseif ( is_author() ) {
		$title = '<span>' . get_the_author() . '</span>' ;
	}
	return $title;
});

// Move Yoast to bottom
function austeve_yoasttobottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'austeve_yoasttobottom');
