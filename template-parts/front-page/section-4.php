<?php
if ($section4Text) :
	?>
	<section id="section-4">
		<div class="entry-content" id="section-4-content">
			<?php echo $section4Title ? "<h3 class='section-title'>".$section4Title."</h3>" : ""; ?>
			<?php echo $section4Text; ?>
		</div>
	</section>
	<?php
endif;
?>