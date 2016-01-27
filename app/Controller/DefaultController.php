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
		$errors = [
			"username" => "",
			"email" => "",
			"password" => ""
		];

		$this->show('default/home', [ 'errors' => $errors ]);
	}
}