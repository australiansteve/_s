<?php
$args = array(
	'post_type'              => array( 'austeve-campaigns' ),
	'post_status'            => array( 'publish' ),
	'posts_per_page'         => '-1',
	'meta_query'			=>  array(
		'relation' => 'AND',
		array(
			'key'         => 'status',
			'value'            => 'active',
			'compare'            => '=',
		)
	),
);
$postsquery = new WP_Query( $args );

if ( $postsquery->have_posts() ) :
	the_content();
	?>
	<form id="campaign-search-form" action="/wishlists" method="GET">
		<div class="select2-parent" data-parent-of="campaign_id">
			<select name="campaign_id" class="select2-single" id="campaign_id" onchange="submitSearch(this)">
				<option value="0"><?php _e('Select your school', 'hamburger-cat'); ?></option>
				<?php
				while ( $postsquery->have_posts() ) :
					$postsquery->the_post();
					?>

					<option value="<?php echo get_the_ID();?>" <?php echo get_the_ID() == $_GET['campaign_id'] ? "selected" : "";?>><?php the_title();?></option>

					<?php
				endwhile;
				?>
			</select>
		</div>
	</form>
	<script type="text/javascript">
		function submitSearch(select_field) {
			if (select_field.value > 0) {
				select_field.form.submit();
			}
			return;
		}
	</script>
	<?php
else :
	?>
	<div class="no-active-campaigns">
		<?php the_field('no_active_school_placeholder_text', 'option');?>
	</div>
	<?php
endif;

wp_reset_postdata();
?>
