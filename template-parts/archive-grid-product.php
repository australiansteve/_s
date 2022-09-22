<?php
$thumbnail = has_post_thumbnail() ? get_the_post_thumbnail_url($post, 'full') : wp_get_attachment_image_src( get_field('default_placeholder_image', 'options'), 'archive-image')[0]; 

global $product;
$author = $product->get_attribute( 'author' );
$price = $product->get_attribute( 'author' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="grid-x grid-margin-x">
		<div class="cell">
			<div class="thumbnail-container">
				<img src='<?php echo $thumbnail; ?>'/>
				<?php
				if ( has_term( 'inky-suggests', 'product_cat' )) {
					echo '<span class="inky-suggests"><img src="'.get_stylesheet_directory_uri().'/media/inky-umbrella-suggests.png" alt="inky umbrella suggests" title="inky umbrella suggests" width="" height="" /></span>';
				}
				?>
				<div class="quick-view-overlay text-center align-center" onclick="return quick_view_product(jQuery(this), <?php echo get_the_ID();?>);"  title="<?php _e('Quick View'); ?>" data-open="quickViewModal">
					<div class="text-container">
						Quick view
					</div>
				</div>
			</div>
		</div>
		<div class="cell">
			<h3 class="product-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>

			<div class="product-author"><?php echo sprintf(__('Author: %s', 'hamburger-cat'), $author); ?></div>

			<div class="product-price <?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><?php echo $product->get_price_html(); ?></div>

			<div class="grid-x grid padding-x">
				<div class="cell">
					<?php
					get_template_part('template-parts/add-to-cart', get_post_type(), $args);
					?>
				</div>
			</div>
		</div>
	</div>
		
</article><!-- #post-<?php the_ID(); ?> -->
