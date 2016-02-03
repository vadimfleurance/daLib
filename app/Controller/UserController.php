<?php

namespace Controller;

use \W\Controller\Controller;

class UserController extends Controller
{
	public function userProfile()
	{
		$userManager = new \Manager\UserManager();
		$user = $this->getUser();

		$id = $user['id'];

		$username = 	$user['username'];
		$email    = 	$user['email'];

		$updatedRows = [
			'username' => [],
			'email' => []
		];

		$errors = [
			"username" => [],
			"email" => [],
			"password" => [],
			"total" => [],
			];

		if ( $_POST ) {

			if ( !empty( $_POST['action']['modify'] )) {
			
				$newUsername = 		$_POST['user']['username'];
				$newEmail = 		$_POST['user']['email'];
				$newPassword = 		$_POST['user']['password'];
				$newPasswordBis = 	$_POST['user']['passwordBis']; 

				$isValidNewUsername 	= true;
				$isValidNewEmail 		= true;
				$isValidNewPasswords 	= true;

				/**************************************************
				*
				*	USERNAME
				*
				**************************************************/
				if ( $username != $newUsername ) {
					// On vérifie que le champs n'est pas vide 
					if ( empty( $newUsername )  ) {
						$isValidNewUsername = false;
						$errors['username'][] = "Veuillez renseigner un nom d'utilisateur. " ;
					}

					// On vérifie la longueur du username
					elseif ( ( strlen( $newUsername ) < 4 ) ) {
						$isValidNewUsername = false;
						$errors['username'][] = "Votre nom d'utilisateur doit avoir 4 caractères minimum. " ;
					}

					$regNewUsername = "!^[0-9\p{L}]{1}[0-9\p{L}._-]{3,}$!";

					// On vérifie que le username n'a pas de caractères spéciaux				
					if ( !preg_match( $regNewUsername , $newUsername ) ) {
						$isValidNewUsername = false;
						$errors['username'][] = "Votre nom d'utilisateur ne doit pas commencer par un caractère spécial. ";
					}

					// On vérifie que le username n'existe pas en BDD
					if ( $userManager->usernameExists( $newUsername ) ) {
						$isValidNewUsername = false;
						$errors['username'][] = "Choisissez un autre nom d'utilisateur, celui-ci est déjà utilisé ! " ;
					}

					if ( $isValidNewUsername ) {
						$userManager->update([
							'username' => $newUsername,
							'dateModified' => date("Y-m-d H:i:s")
						], $id );
						$updatedRows['username'][] = "Le pseudonyme a été modifié correctement ! " ;

						$refreshUser = new \W\Security\AuthentificationManager();
						$refreshUser->refreshUser();
					}
				}
				
				/**************************************************
				*
				*	EMAIL
				*	
				**************************************************/ 
				if ( $email != $newEmail ) {
					// On vérifie que le champs n'est pas vide
					if ( empty( $newEmail ) ) {
						$isValidNewEmail = false;
						$errors['email'][] = "Veuillez renseigner une adresse email. " ;
					}

					// On vérifie que l'email est valide
					elseif ( !filter_var( $newEmail , FILTER_VALIDATE_EMAIL ) ) {
						$isValidNewEmail = false;
						$errors['email'][] = "Votre adresse email n'est pas valide. ";
					}

					// On vérifie qu'il n'existe pas en BDD
					elseif ( $userManager->emailExists( $newEmail ) ) {
						$isValidNewEmail = false;
						$errors['email'][] = "Choisissez une autre adresse email, celle-ci est déjà utilisée ! " ;
					}

					if ( $isValidNewEmail ) {
						$userManager->update([
							'email' => $newEmail,
							'dateModified' => date("Y-m-d H:i:s")
						], $id );
						$updatedRows['email'][] = "L'email a été modifié correctement ! " ;
						
						$refreshUser = new \W\Security\AuthentificationManager();
						$refreshUser->refreshUser();
					}
				}

				/**************************************************
				*
				* 	PASSWORD 
				*
				**************************************************/
				// On vérifie qu'ils ne sont pas vides
				if ( !empty( $newPassword ) || !empty( $newPasswordBis ) ) {
					
					// On vérifie la longueur du password
					if ( ( strlen( $newPassword ) < 8 ) ) {
						$isValidNewPasswords = false;
						$errors['password'][] = "Votre mot de passe doit avoir 8 caractères minimum! " ;
					}

					// On vérifie que les deux password sont bien identiques
					if ( $newPassword != $newPasswordBis ) {
						$isValidNewPasswords = false;
						$errors['password'][] = "Vos mots de passe ne sont pas identiques. " ;
					}
					
					if ( $isValidNewPasswords ) {

						$userManager->update([
							'password' => password_hash( $newPassword , PASSWORD_DEFAULT ),
							'dateModified' => date("Y-m-d H:i:s")
						], $id );
						$updatedRows['password'][] = "Le password a été modifié correctement ! " ;
						
						$refreshUser = new \W\Security\AuthentificationManager();
						$refreshUser->refreshUser();
					}				
				}
			}
		}
		$user = $userManager->find($id);
		$this->show( 'user/profile', [
			"user" => $user,
			"errors" => $errors,
			"updatedRows" => $updatedRows
		]);
	}
}