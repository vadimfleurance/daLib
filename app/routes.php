<?php
	
	$w_routes = array(
		['GET', '/', 'Default#home', 'home'],
		['GET', '/scrap/', 'Scraper#globalScraper', 'global_scraper'],
		['GET', '/scraptest/', 'Scraper#MovieInsert', 'MovieInsert'],
		['GET', '/movie-detail/[i:id]/', 'Movie#movieDetails', 'movie_detail'],
		['POST', '/addtocollection/', 'Collection#addToCollection', 'add_to_collection'],
	);