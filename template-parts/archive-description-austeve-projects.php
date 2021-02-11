
<?php if (is_tax('project-category')) {
	the_archive_description( '<div class="archive-description">', '</div>' );
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
