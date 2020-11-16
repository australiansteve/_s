
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="single-container text-left">

		<?php the_post_thumbnail('featured-image'); ?>
		
		<h1 class="page-title"><?php the_title();?></h1>
		
		<?php echo do_shortcode("[add_to_cart id='".get_field('product')."' show_price='false' style='']"); ?>

		<?php the_content();?>
		
		<div class="grid-x grid-margin-x">
			<div class="cell medium-6 text-center medium-text-right">
				<?php echo do_shortcode("[add_to_cart id='".get_field('product')."' show_price='false' style='']"); ?>
			</div>
			<div class="cell medium-6 text-center medium-text-left">
				<a href="/our-training" class="button"><?php echo "Courses";?></a>
			</div>
		</div>

		<div class="entry-footer">
			<?php hamburger_cat_entry_footer(); ?>
		</div><!-- .entry-footer -->

	</div>
</article><!-- #post-<?php the_ID(); ?> -->
