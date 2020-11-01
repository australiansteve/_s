
<script type="text/javascript">
	function setNextPreviousButton(selector, imageNumber) {
		if (jQuery("#image-gallery .project:nth-of-type(" + imageNumber + ")").length) {
			jQuery(selector).attr('data-image', imageNumber);
			jQuery(selector).css('display', 'block');

		}
		else {
			jQuery(selector).css('display', 'none');
		}
	}

	jQuery(document).ready(function() {

		jQuery(document).on('click', '.modal-button', function(event) {
			var imageContainer = jQuery("#image-gallery .project:nth-of-type(" + this.dataset.image + ") .container");
			jQuery(imageContainer).trigger('click');
		});

		jQuery(document).on('click', '[data-open]', function(event) {
			jQuery("#imageModal img").attr('src', this.dataset.fullimage);

			var previousImage = parseInt(this.dataset.imagecounter, 10) - 1;
			setNextPreviousButton("#imageModal .previous-button", previousImage);

			var nextImage = parseInt(this.dataset.imagecounter, 10) + 1;
			setNextPreviousButton("#imageModal .next-button", nextImage);
		});
	});

</script>