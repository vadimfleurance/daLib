<?php
	
	$w_routes = array(
		['GET', '/', 'Default#home', 'home'],
		['GET', '/scrap/', 'Scraper#globalScraper', 'global_scraper'],
		['GET', '/scraptest/', 'Scraper#MovieInsert', 'MovieInsert'],
		['GET', '/moviedetail/[:id]/', 'Movie#movieDetails', 'movie_detail'],
	);