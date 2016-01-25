//			Owl Carousel
// Ref. http://owlgraphic.com/owlcarousel/index.html
$(document).ready(function() {
	var owl = $("#owl-demo");
	owl.owlCarousel({
		autoPlay: 4000,
		items : 4,
		itemsDesktopSmall : [992,3],
		itemsTablet: [767,2],
		itemsMobile : [480, 1]
	});
});