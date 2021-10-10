<div id="teacher-search">
	<form id="teacher-search-form" action="/teachers" method="GET">
		<input name="tname" type="text" placeholder="<?php _e('Teacher\'s Name', 'hamburger-cat');?>" value="<?php echo $_GET['tname'];?>"/>

		<span class="or-divider"> - <?php _e('or', 'hamburger-cat');?> - </span>

		<div class="select2-parent" data-parent-of="tschool">
			<select class="select2-single" name="tschool" id="tschool">
				<option value="0"><?php _e('Select school', 'hamburger-cat');?></option>
				<option value="0"><?php _e('=====================', 'hamburger-cat');?></option>
				<?php
				$args = array(
					'post_type'              => array( 'austeve-schools' ),
					'post_status'            => array( 'publish' ),
					'posts_per_page'         => '-1',
				);

				$postsquery = new WP_Query( $args );

				if ( $postsquery->have_posts() ) {
					while ( $postsquery->have_posts() ) {
						$postsquery->the_post();
						$selectedStatus = get_the_ID() == $_GET['tschool'] ? "selected" : "";
						echo "<option value='".get_the_ID()."' ".$selectedStatus.">".get_the_title()."</option>";
					}
				}

				wp_reset_postdata();
				?>
			</select>
		</div>

		<div class="select2-parent" data-parent-of="tgrade">
			<select name="tgrade" class="select2-single" id="tgrade">
				<option value="0"><?php _e('Select grade', 'hamburger-cat');?></option>
				<option value="0"><?php _e('=====================', 'hamburger-cat');?></option>
				<option value="00-kindergarten" <?php echo '00-kindergarten' == $_GET['tgrade'] ? "selected" : "";?>><?php _e('Kindergarten', 'hamburger-cat');?></option>
				<option value="01-one" <?php echo '01-one' == $_GET['tgrade'] ? "selected" : "";?>><?php _e('Grade 1', 'hamburger-cat');?></option>
				<option value="02-two" <?php echo '02-two' == $_GET['tgrade'] ? "selected" : "";?>><?php _e('Grade 2', 'hamburger-cat');?></option>
				<option value="03-three" <?php echo '03-three' == $_GET['tgrade'] ? "selected" : "";?>><?php _e('Grade 3', 'hamburger-cat');?></option>
				<option value="04-four" <?php echo '04-four' == $_GET['tgrade'] ? "selected" : "";?>><?php _e('Grade 4', 'hamburger-cat');?></option>
				<option value="05-five" <?php echo '05-five' == $_GET['tgrade'] ? "selected" : "";?>><?php _e('Grade 5', 'hamburger-cat');?></option>
				<option value="06-six" <?php echo '06-six' == $_GET['tgrade'] ? "selected" : "";?>><?php _e('Grade 6', 'hamburger-cat');?></option>
			</select>
		</div>

		<input type="submit" class="button" value="<?php _e('Search', 'hamburger-cat');?>"/>
		
	</form>
</div>