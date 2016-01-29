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

			$this->redirectToRoute('collection');
		}

		$errors = [
			"username" => "",
			"email" => "",
			"password" => ""
		];

		$this->show('default/home', [ 'errors' => $errors ]);
	}
}