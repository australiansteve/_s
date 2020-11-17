<?php

$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);
$searchTerm = array_key_exists('s', $queries) ? $queries['s'] : "";

?>
<div class="grid-x">
	<div class="cell text-center" id="search">
			<h4><?php echo get_field('sidebar_search_title', 'options');?></h4>
			<form action="">
				<input type="text" name="s" value="<?php echo $searchTerm;?>" class="" />
				<input type="submit" class="button " value="<?php echo get_field('sidebar_search_button_text', 'options');?>" />
			</form>
	</div>
	<div class="cell text-center" id="subscribe">
			<h4><?php echo get_field('sidebar_subscribe_title', 'options');?></h4>
			<?php echo do_shortcode("[ninja_form id='".get_field('sidebar_ninja_form_id', 'options')."']");?>
	</div>
</div>