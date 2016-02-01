<?php
	
	$w_routes = array(
		['GET', '/', 'Default#home', 'home'],
		['GET', '/search/ajax/', 'Movie#searchAjax', 'search_ajax'],
		// ['GET', '/scrap/', 'Scraper#globalScraper', 'global_scraper'],
		['GET', '/movie-detail/[i:id]/', 'Movie#movieDetails', 'movie_detail'],
		['POST', '/managecollection/', 'Collection#manageCollection', 'manage_collection'],
		['POST', '/statusmanage/', 'Collection#manageStatus', 'status_manage'],
		['GET', '/collection/[i:cPage]?/', 'Collection#showCollection', 'show_collection'],
		['GET|POST', '/add-movie/', 'Movie#addMovie', 'add_movie'],


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

		//Authorize PathCollection
		// ['GET|POST', '/path-to-collection/', 'Path#accessTo', 'path_to_collection' ],
		

		/**
		* 	BACK-OFFICE
		*/	
			//	Accès au back-office
		['GET', '/back-office/', 'BackOffice#home', 'back_office' ],

			// Lancement du scrapping depuis le backoffice
		['POST', '/back-office/scrapper/', 'BackOffice#scrapper', 'back_office_scrapper' ],

			//	Accès depuis le back-office aux utilisateurs
		['POST', '/back-office/users/', 'BackOffice#listUsers', 'back_office_users' ],
			
			// Accès à la page permettant de modifier le compte de l'utilisateur
		['GET|POST', '/back-office/users/profile/[:id]/', 'BackOffice#profile', 'profile'],
			
			//	Accès depuis le back-office aux films
		['POST', '/back-office/movies/', 'BackOffice#listMovies', 'back_office_movies' ],

			//	Accès depuis le back-office aux films
		['GET|POST', '/back-office/movie/detail/[:id]/', 'BackOffice#movieDetail', 'detail' ],

			//	Suppression d'un utilisateur
		['GET|POST', '/back-office/user/delete/[:id]/', 'BackOffice#deleteUser', 'delete_user' ],

	
	);	
