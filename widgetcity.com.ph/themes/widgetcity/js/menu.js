function initMenus() {
	$('#block-menu-menu-product-menu ul.menu').attr("id", "accordion").addClass('noaccordion');
	$('#accordion ul').hide();
	$('#accordion .active-trail ul:first').show();
	$('#accordion li.expanded a:first').attr('href','#');

	$('#block-menu-menu-product-menu ul.menu li a').click(
		function() {
			var checkElement = $(this).next();
			var parent = this.parentNode.parentNode.id;

			if($('#' + parent).hasClass('noaccordion') && ($(this).parent().hasClass('expanded'))) {
				$(this).next().slideToggle('normal');
				return false;
			}
			if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
				if($('#' + parent).hasClass('collapsible')) {
					$('#' + parent + ' ul:visible').slideUp('normal');
				}
				return false;
			}
			if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
				$('#' + parent + ' ul:visible').slideUp('normal');
				checkElement.slideDown('normal');
				return false;
			}
		}
);
}
$(document).ready(function() {
	initMenus();
	$(".block-widget .block-title").corner("top 5px");
});