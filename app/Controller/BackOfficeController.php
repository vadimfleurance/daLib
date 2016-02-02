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
		$this->show('back_office/back-office-home');
	}

	public function scrapperHome()
	{
		$this->allowTo('admin');
		
		$this->show('back_office/loading-scrapper');
	}

	public function launchScrapper()
	{
		$this->allowTo('admin');
		
		$scrapperController  = new ScraperController();
		$movies = $scrapperController->globalScraper();
		
		$this->show('back_office/loading-scrapper');
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

	public function deleteUser( $id )
	{
		$this->allowTo('admin');

		$userManager = new \Manager\UserManager();
		$user = $userManager->find( $id );		

		$userManager->delete( $id );

		$this->show('back_office/delete-user', [
			"user" => $user
			]);
	}

	public function generateNewPasswordUser( $id ) 
	{
		$this->allowTo('admin');

		$userManager = new \Manager\UserManager();
		$user = $userManager->find( $id );	

		$emailSender = new \Security\EmailSender();
		$emailSender->sendResetPasswordLink( $user );

		$this->show('back_office/generate_new_password_user', [
			"user" => $user
		]);
	}

	public function profile( $id )
	{	
		$this->allowTo('admin');

		//Crée une instance de notre gestionnaire
		$userManager = new \Manager\UserManager();
		$user = $userManager->find($id);

		$username = 	$user['username'];
		$email = 		$user['email'];
		$role = 		$user['role'];

		$updatedRows = [
			'username' => [],
			'email' => [],
			'role' =>[]
		];

		if ( $_POST ) {

			if ( !empty( $_POST['action']['modify'] )) {
			
				$newUsername = 	$_POST['user']['username'];
				$newEmail = 	$_POST['user']['email'];
				$newRole = 		$_POST['role'];

				if ( !empty( $newUsername ) && !empty( $newEmail ) && !empty( $newRole )) {

					if ( $username != $newUsername ) {
						$userManager->update([
							'username' => $newUsername,
							'dateModified' => date("Y-m-d H:i:s")
						], $user['id'] );
						$updatedRows['username'][] = "Le pseudonyme a été modifié correctement ! " ;
					}
					
					if ( $email != $newEmail ) {
						$userManager->update([
							'email' => $newEmail,
							'dateModified' => date("Y-m-d H:i:s")
						], $user['id'] );
						$updatedRows['email'][] = "L'email a été modifié correctement ! " ;
					}

					if ( $role != $newRole ) {
						$userManager->update([
							'role' => $newRole,
							'dateModified' => date("Y-m-d H:i:s")
						], $user['id'] );
						$updatedRows['role'][] = "Le role a été modifié correctement ! " ;
					}
				}
			}
			$user = $userManager->find($id);
		}
		$this->show( 'back_office/profile', [
			"user" => $user,
			"updatedRows" => $updatedRows
		]);
	}
			
	public function listMovies()
	{
		$this->allowTo('admin');

		$movieManager = new \Manager\MovieManager();

		$movies = $movieManager->getAllDtbMovies();

		$this->show('back_office/back-office-movies', [
			'movies' => $movies 
		]);
	}


	public function movieDetail( $id )
	{
		$this->allowTo('admin');

		$movieManager = new \Manager\MovieManager();

		$movie = $movieManager->getMovieById( $id );

		$title 		=	$movie['title'];
		$synopsis 	= 	$movie['synopsis'];
		$duration 	= 	$movie['duration'];
		$year 		=	$movie['year'];
		$imdbRef 	=	$movie['imdbRef'];
		$imdbRating = 	$movie['imdbRating'];

		$updatedRows = [
			'title' => [],
			'synopsis' => [],
			'duration' =>[],
			'year' => [],
			'imdbRef' =>[],
			'imdbRating' => []
		];

		if ( $_POST ) {

			if ( !empty( $_POST['action']['modify'])) {
					
					$newTitle 		=	trim($_POST['movie']['title']);
					$newSynopsis 	=	trim($_POST['movie']['synopsis']);
					$newDuration 	= 	trim($_POST['movie']['duration']);
					$newYear 		=	trim($_POST['movie']['year']);
					$newImdbRef 	=	trim($_POST['movie']['imdbRef']);
					$newImdbRating 	= 	trim($_POST['movie']['imdbRating']);

				if ( !empty( $newTitle ) && !empty( $newSynopsis ) && !empty( $newDuration ) 
					&& !empty( $newYear ) && !empty( $newImdbRef ) && !empty( $newImdbRating )) {


					if ( $title != $newTitle ) {
						$rowName = 'title';
						$rowData = $newTitle;
						$updatedMovie = $movieManager->updateRowMovie( $rowName, $rowData, $id );
						$updatedRows['title'][] = "Le titre a été modifié correctement ! " ;
					}


					if ( $synopsis != $newSynopsis ) {
						$rowName = 'synopsis';
						$rowData = $newSynopsis;
						$updatedMovie = $movieManager->updateRowMovie( $rowName, $rowData, $id );
						$updatedRows['synopsis'][] = "Le synopsis a été modifié correctement ! " ;
					}
					
					if ( $duration != $newDuration ) {
						$rowName = 'duration';
						$rowData = $newDuration;
						$updatedMovie = $movieManager->updateRowMovie( $rowName, $rowData, $id );
						$updatedRows['duration'][] = "La durée a été modifiée correctement ! " ;
					}
					
					if ( $year != $newYear ) {
						$rowName = 'year';
						$rowData = $newYear;
						$updatedMovie = $movieManager->updateRowMovie( $rowName, $rowData, $id );
						$updatedRows['year'][] = "L'année a été modifiée correctement ! " ;
					}

					if ( $imdbRef != $newImdbRef ) {
						$rowName = 'imdbRef';
						$rowData = $newImdbRef;
						$updatedMovie = $movieManager->updateRowMovie( $rowName, $rowData, $id );
						$updatedRows['imdbRef'][] = "La référence IMDB a été modifiée correctement ! " ;
					}
					
					if ( $imdbRating != $newImdbRating ) {
						$rowName = 'imdbRating';
						$rowData = $newImdbRating;
						$updatedMovie = $movieManager->updateRowMovie( $rowName, $rowData, $id );
						$updatedRows['imdbRating'][] = "La note IMDB a été modifiée correctement ! " ;
					}
				}
			}
			$movie = $movieManager->getMovieById( $id );
		}
		$this->show('back_office/movie-detail', [
			"movie" => $movie,
			"updatedRows" => $updatedRows
		]);
	}

}