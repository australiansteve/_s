//customizer.js is only done in backend so not including in main
import './navigation.js'
import './foundation.js'



jQuery(document).ready(function() {

	jQuery(document).on("open.zf.reveal", "[data-reveal]", function() {
		console.log("reveal");
	});

});