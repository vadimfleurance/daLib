<?php
namespace Controller;

use \W\Controller\Controller;
class CollectionController extends Controller
{
	public function addToCollection()
	{	
		$bool = $_POST['bool'];
		$idMovie = $_POST['idMovie']
		$user= $this->getUser();
		$idUser =$user['id'];

		$mUM = new \Manager\MoviesUsersManager; 
		/*echo */$result = $mUM->collect();

	}
}