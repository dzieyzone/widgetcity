/*Drupal.behaviors.productHover = function(context) {
	var imgsrc='';
	$(".product-list-display .views-row").each(function(){
//		swapTitle($('h3 a',this));
		imgsrc = 'url('+$('.teaser-image img',this).attr('src')+')';
		$('.teaser-image', this).css('background-image',imgsrc);
	});
//	$(".product-list-display .teaser-content .slidethis, .teaser-image img").hide();
	$(".teaser-image img").hide();
	$(".product-list-display .views-row").hoverIntent(function() {
//		swapTitle($('h3.title a',this));
		var theHover = $(".teaser-content .slidethis", this);
		theHover.slideUp("normal");
		theHover.click(function() {
			var href = $(".title a", $(this).parent()).attr("href");
			window.location = href;
		});
	},
	function() {
		$(".teaser-content .slidethis", this).slideDown("normal");
//		swapTitle($('h3.title a',this));
	});
};
*/
$(document).ready(function() {
	$('.node-type-product .node-inner').corner("tl br").parent().corner("tl br");
	$(".product-list-display .views-row").each(function(){
		swapTitle($('h3 a',this));
	});
});
function swapTitle(thistag){
	var myTag = $(thistag);
	var mytitle = $(thistag).attr('title');
	var mytext = $(thistag).text();
	$(thistag).attr('title',mytext).html(mytitle);
}
