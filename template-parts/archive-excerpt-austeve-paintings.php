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

	$price = get_field('price'); 
	$is_available = has_term( 'available', 'painting-category' );
	if ($price && $is_available) {
		?>
		<div class="price"><span class="available"><?php _e('Available, ', 'hamburger-cat'); ?></span><?php echo $price;?></div>
		<?php
	}
	else {
		?>
		<div class="price"><span class="sold"><?php _e('Sold', 'hamburger-cat'); ?></span></div>
		<?php
	}

	?>
</div>