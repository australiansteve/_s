

<script type="text/javascript">

jQuery(document).ready(function() {

	var videoModal;

	jQuery(document).on('closed.zf.reveal', '[data-reveal]', function() {

		//Reset src so that video stops laying in background
		jQuery('#video-modal').find("iframe").attr('src', '');

		//Remove modal from page
		jQuery('#video-modal').remove();


		videoModal = null;
	});
	

	jQuery(document).on('click', "[data-close='video-modal']", function(e) {		
		if (videoModal) {
			videoModal.close();
		}
	});

	jQuery(document).on('click', "[data-open='video-modal']", function(e) {

		// create your modal template    
		var modal = '<div class="reveal" id="video-modal" data-reveal>' +
					'	<div class="iframe-container">' +
							jQuery(this).data('video-html') + 
					'	</div>' +
					'	<div class="actions text-center">' +
					'		<a href="" class="read-more-button button"><?php the_field('read_more_text', 'options')?></a> '+
					'	</div>' +
					'	<button class="close-button" data-close="video-modal" aria-label="Close modal" type="button">' +
					'		<span aria-hidden="true">&times;</span>' +
					'	</button>' +
					'</div>';

		// appending new reveal modal to the page
		jQuery('body').append(modal);

		// registergin this modal DOM as Foundation reveal    
		videoModal = new Foundation.Reveal(jQuery('#video-modal'));

		// open
		videoModal.open();

	});

});

</script>