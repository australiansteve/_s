<div class="sjle-program" style="background-color: <?php the_field('highlight_color'); ?>">
	<div data-equalizer-watch="title-match" class="title-container">
		<div class="name">
			<?php the_title('<h3>', '</h3>'); ?>
		</div>
		<div class="secondary-title">
			<h4><?php the_field('secondary_title'); ?></h4>
		</div>
	</div>
	<div class="whos-it-for" data-equalizer-watch="wif-match">
		<?php the_field('whos_it_for'); ?>
	</div>
</div>

<div class="learn-more">
	<a href="<?php the_permalink();?>" class="button"><?php the_field('learn_more_button_text', 'options');?></a>
</div>