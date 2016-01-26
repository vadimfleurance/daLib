<?php

namespace Controller;

use \W\Controller\Controller;

class MovieController extends Controller
{
	public function searchAjax()
	{
		$movieManager = new \Manager\MovieManager();
		$MoviesFound = $movieManager->searchAjax();
		$this->show('movie/search_ajax', $moviesFound);
	}
}