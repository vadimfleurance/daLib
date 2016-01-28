$("#search-input").on("keyup", function(){
	var wordSearch = $("#search-input").val();

	if (wordSearch.length>=3){
		$.ajax({
			"url": $("#search-form").attr("data-ajax"),
			"type": $("#search-form").attr("method"),
			"data": $("#search-form").serialize()
		}).done(function(response){
			$("#result-search").html(response);
		});
	}

	else{
		$("#result-search").empty();
	}
});