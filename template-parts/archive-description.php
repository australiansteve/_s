<?php
$description = is_category() ? get_field('archive_description_category_'.strtolower(single_term_title('', false)), 'option') : get_field('archive_description_'.get_post_type(), 'option');

if ($description):
?>
	<div class="archive-description">
		<?php echo $description; ?>
	</div>
<?php
endif;
?>