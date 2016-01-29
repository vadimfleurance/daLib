<?php
namespace Controller;

use \W\Controller\Controller;
class CollectionController extends Controller
{
	public function manageCollection()
	{	

		$bool = (bool) $_POST['bool'];
		$idMovie = $_POST['idMovie'];
		$user= $this->getUser();
		$idUser =$user['id'];
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

}