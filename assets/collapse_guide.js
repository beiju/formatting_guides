jQuery(document).ready(function() {
	// Insert anchor that will act as toggle to collapse/uncollapse the sectionfields
	jQuery('.formatting_guides').before('\
		(<a title="Toggle collapse" class="togglecollapse">Show formatting guide</a>)\
	');
	
	jQuery("a.togglecollapse").each(function () {
		jQuery(this).next('label').hide();
	});
	
	jQuery("a.togglecollapse").click(
		function () {
			// Toggle guide
			jQuery(this).next('label').slideToggle();
		}
	);

});