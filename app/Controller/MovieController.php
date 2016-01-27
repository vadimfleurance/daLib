<?php
namespace Controller;
use \W\Controller\Controller;

class MovieController extends Controller
{
	public function movieDetails($id)
	{
		$movieManager = new \Manager\MovieManager;
		
		$movie = $movieManager->getInfos($id);
		$this->show('movie/details', ['movie' => $movie]);
	}
}