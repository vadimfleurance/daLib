<?php
namespace Controller;

use \W\Controller\Controller;
class CollectionController extends Controller
{
	public function manageCollection()
	{	

		$bool = (bool) $_POST['bool'];
		$idMovie = (int) $_POST['idMovie'];
		$user= $this->getUser();
		$idUser = (int) $user['id'];
		//var_dump($bool);

		$mUM = new \Manager\MoviesUsersManager; 

		if($bool == true) {
			$result = $mUM->collect($idMovie, $idUser);
		}
		else if($bool == false) {
			$result = $mUM->remove($idMovie, $idUser);
		}
	}
	public function manageStatus()
	{	
		$status =$_POST['status'];
		$bool = (bool) $_POST['bool'];
		$idMovie = $_POST['idMovie'];
		$user= $this->getUser();
		$idUser =$user['id'];
		//var_dump($bool);

		$mUM = new \Manager\MoviesUsersManager;
		$mUM->setStatus($status, $bool, $idMovie, $idUser);
	}

	//affiche la page connection
	public function showCollection()
	{
		//recupere l'id de l'utilisateur connecté
		$user= $this->getUser();
		$idUser = (int) $user['id'];

		//récupere la collection de l'utilisateur connecté tableau/sous tableau voir la fonction getEntireCollection pour l'architecture
		$mUM = new \Manager\MoviesUsersManager;
		//compte le total de film de la collection
		$totalMovies = $mUM->countCollection($idUser);


		$collection = $mUM->getEntireCollection($idUser);
		$this->show('collection/collection', ['collection' => $collection ]);


	}
	

}//end of class