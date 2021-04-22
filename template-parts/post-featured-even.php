<div class="cell small-12 even">
	<div class="grid-x align-middle container">
		
		<div class="cell small-12 show-for-small-only featured-post-image">

<?php
$video = get_field('post_video'); 
if ($video) :
?>
			<div class="embed-container" data-equalizer-watch="box">
				<?php echo $video; ?>
			</div>
<?php
	else:
?>
			<div class="image-container" data-equalizer-watch="box">
				<img src='<?php the_post_thumbnail_url();?>' width="100%"/>
			</div>
<?php
	endif;
	//Else display image
?>

		</div>
		<div class="cell small-12 medium-6 large-5 small-push-12 featured-post-content">
				<div class="grid-x featured-post-content container content align-middle" data-equalizer-watch="box">
					<div class="cell small-12">

						<?php the_title('<h3>', '</h3>'); ?>
						
						<div class="excerpt">
							<?php the_excerpt(); ?>
						</div>

						<div class="action">		
							<a class="button" href="<?php the_permalink();?>">READ MORE</a>
						</div>

					</div>
				</div>
		</div>
		<div class="cell small-12 medium-6 large-7 hide-for-small-only featured-post-image">

<?php
$video = get_field('post_video'); 
if ($video) :
?>
			<div class="embed-container" data-equalizer-watch="box">
				<?php echo $video; ?>
			</div>
<?php
	else:
?>
			<div class="image-container" data-equalizer-watch="box">
				<img src='<?php the_post_thumbnail_url();?>' width="100%"/>
			</div>
<?php
	endif;
	//Else display image
?>

		</div>
	</div>
</div>