<?php

namespace Controller;

use \W\Controller\Controller;

class DefaultController extends Controller
{
	/**
	 * Page d'accueil par défaut
	 */
	public function home()
	{	
		if ( $this->getUser() ) {

			$this->redirectToRoute('show_collection');
		}

		$errors = [
			"username" => "",
			"email" => "",
			"password" => ""
		];
		$movieManager = new \Manager\MovieManager;
		$moviesFound = $movieManager->getBestImdbRating();
		$this->show('default/home', [ 'errors' => $errors, 'moviesFound' => $moviesFound ]);
	}
}