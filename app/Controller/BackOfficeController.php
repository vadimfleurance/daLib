<?php

namespace Controller;

use \W\Controller\Controller;

class BackOfficeController extends Controller
{
	/**
	 * 	Page d'accueil BackOffice
	 */
	public function home()
	{	
		$this->allowTo('admin');
		$this->show('back_office/home');
	}

	public function scrapper()
	{
		if ( !empty( $_POST['action']['scrapping'] )) {

			$scrapperController  = new ScraperController();
			$movies = $scrapperController->globalScraper();
		}
	}

	public function listUsers()
	{
		$this->allowTo('admin');
		
		$userManager = new \Manager\UserManager();
		$users = $userManager->findAll();

		$this->show('back_office/back-office-users', [
			"users" => $users
			]);
	}

	public function  profile($id)
	{	
		$errors = [
			"username" => [],
			"email" => [],
			"password" => [],
			"total" => [],
			];


		//Crée une instance de notre gestionnaire
		$userManager = new \Manager\UserManager();

		//Récupère l'utilisateur en BDD en fct de l'identification dans l'url
		$user = $userManager->find($id);

		echo('$user : de la méthode profile');
		debug($user);

		echo('$_POST : de la méthode profile');
		debug($_POST);

		$this->show( 'back_office/profile', [
			"user" => $user,
			'errors' => $errors
			]);
	}


	public function getMovies()
	{
		$this->allowTo('admin');
		$this->show('back_office/back-office-movies');
	}


}