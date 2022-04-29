<?php

?>
<div class="austeve-paintings-meta">
	<?php 
	$year = get_field('year'); 
	if ($year) {
		?>
		<div class="year"><?php echo $year;?></div>
		<?php
	}

	$style = get_field('style'); 
	if ($style) {
		?>
		<div class="style"><?php echo $style;?></div>
		<?php
	}

	$size = get_field('size'); 
	if ($size) {
		?>
		<div class="size"><?php echo $size;?></div>
		<?php
	}

	$is_available = has_term( 'available', 'painting-category' );
	$price = $is_available ? get_field('price') : '';

	$status = get_field('current_status');
	$status = $status ? $status : __('Available', 'hamburger-cat');
	$status .= $price ? ', ' : '';
	?>
	<div class="price"><span class="status"><?php echo $status; ?></span><?php echo $price;?></div>
	
</div>