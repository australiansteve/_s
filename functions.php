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
		add_image_size( 'header-logo', 240, 200, false);
		add_image_size( 'footer-logo', 240, 200, false);
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

	wp_enqueue_style( 'select2-style', get_template_directory_uri(). '/dist/select2/css/select2.min.css', array( ) );
	wp_enqueue_script( 'select2-js', get_template_directory_uri(). '/dist/select2/js/select2.min.js', array( 'jquery' ) );

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

function austeve_add_additional_class_on_li($classes, $item, $args) {
	if(isset($args->add_li_class)) {
		$classes[] = $args->add_li_class;
	}
	return $classes;
}
add_filter('nav_menu_css_class', 'austeve_add_additional_class_on_li', 1, 3);

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

function austeve_add_query_vars_filter( $vars ){
	$vars[] = "school";
	$vars[] = "grade";
	return $vars;
}
add_filter( 'query_vars', 'austeve_add_query_vars_filter' );

function austeve_filter_teachers($query) {

	if ( ! is_admin() && $query->is_main_query() && is_post_type_archive('austeve-teachers')) {

		$school = intval(get_query_var('school'), 10);
		
		if ($school > 0):
			error_log("filter by school");
			
			$school_query = array(
				'key'     => 'school',
				'value'   => $school,
				'compare' => 'IN',
			);    
			
			$meta_query = array( 'relation' => 'AND' , 
				$school_query
			);

			error_log("meta_query: ".print_r($meta_query, true));
			$query->set('meta_query',$meta_query);
		endif;

		//always order by grade
		$query->set('meta_key', 'grade');
		$query->set('orderby', 'meta_value_num grade');
		$query->set('order', 'ASC');
		$query->set('posts_per_page', '50');
	}

	return $query;
}
add_action('pre_get_posts', 'austeve_filter_teachers' );


function austeve_acf_load_school_grades( $field ) {

	if (is_admin() && !is_ajax()) {
		global $post;

		$teacher_school = get_field('school', $post->ID);
		$school_grades = get_field('grades', $teacher_school);

		if( is_array($school_grades) ) {
			foreach($school_grades as $grade) {
				$field['choices'][] = $grade['grade'];
			}
		}
		error_log("field ".print_r($field, true));
	}

    // return the field
	return $field;

}

add_filter('acf/load_field/key=field_61438a249523b', 'austeve_acf_load_school_grades');

add_action( 'wp_ajax_austeve_setup_donation', 'austeve_setup_donation' );
add_action( 'wp_ajax_nopriv_austeve_setup_donation', 'austeve_setup_donation' );

function austeve_setup_donation() {

	$nonce = $_REQUEST['security'];

	$teacher_id  = isset($_REQUEST['teacher_id']) ? intval( $_REQUEST['teacher_id'] ) : null;
	$school_id  = isset($_REQUEST['school_id']) ? intval( $_REQUEST['school_id'] ) : null;


	if (wp_verify_nonce( $nonce, "setup-donation" )) {

		if($school_id) {
			error_log("school_id:".$school_id);
			$product_id = get_field('school_gift_card_product', 'options');
			$product = wc_get_product($product_id);
			$variations = $product->get_available_variations();
			?>

			<div><label label-for="school"><?php _e('Gift card for school:', 'hamburger-cat');?></label><?php echo get_the_title($school_id);?></div>
			<div class="donation-form">
				<input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
				<label label-for="variation_id"><?php _e('Value:', 'hamburger-cat'); ?></label>
				<div class="select2-parent" data-parent-of="variation_id">
					<select name="variation_id" class="select2-single" id="variation_id">
						<?php
						foreach($variations as $variation) {
							echo "<option value='".$variation['variation_id']."'>".$variation['attributes']['attribute_value']."</option>";
						}
						?>
					</select>
				</div>
				<input type="hidden" name="school_id" value="<?php echo $school_id;?>" />
				<button class="button add-donation-to-cart" onclick="add_donation_to_cart(event)">Add to cart</button>
			</div>
			<?php	
		}
		if($teacher_id) {
			error_log("teacher_id:".$teacher_id);
			$product_id = get_field('generic_gift_card_product', 'options');
			$product = wc_get_product($product_id);
			$variations = $product->get_available_variations();
			?>

			<div><label label-for="teacher"><?php _e('Gift card for:', 'hamburger-cat');?></label><?php echo get_the_title($teacher_id);?> - <?php echo get_field('grades', get_field('school', $teacher_id))[get_field('grade', $teacher_id)]['grade'];?></div>
			<div class="donation-form">
				<input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
				<label label-for="teacher"><?php _e('Value:', 'hamburger-cat'); ?></label>
				<div class="select2-parent" data-parent-of="variation_id">
					<select name="variation_id" class="select2-single" id="variation_id">
						<?php
						foreach($variations as $variation) {
							echo "<option value='".$variation['variation_id']."'>".$variation['attributes']['attribute_value']."</option>";
						}
						?>
					</select>
				</div>
				<input type="hidden" name="teacher_id" value="<?php echo $teacher_id;?>" />
				<button class="button add-donation-to-cart" onclick="add_donation_to_cart(event)">Add to cart</button>
			</div>
			<?php

		}
	}

	die();				
}

add_action( 'wp_ajax_austeve_add_to_cart', 'austeve_wc_ajax_add_to_cart' );
add_action( 'wp_ajax_nopriv_austeve_add_to_cart', 'austeve_wc_ajax_add_to_cart' );

function austeve_wc_ajax_add_to_cart() {
	$product_id  = intval( $_REQUEST['product_id'] );
	$variation_id  = intval( $_REQUEST['variation_id'] );
	$teacher_id  = isset($_REQUEST['teacher_id']) ? intval( $_REQUEST['teacher_id'] ) : null;
	$school_id  = isset($_REQUEST['school_id']) ? intval( $_REQUEST['school_id'] ) : null;
	$wishlist_id  = isset($_REQUEST['wishlist_id']) ? intval( $_REQUEST['wishlist_id'] ) : null;
	$quantity = isset($_REQUEST['quantity']) ? intval( $_REQUEST['quantity'] ) : 1;

	$nonce = $_REQUEST['security'];
	$user_id = get_current_user_id();

	if (wp_verify_nonce( $nonce, "add-to-cart" )) {

		$custom_data = array();

		if ($wishlist_id) {
			error_log("add for wishlist: ".$wishlist_id);
			$teacher_id = get_field('teacher', $wishlist_id);
			$custom_data['wishlist_id'] = $wishlist_id;
		}

		error_log("austeve_wc_ajax_add_to_cart is ok to go: ". $product_id.", ".$variation_id.", ".$teacher_id. "(wishlist: ".$wishlist_id.")");
		$sgrades = get_field('grades', get_field('school', $teacher_id));

		if ($teacher_id) {
			$custom_data['teacher_id'] = $teacher_id;
			$custom_data['teacher_grade'] = $sgrades[get_field('grade', $teacher_id)]['grade'];
			$custom_data['teacher_school'] = get_the_title(get_field('school', $teacher_id));
		}
		if ($school_id) {
			$custom_data['school_id'] = $school_id;
		}
		error_log("Adding custom data to cart item: ".print_r($custom_data, true));
		WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, array(), $custom_data );

		echo WC()->cart->cart_contents_count;
	}
	
	die();
}

// Display custom cart item meta data (in cart and checkout)
add_filter( 'woocommerce_get_item_data', 'display_cart_item_custom_meta_data', 10, 2 );
function display_cart_item_custom_meta_data( $item_data, $cart_item ) {
	$meta_key = 'teacher_id';
	if ( isset($cart_item[$meta_key]) ) {
		$item_data[] = array(
			'key'       => "For Teacher",
			'value'     => get_the_title($cart_item[$meta_key]),
		);
	}
	$meta_key = 'teacher_grade';
	if ( isset($cart_item[$meta_key]) ) {
		$item_data[] = array(
			'key'       => "\nGrade",
			'value'     => $cart_item[$meta_key],
		);
	}
	$meta_key = 'school_id';
	if ( isset($cart_item[$meta_key]) ) {
		$item_data[] = array(
			'key'       => "For School",
			'value'     => get_the_title($cart_item[$meta_key]),
		);
	}
	return $item_data;
}

// Save cart item custom meta as order item meta data and display it everywhere on orders and email notifications.
add_action( 'woocommerce_checkout_create_order_line_item', 'save_cart_item_custom_meta_as_order_item_meta', 10, 4 );
function save_cart_item_custom_meta_as_order_item_meta( $item, $cart_item_key, $values, $order ) {
	$meta_key = 'teacher_id';
    //error_log("woocommerce_checkout_create_order_line_item: ".print_r($values, true));
	if ( isset($values[$meta_key]) ) {
		$item->update_meta_data( "For Teacher", get_the_title($values[$meta_key]));
		$item->update_meta_data( "Grade", get_field('grade', $values[$meta_key]));
		$item->update_meta_data( "School", get_the_title(get_field('school', $values[$meta_key])));
	}
	$meta_key = 'teacher_grade';
	if ( isset($values[$meta_key]) ) {
		$item->update_meta_data( "Grade", $values[$meta_key]);
	}
	$meta_key = 'teacher_school';
	if ( isset($values[$meta_key]) ) {
		$item->update_meta_data( "School", $values[$meta_key]);
	}
	$meta_key = 'school_id';
	if ( isset($values[$meta_key]) ) {
		$item->update_meta_data( "For School", get_the_title($values[$meta_key]));
	}
	$meta_key = 'wishlist_id';
	if ( isset($values[$meta_key]) ) {
		$item->update_meta_data( "wishlist_id", $values[$meta_key]);
	}
}

add_action( 'wp_ajax_austeve_get_cart_count', 'austeve_get_cart_count' );
add_action( 'wp_ajax_nopriv_austeve_get_cart_count', 'austeve_get_cart_count' );

function austeve_get_cart_count() {

	$nonce = $_REQUEST['security'];

	if (wp_verify_nonce( $nonce, "get-cart-count" )) {

		echo WC()->cart->cart_contents_count;
	}
	
	die();
}

add_action('woocommerce_thankyou', 'austeve_order_placed', 10, 1);
function austeve_order_placed( $order_id ) {
	if ( ! $order_id )
		return;

    // Allow code execution only once 
	if( ! get_post_meta( $order_id, '_thankyou_action_done', true ) ) {

        // Get an instance of the WC_Order object
		$order = wc_get_order( $order_id );

        // Loop through order items
		foreach ( $order->get_items() as $item_id => $item ) {

			$item_meta_data = $item->get_formatted_meta_data();
			$product_id = $item->get_product_id();
			$quantity = $item->get_quantity();

        	//if a wishlist_id is set on the cart item, reduce the wishlists item count by the quantity
			foreach ($item_meta_data as $meta_data) {
				if ($meta_data->key == 'wishlist_id') {
					$wishlist_id = $meta_data->value;
					$wishlist_items = get_field('wishlist_items', $wishlist_id);

					foreach($wishlist_items as $key=>$wishlist_item) {
						if ($wishlist_item['product'] == $product_id) {
							error_log("ORDER placed: Updating product_id ".$product_id." 'has' quantity by +".$quantity." for wishlist_id ".$wishlist_id." (Order: ".$order_id.")");

							$wishlist_items[$key]['has'] += $quantity;
						}
					}
					update_field('wishlist_items', $wishlist_items, $wishlist_id);
					break;
				}
			}
		}

        // Flag the action as done (to avoid repetitions on reload for example)
		$order->update_meta_data( '_thankyou_action_done', true );
		$order->save();
	}
}

add_filter('woocommerce_order_status_changed','austeve_reset_item_qty', 10, 4);

function austeve_reset_item_qty( $order_id, $old_status, $new_status, $order ) {
	if ( $new_status === 'cancelled' || $new_status === 'refunded') {
		// Loop through order items
		foreach ( $order->get_items() as $item_id => $item ) {

			$item_meta_data = $item->get_formatted_meta_data();
			$product_id = $item->get_product_id();
			$quantity = $item->get_quantity();

	    	//if a wishlist_id is set on the cart item, add back to the wishlists item count by the quantity
			foreach ($item_meta_data as $meta_data) {
				if ($meta_data->key == 'wishlist_id') {
					$wishlist_id = $meta_data->value;
					$wishlist_items = get_field('wishlist_items', $wishlist_id);

					foreach($wishlist_items as $key=>$wishlist_item) {
						if ($wishlist_item['product'] == $product_id) {
							error_log("ORDER ".$new_status.": Updating product_id ".$product_id." 'has' quantity by -".$quantity." for wishlist_id ".$wishlist_id." (Order: ".$order_id.")");

							$wishlist_items[$key]['has'] -= $quantity;
						}
					}
					update_field('wishlist_items', $wishlist_items, $wishlist_id);
					break;
				}
			}
		}
	} 
}