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
	
	<a class="button" href="<?php the_field('wishlist_url');?>" target="_blank"><?php echo sprintf(__('View %s Wishlist', 'hamburger-cat'), $category_name); ?></a>

	<footer class="entry-footer">
		<?php hamburger_cat_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	
</article><!-- #post-<?php the_ID(); ?> -->
