<?php /*Artist bandcamp embed */
?>
<div class="artist-additional-link">
	<a href="<?php the_sub_field('link_url'); ?>" target="_blank">
		<?php
		
		$image = get_sub_field('image');
		$size = 'full'; // (thumbnail, medium, large, full or custom size)

		if( $image ) :
			//echo wp_get_attachment_image( $image, $size );
			?>
			<div class="link-image"><img class="thumbnail" src="<?php echo $image['sizes']['medium'];?>" width="<?php echo $image['sizes']['medium-width'];?>" height="<?php echo $image['sizes']['medium-height'];?>"/></div>
			<?php
		endif;
		if (get_sub_field('text')) :
			?>
			<div class="link-text"><?php echo get_sub_field('text');?></div>
			<?php
		elseif ( !$image ):
			echo "Link";
		endif;
		
		?>
	</a>
</div>