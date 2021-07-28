<?php
if ($section10Text) :
	?>
	<section id="section-10">
		<div class="entry-content" id="section-10-content">
			<?php echo $section10Title ? "<h3 class='section-title'>".$section10Title."</h3>" : ""; ?>
			<?php echo $section10Text; ?>
		</div>
	</section>
	<?php
endif;
?>