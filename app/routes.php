<?php
	
	$w_routes = array(

		// Back-Office
		['GET|POST', '/back-office/', 'BackOffice#home', 'back_office'],
		['GET|POST', '/back-office/scrapper/home/', 'BackOffice#scrapperHome', 'scrapper_home'],
		['GET|POST', '/back-office/scrapper/launch/', 'BackOffice#launchScrapper', 'launch_scrapper'],
		['GET|POST', '/back-office/users/', 'BackOffice#listUsers', 'back_office_users'],
		['GET|POST', '/back-office/users/profile/[:id]/', 'BackOffice#profile', 'profile'],
		['GET|POST', '/back-office/user/new-password/[:id]/', 'BackOffice#generateNewPasswordUser', 'generate_new_password_user'],
		['GET|POST', '/back-office/user/delete/[:id]/', 'BackOffice#deleteUser', 'delete_user'],
		['GET|POST', '/back-office/movies/', 'BackOffice#listMovies', 'back_office_movies'],
		['GET|POST', '/back-office/movie/detail/[:id]/', 'BackOffice#movieDetail', 'detail'],

		// Collection & Suggestions
		['GET', '/collection/[i:cPage]?/', 'Collection#showCollection', 'show_collection'],
		['POST', '/managecollection/', 'Collection#manageCollection', 'manage_collection'],
		['GET', '/suggestion/[i:cPage]?/', 'Collection#showSuggestion', 'show_suggestion'],

		// Homepage
		['GET', '/', 'Default#home', 'home'],
		['GET|POST', '/sitemap.xml', 'Sitemap#sitemapWrite', 'sitemap' ],
		
		// Movies & Search
		['GET|POST', '/add-movie/', 'Movie#addMovie', 'add_movie'],
		['GET', '/movie-detail/[i:id]/', 'Movie#movieDetails', 'movie_detail'],
		['POST', '/statusmanage/', 'Collection#manageStatus', 'status_manage'],
		['GET', '/search/[i:page]?/', 'Movie#search', 'search'],
		['GET', '/search-ajax/', 'Movie#searchAjax', 'search_ajax'],

		// User
		['GET|POST', '/login/', 'Login#logIn', 'login' ],
		['GET', '/logout/', 'Login#logOut', 'logout' ],
		['GET|POST', '/forgot-password/', 'Login#forgotPassword', 'forgot_password' ],
		['GET|POST', '/new-password/[:tokenPassword]/[:id]/', 'Login#newPassword', 'new_password' ],
		['GET|POST', '/registration/', 'Registration#register', 'register' ],
		['GET|POST', '/registration-confirmed/', 'Registration#success', 'registration_success' ],
		['GET|POST', '/profile/', 'User#userProfile', 'user_profile' ],
		
	);