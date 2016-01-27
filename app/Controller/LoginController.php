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


	public function forgotPassword()
	{
		if ( $_POST ){

			$email = $_POST['emailForgotPasswordInput'];

			// Vérifie qu'il existe
			$userManager = new \Manager\UserManager();
			$user = $userManager->getUserByUsernameOrEmail( $email );
		}

		if ( isset($user) ) {

			/**************************************************
			*
			* 	PHP MAILER
			*
			**************************************************/
			date_default_timezone_set('Etc/UTC');

			$mail = new \PHPMailer;
			
			$mail->isSMTP();
			
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug = 0;
			
			//Ask for HTML-friendly debug output
			$mail->Debugoutput = 'html';
			
			//Set the hostname of the mail server
			$mail->Host = 'smtp.gmail.com';
			
			// use
			// $mail->Host = gethostbyname('smtp.gmail.com');
			// if your network does not support SMTP over IPv6
			//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
			$mail->Port = 587;

			//Set the encryption system to use - ssl (deprecated) or tls
			$mail->SMTPSecure = 'tls';

			//Whether to use SMTP authentication
			$mail->SMTPAuth = true;

			//Username to use for SMTP authentication - use full email address for gmail
			$mail->Username = "contact.dalib@gmail.com";

			//Password to use for SMTP authentication
			$mail->Password = "merciwebforce3";

			//Set who the message is to be sent from
			$mail->setFrom('contact.dalib@gmail.com', 'Contact');

			//Set who the message is to be sent to
			$mail->addAddress( $user['email'] , $user['username'] );

			//Set the subject line
			$mail->Subject = 'PHPMailer GMail SMTP test';

			$token = \W\Security\StringUtils::randomString(32);

			$userManager->update([
				'token' => $token,
				'dateModified' => date('Y-m-d H:i:s')
				], $user['id']);

			$resetLink = $this->generateUrl('new_password', [
				'token' => $token,
				'id' => $user['id']
				], true );
			
			//Read an HTML message body from an external file, convert referenced images to embedded,
			//convert HTML into a basic plain-text alternative body
			$mail->msgHTML( $resetLink );

			/**
			*	MESSAGE D'ERREURS !
			*/
			//send the message, check for errors
			// if (!$mail->send()) {
			//     echo "Mailer Error: " . $mail->ErrorInfo;
			// } 
			// else {
			//     echo "Message sent!";
			// }
			$mail->send();
		}
		$this->show('user/forgot-password');
	}


	public function newPassword( $token, $id )
	{
		$errors = [
			"password" => [],
			"total" => []
			];


		if ( $_POST ) {

			if ( !empty($_POST['action']['sendRequest']) ) {

				$userManager = new \Manager\UserManager();
				$user = $userManager->find( $id );
			
				$newPassword = $_POST['user']['newPassword'];
				$newPasswordBis = $_POST['user']['newPasswordBis'];

				$isValid = true;

				/**************************************************
				*
				* 	NEW PASSWORD 
				*
				**************************************************/
				// On vérifie qu'ils ne sont pas vides
				if ( empty( $newPassword ) || empty( $newPasswordBis ) ) {
					$isValid = false;
					$errors['password'][] = "Vos mots de passe ne sont pas renseignés. " ;
				}

				// On vérifie la longueur du password
				elseif ( ( strlen( $newPassword ) < 8 ) ) {
					$isValid = false;
					$errors['password'][] = "Votre mot de passe doit avoir 8 caractères minimum! " ;
				}

				// On vérifie que les deux password sont bien identiques
				if ( $newPassword != $newPasswordBis ) {
					$isValid = false;
					$errors['password'][] = "Vos mots de passe ne sont pas identiques. " ;
				}

				/**************************************************				
				*
				*	ENVOIE EN BDD
				*
				**************************************************/
				if ( $token === $user['token'] || $isValid ) {

					/** 
					*	Insertion en BDD
					*/
					$userManager->update([
						'token' 		=> "",
						'password' 		=> password_hash( $newPassword , PASSWORD_DEFAULT), 
						'dateModified' 	=> date('Y-m-d H:i:s')
						], $user['id'] );

					$authManager = new \W\Security\AuthentificationManager();

					$user = $userManager->find( $user['id'] );
					$authManager->logUserIn( $user );
					
					// $this->redirectToRoute('home');
				} 
				else {
					$errors['total'][] = "Veuillez remplir correctement le formulaire en suivant les indications présentes en dessous des champs correspondant. " ;
				}
			}
			$this->show('user/new-password', [
				"errors" => $errors,
				]);
		}
		$this->show('user/new-password');
	}


	public function rememberMe()
	{
		
	}

}