<?php

namespace Controller;

use \W\Controller\Controller;

class RegistrationController extends Controller
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
			"total" => [],
			];

		// Est testé si la soumission du formulaire est exécutée ou non
		if ( $_POST )
		{	
			if ( !empty( $_POST['action']['register']) )
			{
				$username =	 	$_POST['user']['username'];
				$email = 		$_POST['user']['email'];
				$password = 	$_POST['user']['password'];
				$passwordBis = 	$_POST['user']['passwordBis'];

				/**************************************************
				*
				* 	VALIDATION DES DONNEES
				*
				**************************************************/
				// On initialise la variable "$isValid" à "true".
				// Elle permet d'identifier lorsque les erreurs surviennent.
				// Elle est utilisée à la fin, si elle reste à true alors 
				// les données sont encovoyées en BDD.
				$isValid = true;

				// Création d'un nouvel objet UserManager()
				$userManager = new \Manager\UserManager();
				

				/**************************************************
				*
				*	USERNAME
				*
				**************************************************/
				// On vérifie que le champs n'est pas vide 
				if ( empty( $username ) )
				{
					$isValid = false;
					$errors['username'][] = "Veuillez renseigner un nom d'utilisateur. " ;
				}

				// On vérifie la longueur du username
				elseif ( ( strlen( $username ) < 4 ) )
				{
					$isValid = false;
					$errors['username'][] = "Votre nom d'utilisateur doit avoir 4 caractères minimum. " ;
				}

				// Le username doit commencer par une lettre(avec accent ou non) ou un chiffre, les autres caractères ne sont pas autorisés
				// Le username est ensuite composé de minimum 3 caractères en plus comprenant : chiffres, lettres (accent ou non), tiret, underscore
				$regUserName = "!^[0-9\p{L}]{1}[0-9\p{L}._-]{3,}$!";

				// On vérifie que le username n'a pas de caractères spéciaux				
				if ( !preg_match( $regUserName , $username ) )
				{
					$isValid = false;
					$errors['username'][] = "Votre nom d'utilisateur ne doit pas commencer par un caractère spécial. ";
				}

				// On vérifie que le username n'existe pas en BDD
				if ( $userManager->usernameExists( $username ) )
				{
					$isValid = false;
					$errors['username'][] = "Choisissez un autre nom d'utilisateur, celui-ci est déjà utilisé ! " ;
				}


				/**************************************************
				*
				*	EMAIL
				*	
				**************************************************/ 
				// On vérifie que le champs n'est pas vide
				if ( empty( $email ) )
				{
					$isValid = false;
					$errors['email'][] = "Veuillez renseigner une adresse email. " ;
				}

				// On vérifie que l'email est valide
				elseif ( !filter_var( $email , FILTER_VALIDATE_EMAIL ) )
				{
					$isValid = false;
					$errors['email'][] = "Votre adresse email n'est pas valide. ";
				}

				// On vérifie qu'il n'existe pas en BDD
				elseif ( $userManager->emailExists( $email ) )
				{
					$isValid = false;
					$errors['email'][] = "Choisissez une autre adresse email, celle-ci est déjà utilisée ! " ;
				}


				/**************************************************
				*
				* 	PASSWORD 
				*
				**************************************************/
				// On vérifie qu'ils ne sont pas vides
				if ( empty( $password ) || empty( $passwordBis ) )
				{
					$isValid = false;
					$errors['password'][] = "Vos mots de passe ne sont pas renseignés. " ;
				}

				// On vérifie la longueur du password
				elseif ( ( strlen( $password ) < 8 ) )
				{
					$isValid = false;
					$errors['password'][] = "Votre mot de passe doit avoir 8 caractères minimum! " ;
				}

				// On vérifie que les deux password sont bien identiques
				if ( $password != $passwordBis )
				{
					$isValid = false;
					$errors['password'][] = "Vos mots de passe ne sont pas identiques. " ;
				}


				/**************************************************				
				*
				*	ENVOIE EN BDD
				*
				**************************************************/
				// Si la variable "$isValid" est restée à "true" alors l'envoie en BDD est effectué.
				// Sinon, est ecrit un message d'erreur en dessous du formulaire indiquant la
				// marche à suivre.
				if( $isValid )
				{
					/** 
					*	Insertion en BDD
					*/
					$userManager->insert([
						"username" 		=> $username,
						"email" 		=> $email,
						"password"		=> password_hash( $password, PASSWORD_DEFAULT ),
						"dateCreated" 	=> date( "Y-m-d H:i:s" )
						]);


					/**
					*	Connexion de l'utilisateur
					*/
					// On va chercher dans la BDD toutes les informations de l'utilisateur,
					// pour pouvoir les passer en arguments de la fonction "->logUserIn()" 
					// dans la variable "$user".
					$user = $userManager->getUserByUsernameOrEmail($username);
						
					// On le log directement une fois le formulaire correctement rempli
					// On crée un objet "$authManager" en instance de "AuthentificationManager.php"
					$authManager = new \W\Security\AuthentificationManager();
					// On appelle la fonction "->logUserIn($user)" sur l'objet précédemment instancé
					// pour pouvoir le connecter.
					$authManager->logUserIn( $user );

					/**
					* 							/!\ 
					*	LogOut volontaire tant que le bouton LogOut inexistant
					*/
									// $authManager->logUserOut( $user );
					/**
					* 							/!\
					*/			

					/**
					*	Redirection une fois créé en BDD et une fois connecté
					*/
					// On appelle la méthode "success" (présente en dessous), elle peut paraître
					// inutile vu son contenu mais dans un futur où on voudrait gérer un envoie de mail
					// (par exemple), elle deviendrait alors justifiée.
					$this->redirectToRoute('registration_success');
				}
				else
				{	
					// Message d'erreur affiché en dessous du formulaire indiquant les champs non renseignés
					$errors['total'][] = "Veuillez remplir correctement le formulaire en suivant les indications présentes en dessous des champs correspondant. " ;
				}
			}
		}
		// Indique le template à afficher avec le tableau d'erreur "$errors" passer en argumant
		$this->show('default/register', [
			"errors" => $errors,
			]);
	}

	public function success()
	{
		// On appelle le template "user/registration-confirmation" afin d'afficher la bonne réussite 
		// de l'inscription de l'utilisateur
		$this->show('user/registration-confirmation');	
	}
}