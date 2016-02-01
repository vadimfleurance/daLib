
//add to collection on dedicated button click with ajax
//is actually a Collection Controller manageCollection Method CALL
//which Callback depending of boolean value either collect or remove method from moviesUsers Manager
$(".add-link").on("click", function(e)
{	
	e.preventDefault();
	var idMovie = $(this).attr("data-mov-id");
	var addUrl =$(this).attr("href");
	console.log(addUrl);
	console.log(idMovie);
	$.ajax({
		url: addUrl,
		type: "POST",
		data: {
			"idMovie" : idMovie,
			"bool" : 1
		}
	})
	.done(function(response){})
	.fail(function(response){console.log("erreur de requete ajax")})

});

//remove from collection on dedicated button click with ajax (see detail of functionnement in previous method comments)

$(".remove-link").on("click", function(e)
{	
	e.preventDefault();
	var idMovie = $(this).attr("data-mov-id");
	var addUrl =$(this).attr("href");
	console.log(addUrl);
	console.log(idMovie);
	$.ajax({
		url: addUrl,
		type: "POST",
		data: {
			"idMovie" : idMovie,
			"bool" : 0
		}
	})
	.done(function(response){})
	.fail(function(response){console.log("erreur de requete ajax")})

});

//set watch status to 1 from  movie in collection on dedicated button click with ajax

$(".status-link").on("click", function(e)
{	
	e.preventDefault();
	var status =$(this).attr("data-status-type");
	var bool =$(this).attr("data-status-value");
	var idMovie = $(this).attr("data-mov-id");
	var btnUrl =$(this).attr("href");
	console.log(status);
	console.log(btnUrl);
	console.log(idMovie);
	console.log(bool);
	$.ajax({
		url: btnUrl,
		type: "POST",
		data: {
			"status": status,
			"idMovie" : idMovie,
			//toggle the status value in database column
			"bool" : (bool)? 0 : 1
		}
	})
	.done(function(response){
		//toggle the value of attribute data-status-value in btn
		var bool =$(this).attr("data-status-value");
		$(this).attr("data-status-value", (bool)? 0 : 1);
	})
	.fail(function(response){console.log("erreur de requete ajax")})

});


