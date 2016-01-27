<?php
	
	$w_routes = array(
		['GET', '/', 'Default#home', 'home'],
		['GET', '/search/ajax/', 'Movie#searchAjax', 'search_ajax'],
		['GET', '/scrap/', 'Scraper#globalScraper', 'global_scraper'],
		['GET', '/scraptest/', 'Scraper#MovieInsert', 'MovieInsert'],
	);