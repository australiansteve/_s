<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

$categories = get_the_terms($post->ID, 'wishlist-category');
$category_name = is_array($categories) && count($categories) > 0 ? $categories[0]->name : "";
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php
	if( have_rows('wishlist_items') ):
		global $post;
		?>
		<div class="grid-x align-center small-up-2 medium-up-3 xlarge-up-4">
			<?php
			while( have_rows('wishlist_items') ) : the_row();
				$product_id = get_sub_field('product');
				?>
				<div class="cell" data-product-id="<?php echo $product_id;?>">
					<?php 
					$post = get_post($product_id);
    				setup_postdata($post);
					get_template_part('template-parts/archive');
  					wp_reset_postdata();

					?>
				</div>
				<?php

			endwhile;
			?>
		</div>
		<?php
	else :
		_e('Wishlist contains no products', 'hamburger-cat');
	endif;
	?>
	<footer class="entry-footer">
		<?php hamburger_cat_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	
</article><!-- #post-<?php the_ID(); ?> -->
