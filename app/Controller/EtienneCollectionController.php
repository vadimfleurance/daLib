<?php

namespace Controller;

use \W\Controller\Controller;

class EtienneCollectionController extends Controller
{
	public function accessTo()
	{
		$this->allowTo([ 'user' , 'admin' ]);
		$this->show('user/collection');
	}
}