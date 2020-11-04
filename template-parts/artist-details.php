<?php /*Artist details */
?>
<div class="artist-details">
	<h2><?php the_title();?></h2>
	<div class="description">
		<?php the_field('description'); ?>
	</div>
	<div class="additional-links">
		<?php
		// check if the repeater field has rows of data
		if( have_rows('additional_links') ):
		 	// loop through the rows of data
		 	echo "<div class='find-out-more'>Additional links:</div>";
		    while ( have_rows('additional_links') ) : the_row();
		        get_template_part( 'template-parts/artist', 'link' );
		    endwhile;
		else :
		    // no rows found
		endif;
		?>
	</div>
	<div class="photo-credit">
		<i><?php echo the_post_thumbnail_caption( ); ?></i>
	</div>
</div>