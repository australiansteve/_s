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
		add_image_size( 'archive-image', 800, 500, true);
		add_image_size( 'header-logo', 600, 260, false);
		add_image_size( 'bio-pic-size', 250, 250, array( 'center', 'center' ) ); // Hard crop center
		add_image_size( 'feature-pic-size', 600, 350, array( 'center', 'center' ) ); // Hard crop center
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
 * Include custom Walker for top nav and offcanvas compatibility
 */
require_once (get_template_directory() . '/inc/custom-walker.php');

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

function austeve_clean_string($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $string)); // Removes special chars.
}

add_filter ( 'pre_get_posts', function($query) {
	if ( !is_admin() && $query->is_main_query() && is_post_type_archive('austeve-funds') || (wp_doing_ajax() && in_array($query->get('post_type'), array('austeve-funds')))) {

	    $query->set( 'meta_key', 'stripped_name' );
		$query->set( 'orderby', 'meta_value' );
		$query->set( 'order'	, 'ASC' );

		if(isset($_GET['fund-name']))
		{
			$query->set('s', $_GET['fund-name']);
			//error_log(print_r($query, true));
		}
		if(isset($_GET['fund-category']))
		{
			//error_log(print_r($query, true));
			$tax_query = array(
				'taxonomy' => 'austeve-funds-category',
				'field'    => 'slug',
				'terms' => explode(",", $_GET['fund-category']),
				'operator' => 'IN',
				'include_children' => true
			);

			$query->set( 'tax_query', array(
				'relation' => 'AND',
				$tax_query
			));

			//error_log(print_r($query, true));
		}
		//error_log(print_r($query, true));

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

function austeve_populate_fund_selector_values($field) {

	//Only get list of funds when admin page (ie. A fund) is being edited in the backend
	if (is_admin())
	{
		// reset choices
		$field['choices'] = array();

		// get the textarea value from options page without any formatting
		$url = get_field('canada_helps_webservice_url', 'option');

		//$args = array( 'timeout' => 120, 'httpversion' => '1.1' );
		$response = wp_remote_get( $url );
		//error_log("Canada Helps page response: ".print_r($response, true));

		$field['choices']["NO_FUND"] = "Select fund";

		if ( is_array( $response ) ) {
			$header = $response['headers']; // array of http header lines
			$body = $response['body']; // use the content

			$jsonResponse = json_decode($body);

			if ($jsonResponse->CharityFunds)
			{
				$funds = $jsonResponse->CharityFunds;

				if (count($funds) == 0)
				{
					$field['choices']["ERROR03"] = "ERROR03: No funds could be found in the response from CanadaHelps. Reload page to try again. Contact steve@weavercrawford.com if the problem persists";

				}

				foreach($funds as $fund)
				{
					//error_log("Fund: ".print_r($fund, true));
			 		$field['choices'][$fund->FundID] = $fund->FundDescription;
				}
			}
			else
			{
				$field['choices']["ERROR02"] = "ERROR02: Could not get Funds from CanadaHelps. Reload page to try again. Contact steve@weavercrawford.com if the problem persists";
			}
		}
		else
		{
			$field['choices']["ERROR01"] = "ERROR01: Could not retrieve response from CanadaHelps. Reload page to try again";
		}

		//error_log("Choices: ".print_r($field['choices'], true));
	}

	return $field;
}
add_filter('acf/load_field/name=canada_helps_fund_id', 'austeve_populate_fund_selector_values');
add_filter('acf/load_field/name=canada_helps_default_fund', 'austeve_populate_fund_selector_values');

function austeve_populate_color_selector_values($field) {

	//Only get list of funds when admin page is being edited in the backend
	if (is_admin())
	{
		// reset choices
		$field['choices'] = array(
			'#bc5298' => 'Pink',
			'#7fb955' => 'Green',
			'#e68f52' => 'Orange',
			'#e4e164' => 'Yellow',
			'#6abfdb' => 'Blue',
			'#6cc2dd' => 'Bright Blue',
		);
	}

	return $field;
}

add_filter('acf/load_field/name=color', 'austeve_populate_color_selector_values');
add_filter('acf/load_field/name=featured_post_background_color', 'austeve_populate_color_selector_values');
add_filter('acf/load_field/name=default_fund_background_color', 'austeve_populate_color_selector_values');
add_filter('acf/load_field/name=about_sub_page_link_color', 'austeve_populate_color_selector_values');
add_filter('acf/load_field/name=grant_highlight_color', 'austeve_populate_color_selector_values');

function austeve_get_stripped_fund_name($fundName)
{
	$strippedName = $fundName;
	error_log(strpos(strtolower($fundName), 'the '));
	if (strpos(strtolower($fundName), 'the ') === 0)
	{
		error_log("Fund name starts with 'the'");
		$strippedName = substr($fundName, 4);
	}
	error_log('Updating stripped_name attribute of fund: '.$strippedName);
	return $strippedName;
}

function austeve_set_post_stripped_name($post_id) {
	$post_type = get_post_type($post_id);
	if ($post_type != 'austeve-funds') {
		return;
	}
	$post = get_post($post_id);
	error_log('Fund has been saved: '.$post->post_title);
	$strippedName = austeve_get_stripped_fund_name($post->post_title);
	update_field('stripped_name', $strippedName, $post_id);
}

add_action('acf/save_post', 'austeve_set_post_stripped_name', 20 );


function austeve_posts_link_attributes() {
    return 'class="button"';
}
add_filter('next_posts_link_attributes', 'austeve_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'austeve_posts_link_attributes');

function austeve_get_funds() {

	$nonce = $_REQUEST['security'];
	if (wp_verify_nonce( $nonce, 'archive-page-posts')) {
		$page = intval($_REQUEST['page']);
		$category = isset($_REQUEST['category']) ? $_REQUEST['category'] : null;
		$search = isset($_REQUEST['s']) ? $_REQUEST['s']: null;

		$args = array(
			'post_type' => array('austeve-funds'),
			'post_status' => array('publish'),
			'nopaging' => false,
			'paged' => $page,
			'order' => 'ASC',
			'orderby' => 'meta_value',
			'meta_key' => 'stripped_name'
		);

		if ($category) {
			$args['tax_query'] = array(
				array(
					'taxonomy'         => 'austeve-funds-category',
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

		global $categoryBgColors; 
		$savedBgColors = get_field('fund_category_background_colors', 'options');
		foreach($savedBgColors as $color)
		{
			$categoryBgColors[$color['category']] = $color['color'];
		}

			while ( $ajaxposts->have_posts() ) {
				$ajaxposts->the_post();

				include( locate_template('template-parts/austeve-funds-archive.php', false, false ));
			}
		}

		wp_reset_query();
	}

	exit;
}

add_action('wp_ajax_austeve_get_funds', 'austeve_get_funds');
add_action('wp_ajax_nopriv_austeve_get_funds', 'austeve_get_funds');
