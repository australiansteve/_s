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
		add_image_size( 'hero-image-large', 1600, 645, true);
		add_image_size( 'archive-image', 800, 640, true);
		add_image_size( 'header-logo', 550, 180, true);
		add_image_size( 'footer-logo', 650, 36, true);
		add_image_size( 'hero-portrait', 850, 1150, true);
		add_image_size( 'section-side', 820, 925, true);
		add_image_size( 'homepage-landing', 1330, 730, true);
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

	$styleFile = (wp_get_environment_type() == 'production') ? 'style.min.css' : 'style.css';

	wp_enqueue_script( 'font-awesome', 'https://kit.fontawesome.com/30900d1525.js', array() );

	wp_enqueue_script( 'lodash', 'https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js', array() );

	wp_enqueue_style( 'hamburger-cat-style', get_template_directory_uri(). '/dist/'.$styleFile, array( ), HAMBURGER_CAT_VERSION );

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


/* Move Yoast metabox below ACF ones */
add_filter( 'wpseo_metabox_prio', function() {
	return 'low';
});

function austeve_custom_js_in_head() {
	$customJS = get_field('custom_js', 'option');

	if( have_rows('custom_js', 'option') ):
		while( have_rows('custom_js', 'option') ) : the_row();
			error_log("custom_js");

	        // Loop over sub repeater rows.
			if( have_rows('js_script') ):
				while( have_rows('js_script') ) : the_row();

	                // Get sub values.
					$name = get_sub_field('name');
					$script = get_sub_field('script');
					$location = get_sub_field('display_in');

					if ($location == 'header') {
						echo $script;
					}

				endwhile;
			endif;
		endwhile;
	endif;
}
add_action('wp_head','austeve_custom_js_in_head', 50);


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


function filter_events($query) {
	//error_log("pre_get_posts': ".print_r($query, true));
	if ( $query->is_post_type_archive('austeve-events') && $query->is_main_query() && !is_admin()) {

		/* Only show past events for the main part of the event archive */
		$date_now = date('Y-m-d H:i:s');

		$query->set( 'meta_query', array('relation' => 'AND',
			array(
				'key'			=> 'end_date',
				'compare'		=> '<',
				'value'			=> $date_now,
				'type'			=> 'DATETIME'
			)
		));

		$query->set( 'order', 'DESC');
		$query->set( 'orderby', 'meta_value');
		$query->set( 'meta_key', 'end_date');
		$query->set( 'meta_type', 'DATE');

	}
}
add_action ('pre_get_posts', 'filter_events');

function filter_paintings($query) {
	//error_log("pre_get_posts': ".print_r($query, true));
	if ( $query->is_post_type_archive('austeve-paintings') && $query->is_main_query() && !is_admin() ) {

		$query->set( 'order', 'ASC');
		$query->set( 'orderby', 'menu_order');

	}
}
add_action ('pre_get_posts', 'filter_paintings', 20);

function get_more_archive() {

	$nonce = $_REQUEST['security'];
	$post_type = $_REQUEST['post_type'];
	$term_id = $_REQUEST['term_id'];
	$page = $_REQUEST['page'];

	if (wp_verify_nonce( $nonce, 'get-more')) {
		//error_log("Get page ".$page. " of ".$post_type);

		$args = array(
			'post_type'		=> array( $post_type ),
			'post_status'	=> array( 'publish' ),
			'paged'			=> $page,
			'order' 		=> 'ASC',
			'orderby' 		=> 'menu_order'
		);

		if ($term_id > 0) {
			$tax_query = array(
				array(
					'taxonomy' => get_term( $term_id )->taxonomy,
				      'field' => 'term_id', 
				      'terms' => $term_id,
				      'include_children' => false
				),
			);

			$args['tax_query'] = $tax_query;
		}

		$postsquery = new WP_Query( $args );

		ob_start();

		if ( $postsquery->have_posts() ) {
			while ( $postsquery->have_posts() ) {
				$postsquery->the_post();

				?>

				<div class="cell">
					<?php get_template_part( 'template-parts/archive', get_post_type() ); ?>
				</div>

				<?php
			}
		}

		// Restore original Post Data
		wp_reset_postdata();

		echo ob_get_clean();

	}

	exit;
}

add_action('wp_ajax_austeve_get_more_archive', 'get_more_archive');
add_action('wp_ajax_nopriv_austeve_get_more_archive', 'get_more_archive');
