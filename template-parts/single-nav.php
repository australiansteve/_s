<div class="grid-x navigation">
	<div class="cell small-6 text-right medium-5 medium-order-1">
		<?php echo get_previous_post_link(
			'%link',
			'<i class="fas fa-2x fa-chevron-left"></i> <span class="nav-title screen-reader-text">%title</span>'
		); ?>
	</div>
	<div class="cell small-6 text-left medium-5 medium-order-3">
		<?php echo get_next_post_link(
			'%link',
			'<i class="fas fa-2x fa-chevron-right"></i> <span class="nav-title screen-reader-text">%title</span>'
		); ?>
	</div>
	<?php
	$returnTo = isset($_GET["returnto"]) ? "#".$_GET["returnto"] : "";
	?>
	<div class="cell text-center medium-2 medium-order-2">
		<a class="button" href="<?php echo get_post_type_archive_link(get_post_type()); echo $returnTo;?>"><?php echo get_post_type_object(get_post_type())->labels->all_items;?></a>
	</div>
</div>