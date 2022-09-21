<?php
global $post;
$thumbnail = has_post_thumbnail() ? get_the_post_thumbnail_url($post, 'full') : wp_get_attachment_image_src( get_field('default_placeholder_image', 'options'), 'archive-image')[0]; 
global $product;
$author = $product->get_attribute( 'author' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="grid-x grid-margin-x">
		<div class="cell medium-4 text-right">
			<a href="<?php echo get_the_permalink();?>" title="<?php echo get_the_title();?>">
				<div class="thumbnail-container">
					<img src='<?php echo $thumbnail; ?>' />
					<?php
					if ( has_term( 'inky-suggests', 'product_cat' )) {
						echo '<span class="inky-suggests"><img src="'.get_stylesheet_directory_uri().'/media/inky-umbrella-suggests.png" alt="inky umbrella suggests" title="inky umbrella suggests" width="" height="" /></span>';
					}
					?>
				</div>
			</a>
		</div>
		<div class="cell medium-8">
			<a href="<?php echo get_the_permalink();?>" title="<?php echo get_the_title();?>">
				<h3 class="page-title"><?php the_title();?></h3>

				<div class="product-author"><?php echo sprintf(__('Author: %s', 'hamburger-cat'), $author); ?></div>

				<div class="product-short-description">
					<div class="fade-bg"></div>
					<span><?php the_excerpt(); ?></span>
				</div>
			</a>

			<div>
				<?php
				get_template_part('template-parts/add-to-cart', get_post_type(), $args);
				?>
			</div>
		</div>
	</div>
		
</article><!-- #post-<?php the_ID(); ?> -->
