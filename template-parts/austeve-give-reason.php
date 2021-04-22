<?php
?>
<div class="cell reason-image <?php echo ($reasonNum == 0) ? 'active' : ''?>">

<?php
	$image = get_sub_field('reason_image');

	if( !empty($image) ): 
		// vars
		$alt = $image['alt'];

		// thumbnail
		$size = 'thumbnail';
		$thumb = $image['sizes'][ $size ];
		$width = $image['sizes'][ $size . '-width' ];
		$height = $image['sizes'][ $size . '-height' ];
?>
	<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" title="<?php the_sub_field('reason_name'); ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" data-id="<?php echo $reasonNum;?>"/>
	<div class="reason-name"><?php the_sub_field('reason_name'); ?></div>
	<div class="active-arrow"></div>

	<div class="hidden reason-bio" style="display:none" data-id="<?php echo $reasonNum;?>"><?php the_sub_field('reason_bio'); ?></div>
	 								
<?php
	endif;
?>
</div>