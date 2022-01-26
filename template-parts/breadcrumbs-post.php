
<div class="breadcrumbs">

	<div class="grid-x text-center">
		<div class="cell medium-6 xlarge-5 medium-text-left">
				<?php echo previous_post_link(); ?>
		</div>

		<div class="cell medium-6 xlarge-5 medium-text-right xlarge-order-3">
			<?php echo next_post_link(); ?>
		</div>

		<div class="cell xlarge-2 xlarge-order-2">
			<div class="back-to-category">
				<?php
				if (has_category('sessions')) :

					echo "<a href='".get_category_link(get_cat_ID('sessions'))."'>";
					echo get_field('back_to_sessions_text', 'option');
					echo "</a>";
				else :

					$post_type_string = get_post_type($post);
					echo "<a href='".get_post_type_archive_link($post_type_string)."'>";
					echo get_field('back_to_news_text', 'option');
					echo "</a>";
				endif;
				?>
			</div>
		</div>
</div>