<div class="cell text-center">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="post-image"><?php the_post_thumbnail('archive-square');?></div>
		<div class="post-title" data-equalizer-watch><?php the_title();?></div>
		<?php if (get_field('position')): 
			$position = get_field('position'); 
			?>
			<div class="team-member-position">
				<?php echo $position;?>
			</div>
		<?php endif; ?>
		<?php if (get_field('email')): 
			$email = get_field('email'); 
			?>
			<div class="team-member-email">
				<a href="mailto:<?php echo $email;?>"><?php echo $email;?></a>
			</div>
		<?php endif; ?>		
		<div class="post-more-information"><a class="button" href="<?php the_permalink();?>"><?php the_field('more_information_button', 'options');?></a></div>
	</article><!-- #post-<?php the_ID(); ?> -->
</div>