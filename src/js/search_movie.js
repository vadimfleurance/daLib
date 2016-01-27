$("#search-input").on("keyup", function(){
	var wordSearch = $("#search-input").val();

	if (wordSearch.length>=3){
		$.ajax({
			"url": $("#search-movie-form").attr("data-ajax"),
			"type": $("#search-movie-form").attr("method"),
			"data": $("#search-movie-form").serialize()
		}).done(function(response){
			$("#result-search").html(response);
		});
	}

	else{
		$("#result-search").empty();
	}
});