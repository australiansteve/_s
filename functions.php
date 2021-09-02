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
				'about-menu' => esc_html__( 'About Page sub-menu', 'hamburger-cat' ),
				'off-canvas-account-login-menu' => esc_html__( 'Off-Canvas Account Login menu', 'hamburger-cat' ),
				'account-login-menu' => esc_html__( 'Account Login menu', 'hamburger-cat' )
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
		add_image_size( 'achievement', 250, 250, true);

		add_filter( 'show_admin_bar', '__return_false' );
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

	wp_enqueue_script('lodash-js',
		'https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js'
	);

	wp_enqueue_script( 'font-awesome', 'https://kit.fontawesome.com/30900d1525.js', array() );

	wp_enqueue_style( 'hamburger-cat-style', get_template_directory_uri(). '/dist/'.$styleFile, array( ), HAMBURGER_CAT_VERSION );

	wp_style_add_data( 'hamburger-cat-style', 'rtl', 'replace' );

	wp_enqueue_script( 'hamburger-cat-js', get_template_directory_uri() . '/dist/main.js', array( 'jquery'), HAMBURGER_CAT_VERSION, true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'hamburger_cat_scripts' );

function hamburger_cat_h5p_alter_styles(&$styles, $libraries, $embed_type) {

	$styleFile = (wp_get_environment_type() == 'production') ? 'h5p.min.css' : 'h5p.css';

	$styles[] = (object) array(
		// Path must be relative to wp-content/uploads/h5p or absolute.
		'path' => get_template_directory_uri(). '/dist/'.$styleFile,
		'version' => '?ver=1.4' // Cache buster
	);
	error_log("H5P Styles: ".print_r($styles, true));
}
add_action('h5p_alter_library_styles', 'hamburger_cat_h5p_alter_styles', 10, 3);

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
	//error_log("wp_nav_menu_objects".print_r( $items, true)." ".print_r($args, true));

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

function your_bp_admin_bar_add() {
	global $wp_admin_bar, $bp;

	if ( !bp_use_wp_admin_bar() || defined( 'DOING_AJAX' ) )
		return;

	$user_domain = bp_loggedin_user_domain();
	$item_link = trailingslashit( $user_domain . 'goals' );

	$wp_admin_bar->add_menu( array(
		'parent'  => $bp->my_account_menu_id,
		'id'      => 'my-goals',
		'title'   => __( 'Goals', 'hamburger-cat' ),
		'href'    => trailingslashit( $item_link ),
		'meta'    => array( 'class' => 'menupop' )
	) );

}
add_action( 'bp_setup_admin_bar', 'your_bp_admin_bar_add', 300 );

function austeve_ld_lesson_complete($lesson_data) {
	error_log("Lesson is complete!");
	error_log(print_r($lesson_data, true));
	date_default_timezone_set('America/Halifax');

	$lessonAlreadyComplete = false;
	if( have_rows('lesson_completion_times', 'user_'.get_current_user_id()) ):
		while( have_rows('lesson_completion_times', 'user_'.get_current_user_id()) ) : the_row();
			if ($lesson_data['lesson']->ID == get_sub_field('lesson_id'))
			{
				$lessonAlreadyComplete = true;
			}
		endwhile;
	endif;

	if (!$lessonAlreadyComplete) {
		$lessonCompletionData = get_field('lesson_completion_times', 'user_'.get_current_user_id());
		$lessonCompletionData[] = array("lesson_id" => $lesson_data['lesson']->ID, "completion_datetime" => date("Y-m-d H:i:s"));
		update_field( 'lesson_completion_times', $lessonCompletionData, 'user_'.get_current_user_id() );
	}
}
add_action( 'learndash_lesson_completed',  'austeve_ld_lesson_complete', 10, 1 );

function austeve_get_xapi_content_in_post($post_id) {
	//error_log("austeve_get_xapi_content_in_post: ".$post_id);
	if(empty($post_id) || !is_numeric($post_id)) 
		return array();
	else
	{
		global $wpdb;
		$meta_post_ids 	= $wpdb->get_col($wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'show_xapi_content' AND post_id = '%d'", $post_id));
		$block_post_ids	= $wpdb->get_col($wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'show_xapi_content_blocks' AND post_id = '%d'", $post_id ));

		$post_ids = array_merge($block_post_ids,$meta_post_ids);
		
		if(empty($post_ids))
			return array();

		$posts = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE ID IN (".implode(",", $post_ids).") AND post_status IN ('publish', 'draft') ORDER BY post_title");

		return empty($posts)? array():$posts;
	}
}

add_action( 'user_register', 'austeve_user_register_display_name', 999, 1 );

function austeve_user_register_display_name ( $user_id ) {

    // get the user data
	$user_info = get_userdata( $user_id );

    // pick our default display name
	$display_publicly_as = $user_info->first_name. " ".$user_info->last_name;

    // update the display name
	wp_update_user( array ('ID' => $user_id, 'display_name' =>  $display_publicly_as));
}

function austeve_before_topic_steps($post_type, $course_id, $user_id){

	$step_complete = (boolean)learndash_user_progress_is_step_complete( $user_id, $course_id, get_the_ID() );

	$wrapper_classes = "ld-steps-wrapper";
	//echo "austeve_before_topic_steps ".get_the_ID();

	if ($step_complete) {
		$wrapper_classes .= " is-complete";
	}
	else {
		$wrapper_classes .= " is-incomplete";
	}

	echo '<div class="'.$wrapper_classes.'">';
}
add_action( 'learndash-topic-course-steps-before', 'austeve_before_topic_steps', 999, 3 );

function austeve_after_topic_steps($post_type, $course_id, $user_id){
	echo '</div> <!-- end .ld-steps-wrapper -->';
}
add_action( 'learndash-topic-course-steps-after', 'austeve_after_topic_steps', 999, 3 );

