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
			"username" => [],
			"email" => [],
			"password" => [],
			"total" => []
			];

		if ( $_POST )
		{	
			if ( !empty( $_POST['action']['register']) )
			{
				$username =	 	$_POST['user']['username'];
				$email = 		$_POST['user']['email'];
				$password = 	$_POST['user']['password'];
				$passwordBis = 	$_POST['user']['passwordBis'];

				/** 
				* 	VALIDATION DES DONNEES
				*/
				$isValid = true;

				/**
				*	Création d'un nouvel objet UserManager() afin de pouvoir accéder aux méthodes : 
				*				 	->usernameExists() et ->emailExists()
				*/ 	
				$userManager = new \Manager\UserManager();
				
				/**
				*	USERNAME
				*/  
				// On vérifie la longueur du username
				if ( ( strlen( $username ) < 4 ) )
				{
					$isValid = false;
					$errors['username'][] = "le nom d'utilisateur doit avoir 4 caractères minimum. " ;
				}

				// On vérifie que le username n'a pas de caractères spéciaux
				// le username doit commencer par une lettre(avec accent ou non) ou un chiffre, les autres caractères ne sont pas autorisés
				// le username est ensuite composé de minimum 3 caractères en plus comprenant : chiffres, lettres (accent ou non), tiret, underscore
				$regUserName = "!^[0-9\p{L}]{1}[0-9\p{L}._-]{3,}$!";
				if ( !preg_match( $regUserName , $username ) )
				{
					$isValid = false;
					$errors['username'][] = "Votre nom d'utilisateur ne doit pas commencer par un caractère spécial. ";
				}


				// On vérifie que le username n'existe pas en BDD
				if ( $userManager->usernameExists( $username ) )
				{
					$isValid = false;
					$errors['username'][] = "Choisissez un autre nom d'utilisateur, celui-ci est déjà utilisé !" ;
				}

				/**
				*	EMAIL
				*/ 
				// On vérifie que l'email est valide
				if ( !filter_var( $email , FILTER_VALIDATE_EMAIL ) )
				{
					$isValid = false;
					$errors['email'][] = "L'adresse email renseignée n'est pas valide. ";
				}

				// On vérifie qu'il n'existe pas en BDD
				if ( $userManager->emailExists( $email ) )
				{
					$isValid = false;
					$errors['email'][] = "Choisissez une autre adresse email, celle-ci est déjà utilisée !" ;
				}

				/**
				* 	PASSWORD 
				*/
				// On vérifie la longueur du password
				if ( ( strlen( $password ) < 8 ) )
				{
					$isValid = false;
					$errors['password'][] = "Le mot de passe doit avoir 8 caractères minimum !" ;
				}

				// On vérifie que les deux password sont bien identiques
				if ( $password != $passwordBis )
				{
					$isValid = false;
					$errors['password'][] = "Les mots de passe ne sont pas identiques. " ;
				}

				// On vérifie qu'ils ne sont pas vides
				if ( empty( $password ) || empty( $passwordBis ) )
				{
					$isValid = false;
					$errors['password'][] = "Les mots de passe ne sont pas renseignés. " ;
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
					$errors['total'][] = "Tous les champs doivent être rempli." ;
				}
			}
		}
		$this->show('default/register', [
			"errors" => $errors,
		]);
	}
}