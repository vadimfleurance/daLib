<?php
	
	$w_routes = array(
		['GET', '/', 'Default#home', 'home'],

		//Registration
		['GET|POST', '/registration/', 'Registration#register', 'register' ],
		['GET|POST', '/registration-confirmed/', 'Registration#success', 'registration_success' ],

		//Login
		['GET|POST', '/login/', 'Login#logIn', 'login' ],		

	);