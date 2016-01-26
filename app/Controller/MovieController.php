<?php

namespace Controller;

use \W\Controller\Controller;

class MovieController extends Controller
{
	public function search()
	{
		$movieManager = new \Manager\MovieManager();
		$this->show('movie/search');
	}
}