
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="single-container">

		<?php the_post_thumbnail('featured-image'); ?>
		
		<h1 class="page-title"><?php the_title();?></h1>
		<?php the_content();?>
		
		<div class="entry-footer">
			<?php hamburger_cat_entry_footer(); ?>
		</div><!-- .entry-footer -->

	</div>
</article><!-- #post-<?php the_ID(); ?> -->
