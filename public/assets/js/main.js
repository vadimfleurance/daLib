$('.to-collection').on('click', function(e)
{	
	e.preventDefault();
	var btn = $(this);
	var state = $(this).attr('data-state');
	var idMovie = $(this).attr('data-mov-id');
	var addUrl = $(this).attr('href');

	$.ajax({
		url: addUrl,
		type: 'POST',
		data: { 'idMovie' : idMovie }
	})
	.done(function(response) {
		if(state === 'add') {
			btn.html('<i class="fa fa-minus"></i> Remove');
			btn.attr('data-state', 'remove');
			btn.next('span').removeClass('hidden');
		}
		else {
			btn.html('<i class="fa fa-plus"></i> Add');
			btn.attr('data-state', 'add');
			btn.next('span').addClass('hidden');
		}
	})
	.fail(function(response) {
		console.log('Erreur de requete ajax')
	})

});

$(".status-link").on("click", function(e)
{	
	e.preventDefault();
	var btn = $(this);
	var status = btn.attr("data-status-type");
	var bool = $(this).attr("data-status-value");
	var idMovie = btn.attr("data-mov-id");
	var btnUrl = btn.attr("href");

	console.log(status);
	console.log(btnUrl);
	console.log(idMovie);

	$.ajax({
		url: btnUrl,
		type: "POST",
		data: {
			"status": status,
			"idMovie" : idMovie
		}
	})
	.done(function(response) {
		if(bool === '1') {
			btn.toggleClass('btn-'+status);
			btn.attr('data-status-value', '0');
		}
		else {
			btn.toggleClass('btn-'+status);
			btn.attr('data-status-value', '1');
		}
	})
	.fail(function(response) {
		console.log("Erreur de requete ajax")
	})

});



// //add to collection on dedicated button click with ajax
// //is actually a Collection Controller manageCollection Method CALL
// //which Callback depending of boolean value either collect or remove method from moviesUsers Manager
// $(".add-link").on("click", function(e)
// {	
// 	e.preventDefault();
// 	var idMovie = $(this).attr("data-mov-id");
// 	var addUrl =$(this).attr("href");
// 	console.log(addUrl);
// 	console.log(idMovie);
// 	$.ajax({
// 		url: addUrl,
// 		type: "POST",
// 		data: {
// 			"idMovie" : idMovie,
// 			"bool" : 1
// 		}
// 	})
// 	.done(function(response){})
// 	.fail(function(response){console.log("erreur de requete ajax")})

// });

// //remove from collection on dedicated button click with ajax (see detail of functionnement in previous method comments)

// $(".remove-link").on("click", function(e)
// {	
// 	e.preventDefault();
// 	var idMovie = $(this).attr("data-mov-id");
// 	var addUrl =$(this).attr("href");
// 	console.log(addUrl);
// 	console.log(idMovie);
// 	$.ajax({
// 		url: addUrl,
// 		type: "POST",
// 		data: {
// 			"idMovie" : idMovie,
// 			"bool" : 0
// 		}
// 	})
// 	.done(function(response){})
// 	.fail(function(response){console.log("erreur de requete ajax")})

// });

// //set watch status to 1 from  movie in collection on dedicated button click with ajax

// // $(".status-link").on("click", function(e)
// // {	
// // 	e.preventDefault();
// // 	var status =$(this).attr("data-status-type");
// // 	var bool =$(this).attr("data-status-value");
// // 	var idMovie = $(this).attr("data-mov-id");
// // 	var btnUrl =$(this).attr("href");
// // 	console.log(status);
// // 	console.log(btnUrl);
// // 	console.log(idMovie);
// // 	console.log(bool);
// // 	$.ajax({
// // 		url: btnUrl,
// // 		type: "POST",
// // 		data: {
// // 			"status": status,
// // 			"idMovie" : idMovie,
// // 			//toggle the status value in database column
// // 			"bool" : (bool)? 0 : 1
// // 		}
// // 	})
// // 	.done(function(response){
// // 		//toggle the value of attribute data-status-value in btn
// // 		var bool =$(this).attr("data-status-value");
// // 		$(this).attr("data-status-value", (bool)? 0 : 1);
// // 	})
// // 	.fail(function(response){console.log("erreur de requete ajax")})

// // });



//			Owl Carousel
// Ref. http://owlgraphic.com/owlcarousel/index.html
$(document).ready(function() {
	var owl = $('#owl-demo');
	owl.owlCarousel({
		autoPlay: 4000,
		items : 4,
		itemsDesktopSmall : [992,3],
		itemsTablet: [767,2],
		itemsMobile : [480, 1]
	});
});
var listMovies = $("#result-search-form");

$('html').click(function() {
	listMovies.css('display', 'none');
});

listMovies.click(function(event){
	event.stopPropagation();
});

$("#search-input").on("keyup click", function(){
	var wordSearch = $.trim($("#search-input").val());
	
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