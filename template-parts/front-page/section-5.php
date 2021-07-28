<?php
if ($section5Text) :
	?>
	<section id="section-5">
		<div class="entry-content" id="section-5-content">
			<?php echo $section5Title ? "<h3 class='section-title'>".$section5Title."</h3>" : ""; ?>
			<?php echo $section5Text; ?>
		</div>
	</section>
	<?php
endif;

?>