<?php

namespace Security;


class EmailSender
{

	public function sendResetPasswordLink( $user )
	{			
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
		$mail->setFrom('contact.dalib@gmail.com', 'daLib : Password forgotten');

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
		$resetLink = \W\Controller\Controller::generateUrl('new_password', [
			'tokenPassword' => $tokenPassword,
			'id' => $user['id']
			], true );

		// On hash le token généré pour plus de sécurité et on le stock en BDD 
		// il va nous servir pour vérifier que le mail n'est pas tombé entre de mauvaises mains
		$userManager = new \Manager\UserManager();
		
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
}