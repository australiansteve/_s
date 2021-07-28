<?php
if ($section6Text) :
	?>
	<section id="section-6">
		<div class="entry-content" id="section-6-content">
			<?php echo $section6Title ? "<h3 class='section-title'>".$section6Title."</h3>" : ""; ?>
			<?php echo $section6Text; ?>
		</div>
	</section>
	<?php
endif;
?>