jQuery(document).ready(function($) {

	// show hide on mouseover.
	$('.home-feature-projects .project').mouseover(function() {   	
		$(this).find('.title').show();
	}).mouseout(function() {
		$(this).find('.title').hide();
	});

});