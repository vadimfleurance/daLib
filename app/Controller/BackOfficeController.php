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
		$this->allowTo('admin');
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
		$this->allowTo('admin');
	
		//Crée une instance de notre gestionnaire
		$userManager = new \Manager\UserManager();

		//Récupère l'utilisateur en BDD en fct de l'identification dans l'url
		$user = $userManager->find($id);

		$username = 	$user['username'];
		$email = 		$user['email'];
		$role = 		$user['role'];

		if ( $_POST ) {

			if ( !empty( $_POST['action']['modify'])) {
			
				$newUsername = 	$_POST['user']['username'];
				$newEmail = 	$_POST['user']['email'];
				$newRole = 		$_POST['role'];

				if ( !empty( $newUsername ) && !empty( $newEmail ) && !empty( $newRole )) {

					if ( $username != $newUsername ) {
						$userManager->update([
							'username' => $newUsername,
							'dateModified' => date("Y-m-d H:i:s")
						], $user['id'] );
					}
					
					if ( $email != $newEmail ) {
						$userManager->update([
							'email' => $newEmail,
							'dateModified' => date("Y-m-d H:i:s")
						], $user['id'] );
					}

					if ( $role != $newRole ) {
						$userManager->update([
							'role' => $newRole,
							'dateModified' => date("Y-m-d H:i:s")
						], $user['id'] );	
					}
				}
			}
		}
		$this->show( 'back_office/profile', [
			"user" => $user
		]);
	}
			
	public function getMovies()
	{
		$this->allowTo('admin');
		$this->show('back_office/back-office-movies');
	}


}