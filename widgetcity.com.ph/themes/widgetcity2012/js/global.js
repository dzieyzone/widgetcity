$(document).ready(function() {
	$("dl.dropdown .menu a").click(function() {
		$("dd ul", $(this).parents('.dropdown')).toggle();
		return false;
	});
/*
	$("dd.dropdown dd ul li a").click(function() {
		$("dd.dropdown dd ul").hide();
	});
*/							
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("dropdown"))
				$("dd ul").hide();
	});
});