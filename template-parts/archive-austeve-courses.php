<div class="cell">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="post-image">
			<?php the_post_thumbnail('archive-square');?>
			<div class="icons">
				<?php 
				$images = get_field('icons');
				$size = 'full';
				if( $images ): ?>
					<?php foreach( $images as $image_id ): ?>
						<?php echo wp_get_attachment_image( $image_id, $size ); ?>
					<?php endforeach; ?>
					<?php 
				endif;
				?>
			</div>
		</div>
		<div class="post-title" data-equalizer-watch><?php the_title();?></div>
		<div class="post-more-information">
			<a class="button" href="<?php the_permalink();?>"><?php the_field('more_information_button', 'options');?></a>
		</div>
	</article>
</div>