<?php
	
	$w_routes = array(
		['GET', '/', 'Default#home', 'home'],
		// ['GET', '/scrap/', 'Scraper#globalScraper', 'global_scraper'],

		['GET', '/movie-detail/[i:id]/', 'Movie#movieDetails', 'movie_detail'],
		['POST', '/managecollection/', 'Collection#manageCollection', 'manage_collection'],
		['POST', '/statusmanage/', 'Collection#manageStatus', 'status_manage'],
		['GET', '/collection/[i:cPage]?/', 'Collection#showCollection', 'show_collection'],
		['GET', '/suggestion/[i:cPage]?/', 'Collection#showSuggestion', 'show_suggestion'],

		['GET|POST', '/add-movie/', 'Movie#addMovie', 'add_movie'],

		//Search	
		['GET', '/search/[i:page]?/', 'Movie#search', 'search'],
		['GET', '/search-ajax/', 'Movie#searchAjax', 'search_ajax'],

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
		
		//Gestion du Sitemap
		['GET|POST', '/sitemap.xml', 'Sitemap#sitemapWrite', 'sitemap' ],

		/**
		* 	BACK-OFFICE
		*/	
			//	Accès au back-office
		['GET|POST', '/back-office/', 'BackOffice#home', 'back_office' ],

		// 	// Lancement du scrapping depuis le backoffice
		// ['GET|POST', '/back-office/scrapper/', 'BackOffice#scrapper', 'back_office_scrapper' ],

		//	Accès depuis le back-office aux utilisateurs
		['GET|POST', '/back-office/users/', 'BackOffice#listUsers', 'back_office_users' ],
			
		// Accès à la page permettant de modifier le compte de l'utilisateur
		['GET|POST', '/back-office/users/profile/[:id]/', 'BackOffice#profile', 'profile'],
			
		//	Accès depuis le back-office aux films
		['GET|POST', '/back-office/movies/', 'BackOffice#listMovies', 'back_office_movies' ],

		//	Accès depuis le back-office au détail d'un film
		['GET|POST', '/back-office/movie/detail/[:id]/', 'BackOffice#movieDetail', 'detail' ],

		//	Suppression d'un utilisateur
		['GET|POST', '/back-office/user/delete/[:id]/', 'BackOffice#deleteUser', 'delete_user' ],




		//	Envoie d'un email pouvant changer le mot de passe de l'utilisateur
		['GET|POST', '/back-office/user/new-password/[:id]/', 'BackOffice#generateNewPasswordUser', 'generate_new_password_user' ],
		
		 //	Accueil page scrapper
		['GET|POST', '/back-office/scrapper/home/', 'BackOffice#scrapperHome', 'scrapper_home' ],

		//	lancement du scrapper
		['GET|POST', '/back-office/scrapper/launch/', 'BackOffice#launchScrapper', 'launch_scrapper' ],

		
		//	Afficher le profile de l'utilisateur
		['GET|POST', '/profile/', 'User#userProfile', 'user_profile' ],

	
	);	
