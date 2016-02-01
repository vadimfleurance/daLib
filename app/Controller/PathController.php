<?php

// A SUPPRIMER PAR LA SUITE


namespace Controller;

use \W\Controller\Controller;

class PathController extends Controller
{
	public function accessTo()
	{
		$this->allowTo([ 'user' , 'admin' ]);
		$this->show('collection/collection');
	}
}