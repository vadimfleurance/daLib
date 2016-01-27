<?php

namespace Controller;

use \W\Controller\Controller;

class MovieController extends Controller
{
	public function searchAjax()
	{
		$movieManager = new \Manager\MovieManager();
		$moviesFound = $movieManager->searchAjax();
		$this->show('movie/search_ajax', ["moviesFound" => $moviesFound, "searchUrl" => "http://www.imdb.com/find?ref_=nv_sr_fn&q=" . $_GET["search-input"] . "&s=all"]);
	}
}