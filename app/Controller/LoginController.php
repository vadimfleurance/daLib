<?php

namespace Controller;

use \W\Controller\Controller;

class LoginController extends Controller
{
	/**
	*	Connexion de l'utilisateur
	*/
	public function logIn()
	{
		//Initialisation du tableau des erreurs.
		$errors = [
			'total' => []
		];

		// Est testé si la soumission du formulaire est exécutée ou non
		if ( $_POST ) {
			
			if ( !empty( $_POST['action']['login'] )) {

				// On récupère les données postées dans des variables.
				$usernameOrEmail = 	$_POST['user']['usernameOrEmail'];
				$password = 		$_POST['user']['password'];

				// On crée les instances de Usermanager() et de AuthentificationManager().
				$userManager = new \Manager\UserManager();
				$authManager = new \W\Security\AuthentificationManager();

				// On teste si les informations rentrées dans le formulaire de login sont valide ou non. 
				// La valeur retournée est l'id de l'utilisateur d'où le nom de variable "$userId".
				$userId = $authManager->isValidLoginInfo( $usernameOrEmail , $password );

				// On test si la valeur de retournée est supérieur à 0. Si oui alors on lance la procédure de connexion. 
				if ( $userId > 0 ) {

					// On stocke dans la variable "$user" toutes les informations liées à l'utilisateur voulant se connecter. 
					$user = $userManager->find( $userId );

					// On lance la procédure de connexion.
					$authManager->logUserIn( $user );

					// On redirige vers la page d'accueil en étant connecté.
					$this->redirectToRoute('home');			
				}
				// Sinon, le couple "$usernameOrEmail"/"$password" est inconnu en BDD et on implémente un message d'erreur dans le tableau "$errors".
				// Ce message d'erreur sera affiché via le fichier "form-login.php".
				else {
					$errors['total'][] = "L'identifiant et/ou le mot de passe saisie n'est pas correct ! Veuillez recommencer. ";
				}
			}
			// On affiche le template "default/login.php" en passant en argument le tableau "$errors" afin de pouvoir y afficher les erreurs.
			$this->show('default/login', [
				"errors" => $errors,
				]);
		}
	}

	public function logOut()
	{
		// On instancie un nouvel objet "$authManager"
		$authManager = new \W\Security\AuthentificationManager();
		
		// On se sert de cet objet afin de pouvoir appeler la méthode 
		// "->logUserOut()" pour pouvoir déconnecter l'utilisateur.
		$authManager->logUserOut();

		// On redirige vers la page d'accueil une fois déconnecté.
		$this->redirectToRoute('home');
	}

	public function rememeberMe()
	{
		
	}

	public function forgotPassword()
	{
		$email = $_POST['email'];

		// Vérifie qu'il existe
		$userManager = new \Manager\UserManager();
		$user = $userManager->getUserByUsernameOrEmail($email);

		if ($user) {

			//phpMailer
			$token = \W\Security\StringUtils::randomString(32);

			$userManager->update([
				'token' => $token,
				'dateModified' => date('Y-m-d H:i:s')
				], $user['id']);

			$resetLink = $this->generateUrl('new_password', [
				'token' => $token,
				'email' => $email
				], true);
		}
	}


	public function newPassword($token, $email)
	{



	}

}