<?php
namespace Controller;
use \W\Controller\Controller;

class MovieController extends Controller
{
	public function movieDetails($id)
	{
		$movieManager = new \Manager\MovieManager;
		
		$movieManager->getInfos($id);
	}
}