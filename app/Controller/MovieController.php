<?php

namespace Controller;

use \W\Controller\Controller;

class MovieController extends Controller
{
	public function searchMovie()
	{
		$this->show('movie/search');
	}
}