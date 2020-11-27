
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="single-container">

		<?php the_post_thumbnail('featured-image'); ?>
		
		<h1 class="page-title"><?php the_title();?></h1>

		<?php the_content();?>
		
		<div class="grid-x grid-margin-x align-center buttons">
			<?php if (get_field('email')): 
				$hasEmail = true; ?>
				<div class="cell medium-6 medium-text-right">
					<a class="button" href="mailto:<?php the_field('email');?>"><?php echo the_field('contact_button_text');?></a>
				</div>
			<?php endif; ?>
			<div class="cell medium-auto medium-text-<?php echo $hasEmail ? 'left' : 'center'; ?>">
				<a class="button" href="/about?lang=<?php echo ICL_LANGUAGE_CODE;?>"><?php echo the_field('back_to_about_button_text', 'options');?></a>
			</div>
		</div>

		<div class="entry-footer">
			<?php hamburger_cat_entry_footer(); ?>
		</div><!-- .entry-footer -->

	</div>
</article><!-- #post-<?php the_ID(); ?> -->
