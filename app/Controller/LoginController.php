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
		if ( $this->getUser() ) {

			$this->redirectToRoute('show_collection');
		}

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

					// On check si la checkbox "Remember Me" présente sur le formulaire de login est coché ou non.
					// Si la checkbox est coché :
					if ( isset( $_POST['user']['rememberMe'] )) {

						// On crée un token avec la méthode "randomString()" de 32 caractères
						$tokenCookie = \W\Security\StringUtils::randomString(32);

						// Ce token est hashé et stocké en BDD
						$hashedTokenCookie = password_hash( $tokenCookie , PASSWORD_DEFAULT);
						$userManager->update([
										'sessionToken' => $hashedTokenCookie,
										], $user['id']
									);
						
						// Afin de pouvoir passer en argument le token et l'id de l'utilisateur 
						// on encode en "json" la tableau comprenant ces deux paramètres. 
						// En effet, dans la fonction "setcookie" le deuxième paramètre ne peut pas recevoir un tableau.
						$cookieValues = json_encode([
											'token' => $tokenCookie,
											'id' => $user['id']
										]);
					
						// On crée le cookie de connexion, est passé en argument "$cookieValues" (tableau encodé en json).
						setcookie('daLib_remember_me' , $cookieValues , time()+(60*60*24*30) , '/' );
					}

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
		}
		// On affiche le template "default/login.php" en passant en argument le tableau "$errors" afin de pouvoir y afficher les erreurs.
		$this->show('default/login', [
			"errors" => $errors,
			]);
	}

	public function logOut()
	{
		// On instancie un nouvel objet "$authManager"
		$authManager = new \W\Security\AuthentificationManager();
		
		// On se sert de cet objet afin de pouvoir appeler la méthode 
		// "->logUserOut()" pour pouvoir déconnecter l'utilisateur.
		$authManager->logUserOut();

		//On vide le cookie de session
		setcookie('daLib_remember_me', '', 0, '/');

		// On redirige vers la page d'accueil une fois déconnecté.
		$this->redirectToRoute('home');
	}


	public function forgotPassword()
	{
		if ( $this->getUser() ) {

			$this->redirectToRoute('show_collection');
		}
		
		//Initialisation du tableau des erreurs.
		$errors = [
			'total' => []
		];

		/**
		*	Création de "$user" via l'email saisie dans l'input
		*/
		if ( $_POST ) {

			// On met dans la variable le mail saisi dans l'input
			$email = $_POST['emailForgotPasswordInput'];

			// On vérifie que le mail existe
			$userManager = new \Manager\UserManager();

			// On crée la variable "$user" dans laquelle on a toutes les infos de l'utilisateur
			$user = $userManager->getUserByUsernameOrEmail( $email );

			if ( !$user ) {
				// On mets un message d'erreur dans le tableau, et on l'envoi dans le template en argument
				$errors['total'][] = "Cet email n'existe pas dans notre registre ! Veuillez recommencer. ";
			}
		}

		/**
		*	Oubli du mot de passe
		*/
		if ( isset( $user )) {

		/**************************************************
		*
		* 	ENVOIE DU MAIL
		*
		**************************************************/
			
		/**
		*	Configuration PHP Mailer
		*/
			//On crée un nouvel objet phpMailer
			$mail = new \PHPMailer;
			
			// On initialise l'objet pour qu'il utilise SMTP
			$mail->isSMTP();
			
			// On désactive l'option de débug
			$mail->SMTPDebug = 0;
			
			// Ecriture en html du debug, ici inutile car on a enlevé le debug
			$mail->Debugoutput = 'html';
			
			// On définit le serveur de mails
			$mail->Host = 'smtp.gmail.com';
			
			// On passe par le port 587 => gmail.com
			$mail->Port = 587;

			// On passe le SMTP en 'tls', type d'encodage pour la sécurité
			$mail->SMTPSecure = 'tls';

			// On active l'authentification SMTP
			$mail->SMTPAuth = true;

			// Le login de compte de mail, ici pour gmail c'est l'adresse complète
			$mail->Username = "contact.dalib@gmail.com";

			// Le mot de passe du compte gmail 
			$mail->Password = "merciwebforce3";

			// L'adresse d'envoie
			$mail->setFrom('contact.dalib@gmail.com', 'daLIb : Password forgotten');

			// Les detinatires des mails qui seront envoyés. On récupère l'email de l'utilisateur ainsi que son nom d'utilisateur
			$mail->addAddress( $user['email'] , $user['username'] );

			// L'objet du mail
			$mail->Subject = 'daLib.com - New password Request';


		/**
		*	Création du lien de réinitialisation du mot de passe
		*/
			// On crée un token pour identitifier la demande, 
			// ce token est complété par l'id dans l'url du lien envoyé. 
			$tokenPassword = \W\Security\StringUtils::randomString(32);

			// On génère l'url (lien de réinitialisation) avec avec comme argument :
			// la route, le token, l'id de l'utilisateur et le $strip_tags passé à true pour l'activer
			$resetLink = $this->generateUrl('new_password', [
				'tokenPassword' => $tokenPassword,
				'id' => $user['id']
				], true );

			// On hash le token généré pour plus de sécurité et on le stock en BDD 
			// il va nous servir pour vérifier que le mail n'est pas tombé entre de mauvaises mains
			$hashedTokenPassword = password_hash( $tokenPassword , PASSWORD_DEFAULT);
			$userManager->update([
				'passwordToken' => $hashedTokenPassword,
				], $user['id']);

		/**
		*	Envoie du mail S.S.
		*/
			// On injecte dans le mail le lien de réinitialisation
			$mail->msgHTML( $resetLink );
			$mail->send();
		}
		// On appelle le template avec les erreurs.
		$this->show('user/forgot-password', [
				"errors" => $errors,
			]);
	}


	public function newPassword( $tokenPassword, $id )
	{
		if ( $this->getUser() ) {

			$this->redirectToRoute('show_collection');
		}
		
		//Initialisation du tableau des erreurs.
		$errors = [
			"password" => [],
			"total" => []
			];
		
		if ( $_POST ) {

			if ( !empty($_POST['action']['sendRequest']) ) {

				$userManager = new \Manager\UserManager();
				$user = $userManager->find($id);
			
				$newPassword 	= $_POST['user']['newPassword'];
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
				if ( $isValid ) {

					if ( password_verify( $tokenPassword, $user['passwordToken'] )) {

						/** 
						*	Insertion en BDD
						*/
						$userManager->update([
							'passwordToken' => "",
							'password' 		=> password_hash( $newPassword , PASSWORD_DEFAULT ), 
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
			}
			$this->show('user/new-password', [
				"errors" => $errors,
				]);
		}
		$this->show('user/new-password');
	}
}