<?php

namespace Controller;

use \W\Controller\Controller;

class UserController extends Controller
{
	/**
	*	Inscription de l'utilisateur
	*/

	public function register()
	{
		 
		$errors = [
			"username" => "",
			"email" => "",
			"password" => ""
			];

		if ( $_POST )
		{	
			if ( !empty( $_POST['action']['register']) )
			{
				$username =	 	$_POST['user']['username'];
				$email = 		$_POST['user']['email'];
				$password = 	$_POST['user']['password'];
				$passwordBis = 	$_POST['user']['passwordBis'];

				//Validation des données
				$isValid = true;

				// Création d'un nouvel objet UserManager() afin de pouvoir accéder aux méthodes : 
				// 		->usernameExists() et ->emailExists()
				$userManager = new \Manager\UserManager();
				
				// Validation du username 
				if ( $userManager->usernameExists( $username ) )
				{
					$isValid = false;
					$errors['username'] = "Choisissez un autre nom d'utilisateur, celui-ci est déjà utilisé !";
				}

				// Validation de l'email
				if ( $userManager->emailExists( $email ) )
				{
					$isValid = false;
					$errors['email'] = "Choisissez une autre adresse email, celle-ci est déjà utilisée !";
				}

				// Validation des mots de passe identiques
				if ( $password != $passwordBis )
				{
					$isValid = false;
					$errors['password'] = "Les mots de passe ne sont pas identiques";
				}

				// Validation du mots de passe
				if ( empty( $password ) || empty( $passwordBis ) )
				{
					$isValid = false;
					$errors['password'] = "Les mots de passe ne sont pas renseignés";
				}




				if( $isValid )
				{
					// On insert en BDD
					$userManager->insert([
						"username" => $username,
						"email" => $email,
						"password" => password_hash($password, PASSWORD_DEFAULT),
						"dateCreated" => date( "Y-m-d H:i:s" )
					]);

					// On redirige vers l'accueil
					$this->redirectToRoute('home');	
				}
				else
				{
					$errors = [
						"username" => "Un nom d'utilisateur doit être renseigné",
						"email" => "Une adresse email doit être renseignée",
						"password" => "Le mot de passe doit être saisie et confirmé dans le deuxième champs"
					];
				}
			}
		}
		$this->show('default/register', [
			"errors" => $errors,
		]);
	}
}