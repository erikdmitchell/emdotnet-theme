jQuery(document).ready(function($) {

	// show hide on mouseover //
	$('.projects .project').mouseover(function() {
		$(this).find('.title').show();
	}).mouseout(function() {
		$(this).find('.title').hide();
	});

});