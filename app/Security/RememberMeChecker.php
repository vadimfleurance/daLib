<?php

namespace Security;

class RememberMeChecker
{
	public function check()
	{	
		// On crée l'objet $authManager pour savoir si un utilisateur est loggé
		$authManager = new \W\Security\AuthentificationManager();
		$loggedUser = $authManager->getLoggedUser();

		// Si l'utilisateur est déjà connecté...
		if ( $loggedUser ) {
			return true;
		}

		// Si on a un cookie de daLib_remember_me dans le navigateur
		if ( !empty( $_COOKIE['daLib_remember_me'] )) {
			
			// Check en BDD que les données sont les bonnes
			$cookieData = json_decode( $_COOKIE['daLib_remember_me'] , true );

			// On crée un nouvel objet "$userManager" 
			// afin de pouvoir retrouver l'utilisateur via l'id stocké dans le cookie
			$userManager = new \Manager\UserManager();
			$user = $userManager->find( $cookieData['id'] );

			$tokenCookie = $cookieData['token'];
			$hashedTokenCookie = $user['sessionToken'];

			// verifier si le token dans le cookie correspond au hash stocké en BDD
			if ( password_verify( $tokenCookie , $hashedTokenCookie )) {
				
				$authManager->logUserIn( $user );
				return true;
			}
			else {
				//efface le cookie erroné
				setcookie('daLib_remember_me', '', 0, '/');
				return false;
			}
		}
		return false;
	}
}