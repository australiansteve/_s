<form id="school-search-form" action="/teachers" method="GET">
	<div class="select2-parent" data-parent-of="school">
		<select name="school" class="select2-single" id="school" onchange="this.form.submit()">
			<?php

			$args = array(
				'post_type'              => array( 'austeve-schools' ),
				'post_status'            => array( 'publish' ),
				'posts_per_page'         => '-1',
			);
			$postsquery = new WP_Query( $args );

			if ( $postsquery->have_posts() ) :
				?>
				<option value="0"><?php _e('Select your school', 'hamburger-cat'); ?></option>
				<?php
				while ( $postsquery->have_posts() ) :
					$postsquery->the_post();
					?>

					<option value="<?php echo get_the_ID();?>" <?php echo get_the_ID() == $_GET['school'] ? "selected" : "";?>><?php the_title();?></option>

					<?php
				endwhile;
			else :?>

				<option><?php _e('No schools found', 'hamburger-cat'); ?></option>
				<?php
			endif;

			wp_reset_postdata();
			?>
		</select>
	</div>
</form>