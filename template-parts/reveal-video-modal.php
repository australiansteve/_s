<div class="reveal" id="video-modal" data-reveal>
	<div class="iframe-container">
	</div>
	<div class="actions text-center">
		<a href="" class="read-more-button button"><?php the_field('read_more_text', 'options')?></a>
	</div>
	<button class="close-button" data-close aria-label="Close modal" type="button">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<script type="text/javascript">
	function showVideo(el) {
		html = jQuery(el).data('video-html');
		jQuery("#video-modal .iframe-container").html(html);
		jQuery("#video-modal .read-more-button").attr("href", jQuery(el).data('post-link'));
	}
</script>