$("#search-input").on("keyup", function(){
	var wordSearch = $("#search-input").val();

	if (wordSearch.length>=3){
		$.ajax({
			"url": $("#search-movie-form").attr("action"),
			"type": $("#search-movie-form").attr("method"),
			"data": $("#bd-search-form").serialize()
		}).done(function(response){
			
		});
	}
});