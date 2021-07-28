<?php
if ($section8Text) :
	?>
	<section id="section-8">
		<div class="entry-content" id="section-8-content">
			<?php echo $section8Title ? "<h3 class='section-title'>".$section8Title."</h3>" : ""; ?>
			<?php echo $section8Text; ?>
		</div>
	</section>
	<?php
endif;
?>