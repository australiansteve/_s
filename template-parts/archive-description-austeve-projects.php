
<?php if (is_tax('project-category')) {
	$term = get_queried_object();
	$fontSize = get_field('archive_description_font_size', $term);

	the_archive_description( '<div class="archive-description" style="font-size: '.$fontSize.'px">', '</div>' );
}
else { 
	/* Top level archive page - read from settings rather than from CPT definition */
	?>
	<div class="archive-description">
		<?php the_field('projects_page_content', 'options'); ?>
	</div>
	<?php
}
?>
