<?php

	//autochargement des classes
	require("../vendor/autoload.php");

	//configuration
	require("../app/config.php");

	//rares fonctions globales
	require("../W/globals.php");

	//instancie notre appli en lui passant la config et les routes
	$app = new W\App($w_routes, $w_config);

    //vérifie si un cookie de "remember me" est présent
    $rememberMeChecker = new \Security\RememberMeChecker();
    $rememberMeChecker->check();

	//exécute l'appli
	$app->run();