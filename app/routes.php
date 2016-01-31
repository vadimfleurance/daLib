<?php
	
	$w_routes = array(
		['GET', '/', 'Default#home', 'home'],
		['GET', '/scrap/', 'Scraper#globalScraper', 'global_scraper'],
		['GET', '/movie-detail/[i:id]/', 'Movie#movieDetails', 'movie_detail'],
		['GET|POST', '/add-movie/', 'Movie#addMovie', 'add_movie'],

		//Search
		['GET', '/search/page=[i:page]/elements=[i:elements]/', 'Movie#search', 'search'],		
		['GET', '/search/ajax/', 'Movie#searchAjax', 'search_ajax'],

		//Registration
		['GET|POST', '/registration/', 'Registration#register', 'register' ],
		['GET|POST', '/registration-confirmed/', 'Registration#success', 'registration_success' ],

		//Login
		['GET|POST', '/login/', 'Login#logIn', 'login' ],

		//logout
		['GET', '/logout/', 'Login#logOut', 'logout' ],

		//ForgotPassword
		['GET|POST', '/forgot-password/', 'Login#forgotPassword', 'forgot_password' ],

		//NewPassword
		['GET|POST', '/new-password/[:tokenPassword]/[:id]/', 'Login#newPassword', 'new_password' ],
	);	