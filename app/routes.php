<?php
	
	$w_routes = array(
		['GET', '/', 'Default#home', 'home'],
		['GET', '/movie/search/', 'Movie#search', 'search_movie'],
		['GET', '/scrap/', 'Scraper#globalScraper', 'global_scraper'],
	);