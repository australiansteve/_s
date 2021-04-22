<?php
$thePostId = $post->post_parent != 0 ? $post->post_parent : $post->post_id;
error_log("Give page post to be used: ".$thePostId);
?>
			<div class="cell small-12" id="featured-funds">
				<h2>Featured Funds</h2>

				<?php get_template_part( 'template-parts/austeve-funds', 'featured-snippet' ); ?>

			</div>

			<div class="cell small-12" id="otherwise">
				<?php the_field('otherwise_text', $thePostId); ?>
			</div>

<?php

// check if the repeater field has rows of data
$rows = get_field('sub_page_links', $thePostId);
if($rows):
?>
			<div class="cell" id="sub-page-links">
				<div class="grid-x small-up-1 medium-up-<?php echo count($rows);?>" >
<?php
 	// loop through the rows of data
    while ( have_rows('sub_page_links', $thePostId) ) : the_row();
?>
					<div class="cell">
						<a class="button" href="<?php the_sub_field('page');?>" style="background-color: <?php the_sub_field('about_sub_page_link_color');?>"><?php the_sub_field('link_text');?></a>
					</div>
<?php
    endwhile;
?>
				</div>
			</div>
<?php
endif;
?>