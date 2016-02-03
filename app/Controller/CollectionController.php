<?php
namespace Controller;

use \W\Controller\Controller;
class CollectionController extends Controller
{
	public function manageCollection()
	{	
		$this->allowTo([ 'user' , 'admin' ]);

		// $bool = (bool) $_POST['bool'];
		// $idMovie = (int) $_POST['idMovie'];
		// $user= $this->getUser();
		// $idUser = (int) $user['id'];
		// //var_dump($bool);

		// $mUM = new \Manager\MoviesUsersManager; 

		// if($bool == true) {
		// 	$result = $mUM->collect($idMovie, $idUser);

		// }
		// else if($bool == false) {
		// 	$result = $mUM->remove($idMovie, $idUser);
		// }

		$idMovie = (int) $_POST['idMovie'];
		$user = $this->getUser();
		$idUser = (int) $user['id'];

		$moviesUserManager = new \Manager\MoviesUsersManager;
		$isPresent = $moviesUserManager->isPresent($idMovie, $idUser);
		($isPresent) ? $moviesUserManager->removeToCollection($idMovie, $idUser) : $moviesUserManager->addToCollection($idMovie, $idUser);

	}
	public function manageStatus()
	{	
		$this->allowTo([ 'user' , 'admin' ]);

		$status = $_POST['status'];
		$idMovie = $_POST['idMovie'];
		$user= $this->getUser();
		$idUser =$user['id'];

		$mUM = new \Manager\MoviesUsersManager;
		$value = $mUM->getSingleStatus($idMovie, $idUser, $status);

		if($value == 0 OR $value == NULL){
			$mUM->setStatus($status, 1 , $idMovie, $idUser);
		}
		else{
			$mUM->setStatus($status, 0 , $idMovie, $idUser);
		}
	}

	//affiche la page connection
	public function showCollection($cPage = 1)
	{
		$this->allowTo([ 'user' , 'admin' ]);

		//recupere l'id de l'utilisateur connecté
		$user = $this->getUser();

		//$class = $this->btnClass; 

		$idUser = (int) $user['id'];

		//récupere la collection de l'utilisateur connecté tableau/sous tableau voir la fonction getEntireCollection pour l'architecture
		$mUM = new \Manager\MoviesUsersManager;
		//compte le total de film de la collection
		$totalMovies = $mUM->countCollection($idUser);
		
		//definition des variables de pagination
		$perPage = 24;
		$nbPages = ceil($totalMovies / $perPage);
		//limite la mauvaise utilisation de l'id de page dans l'url
		

		//appel de recuperation de collection
		$collection = $mUM->getEntireCollection($idUser,$totalMovies, $cPage, $perPage);
		//affichage de la page
		if (!empty($collection['movies'])){
			if($cPage > $nbPages){
				//Si le num de la page courante est superieure au nb de page total, redirection  vers la 404
				$this->showNotFound();
			}
			$this->show('collection/collection', [
													'collection' => $collection ,
													'nbPages'	=> $nbPages,
													'cPage' =>$cPage
												 ]);			
		}

		else{
			$this->redirectToRoute("show_suggestion");
		}

	}//end of method
	public function showSuggestion($cPage = 1)
	{
		$this->allowTo([ 'user' , 'admin' ]);
		$user = $this->getUser();
		$idUser = (int) $user['id'];

		$movieManager = new \Manager\MovieManager;
		$allMovies = $movieManager->countAllMovies($idUser);
		
		$perPage = 24;
		$nbPages = ceil($allMovies / $perPage);
		$suggestion = $movieManager->getSuggestion($idUser,$cPage, $perPage);
		
		$this->show('collection/suggestion', [
												'suggestion' => $suggestion,
												'nbPages'	=> $nbPages,
												'cPage' =>$cPage
												
											 ]);

	}
	

}//end of class