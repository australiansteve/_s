
<script type="text/javascript">
	var projectInFocus = 1; //1 based CSS arrays
	var nextPage = 2; //1 based CSS arrays

	window.addEventListener('load', function() {
		var el = document.getElementById('project-scroll');
		var hammertime = Hammer(el);
		hammertime.get('swipe').set({ direction: Hammer.DIRECTION_HORIZONTAL });
		hammertime.on('swipe', function(ev) {
			var direction = '';
			switch(ev.direction) {
				case Hammer.DIRECTION_LEFT:
				console.log("Swipe left");
				scrollProjects(true);
				break;
				case Hammer.DIRECTION_RIGHT:
				scrollProjects(false);
				break;
			}
		});

		el.onwheel = function(event) {
			event.preventDefault();
			if (event.deltaY > 0) {
				scrollProjects(true);
			}
			else {
				scrollProjects(false);
			}
		}

	}, false);

	var scrollProjects = debounce(function(next) {
		if (next) {
			scrollNextProject();
		}
		else {
			scrollPreviousProject();
		}
	}, 500, true);

	function getMargin(projects) {
		return ((projects * -100) + 0) + "%";
	}

	function scrollNextProject() {
		var scrollMore = 1;
		if (jQuery("#project-scroll td.project:nth-of-type("+(projectInFocus)+") ~ td.project").length >= scrollMore) {
			projectInFocus++; //Update first project displayed
			setNewMargin(getMargin((projectInFocus-1)));
		}
	}

	function scrollPreviousProject() {
		if (jQuery("#project-scroll td.project:nth-of-type("+(projectInFocus)+")").prev().length == 1) {
			projectInFocus--; //Update first project displayed
			setNewMargin(getMargin((projectInFocus-1)));
		}
	}

	jQuery(".next").on('click', function(e) {
		e.preventDefault();
		scrollProjects(true);
	});

	jQuery(".previous").on('click', function(e) {
		e.preventDefault();
		scrollProjects(false);
	});

	function setNewMargin(margin) {
		jQuery("#project-scroll td.project:nth-of-type(1)").css('margin-left', margin);
	}


	// Returns a function, that, as long as it continues to be invoked, will not
	// be triggered. The function will be called after it stops being called for
	// N milliseconds. If `immediate` is passed, trigger the function on the
	// leading edge, instead of the trailing.
	function debounce(func, wait, immediate) {
		var timeout;
		return function() {
			var context = this, args = arguments;
			var later = function() {
				timeout = null;
				if (!immediate) func.apply(context, args);
			};
			var callNow = immediate && !timeout;
			clearTimeout(timeout);
			timeout = setTimeout(later, wait);
			if (callNow) func.apply(context, args);
		};
	};

</script>