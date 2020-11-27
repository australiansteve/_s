<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Hamburger_Cat
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function hamburger_cat_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'hamburger_cat_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function hamburger_cat_woocommerce_scripts() {
	wp_enqueue_style( 'hamburger-cat-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), HAMBURGER_CAT_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
		font-family: "star";
		src: url("' . $font_path . 'star.eot");
		src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
		url("' . $font_path . 'star.woff") format("woff"),
		url("' . $font_path . 'star.ttf") format("truetype"),
		url("' . $font_path . 'star.svg#star") format("svg");
		font-weight: normal;
		font-style: normal;
	}';

	wp_add_inline_style( 'hamburger-cat-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'hamburger_cat_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function hamburger_cat_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'hamburger_cat_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function hamburger_cat_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'hamburger_cat_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'hamburger_cat_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function hamburger_cat_woocommerce_wrapper_before() {
		?>
		<main id="primary" class="site-main">
			<?php
			$sectionId = 'other_landing';
			$section = get_field($sectionId, 'options');
			if ($section) {
				include( locate_template( 'template-parts/section-header.php', false, false ) ); 
				echo "<div class='page-content'>";
			}
		}
	}
	add_action( 'woocommerce_before_main_content', 'hamburger_cat_woocommerce_wrapper_before' );

	if ( ! function_exists( 'hamburger_cat_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function hamburger_cat_woocommerce_wrapper_after() {
		$sectionId = 'other_landing';
		$section = get_field($sectionId, 'options');
		if ($section) {
			echo "</div>";
			include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
		}
		?>

	</main><!-- #main -->
	<?php
}
}
add_action( 'woocommerce_after_main_content', 'hamburger_cat_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'hamburger_cat_woocommerce_header_cart' ) ) {
			hamburger_cat_woocommerce_header_cart();
		}
	?>
 */

	if ( ! function_exists( 'hamburger_cat_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function hamburger_cat_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		hamburger_cat_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'hamburger_cat_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'hamburger_cat_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function hamburger_cat_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'hamburger-cat' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'hamburger-cat' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'hamburger_cat_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function hamburger_cat_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php hamburger_cat_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}

// To change add to cart text on single product page
add_filter( 'woocommerce_product_add_to_cart_text', 'hamburger_cat_woocommerce_custom_single_add_to_cart_text' ); 
function hamburger_cat_woocommerce_custom_single_add_to_cart_text() {

	if (get_post_type() == 'austeve-courses'):
		return __( get_field('course_add_to_cart_text', 'options'), 'woocommerce' );
	endif; 
}

// define the woocommerce_cart_item_permalink callback 
function hamburger_cat_filter_woocommerce_item_permalink( $product_get_permalink_item, $item, $item_key ) { 
	$posts = get_posts(array(
		'numberposts'	=> -1,
		'post_type'		=> 'austeve-courses',
		'meta_key'		=> 'product',
		'meta_value'	=> $item['product_id']
	));
	if ($posts) {
		return get_permalink($posts[0]->ID);
	}


	return $product_get_permalink_item; 
}; 

// add the filter 
add_filter( 'woocommerce_cart_item_permalink', 'hamburger_cat_filter_woocommerce_item_permalink', 10, 3 ); 
add_filter( 'woocommerce_order_item_permalink', 'hamburger_cat_filter_woocommerce_item_permalink', 10, 3 ); 

function hamburger_cat_custom_redirects() {

	if ( is_singular('product') ) {
		$posts = get_posts(array(
			'numberposts'	=> -1,
			'post_type'		=> 'austeve-courses',
			'meta_key'		=> 'product',
			'meta_value'	=> get_the_ID()
		));

		if ($posts) {
			error_log(print_r($posts[0], true));
			error_log("Redirecting to ".get_permalink($posts[0]->ID));
			wp_redirect( get_permalink($posts[0]->ID) );
			die;
		}


	}

	if ( is_shop() ) {
			error_log("Redirecting to ".site_url('our-training?lang='.ICL_LANGUAGE_CODE));
			wp_redirect( site_url('our-training?lang='.ICL_LANGUAGE_CODE) );
			die;


	}

}
add_action( 'template_redirect', 'hamburger_cat_custom_redirects' );
