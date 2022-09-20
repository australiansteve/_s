<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>

<nav class="woocommerce-MyAccount-navigation">
    <div class="show-for-small-only text-center" id="small-menu-parent">
        <ul class="vertical menu accordion-menu show-for-small-only" id="wc-nav-menu-accoridan-small" data-accordion-menu>
            <li>
                <a href="#" class="menu-header"><span><?php _e('My Account Menu', 'hamburger-cat');?></span> <i class="fas fa-caret-down"></i></a>
                <ul class="menu vertical nested">
            		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
            			<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
            				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
            			</li>
            		<?php endforeach; ?>
                </ul>
            </li>
    	</ul>
    </div>
    <ul class="vertical menu accordion-menu show-for-medium" id="wc-nav-menu-accoridan">
        <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
            <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
                <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
