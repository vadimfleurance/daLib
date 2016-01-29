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
$("#search-input").on("keyup", function(){
	var wordSearch = $("#search-input").val();
	var listMovies = $("#result-search-form");

	if(wordSearch.length >= 3) {
		$.ajax({
			"url": $("#search-form").attr("data-ajax"),
			"type": $("#search-form").attr("method"),
			"data": $("#search-form").serialize()
		}).done(function(response){
			listMovies.css('display', 'block');
			listMovies.html(response);
		});
	}
	else {
		listMovies.css('display', 'none');
		listMovies.empty();
	}
});