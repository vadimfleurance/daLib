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

	public function profile($id)
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

		$username = 	$user['username'];
		$email = 		$user['email'];
		$role = 		$user['role'];

		if ( $_POST ) {

			// debug($_POST);
			// die();
			$newUsername = 	$_POST['user']['username'];
			$newEmail = 	$_POST['user']['email'];
			$newRole = 		$_POST['role'];

			$isValid = true; 

			/**************************************************
			*
			*	USERNAME
			*
			**************************************************/
			if ( empty( $newUsername )) {
				$isValid = false;
				$errors['username'][] = "Veuillez renseigner un nom d'utilisateur. " ;
			}

			if ( $username === $newUsername ) {
				$isValid = false;
				$errors['username'][] = "Existe déjà en base de donnée. " ;
			}

			/**************************************************
			*
			*	EMAIL
			*
			**************************************************/
			if ( empty( $newEmail )) {
				$isValid = false;
				$errors['email'][] = "Veuillez renseigner une adresse email. " ;
			}

			if ( $email === $newEmail ) {
				$isValid = false;
				$errors['email'][] = "Existe déjà en base de donnée. " ;
			}

			
			/**************************************************
			*
			*	ROLE
			*
			**************************************************/
			if ( $role === $newRole ) {
				$isValid = false;
				$errors['role'][] = "Ce rôle pour cet utilisateur existe déjà en base de donnée. " ;
			}


			/**************************************************
			*
			*	ENVOIE EN BDD
			*
			**************************************************/
			if ( $isValid ) {

				$userManager->update([
					"username" => $newUsername,
					"email" => $newEmail,
					"role" => $newRole,
					"dateModified" => date("Y-m-d H:i:s")
				]);
			}
		}

		// echo('$user : de la méthode profile');
		// debug($user);

		// echo('$_POST : de la méthode profile');
		// debug($_POST);

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