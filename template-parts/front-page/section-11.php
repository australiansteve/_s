<?php
if ($section11Gallery) :
	?>
	<section id="section-11">
		<div class="entry-content" id="section-11-content">
			<?php echo $section11Title ? "<h3 class='section-title'>".$section11Title."</h3>" : ""; ?>
			<?php echo $section11Text ? $section11Text : ""; ?>

			<div class="grid-x grid-padding-x small-up-2 medium-up-<?php echo count($section11Gallery);?> align-center">
				<?php foreach( $section11Gallery as $image_id ): ?>
	            	<div class="cell">
	                	<?php echo wp_get_attachment_image( $image_id, 'sponsor-logo' ); ?>
	            	</div>
		        <?php endforeach; ?>
		    </div>
		</div>
	</section>
	<?php
endif;
?>